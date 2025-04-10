<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
</head>
<body>
    <h2>Đăng nhập</h2>
    <?php
    if (isset($_SESSION['error'])) {
        echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']); // Xóa thông báo lỗi sau khi hiển thị
    }
    ?>
    <form action="process_login.php" method="POST">
        <label for="user">Tài khoản:</label>
        <input type="text" name="user" required><br>

        <label for="pass">Mật khẩu:</label>
        <input type="password" name="pass" required><br>

        <button type="submit">Đăng nhập</button>
    </form>
</body>
</html>