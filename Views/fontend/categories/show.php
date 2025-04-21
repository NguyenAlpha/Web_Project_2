<main>
    <div class="main">
        <div class="container category">
            <div class="category__left">
                <div class="filter__box">
                
                <!-- Nếu danh mục có filter -->
                <?php if(!empty($filters)): ?>
                    <form action="./index.php?controller=category&action=show&id=<?=$_GET['id']?>" method="post" id="filterForm">
                        <!--
                            biến $attributes là mảng liên kết với key là tên thuộc tính có dấu và value là tên thuộc tính không dấu
                            Ví dụ: ["Thương hiệu" => "ThuongHieu",
                                    "Dung Lượng" => "DungLuong"];
                            biến $filters là mảng liên kết với key là tên thuộc tính có dấu và value là mảng giá trị của thuộc tính đó
                            Ví dụ: ["Thương hiệu" => ["HP", "Asus"],
                                    "Dung Lượng" => ["8GB", "16GB", "24GB"]];
                        -->
                        <!-- Duyệt qua từng thuộc tính trong filter -->
                        <?php foreach($filters as $attribute => $listsValue): ?>
                            <!-- Hiện tên thuộc tính -->
                            <p class="filter__attribute"><?=$attribute?></p>

                            <!-- Duyệt qua tường giá trị của thuộc tính -->
                            <?php foreach($listsValue as $value):
                                // Id hợp lệ(không chứa khoảng trắng)
                                $safeId = strtolower(str_replace(" ", "_", $value));?>
                                <div class="filter__attribute__item">
                                    <!-- Nếu thuộc tính đã đã có chọn và giá trị của thuộc tính đó có trong có chọn -->
                                    <?php if(isset($_POST[$attributes[$attribute]]) && 
                                            in_array($value, $_POST[$attributes[$attribute]]) && !empty($value)):?>
                                        <label for="<?=$safeId?>">
                                            <input type="checkbox" id="<?=$safeId?>" name="<?=$attributes[$attribute]?>[]" value="<?=$value?>" checked>
                                            <?=$value?>
                                        </label>
                                    <!-- Nếu thuộc tính chưa được chọn -->
                                    <?php elseif(!empty($value)):?>
                                        <label for="<?=$safeId?>">
                                            <input type="checkbox" id="<?=$safeId?>" name="<?=$attributes[$attribute]?>[]" value="<?=$value?>">
                                            <?=$value?>
                                        </label>
                                    <?php endif;?>
                                </div>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                        <div class="filter__button__box">
                            <button type="submit" class="filter__button" name='submit' value="filter" id="filterButton" disabled>Tìm kiếm</button>
                        </div>
                    </form>
                <!-- Nếu danh mục chua có filter -->
                <?php else:?>
                    <p class="error">Chưa có bộ lọc</p>
                <?php endif;?>
                </div>
            </div>
            <div class="category__right">
                <?php if(!empty($products)):?>
                    <div class="product__item wrap">
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
                                <div class="button__addcart__box">
                                    <button class="button button__addcart" type="submit" name="addcart">Mua ngay</button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
    
                <?php else:?>
                        <p class="error">không có sản phẩm nào</p>
                <?php endif;?>
                <?php if ($totalPages > 1): ?>
                    <div class="pagination category">
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <a 
                                href="?controller=category&action=show&id=<?= $_GET['id'] ?>&page=<?= $i ?>" 
                                class="pagination__link <?= ($i == $currentPage) ? 'active' : '' ?>">
                                <?=$i?>
                            </a>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
</main>