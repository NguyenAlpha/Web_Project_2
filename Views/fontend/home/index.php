<main>
    <div class="main">
        <div class="container product">
            <div class="all-product">             
            <?php foreach($categories as $value):?>
                <div class="product-box product-container">
                    <h2 class="name-list-product"><?=$value['TenLoai']?> bán chạy</h2>
                    <button class="arrow left-arrow" onclick="scrollLeftt(this)">&#9664;</button>
                    <div class="product__item home productWrapper">
                        <?php foreach($products as $item): ?>
                            <?php if($item['MaLoai'] == $value['MaLoai']):?>
                                <div class="product__item__card">
                                    <a href="./index.php?controller=product&action=show&id=<?= $item["MaSP"]?>">
                                        <div class="product__item__card__img">
                                            <img src="<?= $item['AnhMoTaSP']?>" alt="">
                                        </div>
                                        <div class="product__item__card__content">
                                            <h3 class="product__item__name"><?=$item["TenSP"]?></h3>
                                            <p class="product__item_price"><?=number_format($item["Gia"], 0, ',', '.') . "đ"?></p>
                                        </div>
                                    </a>
                                    <div class="button__addcart__box">
                                        <button class="button button__addcart" type="submit" name="addcart">Thêm vào giỏ</button>
                                    </div>
                                </div>
                            <?php endif;?>
                        <?php endforeach; ?>
                    </div>
                    <button class="arrow right-arrow" onclick="scrollRight(this)">&#9654;</button>
                </div>
            <?php endforeach;?>
            </div>
        </div>
    </div>
</main>
