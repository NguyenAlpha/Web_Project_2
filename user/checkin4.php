<?php
session_start();
require("./db_connect.php");

if (empty($_POST["user"])) {
    die("Tên đăng nhập không được để trống");
}

$user = $_POST['user'];
$pass = $_POST['pass'];

$sql = "SELECT * FROM user WHERE username = '$user' AND password = '$pass'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
    $_SESSION['id'] = $userData['id']; // Gán id để in4customer.php dùng
    header("Location: in4customer.php"); // Chuyển đến trang thông tin
    exit();
} else {
    $_SESSION['error'] = "Sai tài khoản hoặc mật khẩu.";
    header("Location: login.php");
    exit();
}
?>
