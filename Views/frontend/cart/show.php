<main class="main container cart-container">
    <div class="cart">
        <table class="table table-cart">
            <thead>
                <tr>
                    <th width="500px">Sản phẩm</th>
                    <th width="200px">Đơn giá</th>
                    <th width="100px">Số lượng</th>
                    <th width="300px">Số Tiền</th>
                    <th width="100px">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php $TongTien = 0;if(isset($carts)):foreach($carts as $cart):
                    $TongTien += $cart['TongTien']?>
                <tr>
                    <td>
                        <a href="?controller=product&action=show&id=<?=$cart['MaSP']?>" class="flex">
                            <img src="<?=$cart['AnhMoTaSP']?>" alt="">
                            <p class="name-product"><?=$cart['TenSP']?></p>
                        </a>
                        </td>
                    <td class="center td-Gia"><?=number_format($cart['Gia'],0, ',', '.') . "đ"?></td>
                    <td class="center">
                        <div class="detail__count">
                            <i class="fa-solid fa-minus"></i>
                            <input type="text" class="count-input input-number" value="<?=$cart['SoLuong']?>" min="1" max="<?=$cart['quantity']?>" name="quantity">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                    </td>
                    <td class="center td-SoTien"><?=number_format($cart['TongTien'], 0, ',', '.') . "đ"?></td>
                    <td class="center"><a href="?controller=cart&action=delete&id=<?=$cart['ID']?>" class="delete-btn">Xóa</a></td>
                    <td class="hidden td-ID"><?=$cart['ID']?></td>
                </tr>
                <?php endforeach;endif?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="center">Tổng tiền</td>
                    <td class="center TongTien">
                        <?php if(isset($carts)):?>
                            <?=number_format($TongTien,0, ',', '.') . "đ"?>
                        <?php endif?>
                    </td>
                    <td class="center buy-btn"><a href="">Mua hàng</a></td>
                </tr>
            </tfoot>
        </table>
    </div>
</main>