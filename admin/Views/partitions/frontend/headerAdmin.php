<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: 'Roboto', sans-serif;
        background-color: #f8f9fb;
        display: flex;
    }

    .sidebar {
        width: 240px;
        height: 100vh;
        background-color: #002766;
        color: white;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-top: 30px;
        position: fixed;
        left: 0;
        top: 0;
        box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
    }

    .logo img {
        width: 70px;
        height: auto;
        margin-bottom: 15px;
    }

    .title {
        font-size: 22px;
        font-weight: 600;
        margin-bottom: 40px;
        text-align: center;
        padding: 0 10px;
    }

    .admin-menu {
        width: 100%;
        display: flex;
        flex-direction: column;
        padding-left: 0;
        align-items: flex-start;
    }

    .admin-menu a {
        width: 100%;
        padding: 14px 20px;
        font-size: 16px;
        font-weight: 500;
        color: white;
        text-decoration: none;
        transition: background-color 0.3s, padding-left 0.3s;
    }

    .admin-menu a:hover {
        background-color: #003a99;
        color: white;
    }

    .dropdown {
        width: 100%;
        position: relative;
    }

    .dropdown-toggle {
        width: 100%;
        padding: 14px 20px;
        font-size: 16px;
        font-weight: 500;
        color: white;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: transparent;
        border: none;
        outline: none;
    }

    .dropdown-toggle:hover {
        background-color: #003a99;
        color: white;
    }

    .dropdown-toggle i {
    color: white;
    margin-left: 5px;
    transition: color 0.3s, transform 0.3s ease;
    transform: rotate(90deg); /* góc xoay mặc định */
}

.dropdown-toggle:hover i,
.dropdown.active .dropdown-toggle i {
    transform: rotate(360deg); /* xoay khi hover hoặc khi active */
}

  
    .dropdown-menu {
        display: none;
        flex-direction: column;
        background-color: #001f4d;
    }

    .dropdown-menu a {
        padding: 12px 40px;
        font-size: 15px;
        color: white;
        text-decoration: none;
    }

    .dropdown-menu a:hover {
        background-color: #003a99;
        color: white;
    }

    .dropdown.active .dropdown-menu {
        display: flex;
    }

    .main-content {
        margin-left: 240px;
        padding: 30px 40px;
        width: calc(100% - 240px);
    }

    @media (max-width: 768px) {
        .sidebar {
            width: 100%;
            height: auto;
            position: relative;
            flex-direction: row;
            justify-content: space-between;
            padding: 10px 20px;
        }

        .admin-menu {
            flex-direction: row;
            padding: 0;
            align-items: center;
            justify-content: center;
        }

        .admin-menu a {
            padding: 10px;
            font-size: 14px;
        }

        .main-content {
            margin-left: 0;
            width: 100%;
            padding: 20px;
        }

        .title {
            display: none;
        }
    }
    </style>

    <title>Admin</title>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <a href="index.php?controller=admin&action=dashboard"><img src="../assets/image/Asset_1.png" alt="Logo"></a>
        </div>
        <div class="title">Admin Dashboard</div>
        <div class="admin-menu">
            <a href="">Trang chủ</a>

            <div class="dropdown">
                <div class="dropdown-toggle">
                    Khách hàng 
                </div>
                <div class="title">Admin Dashboard - Quản Lý</div>
            </div>
            <div class="admin-menu">
                <div><a href="?controller=admin&action=dashboard">Trang chủ</a></div>
                <div><a href="?controller=admin&action=adminInfo">Thông tin admin</a></div>
                <div><a href="?controller=admin&action=customer">Khách hàng</a></div>
                <div><a href="?controller=admin&action=productsmanage">Sản phẩm</a></div>
                <div><a href="?controller=admin&action=logout">Đăng xuất</a></div>
            </div>

            <a href="index.php?controller=admin&action=productsmanage">Sản phẩm</a>
            <a href="index.php?controller=admin&action=logout">Đăng xuất</a>
        </div>
    </div>

    <div class="main-content">
        <!-- Nội dung chính ở đây -->
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dropdownToggle = document.querySelector('.dropdown-toggle');
            const dropdown = document.querySelector('.dropdown');

            dropdownToggle.addEventListener('click', function () {
                dropdown.classList.toggle('active');
            });
        });
    </script>
</body>
</html>
