<?php
session_start();
include './db_connect.php';

// Kiểm tra xem user đã đăng nhập chưa
if (!isset($_SESSION['id'])) {
    die("Bạn chưa đăng nhập.");
}

$id = $_SESSION['id'];

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối CSDL thất bại: " . mysqli_connect_error());
}

// Truy vấn dữ liệu user
$sql = "SELECT * FROM users WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

// Kiểm tra kết quả
if (!$result) {
    die("Lỗi truy vấn: " . mysqli_error($conn));
}

$user = mysqli_fetch_assoc($result);

// Nếu không tìm thấy user
if (!$user) {
    die("Không tìm thấy người dùng.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thông tin tài khoản</title>
</head>
<body>
<h2>Thông tin tài khoản</h2>
<div class="profile">
    <p>Họ tên: <?php echo htmlspecialchars($user['username']); ?></p>
    <p>Giới tính: <?php echo htmlspecialchars($user['gender']); ?></p>
    <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
    <p>Số điện thoại: <?php echo htmlspecialchars($user['phonenumber']); ?></p>
    <p>Ngày sinh: <?php echo htmlspecialchars($user['date_of_birth']); ?></p>
    <p>Địa chỉ: <?php echo htmlspecialchars($user['address']); ?></p>
</div>
</body>
</html>
