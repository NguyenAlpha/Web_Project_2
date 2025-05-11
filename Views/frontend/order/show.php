<?php /** @var array $listMaDon */ ?>
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
                        <a href="?controller=order&action=show&userID=<?=$user['ID']?>">
                            <li class="list-group-item">Đơn hàng </li>
                        </a>
                        <li class="list-group-item">Lịch sử đơn hàng</li>
                        <li class="list-group-item">
                            <a href="index.php?controller=user&action=logout">Đăng xuất</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Order content -->
            <div class="col-md-9" id="ajax-content-area">
                <div class="order-list">
                    <?php if (!empty($listMaDon)): foreach ($listMaDon as $don): ?>
                        <div class="list-box">
                            <div class="flex list-box__title">
                                <div class="">
                                    <div><b>Đơn hàng: </b><span>#<?=$don['MaDon']?></span></div>
                                    <div><b>Địa chỉ giao: </b><span><?=$don['DiaChi']?></span></div>
                                    <div><b>Ngày đặt: </b><span><?=$don['NgayDat']?></span></div>
                                    <div><b>Ngày giao: </b><span><?=$don['NgayGiao'] ?? ''?></span></div>
                                </div>
                                <b class="status"><?=$don['TrangThai']?></b>
                            </div>

                            <?php if (!empty($orders)): foreach ($orders as $order): if ($order['MaDon'] != $don['MaDon']) continue; ?>
                                <div class="flex">
                                    <div class="flex">
                                        <img src="<?=$order['AnhMoTaSP']?>" alt="">
                                        <p><?=$order['TenSP']?></p>
                                    </div>
                                    <div>
                                        <div>
                                            <span>Số lượng: </span><b><?=$order['SoLuongOrder']?></b>
                                        </div>
                                        <div>
                                            <span>Đơn giá: </span><b><?=number_format($order['Gia'], 0, ',', '.') . "đ"?></b>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; endif; ?>

                            <div class="list-box__footer">
                                <div>
                                    <span>Tổng tiền: </span>
                                    <b style="color: red;"><?=number_format($don['TongTien'], 0, ',', '.') . "đ"?></b>
                                </div>

                                <?php if ($don['TrangThai'] != 'Đã giao'): ?>
                                    <div style="text-align: right; margin-top: 8px;">
                                            <form method="POST" action="index.php?controller=order&action=confirmDelivered" style="text-align: right; margin-top: 8px;">
                                <input type="hidden" name="MaDon" value="<?=$don['MaDon']?>">
                                <button type="submit" class="btn-confirm-delivered">
                                    ✅ Xác nhận đã giao hàng
                                </button>
                            </form>

                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="./assets/javascript/address.js"></script>