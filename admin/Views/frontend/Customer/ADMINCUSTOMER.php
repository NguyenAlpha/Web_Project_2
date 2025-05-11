<?php
include_once(__DIR__ . '/../../../../Core/Database.php');
include "./Views/partitions/frontend/headerAdmin.php";
?>
<style>
    body {
    font-family: 'Segoe UI', sans-serif;
    background-color: #f4f6fa;
    margin: 0;
    padding: 20px;
}

h1 {
    text-align: center;
    color: #1a237e;
    font-size: 28px;
    margin-bottom: 30px;
}

table {
    width: 90%;
    margin: 0 auto;
    border-collapse: collapse;
    background-color: #ffffff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

th, td {
    padding: 16px;
    text-align: center;
    border-bottom: 1px solid #f0f0f0;
}

th {
    background-color: #1a237e;
    color: #ffffff;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

td {
    font-size: 14px;
    color: #333;
}

tr:hover {
    background-color: #f9fbff;
}

.btn-action, .btn-xoa {
    padding: 8px 16px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 500;
    font-size: 13px;
    border: 1px solid;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-block;
    margin: 2px;
}

.btn-action {
    color: #1a237e;
    background-color: #fff;
    border-color: #1a237e;
}

.btn-action:hover {
    background-color: #1a237e;
    color: #fff;
}

.btn-xoa {
    color: #c62828;
    background-color: #fff;
    border-color: #c62828;
}

.btn-xoa:hover {
    background-color: #c62828;
    color: #fff;
}

.addsp {
    text-align: center;
    margin-top: 25px;
}

.addsp a {
    padding: 10px 22px;
    background-color: #fff;
    color: #1a237e;
    border: 1px solid #1a237e;
    border-radius: 6px;
    font-weight: bold;
    text-decoration: none;
    transition: all 0.3s ease;
}

.addsp a:hover {
    background-color: #1a237e;
    color: white;
}

/* Popup */
.popup-cart {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    padding: 30px;
    width: 80%;
    max-width: 900px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    border-radius: 12px;
    z-index: 1000;
    max-height: 90%;
    overflow-y: auto;
}

.popup-cart h2 {
    margin-top: 0;
    color: #1a237e;
}

.popup-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.4);
    width: 100%;
    height: 100%;
    z-index: 999;
}

.close-button {
    background-color: #1a237e;
    color: white;
    padding: 10px 18px;
    border: none;
    border-radius: 6px;
    font-size: 14px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.close-button:hover {
    background-color: #0d1546;
}
/* Bố cục hiển thị gồm sidebar trái + nội dung phải */
body {
    display: flex;
    margin: 0;
    padding: 0;
}

.sidebar {
    width: 250px;
    background-color: #0d2a63;
    min-height: 100vh;
}

.main-content {
    flex: 1;
    padding: 30px 40px;
    background-color: #f4f6fa;
}

.main-content h1 {
    text-align: center;
}
</style>
<table>
  <thead>
    <tr>
      <th>Username</th>
      <th>Password</th>
      <th>Email</th>
      <th>Giỏ hàng</th>
      <th>Thao tác</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($customers as $value): ?>
      <tr>
        <td><?php echo htmlspecialchars($value['username']); ?></td>
        <td><?php echo htmlspecialchars($value['password']); ?></td>
        <td><?php echo htmlspecialchars($value['email']); ?></td>
        <td>
          <a href="javascript:void(0);" class="btn-action" onclick="openCartPopup(<?= $value['ID'] ?>)">Xem</a>
        </td>
        <td>
          <a href="admin/index.php?controller=admin&action=Editcustomer&id=<?= $value['ID'] ?>" class="btn-action">Sửa</a>
          <a href="admin/index.php?controller=admin&action=deleteCustomer&id=<?= $value['ID'] ?>" class="btn-xoa" onclick="return confirm('Bạn có chắc muốn xoá khách hàng này không?')">Xoá</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<!-- Popup hiển thị giỏ hàng -->
<div id="popupCart" class="popup-cart">
    <h2 id="popupCartTitle"></h2>
    <div id="cartContent"></div>
    <div class="popup-buttons">
        <button class="close-button"onclick="closeCartPopup()">Đóng</button>
    </div>
</div>

<div id="popupOverlay" class="popup-overlay"></div>

<script>
function openCartPopup(customerID) {
    document.getElementById('popupCart').style.display = 'block';
    document.getElementById('popupOverlay').style.display = 'block';
    document.getElementById('cartContent').innerHTML = "Đang tải giỏ hàng...";
    fetch(`index.php?controller=admin&action=CustomerCartAjax&customerID=${customerID}`)
    .then(response => response.text())
    .then(data => {
        document.getElementById('cartContent').innerHTML = data;
    })
    .catch(error => {
        console.error('Lỗi:', error);
        document.getElementById('cartContent').innerHTML = "Không tải được giỏ hàng.";
    });
}

function closeCartPopup() {
    document.getElementById('popupCart').style.display = 'none';
    document.getElementById('popupOverlay').style.display = 'none';
}
</script>
