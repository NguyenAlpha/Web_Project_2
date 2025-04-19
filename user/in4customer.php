<?php
session_start();
include './db_connect.php';

if (!isset($_SESSION['id'])) {
    echo "Bạn chưa đăng nhập.";
    exit();
}

$id = $_SESSION['id'];
$sql = "SELECT * FROM user WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "Không tìm thấy người dùng!";
    exit();
}
?>

<h2>Thông tin tài khoản</h2>
<p>Họ tên: <?php echo $user['username']; ?></p>
<p>Giới tính: <?php echo $user['gender']; ?></p>
<p>Email: <?php echo $user['email']; ?></p>
<p>Số điện thoại: <?php echo $user['phonenumber']; ?></p>
<p>Ngày sinh: <?php echo $user['date_of_birth']; ?></p>
