<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tmdt";
include "./Views/partitions/frontend/headerAdmin.php";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
// Lấy thống kê tổng quan
$stats = [
    'total_products' => $conn->query("SELECT COUNT(*) FROM products")->fetch_row()[0],
    'total_orders' => $conn->query("SELECT COUNT(*) FROM orders")->fetch_row()[0],
    'total_customers' => $conn->query("SELECT COUNT(*) FROM users")->fetch_row()[0],
    'total_revenue' => $conn->query("SELECT SUM(TongTien) FROM orders WHERE TrangThai = 'đã giao'")->fetch_row()[0] ?? 0,
    'low_stock' => $conn->query("SELECT COUNT(*) FROM products WHERE SoLuong < 5")->fetch_row()[0],
];

// Lấy đơn hàng gần đây
$recent_orders = $conn->query("
    SELECT o.MaDon, o.NgayDat, o.TongTien, o.TrangThai, u.username 
    FROM orders o
    JOIN users u ON o.UserID = u.ID
    ORDER BY o.NgayDat DESC LIMIT 5
")->fetch_all(MYSQLI_ASSOC);

// Lấy doanh thu theo tháng (12 tháng gần nhất)
$revenue_by_month = $conn->query("
    SELECT 
        DATE_FORMAT(NgayDat, '%Y-%m') AS month,
        SUM(TongTien) AS revenue
    FROM orders
    WHERE NgayDat >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH)
    AND TrangThai = 'đã giao'
    GROUP BY DATE_FORMAT(NgayDat, '%Y-%m')
    ORDER BY month ASC
")->fetch_all(MYSQLI_ASSOC);

// Lấy top sản phẩm bán chạy
$top_products = $conn->query("
    SELECT p.MaSP, p.TenSP, p.MaLoai, SUM(lp.SoLuong) AS total_sold
    FROM listproduct lp
    JOIN products p ON lp.MaSP = p.MaSP
    JOIN orders o ON lp.MaDon = o.MaDon
    WHERE o.TrangThai = 'đã giao'
    GROUP BY lp.MaSP
    ORDER BY total_sold DESC
    LIMIT 5
")->fetch_all(MYSQLI_ASSOC);

// Xử lý thống kê theo khoảng thời gian
$start_date = $_POST['start_date'] ?? date('Y-m-01');
$end_date = $_POST['end_date'] ?? date('Y-m-t');
$top_customers = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['stats_submit'])) {
    $stmt = $conn->prepare("
        SELECT 
            u.ID, u.username, u.email, 
            SUM(o.TongTien) as total_spent,
            COUNT(o.MaDon) as order_count
        FROM users u
        JOIN orders o ON u.ID = o.UserID
        WHERE o.TrangThai = 'đã giao'
        AND o.NgayDat BETWEEN ? AND ?
        GROUP BY u.ID
        ORDER BY total_spent DESC
        LIMIT 5
    ");
    $stmt->bind_param("ss", $start_date, $end_date);
    $stmt->execute();
    $top_customers = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Quản Trị</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary-color: #00268c;
            --secondary-color: #6c757d;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --info-color: #17a2b8;
        }
        .main-content {
            display: flex;
            width: 80%;
            margin-left: 250px;
            padding: 20px;
            margin-top: 60px;
        }
        .dd{
            display: flex;
            width: 80%;
            margin-left: 250px;
            padding: 20px;
            margin-top: 60px;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
            height: 100%;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .card-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: 10px 10px 0 0 !important;
        }
        
        .stat-card {
            text-align: center;
            padding: 20px;
        }
        
        .stat-card .value {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 10px 0;
        }
        
        .stat-card .label {
            font-size: 1rem;
            color: var(--secondary-color);
        }
        
        .revenue-chart-container {
            position: relative;
            height: 300px;
        }
        
        .badge-status {
            padding: 6px 10px;
            border-radius: 20px;
            font-weight: 500;
        }
        
        .status-delivered {
            background-color: #d4edda;
            color: var(--success-color);
        }
        
        .status-pending {
            background-color: #fff3cd;
            color: var(--warning-color);
        }
        
        .status-shipping {
            background-color: #cce5ff;
            color: var(--info-color);
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(0, 38, 140, 0.05);
        }
        
        .product-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 4px;
        }
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000; /* Đảm bảo thanh điều hướng luôn trên cùng */
        }
    </style>
</head>
<body>
    <?php include "./Views/partitions/frontend/headerAdmin.php"; ?>
    
    <div class="dd">
        <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="display-5 fw-bold text-primary">
                    <i class="bi bi-speedometer2"></i> Dashboard Quản Trị
                </h1>
                <p class="text-muted">Tổng quan hệ thống và thống kê</p>
            </div>
        </div>
        
        <!-- Thống kê tổng quan -->
        <div class="row mb-4">
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="value text-primary"><?= number_format($stats['total_products']) ?></div>
                        <div class="label">Tổng sản phẩm</div>
                        <i class="bi bi-box-seam display-4 text-primary opacity-25 mt-3"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="value text-success"><?= number_format($stats['total_orders']) ?></div>
                        <div class="label">Tổng đơn hàng</div>
                        <i class="bi bi-cart-check display-4 text-success opacity-25 mt-3"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="value text-info"><?= number_format($stats['total_customers']) ?></div>
                        <div class="label">Khách hàng</div>
                        <i class="bi bi-people display-4 text-info opacity-25 mt-3"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="value text-danger"><?= number_format($stats['total_revenue']) ?> ₫</div>
                        <div class="label">Tổng doanh thu</div>
                        <i class="bi bi-currency-dollar display-4 text-danger opacity-25 mt-3"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <!-- Biểu đồ doanh thu -->
            <div class="col-lg-8 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-graph-up"></i> Doanh thu 12 tháng gần nhất</h5>
                    </div>
                    <div class="card-body">
                        <div class="revenue-chart-container">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Sản phẩm sắp hết hàng -->
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0"><i class="bi bi-exclamation-triangle"></i> Sản phẩm sắp hết hàng</h5>
                    </div>
                    <div class="card-body">
                        <?php if ($stats['low_stock'] > 0): ?>
                            <div class="alert alert-warning">
                                Có <strong><?= $stats['low_stock'] ?></strong> sản phẩm sắp hết hàng
                            </div>
                            <?php
                            $low_stock_products = $conn->query("
                                SELECT MaSP, TenSP, SoLuong 
                                FROM products 
                                WHERE SoLuong < 5 
                                ORDER BY SoLuong ASC 
                                LIMIT 5
                            ")->fetch_all(MYSQLI_ASSOC);
                            ?>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th class="text-end">Tồn kho</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($low_stock_products as $product): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($product['TenSP']) ?></td>
                                                <td class="text-end text-danger fw-bold"><?= $product['SoLuong'] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <a href="?controller=admin&action=productsmanage" class="btn btn-sm btn-warning">
                                <i class="bi bi-box-arrow-in-right"></i> Xem tất cả
                            </a>
                        <?php else: ?>
                            <div class="alert alert-success">
                                <i class="bi bi-check-circle"></i> Tất cả sản phẩm đều có đủ hàng
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <!-- Đơn hàng gần đây -->
            <div class="col-lg-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-clock-history"></i> Đơn hàng gần đây</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Mã đơn</th>
                                        <th>Khách hàng</th>
                                        <th>Ngày đặt</th>
                                        <th class="text-end">Tổng tiền</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recent_orders as $order): ?>
                                        <tr>
                                            <td>#<?= $order['MaDon'] ?></td>
                                            <td><?= htmlspecialchars($order['username']) ?></td>
                                            <td><?= date('d/m/Y', strtotime($order['NgayDat'])) ?></td>
                                            <td class="text-end"><?= number_format($order['TongTien'], 0, ',', '.') ?> ₫</td>
                                            <td>
                                                <span class="badge-status status-<?= 
                                                    $order['TrangThai'] == 'đã giao' ? 'delivered' : 
                                                    ($order['TrangThai'] == 'đang giao' ? 'shipping' : 'pending') 
                                                ?>">
                                                    <?= $order['TrangThai'] ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <a href="?controller=admin&action=orders" class="btn btn-sm btn-primary mt-2">
                            <i class="bi bi-list-ul"></i> Xem tất cả đơn hàng
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Top sản phẩm bán chạy -->
            <div class="col-lg-6 mb-4">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="bi bi-trophy"></i> Top sản phẩm bán chạy</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Sản phẩm</th>
                                        <th>Loại</th>
                                        <th class="text-end">Đã bán</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($top_products as $index => $product): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <?php
                                                    $imagePath = '.' . $conn->query("
                                                        SELECT AnhMoTaSP FROM products 
                                                        WHERE MaSP = {$product['MaSP']}
                                                    ")->fetch_row()[0];
                                                    ?>
                                                    <img src="<?= htmlspecialchars($imagePath) ?>" 
                                                         class="product-img me-2" 
                                                         onerror="this.src='../assets/image/no-image.jpg'">
                                                    <?= htmlspecialchars($product['TenSP']) ?>
                                                </div>
                                            </td>
                                            <td><?= htmlspecialchars($product['MaLoai']) ?></td>
                                            <td class="text-end fw-bold"><?= $product['total_sold'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Thống kê khách hàng theo khoảng thời gian -->
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="bi bi-people-fill"></i> Thống kê khách hàng tiềm năng</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label class="form-label">Từ ngày</label>
                                <input type="date" name="start_date" class="form-control" 
                                       value="<?= htmlspecialchars($start_date) ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Đến ngày</label>
                                <input type="date" name="end_date" class="form-control" 
                                       value="<?= htmlspecialchars($end_date) ?>" required>
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="submit" name="stats_submit" class="btn btn-primary">
                                    <i class="bi bi-search"></i> Thống kê
                                </button>
                            </div>
                        </form>
                        
                        <?php if (!empty($top_customers)): ?>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Khách hàng</th>
                                            <th>Email</th>
                                            <th class="text-end">Tổng chi tiêu</th>
                                            <th class="text-center">Số đơn hàng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($top_customers as $index => $customer): ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= htmlspecialchars($customer['username']) ?></td>
                                                <td><?= htmlspecialchars($customer['email']) ?></td>
                                                <td class="text-end fw-bold text-success">
                                                    <?= number_format($customer['total_spent'], 0, ',', '.') ?> ₫
                                                </td>
                                                <td class="text-center"><?= $customer['order_count'] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php elseif (isset($_POST['stats_submit'])): ?>
                            <div class="alert alert-info">
                                Không có dữ liệu thống kê trong khoảng thời gian này
                            </div>
                        <?php else: ?>
                            <div class="alert alert-secondary">
                                Vui lòng chọn khoảng thời gian để xem thống kê khách hàng
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Biểu đồ doanh thu
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: [
                <?php foreach ($revenue_by_month as $month): ?>
                    '<?= date('m/Y', strtotime($month['month'] . '-01')) ?>',
                <?php endforeach; ?>
            ],
            datasets: [{
                label: 'Doanh thu (₫)',
                data: [
                    <?php foreach ($revenue_by_month as $month): ?>
                        <?= $month['revenue'] ?? 0 ?>,
                    <?php endforeach; ?>
                ],
                backgroundColor: 'rgba(0, 38, 140, 0.1)',
                borderColor: 'rgba(0, 38, 140, 1)',
                borderWidth: 2,
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Doanh thu: ' + new Intl.NumberFormat('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            }).format(context.raw);
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return new Intl.NumberFormat('vi-VN', {
                                style: 'currency',
                                currency: 'VND',
                                maximumFractionDigits: 0
                            }).format(value);
                        }
                    }
                }
            }
        }
    });
    
    // Xử lý hiển thị/ẩn danh sách đơn hàng
    document.querySelectorAll('.toggle-orders').forEach(button => {
        button.addEventListener('click', function() {
            const customerId = this.getAttribute('data-customer-id');
            const orderDetails = document.getElementById(`orders-${customerId}`);
            
            if (orderDetails.style.display === 'none') {
                orderDetails.style.display = 'table-row';
                this.innerHTML = '<i class="bi bi-chevron-up"></i> Ẩn đơn hàng';
            } else {
                orderDetails.style.display = 'none';
                this.innerHTML = '<i class="bi bi-list-ul"></i> Xem đơn hàng';
            }
        });
    });
    </script>
</body>
</html>