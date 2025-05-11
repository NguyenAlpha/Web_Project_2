<div id="ajax-content-area">
<link rel="stylesheet" href="./Views/frontend/user/address.css">

<table>
    <tr><th>Địa chỉ</th></tr>
    <?php foreach ($addresses as $addr): ?>
        <tr>
            <td>
                <?= htmlspecialchars($addr['address']) ?>
                <div class="tools">
                    <!-- Nút sửa hiển thị đúng form theo ID -->
                    <button onclick="toggleEditForm(<?= $addr['id'] ?>)" class="btn-edit" type="button">Sửa</button>
                    <a href="index.php?controller=Address&action=deleteaddress&id=<?= $addr['id'] ?>" class="btn btn-delete">Xóa</a>
                </div>

                <!-- Form sửa địa chỉ riêng biệt theo ID -->
                <form id="editForm_<?= $addr['id'] ?>" style="display:none;" class="mt-3 border p-3 bg-light" method="post" action="index.php?controller=Address&action=updateaddress&id=<?= $addr['id'] ?>">
                    <input type="hidden" name="controller" value="address">
                    <input type="hidden" name="action" value="updateaddress">
                    <input type="hidden" name="id" value="<?= $addr['id']?>">
                <div class="mb-2">
                        <label>Địa chỉ mới</label>
                        <input type="text" class="form-control" name="address" value="<?= htmlspecialchars($addr['address']) ?>" required>
                    </div>
                    <button  class="btn btn-edit" type="submit">Lưu địa chỉ</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>


<div class="center-button">
        <button onclick="bindAddressFormEvents()" class="btn-address" type="button">Thêm địa chỉ</button>
        
        <br>
        
        <form id="addAddressForm" method="get" action="index.php"  style="display:none;" class="mt-3 border p-3 bg-light">
            <input type="hidden" name="controller" value="Address">
            <input type="hidden" name="action" value="addaddress">
            <input type="hidden" name="userID" value="<?=$_SESSION['user']['ID']?>">
            <div class="mb-2">
                <label>Địa chỉ</label>
                <input type="text" class="form-control" name="address" required>
            </div>
            <button class="btn btn-success" type="submit">Lưu địa chỉ</button>
        </form>
    </div>

  
 