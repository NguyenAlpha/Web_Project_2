<?php 
include 'db_connect.php'; 
if(isset($_POST['user'])){
    $sql = "INSERT INTO user (username, password, email) VALUES ('$_POST[user]','$_POST[pass]','$_POST[email]')";
  $conn->query($sql);
}

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký</title>
</head>
<body>
    <h2>Đăng ký</h2>
    <?php
    if (isset($_SESSION['error'])) {
        echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']); // Xóa thông báo lỗi sau khi hiển thị
    }
    ?>
    <form action="register.php" method="POST">
        <label for="user">Tài khoản:</label>
        <input type="text" name="user" ><br>
        <label for="pass">Mật khẩu:</label>
        <input type="password" name="pass" ><br>
        <label for="re-pass">Nhập lại mật khẩu:</label>
        <input type="password" name="re-pass" ><br>
        <label for="email">Email:</label>
        <input type="text" name="email" ><br>
        <button type="submit">Đăng ký</button>
        
    </form>
</body>
</html>