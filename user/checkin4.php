<?php
session_start();
require "db_connect.php"; // File kết nối database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["user"]);
    $password = trim($_POST["pass"]);

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $db_user, $db_pass);
        $stmt->fetch();
        
        // Kiểm tra mật khẩu
        if (password_verify($password, $db_pass)) {
            $_SESSION["user_id"] = $id;
            $_SESSION["username"] = $db_user;
            header("Location: index.php");
            exit();
        } else {
            $_SESSION["error"] = "Sai mật khẩu!";
        }
    } else {
        $_SESSION["error"] = "Tài khoản không tồn tại!";
    }

    $stmt->close();
    $conn->close();
    header("Location: login.php");
    exit();
}
