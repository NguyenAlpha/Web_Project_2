<main>
    <div class="main">
        <div class="container">
            <div class="filter__box">
                <form action="./test.php" method="get">
                    <?php foreach($filters as $attribute => $lists): ?>
                        <p class="filter__attribute"><?=$attribute?></p>
                        <?php foreach($lists as $value):
                            $safeId = strtolower(str_replace(" ", "_", $value)); // ID hợp lệ?> 
                            <div class="">
                                <input type="checkbox" id="<?=$safeId?>" name="<?=$attribute?>[]" value="<?=$value?>">
                                <label for="<?=$safeId?>"> <?=$value?> </label>
                            </div>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                    <input type="submit" value="LỌC">
                </form>
            </div>
            <div class="product__item">
                <?php foreach($products as $item): ?>
                    <div class="product__item__card">
                    <a href="./index.php?controller=product&action=show&id=<?=$item["MaSP"]?>">
                        <div class="product__item__card__img">
                            <img src="<?=$item['AnhMoTaSP']?>" alt="">
                        </div>
                        <div class="product__item__card__content">
                            <h3 class="product__item__name"><?=$item["TenSP"]?></h3>
                            <p class="product__item_price"><?=number_format($item["Gia"], 0, ',', '.') . "đ"?></p>
                        </div>
                    </a>
                    
                        <button class="button button__addcart" type="submit" name="addcart">Thêm vào giỏ</button>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>