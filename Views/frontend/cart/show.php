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
                <?php if(isset($carts)):foreach($carts as $cart):?>
                <tr>
                    <td class="flex">
                        <img src="<?=$cart['AnhMoTaSP']?>" alt="">
                        <p class="name-product"><?=$cart['TenSP']?></p>
                    </td>
                    <td class="center"><?=$cart['Gia']?></td>
                    <td class="center"><?=$cart['SoLuong']?></td>
                    <td class="center"><?=$cart['TongTien']?></td>
                    <td class="center"><a href="#" class="delete-btn">Xóa</a></td>
                </tr>
                <?php endforeach;endif?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="center">Tổng tiền</td>
                    <td class="center">
                        <?php if(isset($carts)):?>
                            <?=array_sum(array_column($carts, 'TongTien'))?>
                        <?php endif?>
                    </td>
                    <td class="center buy-btn"><a href="">Mua hàng</a></td>
                </tr>
            </tfoot>
        </table>
    </div>
</main>