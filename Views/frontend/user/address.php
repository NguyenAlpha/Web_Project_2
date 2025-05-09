<div id="ajax-content-area">
<link rel="stylesheet" href="./Views/frontend/user/address.css">
<table>
            <tr><th>Địa chỉ</th></tr>

            <?php 
            foreach ($addresses as $addr): ?>
                <tr><td><?=($addr['address'])?> <button class="">sửa</button></td></tr>

            <?php endforeach; ?>

            </table>
        <br>
<form id="addAddressForm" class="mt-3 border p-3 bg-light">
  <div class="mb-2">
    <label>Địa chỉ</label>
    <input type="text" class="form-control" name="address" required>
  </div>
  <div class="mb-2">
    <label>Thành phố</label>
    <input type="text" class="form-control" name="city" required>
  </div>
  <button class="btn btn-success" type="submit">Lưu địa chỉ</button>
</form>
</div>

