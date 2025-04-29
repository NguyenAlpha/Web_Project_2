<?php
include_once(__DIR__ . '/../../../Core/Database.php');
include "./Views/partitions/frontend/headerAdmin.php";
?>
<style>
    body {
    font-family: 'Segoe UI', sans-serif;
    background-color: #eef2f7;
    margin: 0;
    padding: 30px;
}

h1 {
    text-align: center;
    color: #00268c;
    font-size: 32px;
    margin-bottom: 40px;
}

table {
    width: 95%;
    max-width: 1200px;
    margin: auto;
    border-collapse: collapse;
    background-color: white;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    overflow: hidden;
}

th, td {
    padding: 16px 20px;
    text-align: left;
    border-bottom: 1px solid #f0f0f0;
}

th {
    background-color: #00268c;
    color: white;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-size: 14px;
}

tr:hover {
    background-color: #f4f8ff;
}

td a {
    color: #0056d2;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

td a:hover {
    color: #00268c;
    text-decoration: underline;
}

.btn-action {
    display: inline-block;
    padding: 8px 14px;
    margin-right: 6px;
    background-color: rgb(253, 253, 253);
    color: #00268c;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 500;
    font-size: 14px;
    transition: background-color 0.3s ease;
    border: 1px solid #00268c;
}

.btn-action:hover {
    background-color: #001f6d;
    color: white;
    text-decoration: none;
}

.btn-xoa {
    display: inline-block;
    padding: 8px 14px;
    margin-right: 6px;
    background-color: rgb(253, 253, 253);
    color: rgb(208, 2, 2);
    border-radius: 6px;
    text-decoration: none;
    font-weight: 500;
    font-size: 14px;
    transition: background-color 0.3s ease;
    border: 1px solid rgb(208, 2, 2);
}

.btn-xoa:hover {
    background-color: rgb(208, 2, 2);
    color: white;
}

.addsp {
    text-align: center;
    margin-top: 30px;
}

.addsp a {
    display: inline-block;
    padding: 10px 20px;
    background-color: white;
    color: #001f6d;
    text-decoration: none;
    border-radius: 6px;
    font-weight: bold;
    transition: background-color 0.3s ease;
    border: 1px solid #001f6d;
}

.addsp a:hover {
    background-color: #001f6d;
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
    max-width: 1000px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    border-radius: 10px;
    z-index: 1000;
    overflow-y: auto;
    max-height: 90%;
}

.popup-cart h2 {
    margin-top: 0;
    color: #00268c;
}

.popup-buttons {
    text-align: right;
    margin-top: 20px;
}

.popup-buttons button {
    background-color: #ccc;
    color: black;
    padding: 8px 16px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

.popup-buttons button:hover {
    background-color: #bbb;
}

.popup-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 999;
}
.close-button
{
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: #fff;
    border: none;
    border-radius: 50px;
    padding: 10px 24px;
    font-size: 15px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 6px 15px rgba(102, 126, 234, 0.4);
}
.close-button:hover
{
    background: linear-gradient(135deg, #5a67d8, #6b46c1);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.6);
    transform: translateY(-2px);
}
</style>

<h1>Danh sách khách hàng</h1>

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
          <a href="index.php?controller=admin&action=Editcustomer&id=<?= $value['ID'] ?>" class="btn-action">Sửa</a>
          <a href="index.php?controller=admin&action=deleteCustomer&id=<?= $value['ID'] ?>" class="btn-xoa" onclick="return confirm('Bạn có chắc muốn xoá khách hàng này không?')">Xoá</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<div class="addsp">
  <a href="index.php?controller=admin&action=addCustomer">Thêm khách hàng</a>
</div>

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
