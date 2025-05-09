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
$totalProducts = $conn->query("SELECT COUNT(*) FROM products")->fetch_row()[0];
$totalOrders = $conn->query("SELECT COUNT(*) FROM orders")->fetch_row()[0];
$lowStock = $conn->query("SELECT COUNT(*) FROM products WHERE SoLuong < 5")->fetch_row()[0];
$recentOrders = $conn->query("SELECT * FROM orders ORDER BY MaDon DESC LIMIT 5")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
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
        }
        .stat-box p {
            font-size: 24px;
            margin: 10px 0;
            color: #333;
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
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f8f9fa;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .nav {
            margin-bottom: 20px;
        }
        .nav a {
            margin-right: 15px;
            text-decoration: none;
            color: #3498db;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Dashboard Quản Trị</h1>   
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
        
        <h2>Đơn hàng gần đây</h2>
        <table>
            <tr>
                <th>Mã đơn</th>
                <th>Khách hàng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
            </tr>
            <?php foreach ($recentOrders as $order): ?>
            <tr>
                <td>#<?php echo $order['MaDon']; ?></td>
                <td>KH-<?php echo $order['UserID']; ?></td>
                <td><?php echo number_format($order['TongTien']); ?>đ</td>
                <td><?php echo $order['TrangThai']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>