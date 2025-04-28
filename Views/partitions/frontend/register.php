<main>
    <div class="container">
        <div class="login-register">
            <h1 class="login-register__title">ĐĂNG KÝ</h1>
            <form action="./index.php?controller=user&action=register" method="post" class="form-register">
                <div class="login-register__inform">
                    <div class="block">
                        <label for="username">Tên tài khoản:</label>
                        <input type="text" name="username" placeholder="Tên tài khoản">
                    </div>
                    <div class="block">
                        <label for="password">Mật khẩu:</label>
                        <input type="password" name="password" id="password" placeholder="Mật khẩu">
                    </div>
                    <div class="block">
                        <label for="repassword">Nhập lại mật khẩu:</label>
                        <input type="password" name="repassword" id="repassword" placeholder="Mật khẩu">
                    </div>
                    <div class="block">
                        <label for="username">Số điện thoại:</label>
                        <input type="text" name="phone" placeholder="Số điện thoại">
                    </div>
                    <div class="block submit">
                        <button class="login-register__submit">Đăng ký</button>
                    </div>
                    <div class="block">
                        <span>Có tài khoản?</span>
                        <a href="./index.php?controller=user&action=login" class="login__link">Đăng nhập</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>