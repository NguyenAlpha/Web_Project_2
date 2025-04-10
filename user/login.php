<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Nhập</title>
</head>
<body>
    <h2>Đăng Nhập</h2>
    <?php
    if (isset($_SESSION['error'])) {
        echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']); // Xóa thông báo lỗi sau khi hiển thị
    }
    ?>
    <form action="checkin4.php" method="POST">
        <label for="user">Tài khoản:</label>
        <input type="text" name="user" ><br>
        <label for="pass">Mật khẩu:</label>
        <input type="password" name="pass" ><br>
        <label for="email">Email:</label>
        <input type="text" name="email" ><br>
        <button type="submit">Đăng Nhập</button>
        
    </form>
</body>
</html>