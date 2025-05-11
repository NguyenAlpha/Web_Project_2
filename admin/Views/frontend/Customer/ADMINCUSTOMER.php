<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tmdt";
include "./Views/partitions/frontend/headerAdmin.php";

// Kết nối CSDL
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Truy vấn danh sách khách hàng
$sql = "SELECT * FROM users"; // hoặc 'users' nếu tên bảng là vậy
$result = $conn->query($sql);

$customers = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $customers[] = $row;
    }
}
?>
<style>
body {
    font-family: 'Segoe UI', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f6fa;
    color: #333;
}

.body {
    margin-left: 250px;
    padding: 20px;
    margin-top: 60px;
}

table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    font-size: 13px;
    table-layout: fixed;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    border-radius: 8px;
    overflow: hidden;
}

th, td {
    padding: 10px;
    text-align: center;
    border-bottom: 1px solid #e0e0e0;
    word-wrap: break-word;
}

th {
    background-color: #3949ab;
    color: #fff;
    font-size: 15px;
    top: 60px;
    z-index: 2;
}

tr:hover {
    background-color: #f1f1f1;
}

/* Cột */
th:nth-child(1), td:nth-child(1),
th:nth-child(2), td:nth-child(2),
th:nth-child(4), td:nth-child(4) {
    width: 15%;
}

th:nth-child(3), td:nth-child(3) {
    width: 25%;
}

th:nth-child(5), td:nth-child(5) {
    width: 20%;
}

.btn-action, .btn-xoa {
    padding: 5px 10px;
    font-size: 12px;
    margin: 2px;
    border-radius: 4px;
    text-decoration: none;
    cursor: pointer;
    transition: 0.2s ease-in-out;
}

.btn-action {
    background-color: #fff;
    color: #1a237e;
    border: 1px solid #1a237e;
}

.btn-action:hover {
    background-color: #1a237e;
    color: #fff;
}

.btn-xoa {
    background-color: #fff;
    color: #c62828;
    border: 1px solid #c62828;
}

.btn-xoa:hover {
    background-color: #c62828;
    color: #fff;
}

/* Popup giỏ hàng */
.popup-cart {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #fff;
    padding: 30px;
    max-width: 700px;
    width: 90%;
    box-shadow: 0 4px 20px rgba(0,0,0,0.2);
    z-index: 9999;
    border-radius: 10px;
}

.popup-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.4);
    z-index: 9998;
}

.popup-buttons {
    text-align: right;
    margin-top: 20px;
}

.close-button {
    padding: 6px 12px;
    background-color: #1a237e;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.close-button:hover {
    background-color: #303f9f;
}
</style>

<div class="body">
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
    const popup = document.getElementById('popupCart');
    const overlay = document.getElementById('popupOverlay');
    const cartContent = document.getElementById('cartContent');

    popup.style.display = 'block';
    overlay.style.display = 'block';

    // Loading spinner
    cartContent.innerHTML = '<div style="text-align:center;padding:20px;">Đang tải giỏ hàng...</div>';

    fetch(`index.php?controller=admin&action=CustomerCartAjax&customerID=${customerID}`)
    .then(response => {
        if (!response.ok) throw new Error('Không thể lấy dữ liệu');
        return response.text();
    })
    .then(data => {
        cartContent.innerHTML = data;
    })
    .catch(error => {
        console.error('Lỗi:', error);
        cartContent.innerHTML = '<div style="color:red; text-align:center;">Không thể tải giỏ hàng.</div>';
    });
}

function closeCartPopup() {
    document.getElementById('popupCart').style.display = 'none';
    document.getElementById('popupOverlay').style.display = 'none';
}
</script>

</div>
