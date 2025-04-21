<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>

    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="./assets/javascript/even.js"></script>
</head>
<body>
    <header>
        <div class="header">
            <div class="container header-container">
                <div class="header__logo">
                    <a href="./index.php"><img src="./assets/image/Asset_1.png" alt=""></a>
                </div>
                <div class="header__search">
                    <form action="./index.php?controller=home&action=search" method="post">
                        <input class="header__search__input" type="text" name="search" placeholder="Tìm kiếm sản phẩm">
                        <button class="header__search__submit" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
                <div class="header--right">
                    <div class="header--right__item header--right__hotline">
                        <i class="fa-solid fa-phone"></i>
                        <a href="tel:0888999">Hotline</a>
                    </div>

                    <div class="header--right__item header--right__cart">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <a href="./pages/cart.php">Giỏ hàng</a>  
                    </div>

                    <div class="header--right__item header--right__account">
                        <i class="fa-solid fa-user"></i>
                        <?php  if(isset($_SESSION["user"])):?>
                            <a href=""><?php echo $_SESSION["user"]["username"]?></a>
                        <?php  else:  ?>
                            <a href="./user/login.php">Đăng Nhập</a>
                        <?php endif;?>
                    </div>

                    <?php if(!isset($_SESSION["user"])):?>
                        <div class="header--right__item">
                        <i class="fa-solid fa-user"></i>
                        <a href="./user/register.php">Đăng ký</a>
                        </div>
                    <?php endif;?>

                    <?php  if(isset($_SESSION["user"])):?>
                        <div class="header--right__item header--right__cart">
                            <a href="./user/logout.php">đăng xuất</a>
                        </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
        <div class="navbar">
            <div class="container navbar-container">
                <ul>
                    <?php foreach($menus as $menuItem):?>
                        <a href="./index.php?controller=category&action=show&id=<?= $menuItem['MaLoai'] ?>"><li class="navbar__item"><?= $menuItem['TenLoai']?></li></a>
                        
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </header>