<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
</head>
<body>
    <div class="main">
        <h2>Login</h2>
        <form action="index.php?controller=Admin&action=login" method="post">
            <input type="text" name="username" placeholder="Tên đăng nhập" required>
            <input type="text" name="password" placeholder="Mật khẩu" required>
            <input type="submit" name="login" value="ĐĂNG NHẬP">
        </form>
    </div>
</body>
</html>