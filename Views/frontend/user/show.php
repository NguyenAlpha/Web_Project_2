
<main class="user__show">
    <link rel="stylesheet" href="./Views/frontend/user/show.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> -->
    <div class="container mt-4">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="<?=$linkIMG ?? './assets/image/avatar.jpg'?>" alt="avatar" class="rounded-circle avatar" width="80">
                        <h5><?php echo $user['username']; ?></h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-danger">
                        <a href="#" class="ajax-link" data-url="?controller=Ajax&action=show">Thông tin tài khoản</a>

                        </li>
                        <li class="list-group-item">
                        <a href="#" class="ajax-link" data-url="?controller=Ajax&action=getaddress">Sổ địa chỉ</a>


                        </li>
                        <a href="?controller=order&action=show&userID=<?=$user['ID']?>"><li class="list-group-item">Đơn hàng đã mua</li></a>
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
