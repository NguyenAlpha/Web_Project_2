<?php 
    // echo print_r($product);
    // echo print_r($details);


?>

<main>
    <div class="main">
        <div class="container">
            <div class="product__detail">
                <div class="product__detail__box1">
                    <!-- phần bên trái -->
                    <div class="product__detail--left">
                        <!-- hình ảnh sản phẩm-->
                        <img src="<?= $product['AnhMoTaSP']?>" alt=""> 
                    </div>

                    <!-- phần bên phải -->
                    <div class="product__detail--right">
                        <!-- tên sản phẩm -->
                        <?php if(!empty($productNameExtension)):?>
                            <h1 class="product__detail__name">
                                <?php echo $product['TenSP'] . ' ('. $productNameExtension . ')'?>
                            </h1>
                        <?php else:?>
                            <h1 class="product__detail__name"><?php echo $product['TenSP']?></h1>
                        <?php endif;?>

                        <!-- giá sản phẩm -->
                        <h2 class="product__detail__price">
                            <?=number_format($product["Gia"],
                             0, ',', '.') . "đ"?>
                        </h2>

                        <!-- các nút mua, giỏ hàng -->
                        <div class="product__button__buy__cart">
                            <button class="product__detail__buy" type="submit">MUA NGAY</button>
                            <button class="product__detail__cart" type="submit"><i class="fa-solid fa-cart-plus"></i>THÊM VÀO GIỎ</i></button>
                        </div>
                    </div>
                </div>
                <div class="product__detail__box2">
                    <h2 class="product__detail__title">Thông Số Kỹ Thuật</h2>

                    <?php if(!empty($details)):?>
                        <table class="product__detail__list">
                            <?php foreach($attributes as $nameAttributeVN => $nameAttributeInDB):?>
                                <?php if(isset($details[$nameAttributeInDB])):?>
                                    <tr>
                                        <td><?=$nameAttributeVN?></td>
                                        <td><?=$details[$nameAttributeInDB]?></td>
                                    </tr>
                                <?php endif;?>
                            <?php endforeach;?>
                        </table>
                    <?php else:?>
                        <p class="error">Chưa có thông số</p>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</main>