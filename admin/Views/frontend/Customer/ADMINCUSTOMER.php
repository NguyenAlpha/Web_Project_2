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

// Xử lý các tham số lọc
$search = $_GET['search'] ?? '';
$sort = $_GET['sort'] ?? 'total_spent'; // Mặc định sắp xếp theo tổng tiền
$order = $_GET['order'] ?? 'DESC'; // Mặc định giảm dần

// Xây dựng câu truy vấn SQL với tổng tiền đã mua
$sql = "SELECT u.*, COALESCE(SUM(o.TongTien), 0) AS total_spent 
        FROM users u
        LEFT JOIN orders o ON u.ID = o.UserID AND o.TrangThai = 'đã giao'
        WHERE 1=1";
$params = [];

if (!empty($search)) {
    $sql .= " AND (u.username LIKE ? OR u.email LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

$sql .= " GROUP BY u.ID";

// Thêm phần sắp xếp
$validSortColumns = ['username', 'email', 'ID', 'total_spent'];
$sort = in_array($sort, $validSortColumns) ? $sort : 'total_spent';
$order = strtoupper($order) === 'DESC' ? 'DESC' : 'ASC';
$sql .= " ORDER BY $sort $order";

// Chuẩn bị và thực thi truy vấn
$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $types = str_repeat('s', count($params));
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

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
    min-height: 100vh;
}

.body {
    margin-left: 240px; /* Cần khớp với width của sidebar */
    padding: 20px;
    margin-top: 0;
    transition: margin-left 0.3s;
}

/* Header cố định */
.table-header {
    position: sticky;
    top: 0;
    z-index: 10;
}

.filter-section {
    background-color: white;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    font-size: 14px;
    table-layout: auto;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    border-radius: 8px;
    overflow: hidden;
}

th, td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #e0e0e0;
    word-wrap: break-word;
}

th {
    background-color: #3949ab;
    color: #fff;
    font-weight: 500;
    position: sticky;
    top: 0;
}

th.sortable:hover {
    background-color: #303f9f;
    cursor: pointer;
}

.sort-icon {
    margin-left: 5px;
    font-size: 0.8em;
}

tr:hover {
    background-color: #f5f7ff;
}

/* Điều chỉnh độ rộng cột */
th:nth-child(1), td:nth-child(1) { width: 15%; }
th:nth-child(2), td:nth-child(2) { width: 15%; }
th:nth-child(3), td:nth-child(3) { width: 25%; }
th:nth-child(4), td:nth-child(4) { width: 15%; }
th:nth-child(5), td:nth-child(5) { width: 15%; }
th:nth-child(6), td:nth-child(6) { width: 15%; }

.btn-action, .btn-xoa {
    padding: 6px 12px;
    font-size: 13px;
    margin: 2px;
    border-radius: 4px;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s;
    display: inline-block;
}

.btn-action {
    background-color: #3949ab;
    color: white;
    border: 1px solid #3949ab;
}

.btn-action:hover {
    background-color: #303f9f;
    border-color: #303f9f;
}

.btn-xoa {
    background-color: #d32f2f;
    color: white;
    border: 1px solid #d32f2f;
}

.btn-xoa:hover {
    background-color: #b71c1c;
    border-color: #b71c1c;
}

/* Popup giỏ hàng */
.popup-cart {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #fff;
    padding: 25px;
    width: 80%;
    max-width: 800px;
    max-height: 80vh;
    overflow-y: auto;
    box-shadow: 0 5px 25px rgba(0,0,0,0.2);
    z-index: 1050;
    border-radius: 8px;
}

.popup-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    z-index: 1040;
}

.popup-buttons {
    text-align: right;
    margin-top: 20px;
}

.close-button {
    padding: 8px 16px;
    background-color: #3949ab;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.close-button:hover {
    background-color: #303f9f;
}
.btn-an{


}

</style>

<div class="body">
<table>
  <thead>
    </>
      <th>ID</th>
      <th>Username</th>
      <th>Email</th>
      <th>Xem đơn hàng</th>
      <th>Xem chi tiết</th>
      <!-- <th>Thao tác</th> -->
    </tr>
  </thead>
  <tbody>
    <?php foreach($customers as $value): ?>

      <tr>    
        <td><?php echo  htmlspecialchars($value['ID']);?></td>
        <td><?php echo htmlspecialchars($value['username']); ?></td>
        <td><?php echo htmlspecialchars($value['email']); ?></td>
        <td>
          <a href="?controller=order&action=userOrder&userID=<?=$value['ID']?> " class="btn-action">Xem</a>
        <!-- </td>
        <>
          <a href="index.php?controller=admin&action=Editcustomer&id=<?= $value['ID'] ?>" class="btn-action">Sửa</a>
          <a href="index.php?controller=admin&action=deleteCustomer&id=<?= $value['ID'] ?>" class="btn-xoa" onclick="return confirm('Bạn có chắc muốn xoá khách hàng này không?')">Xoá</a>
           <a href="http://" class="btn-an">Ẩn</a> 
        </td> -->
        </td>
        <td> <a href="index.php?controller=admin&action=CustomerID&id=<?= $value['ID']?>" class="btn-action">Xem</a></td>
      </tr>

    <?php endforeach; ?>
  </tbody>
</table>