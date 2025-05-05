<main>
    <div class="container">
        <div class="user__info">
            <h1 class="title">CHI TIẾT TÀI KHOẢN</h1>
            <p>Tên: <?=$user['username']?></p>
            <p>Mật khẩu: <?=$user['password']?></p>
        </div>
    </div>
    <!-- Giả sử bạn đã load dữ liệu người dùng vào biến $user -->
    <!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thông tin tài khoản</title>
    <link rel="stylesheet" href="./show.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> <!-- nếu đang dùng Bootstrap -->
</head>
<body>
   


<form action="index.php?controller=user&action=update" method="POST">
<link rel="stylesheet" href="user/show.css">

    <div class="container mt-4">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="avatar.png" alt="avatar" class="rounded-circle mb-2" width="80">
                        <h5><?php echo $user['username']; ?></h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-danger">Thông tin tài khoản</li>
                        <li class="list-group-item">
                         <a href="index.php?controller=user&action=address">Sổ địa chỉ</a>
                        </li>
                        <li class="list-group-item">Quản lý đơn hàng</li>
                        <li class="list-group-item">Sản phẩm đã xem</li>
                        <li class="list-group-item"><a href="index.php?controller=user&action=logout">Đăng xuất</a></li>
                    </ul>
                </div>
            </div>

            <!-- Form content -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Thông tin tài khoản</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Họ Tên</label>
                            <input type="text" class="form-control" name="username" value="<?php echo $user['username']; ?>">
                        </div>

                        <div class="form-group mt-3">
                            <label>Giới tính</label><br>
                            <input type="radio" name="gender" value="Nam" <?php if($user['sex'] == 'Nam') echo 'checked'; ?>> Nam
                            <input type="radio" name="gender" value="Nữ" <?php if($user['sex'] == 'Nữ') echo 'checked'; ?>> Nữ
                        </div>

                        <div class="form-group mt-3">
                            <label>Số điện thoại</label>
                            <input type="text" class="form-control" name="phonenumber" value="<?php echo $user['phonenumber']; ?>">
                        </div>

                        <div class="form-group mt-3">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="<?php echo $user['email']; ?>">
                        </div>

                        <div class="form-group mt-3">
                            <label>Ngày sinh</label>
                            <div class="row">
                                <div class="col">
                                    <select class="form-control" name="dob_day">
                                        <option>Ngày</option>
                                        <?php for($i=1; $i<=31; $i++) echo "<option>$i</option>"; ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <select class="form-control" name="dob_month">
                                        <option>Tháng</option>
                                        <?php for($i=1; $i<=12; $i++) echo "<option>$i</option>"; ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <select class="form-control" name="dob_year">
                                        <option>Năm</option>
                                        <?php for($i=1950; $i<=date('Y'); $i++) echo "<option>$i</option>"; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 text-center">
                            <button type="submit" class="btn btn-danger">LƯU THAY ĐỔI</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
</form>
</html>
</main>