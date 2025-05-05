<main>
    <div class="container">
        <div class="login-register">
            <h1 class="login-register__title">ĐĂNG KÝ</h1>
            <form action="./index.php?controller=user&action=register" method="post" class="form-register">
                <div class="login-register__inform">

                    <div class="block">
                        <label for="username">Tên tài khoản:</label>
                        <input type="text" name="username" id="username" placeholder="Tên tài khoản" required>
                    </div>

                    <div class="block">
                        <label for="password">Mật khẩu:</label>
                        <input type="password" name="password" id="password" placeholder="Mật khẩu" required>
                    </div>

                    <div class="block">
                        <label for="repassword">Nhập lại mật khẩu:</label>
                        <input type="password" name="repassword" id="repassword" placeholder="Nhập lại mật khẩu" required>
                    </div>

                    <div class="block">
                        <label for="phone">Số điện thoại:</label>
                        <input type="text" name="phone" id="phone" placeholder="Số điện thoại" required>
                    </div>

                    <div class="block">
                        <label for="sex">Giới tính:</label>
                        <select name="sex" id="sex" required>
                            <option value="">-- Chọn giới tính --</option>
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                            <option value="Khác">Khác</option>
                        </select>
                    </div>

                    <div class="block">
                        <label for="date_of_birth">Ngày sinh:</label>
                        <input type="date" name="date_of_birth" id="date_of_birth" required>
                    </div>

                    <div class="block submit">
                        <button type="submit" class="login-register__submit">Đăng ký</button>
                    </div>

                    <div class="block">
                        <span>Đã có tài khoản?</span>
                        <a href="./index.php?controller=user&action=login" class="login__link">Đăng nhập</a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</main>
