<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS nội tuyến -->
    <style>
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
        }

        .admin-header {
         
            background-color: rgb(0, 38, 133);
           color: white;
           padding: 20px 0;
           width: 100vw; /* Full chiều rộng màn hình */
           position: relative;
           left: 0;
           margin: 0;
          }

        

        .admin-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .logo img {
            width: 50px;
            height: auto;
            display: flex;
            margin: 0 auto;
        }

        .admin-logo .title {
            font-size: 28px;
            font-weight: bold;
        }

        .admin-menu {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        .admin-menu a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            font-size: 16px;
            transition: color 0.3s;
        }

        .admin-menu a:hover {
            color: rgb(0, 26, 86);
        }
    </style>

    <script src="./assets/javascript/even.js"></script>
    <title>Admin</title>
</head>
<body>
    <header>
        <div class="admin-header">
            <div class="admin-logo">
                <div class="logo">
                    <a href="#"><img src="../assets/image/Asset_1.png" alt="Logo"></a>
                </div>
                <div class="title">Admin Dashboard - Quản Lý</div>
            </div>
            <div class="admin-menu">
                <div><a href="?">Trang chủ</a></div>
                <div><a href="?controller=admin&action=customer">Khách hàng</a></div>
                <div><a href="#">Sản phẩm</a></div>
                <div><a href="#">Đăng xuất</a></div>
            </div>
        </div>
    </header>
</body>
</html>
