
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
            <div class="order-list">
                <?php 
                if(!empty($listMaDon)): foreach($listMaDon as $don):?>
                <div class="list-box">
                    <div class="flex list-box__title">
                        <div class="">
                            <div class=""><b>Đơn hàng: </b> <span>#<?=$don['MaDon']?></span></div>
                            <div class=""><b>Địa chỉ giao: </b> <span><?=$don['DiaChi']?></span></div>
                            <div class=""><b>Ngày đặt: </b> <span><?=$don['NgayDat']?></span></div>
                            <div class=""><b>Ngày giao: </b> <span><?=$don['NgayGiao'] ?? ''?></span></div>
                        </div>
                        <b class="status"><?=$don['TrangThai']?></b>
                    </div>
                    <?php if(!empty($orders)): foreach($orders as $order): if($order['MaDon'] != $don['MaDon']) continue;?>
                    <div class="flex">
                        <div class="flex">
                            <img src="<?=$order['AnhMoTaSP']?>" alt="">
                            <p><?=$order['TenSP']?></p>
                        </div>
                        <div class="">
                            <div class="">
                                <span>Số lượng: </span>
                                <b><?=$order['SoLuongOrder']?></b>
                            </div>
                            <div class="">
                                <span>Đơn giá: </span>
                                <b><?=number_format($order['Gia'],0, ',', '.') . "đ"?></b>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;endif;?>
                    <div class="list-box__footer">
                        <div class="">
                            <span>Tổng tiền: </span>
                            <b style="color: red;"><?=number_format($don['TongTien'],0, ',', '.') . "đ"?></b>
                        </div>
                    </div>
                </div>
                <?php endforeach;else:?>

                <?php endif;?>
            </div>
      </div>
    </div>
  </div>
</main>
</main>
<script src="./assets/javascript/address.js"></script>