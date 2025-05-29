<style>
    /* QR Modal Styles */
.modal {
  display: none;
  position: fixed;
  z-index: 1000;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.7);
}

.modal-content {
  background-color: #fefefe;
  margin: 10% auto;
  padding: 20px;
  border-radius: 8px;
  width: 400px;
  max-width: 90%;
  text-align: center;
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  cursor: pointer;
}

.qr-code img {
  width: 200px;
  height: 200px;
  margin: 15px auto;
  border: 1px solid #ddd;
}

.bank-info {
  text-align: left;
  margin: 15px 0;
  padding: 10px;
  background: #f5f5f5;
  border-radius: 5px;
}

.btn-confirm {
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin-top: 10px;
}
</style>

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
        <div id="qrModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Quét mã QR để thanh toán</h2>
    <div class="qr-code">
      <!-- Thay bằng mã QR thực tế của bạn -->
      <img src="./assets/image/z6592483894009_ba539f3a883a0e30a90e77d373d81d33.jpg" alt="Mã QR Thanh Toán">
    </div>
    <div class="bank-info">
      <p><strong>Ngân hàng:</strong> Vietcombank</p>
      <p><strong>Số tài khoản:</strong> 123456789</p>
      <p><strong>Chủ tài khoản:</strong> CÔNG TY TNHH ABC</p>
      <p><strong>Số tiền:</strong> <?=number_format($TongTien,0, ',', '.')?>đ</p>
      <p><strong>Nội dung:</strong> THANHTOAN <?=$_SESSION['user']['ID']?></p>
    </div>
    <button id="confirmPayment" class="btn-confirm" type="submit">Tôi đã thanh toán</button>
  </div>
</div>
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
<script>
// Lấy các phần tử DOM
const transferRadio = document.getElementById('transfer');
const qrModal = document.getElementById('qrModal');
const closeBtn = document.querySelector('.close');
const confirmBtn = document.getElementById('confirmPayment');
const payForm = document.querySelector('form');

// Khi chọn thanh toán chuyển khoản
transferRadio.addEventListener('change', function() {
  if(this.checked) {
    qrModal.style.display = 'block';
  }
});

// Đóng modal khi click nút X
closeBtn.onclick = function() {
  qrModal.style.display = 'none';
}

// Đóng modal khi click bên ngoài
window.onclick = function(event) {
  if (event.target == qrModal) {
    qrModal.style.display = 'none';
  }
}

// Xác nhận đã thanh toán
confirmBtn.onclick = function() {
  qrModal.style.display = 'none';
  payForm.submit(); // Gửi form đặt hàng
}
</script>