<?php

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tmdt";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
$admin_id = $_SESSION['admin_id'];
$admin_info = $conn->query("SELECT * FROM admins WHERE ID = $admin_id")->fetch_assoc();
include "./Views/partitions/frontend/headerAdmin.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_password'])) {
    $current_pass = $_POST['current_password'];
    $new_pass = $_POST['new_password'];
    $confirm_pass = $_POST['confirm_password'];
    
    if ($admin_info['password'] == $current_pass) {
        if ($new_pass == $confirm_pass) {
            $conn->query("UPDATE admins SET password = '$new_pass' WHERE ID = $admin_id");
            $success = "Đổi mật khẩu thành công!";
        } else {
            $error = "Mật khẩu mới không khớp!";
        }
    } else {
        $error = "Mật khẩu hiện tại không đúng!";
    }
    $admin_info = $conn->query("SELECT * FROM admins WHERE ID = $admin_id")->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 800px;
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
        .info-card {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background: #45a049;
        }
        .success {
            color: green;
            margin-bottom: 15px;
        }
        .error {
            color: red;
            margin-bottom: 15px;
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
        <h1>Thông Tin Admin</h1>
        
        <?php if (isset($success)): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>
        
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <div class="info-card">
            <h2>Thông tin tài khoản</h2>
            <p><strong>Tên đăng nhập:</strong> <?php echo htmlspecialchars($admin_info['username']); ?></p>
            <p><strong>Mật khẩu:</strong> ********</p>
        </div>
        
        <div class="info-card">
            <h2>Đổi mật khẩu</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="current_password">Mật khẩu hiện tại</label>
                    <input type="password" id="current_password" name="current_password" required>
                </div>
                
                <div class="form-group">
                    <label for="new_password">Mật khẩu mới</label>
                    <input type="password" id="new_password" name="new_password" required>
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">Xác nhận mật khẩu mới</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                
                <button type="submit" name="change_password">Đổi mật khẩu</button>
            </form>
        </div>
    </div>
</body>
</html>
