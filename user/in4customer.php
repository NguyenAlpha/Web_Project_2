<?php

session_start();
include './db_connect.php'; // file kết nối database

$id = $_SESSION['id']; // id user đang login

$sql = "SELECT * FROM users WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result); // lấy data user đưa vô biến $user
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>Thông tin tài khoản</h2>
<div class="profile">
    <p>Họ tên: <?php echo $user['username']; ?></p>
    <p>Giới tính: <?php echo $user['gender']; ?></p>
    <p>Email: <?php echo $user['email']; ?></p>
    <p>Số điện thoại: <?php echo $user['phonenumber']; ?></p>
    <p>Ngày sinh: <?php echo $user['date_of_birth']; ?></p>
</div>

</body>
</html>