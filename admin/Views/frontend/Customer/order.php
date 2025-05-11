<?php require __DIR__ . '/../../partitions/frontend/headerAdmin.php'?>
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="./css/order.css">
<script src="./js/js.js"></script>
<div class="oreder-containner">
    <div class="back-btn">
        <a class="back-btn__link" href="<?=$_SERVER['HTTP_REFERER']?>"><i class="fa-solid fa-arrow-left"></i>quay lại</a>
    </div>
    <div class="">
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
                <div class="flex list-box-content">
                    <a href="?controller=admin&action=editProduct&MaSP=<?=$order['MaSP']?>">
                        <div class="flex">
                            <img src="../<?=$order['AnhMoTaSP']?>" alt="">
                            <p><?=$order['TenSP']?></p>
                        </div>
                        </a>
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
                                    <?php endforeach; endif; ?>
                <div class="list-box__footer">
                    <div class="">
                        <b>Tổng tiền: </b>
                        <b style="color: red;"><?=number_format($don['TongTien'],0, ',', '.') . "đ"?></b>
                    </div>
                <?php if ($don['TrangThai'] != 'Đã giao'): endif;?>
                </div>
            </div>
            <?php endforeach; endif; ?>
        </div>
    </div>
</div>




</body>