
<main class="user__show">
    <link rel="stylesheet" href="./Views/frontend/user/show.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> -->
    <div class="container">
        <div class="user__info">
            <h1 class="title">CHI TIẾT TÀI KHOẢN</h1>
            <p>Tên: <?=$user['username']?></p>
            <p>Mật khẩu: <?=$user['password']?></p>
        </div>
    </div>
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
                        <li class="list-group-item text-danger">
                        <a href="#" class="ajax-link" data-url="?controller=Ajax&action=show">Thông tin tài khoản</a>

                        </li>
                        <li class="list-group-item">
                        <a href="#" class="ajax-link" data-url="?controller=Ajax&action=getaddress">Sổ địa chỉ</a>


                        </li>
                        <li class="list-group-item">Quản lý đơn hàng</li>
                        <li class="list-group-item">Sản phẩm đã xem</li>
                        <li class="list-group-item"><a href="index.php?controller=user&action=logout">Đăng xuất</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9" id="ajax-content-area">
        <?php include 'Views/frontend/user/profile.php'; ?>
      </div>
    </div>
  </div>
</main>
</main>
<script src="./assets/javascript/address.js"></script>