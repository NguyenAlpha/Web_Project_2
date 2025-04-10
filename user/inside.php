<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang chủ</title>
</head>
<body>
    <h2>Chào mừng, <?php echo $_SESSION["username"]; ?>!</h2>
    <a href="logout.php">Đăng xuất</a>
</body>
</html>
