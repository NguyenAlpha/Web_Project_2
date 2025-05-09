<?php
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'admin';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
if ($controller == 'admin' && $action == 'login') {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tmdt";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Kết nối database thất bại: " . $conn->connect_error);
    }
    $error = '';
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $input_username = $conn->real_escape_string($_POST['username']);
        $input_password = $conn->real_escape_string($_POST['password']);
        
        $result = $conn->query("SELECT * FROM admins WHERE username = '$input_username'");
        
        if ($result->num_rows > 0) {
            $admin = $result->fetch_assoc();
            
            if ($input_password === $admin['password']) {
                $_SESSION['admin_id'] = $admin['ID'];
                $_SESSION['admin_username'] = $admin['username'];
                header("Location: index.php?controller=admin&action=dashboard");
                exit();
            } else {
                $error = "Mật khẩu không chính xác!";
            }
        } else {
            $error = "Tài khoản không tồn tại!";
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Đăng Nhập Admin</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f5f5f5;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .login-container {
                background: white;
                padding: 30px;
                border-radius: 8px;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
                width: 350px;
            }
            h1 {
                text-align: center;
                color: #333;
                margin-bottom: 25px;
            }
            .form-group {
                margin-bottom: 20px;
            }
            label {
                display: block;
                margin-bottom: 8px;
                font-weight: bold;
                color: #555;
            }
            input[type="text"],
            input[type="password"] {
                width: 100%;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 4px;
                box-sizing: border-box;
            }
            button {
                width: 100%;
                padding: 12px;
                background-color: #4CAF50;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
            }
            button:hover {
                background-color: #45a049;
            }
            .error {
                color: red;
                margin-bottom: 15px;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="login-container">
            <h1>Đăng Nhập Hệ Thống</h1>
            
            <?php if (!empty($error)): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="POST" action="index.php?controller=admin&action=login">
                <div class="form-group">
                    <label for="username">Tên đăng nhập</label>
                    <input type="text" id="username" name="username" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit">Đăng Nhập</button>
            </form>
        </div>
    </body>
    </html>
    <?php
    $conn->close();
    exit();
}
header("Location: index.php?controller=admin&action=login");
exit();
?>