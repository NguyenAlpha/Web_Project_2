<main>
    <div class="main">
        <div class="container search">
            <h2 class="search title">Nội dung tìm kiếm: "<?=$textSearch?>"</h2>
            <div class="product__item wrap">
                <?php foreach($products as $item): ?>
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
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>

