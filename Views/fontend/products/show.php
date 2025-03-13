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
                        <h1 class="product__detail__name">
                            <?php echo $product['TenSP'] . " (
                            {$detail['CPU']}/
                            {$detail['RAM']}GB/
                            {$detail['DungLuong']}GB/
                            {$detail['KichThuocManHinh']} inch/
                            {$detail['DoPhanGiai']}
                            )" ?>
                        </h1>

                        <h2 class="product__detail__price">
                            <?=number_format($product["Gia"],
                             0, ',', '.') . "đ"?>
                        </h2>

                        <div class="product__button__buy__cart">
                            <button class="product__detail__buy" type="submit">MUA NGAY</button>
                            <button class="product__detail__cart" type="submit">THÊM VÀO GIỎ</button>
                        </div>
                    </div>
                </div>

                
                <div class="product__detail__box2">
                    <h2 class="product__detail__title">Thông Tin Sản phẩm</h2>
                    <table class="product__detail__list">
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
                            <td><?=$detail['RAM'] . "GB"?></td>
                        </tr>
                        <tr>
                            <td>Bộ nhớ</td>
                            <td><?=$detail['DungLuong'] . "GB"?></td>
                        </tr>
                        <tr>
                            <td>Kích thước màn hình</td>
                            <td><?=$detail['KichThuocManHinh'] . " inch"?></td>
                        </tr>
                        <tr>
                            <td>Độ phân giải</td>
                            <td><?=$detail['DoPhanGiai']?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>