<main>
    <div class="container product">
        <?php foreach($categories as $value):?>
            <div class="home-page product-container">
                <div class="home-page header-product-bar">
                    <h2 class="home-page name-product-bar"><?=$value['TenLoai']?> bán chạy</h2>
                    <div class="home-page line"></div>
                    <a href="./index.php?controller=category&action=show&id=<?=$value['MaLoai']?>" class="home-page see-more">xem tất cả<i class="fa fa-angle-double-right"></i></a>
                </div>
                <button class="home-page arrow left-arrow" onclick="scrollLeftt(this)"><i class="fa-solid fa-arrow-left"></i></button>
                <div class="home-page product__bar productWrapper">
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
                                    <button class="button button__addcart" type="submit" name="addcart">Mua ngay</button>
                                </div>
                            </div>
                        <?php endif;?>
                    <?php endforeach; ?>
                </div>
                <button class="home-page arrow right-arrow" onclick="scrollRight(this)"><i class="fa-solid fa-arrow-right"></i></button>
            </div>
        <?php endforeach;?>
    </div>
</main>
