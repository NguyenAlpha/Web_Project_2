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
    <script src="./assets/javascript/add.js"></script>
</head>
<body>
    <header>
        <div class="header">
            <div class="container header-container">
                <div class="header__logo">
                    <a href="./index.php"><img src="./assets/image/Asset_1.png" alt=""></a>
                </div>
                <div class="header__search">
                    <form action="./index.php?controller=home&action=search" method="ge t">
                        <input type="hidden" name="controller" value="home">
                        <input type="hidden" name="action" value="search">
                        <?php if(isset($textSearch)):?>
                            <input class="header__search__input" type="text" name="search" value="<?=$textSearch?>" placeholder="Tìm kiếm sản phẩm">
                        <?php else:?>
                            <input class="header__search__input" type="text" name="search" placeholder="Tìm kiếm sản phẩm">
                        <?php endif;?>
                        <button class="header__search__submit" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
                <div class="header--right">
                    <a href="tel:0888999">
                        <div class="header--right__item header--right__hotline">
                            <i class="fa-solid fa-phone"></i>    
                            Hotline
                        </div>
                    </a>

                    <a href="./index.php?controller=cart&action=show">
                        <div class="header--right__item header--right__cart">
                            <i class="fa-solid fa-cart-shopping"></i>Giỏ hàng
                        </div>
                    </a>  

                    
                    <?php  if(isset($_SESSION["user"])):?>
                    <a href="./index.php?controller=user&action=show">
                        <div class="header--right__item header--right__account">
                            <i class="fa-solid fa-user"></i>    
                            <?php echo $_SESSION["user"]["username"]?>
                        </div>
                    </a>
                    <?php  else:  ?>
                    <a href="./index.php?controller=user&action=login">
                        <div class="header--right__item header--right__account">
                            <i class="fa-solid fa-user"></i>    
                            Đăng Nhập
                        </div>
                    </a>
                    <?php endif;?>

                    <?php if(!isset($_SESSION["user"])):?>
                    <a href="./index.php?controller=user&action=register">
                        <div class="header--right__item">
                            <i class="fa-solid fa-user"></i>
                            Đăng ký
                        </div>
                    </a>
                    <?php endif;?>

                    <?php  if(isset($_SESSION["user"])):?>
                    <a href="./index.php?controller=user&action=logout">
                        <div class="header--right__item header--right__cart">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            đăng xuất
                        </div>
                    </a>
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