<main>
    <div class="container">
        <?php if(isset($cartAlert)):?>
            <h1 class="alert cart-alert"><?=$cartAlert?></h1>
        <?php endif;?>
        <div class="login-register">
            <h1 class="login-register__title">ĐĂNG NHẬP</h1>
            <form action="./index.php?controller=user&action=login" method="post">
                <div class="login-register__inform">
                    <div class="block">
                        <label for="username">Tên đăng nhập:</label>
                        <input type="text" name="username" placeholder="Tên đăng nhập">
                    </div>
                    <div class="block">
                        <label for="password">Mật khẩu:</label>
                        <input type="password" name="password" placeholder="Mật khẩu">
                    </div>
                    <div class="block">
                        <p class="error"><?=$erroLogin ?? ''?></p>
                    </div>
                    <div class="block submit">
                        <button class="login-register__submit">Đăng nhập</button>
                    </div>
                    <div class="block">
                        <span>Chưa có tài khoản?</span>
                        <a href="./index.php?controller=user&action=register" class="register__link">Đăng ký</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>