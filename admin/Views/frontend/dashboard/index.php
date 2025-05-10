<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tmdt";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
include "./Views/partitions/frontend/headerAdmin.php";

// Lấy dữ liệu tổng quan
$totalProducts = $conn->query("SELECT COUNT(*) FROM products")->fetch_row()[0];
$totalOrders = $conn->query("SELECT COUNT(*) FROM orders")->fetch_row()[0];
$lowStock = $conn->query("SELECT COUNT(*) FROM products WHERE SoLuong < 5")->fetch_row()[0];
$recentOrders = $conn->query("SELECT * FROM orders ORDER BY MaDon DESC LIMIT 5")->fetch_all(MYSQLI_ASSOC);

// Xử lý thống kê khách hàng
$topCustomers = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['stats_submit'])) {
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    
    if (!empty($startDate) && !empty($endDate) && $startDate <= $endDate) {
        $sql = "SELECT 
                    u.ID, 
                    u.username, 
                    u.email, 
                    SUM(o.TongTien) as total_spent,
                    COUNT(o.MaDon) as order_count
                FROM 
                    users u
                JOIN 
                    orders o ON u.ID = o.UserID
                WHERE 
                    o.TrangThai = 'đã giao' AND
                    o.NgayDat BETWEEN ? AND ?
                GROUP BY 
                    u.ID
                ORDER BY 
                    total_spent DESC
                LIMIT 5";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $startDate, $endDate);
        $stmt->execute();
        $result = $stmt->get_result();
        $topCustomers = $result->fetch_all(MYSQLI_ASSOC);

        // Lấy chi tiết đơn hàng
        foreach ($topCustomers as &$customer) {
            $sql = "SELECT 
                        o.MaDon, 
                        o.TongTien, 
                        o.NgayDat, 
                        o.TrangThai,
                        COUNT(lp.MaSP) as product_count
                    FROM 
                        orders o
                    JOIN 
                        listproduct lp ON o.MaDon = lp.MaDon
                    WHERE 
                        o.UserID = ? AND
                        o.NgayDat BETWEEN ? AND ?
                    GROUP BY 
                        o.MaDon
                    ORDER BY 
                        o.TongTien DESC";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iss", $customer['ID'], $startDate, $endDate);
            $stmt->execute();
            $customer['orders'] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #eef2f7;
            margin: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            border: none;
        }

        .card-header {
            background-color: #00268c;
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 15px 20px;
        }

        .stats {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat-box {
            flex: 1;
            background: white;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0,0,0,0.05);
            text-align: center;
        }

        .stat-box h3 {
            margin-top: 0;
            color: #555;
            font-size: 16px;
        }

        .stat-box p {
            font-size: 24px;
            margin: 10px 0;
            color: #333;
            font-weight: bold;
        }

        .warning {
            color: #e74c3c;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
        }

        th {
            background-color: #00268c;
            color: white;
            text-transform: uppercase;
            font-size: 14px;
        }

        tr:hover {
            background-color: #f4f8ff;
        }

        .btn-action {
            display: inline-block;
            padding: 6px 12px;
            background-color: white;
            color: #00268c;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s ease;
            border: 1px solid #00268c;
        }

        .btn-action:hover {
            background-color: #00268c;
            color: white;
        }

        .toggle-orders {
            transition: all 0.3s ease;
        }

        .toggle-orders:hover {
            background-color: #00268c;
            color: white;
        }

        .order-details {
            background-color: #f8f9fa;
        }

        .order-details table {
            background-color: white;
            margin: 0;
        }

        .order-details table th {
            background-color: #f8f9fa;
            color: #333;
        }

        .text-end {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4" style="color: #00268c;">Dashboard Quản Trị</h1>
        
        <div class="stats">
            <div class="stat-box">
                <h3>Tổng sản phẩm</h3>
                <p><?php echo $totalProducts; ?></p>
            </div>
            <div class="stat-box">
                <h3>Tổng đơn hàng</h3>
                <p><?php echo $totalOrders; ?></p>
            </div>
            <div class="stat-box">
                <h3>Sản phẩm sắp hết</h3>
                <p class="warning"><?php echo $lowStock; ?></p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0"><i class="bi bi-cart"></i> Đơn hàng gần đây</h4>
                    </div>
                    <div class="card-body">
                        <table>
                            <thead>
                                <tr>
                                    <th>Mã đơn</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recentOrders as $order): ?>
                                    <tr>
                                        <td>#<?php echo $order['MaDon']; ?></td>
                                        <td>
                                            <?php 
                                            // Kiểm tra và hiển thị ngày đặt hàng
                                            if (isset($order['NgayDat']) && !empty($order['NgayDat'])) {
                                                echo date('d/m/Y', strtotime($order['NgayDat']));
                                            } else {
                                                echo 'N/A';
                                            }
                                            ?>
                                        </td>
                                        <td class="text-end">
                                            <?php 
                                            // Kiểm tra và hiển thị tổng tiền
                                            if (isset($order['TongTien'])) {
                                                echo number_format($order['TongTien'], 0, ',', '.') . ' ₫';
                                            } else {
                                                echo '0 ₫';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                            // Kiểm tra và hiển thị trạng thái
                                            echo isset($order['TrangThai']) ? $order['TrangThai'] : 'N/A';
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0"><i class="bi bi-bar-chart"></i> Thống kê khách hàng</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" class="mb-3">
                            <input type="hidden" name="stats_submit" value="1">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="form-label">Từ ngày</label>
                                    <input type="date" name="start_date" class="form-control" required>
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label">Đến ngày</label>
                                    <input type="date" name="end_date" class="form-control" required>
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        
                        <?php if (!empty($topCustomers)): ?>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Khách hàng</th>
                                            <th class="text-end">Tổng chi</th>
                                            <th>Chi tiết</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($topCustomers as $index => $customer): ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= htmlspecialchars($customer['username']) ?></td>
                                                <td class="text-end"><?= number_format($customer['total_spent'], 0, ',', '.') ?> ₫</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary toggle-orders" 
                                                            data-customer-id="<?= $customer['ID'] ?>">
                                                        <i class="bi bi-list-ul"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr class="order-details" id="orders-<?= $customer['ID'] ?>" style="display: none;">
                                                <td colspan="4">
                                                    <div class="p-2 bg-light">
                                                        <table class="table table-sm mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Mã đơn</th>
                                                                    <th>Ngày</th>
                                                                    <th class="text-end">Tổng</th>
                                                                    <th>Xem</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($customer['orders'] as $order): ?>
                                                                    <tr>
                                                                        <td>#<?= $order['MaDon'] ?? 'N/A' ?></td>
                                                                        <td>
                                                                            <?= isset($order['NgayDat']) ? date('d/m/Y', strtotime($order['NgayDat'])) : 'N/A' ?>
                                                                        </td>
                                                                        <td class="text-end">
                                                                            <?= isset($order['TongTien']) ? number_format($order['TongTien'], 0, ',', '.') . ' ₫' : '0 ₫' ?>
                                                                        </td>
                                                                        <td>
                                                                            <a href="index.php?controller=admin&action=orderDetail&id=<?= $order['MaDon'] ?? '' ?>" 
                                                                            class="btn btn-sm btn-outline-info">
                                                                                <i class="bi bi-eye"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php elseif (isset($_POST['stats_submit'])): ?>
                            <div class="alert alert-info">Không có dữ liệu thống kê trong khoảng thời gian này</div>
                        <?php else: ?>
                            <div class="alert alert-secondary">Vui lòng chọn khoảng thời gian để xem thống kê</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Xử lý hiển thị/ẩn danh sách đơn hàng
    document.querySelectorAll('.toggle-orders').forEach(button => {
        button.addEventListener('click', function() {
            const customerId = this.getAttribute('data-customer-id');
            const orderDetails = document.getElementById(`orders-${customerId}`);
            
            if (orderDetails.style.display === 'none') {
                orderDetails.style.display = 'table-row';
                this.innerHTML = '<i class="bi bi-chevron-up"></i>';
            } else {
                orderDetails.style.display = 'none';
                this.innerHTML = '<i class="bi bi-list-ul"></i>';
            }
        });
    });
    </script>
</body>
</html>

<?php $conn->close(); ?>