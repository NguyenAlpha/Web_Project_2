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
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <form action="?controller=order&action=addOrder" method="post">
    <div class="address address-block">
        <?php if(!empty($addresses)):?>
            <p class="cart-address__title">Địa chỉ nhận hàng</p>
            <p class="address"><b>Người Nhận: </b><?=$_SESSION['user']['username']?> (+84) <?=$_SESSION['user']['phonenumber']?></p>
            <div class="cart-address__info flex">
                <i class="fa-solid fa-location-dot"></i>
                <div class="">
                    <select name="address" required>
                        <?php foreach($addresses as $ar):?>
                        <option><?=$ar['address']?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>

        <?php else:?>
            <p class="cart-address__title">Địa chỉ nhận hàng</p>
            <p>chưa có địa chỉ! <select name="address" required hidden></select> <a href="?controller=user&action=show" class="address__add">Thêm mới</a></p>
        <?php endif;?>
    </div>
    <div class="pay pay--block">
        <h2 class="pay__title">Hình thức thanh toán</h2>
        <div class="pay__radio">
            <input type="radio" value="cash" name="pay" id="cash">
            <label for="cash"><i class="fa-solid fa-money-bill-1-wave"></i>Thanh toán tiền mặt khi nhận hàng</label>
        </div>
        <div class="pay__radio">
            <input type="radio" value="transfer" name="pay" id="transfer" required>
            <label for="transfer"><i class="fa-solid fa-money-bill-transfer"></i>Chuyển khoản ngân hàng</label>
        </div>
        <div class="flex pay-price">
            <p class="pay__sum-price-title">Tổng thanh toán: </p>
            <p class="pay__sum-price"><?=number_format($TongTien,0, ',', '.') . "đ"?></p>
        </div>
        <button type="submit" class="pay-submit">Đặt hàng</button>
    </div>
    </form>
</main>