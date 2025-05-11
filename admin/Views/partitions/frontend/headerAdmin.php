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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>
    /* CSS RIÊNG CHO HEADER - KHÔNG ẢNH HƯỞNG CÁC TRANG KHÁC */
    .admin-header-container {
        position: fixed;
        left: 0;
        top: 0;
        width: 240px;
        height: 100vh;
        background-color: #002766;
        color: white;
        padding: 20px 0;
        box-sizing: border-box;
        z-index: 1000;
    }

    .admin-header-container .logo {
        text-align: center;
        margin-bottom: 30px;
    }

    .admin-header-container .logo img {
        width: 70px;
        height: auto;
    }

    .admin-header-container .title {
        font-size: 22px;
        font-weight: 600;
        text-align: center;
        margin-bottom: 40px;
        padding: 0 10px;
    }

    .admin-menu {
        width: 100%;
        padding-left: 0;
        list-style: none;
    }

    .admin-menu a {
        display: block;
        padding: 14px 20px;
        font-size: 16px;
        font-weight: 500;
        color: white;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .admin-menu a:hover {
        background-color: #003a99;
    }

    .dropdown {
        position: relative;
    }

    .dropdown-toggle {
        width: 100%;
        padding: 14px 20px;
        font-size: 16px;
        font-weight: 500;
        background-color: #001f4d;
        color: white;
        background: none;
        border: none;
        text-align: left;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .dropdown-toggle:hover {
        background-color: #003a99;
    }

    .dropdown-toggle i {
        color: white;
        margin-left: 5px;
        transition: transform 0.3s ease;
        transform: rotate(90deg); /* Góc xoay mặc định */
    }

    .dropdown.active .dropdown-toggle i {
        transform: rotate(360deg); /* Xoay khi active */
    }

    .dropdown-menu {
        display: none;
        background-color: #001f4d;
        padding-left: 0;
        list-style: none;
    }

    .dropdown-menu a {
        padding: 12px 20px 12px 40px;
    }

    .dropdown.active .dropdown-menu {
        display: block;
    }

    body {
        margin: 0;
        font-family: 'Roboto', sans-serif;
    }
    </style>
</head>
<body>
    <div class="admin-header-container">
        <div class="logo">
            <a href="index.php?controller=admin&action=dashboard"><img src="../assets/image/Asset_1.png" alt="Logo"></a>
        </div>
        <div class="title">Admin Dashboard</div>
        <ul class="admin-menu">
            <li><a href="index.php?controller=admin&action=dashboard">Trang chủ</a></li>
            
            <li class="dropdown">
                <button class="dropdown-toggle">Khách hàng </button>
                <ul class="dropdown-menu">
                    <li><a href="index.php?controller=admin&action=customer">Xem khách hàng</a></li>
                    <li><a href="index.php?controller=admin&action=addCustomer">Thêm khách hàng</a></li>
                </ul>
            </li>

            <li><a href="index.php?controller=admin&action=productsmanage">Sản phẩm</a></li>
            <li><a href="index.php?controller=admin&action=logout">Đăng xuất</a></li>
        </ul>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownToggle = document.querySelector('.dropdown-toggle');
        const dropdown = document.querySelector('.dropdown');

        dropdownToggle.addEventListener('click', function() {
            dropdown.classList.toggle('active');
        });
    });
    </script>