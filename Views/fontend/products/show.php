<?php 
    // echo print_r($product);
    // echo print_r($detail);


?>

<main>
    <div class="main">
        <div class="container">
            <div class="product__detail">
                <div class="product__detail__box1">
                    <div class="product__detail--left">
                        <img src="<?= $product['AnhMoTaSP']?>" alt="">
                    </div>
                    <div class="product__detail--right">
                        <?php if(!empty($detail)):?>
                            <h1 class="product__detail__name">
                                <?php echo $product['TenSP'] . " (
                                {$detail['CPU']}/
                                {$detail['RAM']}/
                                {$detail['DungLuong']}/
                                {$detail['KichThuocManHinh']}/
                                {$detail['DoPhanGiai']}
                                )" ?>
                            </h1>
                        <?php else:?>
                            <h1 class="product__detail__name"><?php echo $product['TenSP']?></h1>
                        <?php endif;?>
                        <h2 class="product__detail__price">
                            <?=number_format($product["Gia"],
                             0, ',', '.') . "đ"?>
                        </h2>

                        <div class="product__button__buy__cart">
                            <button class="product__detail__buy" type="submit">MUA NGAY</button>
                            <button class="product__detail__cart" type="submit"><i class="fa-solid fa-cart-plus"></i>THÊM VÀO GIỎ</i></button>
                        </div>
                    </div>
                </div>
                <div class="product__detail__box2">
                    <h2 class="product__detail__title">Thông Số Kỹ Thuật</h2>
                    <?php if(!empty($detail)):?>
                        <table class="product__detail__list">
                            <tr>
                                <td>Dung lượng</td>
                                <td><?=$detail['DungLuong']?></td>
                            </tr>
                            <tr>
                                <td>Kích thước màn hình</td>
                                <td><?=$detail['KichThuocManHinh']?></td>
                            </tr> 
                            <tr>
                                <td>Thương hiệu</td>
                                <td><?=$detail['ThuongHieu']?></td>
                            </tr>
                            <tr>
                                <td>CPU</td>
                                <td><?=$detail['CPU']?></td>
                            </tr>
                            <tr>
                                <td>RAM</td>
                                <td><?=$detail['RAM']?></td>
                            </tr>
                            <tr>
                                <td>Bộ nhớ</td>
                                <td><?=$detail['DungLuong']?>
                            <tr>
                                <td>Độ phân giải</td>
                                <td><?=$detail['DoPhanGiai']?></td>
                            </tr>
                        </table>
                    <?php else:?>
                        <p class="error">Chưa có thông số</p>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</main>