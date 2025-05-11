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
<<<<<<< HEAD
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
          <a href="javascript:void(0);" class="btn-action" onclick="openCartPopup(<?= $value['ID'] ?>)">Xem</a>
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

<!-- Popup hiển thị giỏ hàng -->
<div id="popupCart" class="popup-cart">
    <h2 id="popupCartTitle"></h2>
    <div id="cartContent"></div>
    <div class="popup-buttons">
        <button class="close-button"onclick="closeCartPopup()">Đóng</button>
=======

/* Form tìm kiếm */
.search-form {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
    align-items: center;
}

.search-input {
    flex: 1;
    padding: 10px 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
    min-width: 200px;
}

.search-button, .reset-button {
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 5px;
}

.search-button {
    background-color: #3949ab;
    color: white;
    border: none;
}

.search-button:hover {
    background-color: #303f9f;
}

.reset-button {
    background-color: #f5f5f5;
    color: #333;
    border: 1px solid #ddd;
    text-decoration: none;
}

.reset-button:hover {
    background-color: #e0e0e0;
}

.total-spent {
    font-weight: 600;
    color: #2e7d32;
    text-align: right;
}

.empty-message {
    text-align: center;
    padding: 30px;
    color: #666;
    font-style: italic;
}

/* Responsive */
@media (max-width: 992px) {
    .body {
        margin-left: 0;
        padding-top: 70px;
    }
    
    table {
        display: block;
        overflow-x: auto;
    }
}
</style>

<div class="body">
<table>
  <thead>
    <tr>
      <th>Username</th>
      <th>Password</th>
      <th>Email</th>
      <th>Xem đơn hàng</th>
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
          <a href="?controller=order&action=userOrder&userID=<?=$_SESSION['user']['ID']?>" class="btn-action">Xem</a>
        </td>
        <td>
          <a href="index.php?controller=admin&action=Editcustomer&id=<?= $value['ID'] ?>" class="btn-action">Sửa</a>
          <a href="index.php?controller=admin&action=deleteCustomer&id=<?= $value['ID'] ?>" class="btn-xoa" onclick="return confirm('Bạn có chắc muốn xoá khách hàng này không?')">Xoá</a>
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
    <!-- Phần lọc và tìm kiếm -->
    <div class="filter-section">
        <h2 style="color: #3949ab; margin-bottom: 20px;">Quản lý khách hàng</h2>
        
        <form method="GET" action="" class="search-form">
            <input type="hidden" name="controller" value="admin">
            <input type="hidden" name="action" value="customer">
            
            <input type="text" class="search-input" name="search" 
                   value="<?= htmlspecialchars($search) ?>" 
                   placeholder="Tìm theo tên hoặc email">
            
            <button type="submit" class="search-button">
                <i class="bi bi-search"></i> Tìm kiếm
            </button>
            
            <a href="?controller=admin&action=customer" class="reset-button">
                <i class="bi bi-arrow-counterclockwise"></i> Xóa lọc
            </a>
        </form>
>>>>>>> ac6261dfc8b632095f699b7f02e17260ecf384a9
    </div>

    <table>
        <thead>
            <tr>
                <th class="sortable" onclick="sortTable('username')">
                    Username
                    <?php if ($sort === 'username'): ?>
                        <i class="bi bi-arrow-<?= $order === 'ASC' ? 'up' : 'down' ?> sort-icon"></i>
                    <?php endif; ?>
                </th>
                <th>Password</th>
                <th class="sortable" onclick="sortTable('email')">
                    Email
                    <?php if ($sort === 'email'): ?>
                        <i class="bi bi-arrow-<?= $order === 'ASC' ? 'up' : 'down' ?> sort-icon"></i>
                    <?php endif; ?>
                </th>
                <th class="sortable total-spent-header" onclick="sortTable('total_spent')">
                    Tổng tiền đã mua
                    <?php if ($sort === 'total_spent'): ?>
                        <i class="bi bi-arrow-<?= $order === 'ASC' ? 'up' : 'down' ?> sort-icon"></i>
                    <?php endif; ?>
                </th>
                <th>Xem đơn hàng</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($customers)): ?>
                <?php foreach($customers as $value): ?>
                    <tr>
                        <td><?= htmlspecialchars($value['username']) ?></td>
                        <td><?= htmlspecialchars($value['password']) ?></td>
                        <td><?= htmlspecialchars($value['email']) ?></td>
                        <td class="total-spent text-center"><?= number_format($value['total_spent'], 0, ',', '.') ?> ₫</td>
                        <td>
                            <a href="javascript:void(0);" class="btn-action" onclick="openCartPopup(<?= $value['ID'] ?>)">Xem</a>
                        </td>
                        <td>
                            <a href="index.php?controller=admin&action=Editcustomer&id=<?= $value['ID'] ?>" class="btn-action">Sửa</a>
                            <a href="index.php?controller=admin&action=deleteCustomer&id=<?= $value['ID'] ?>" class="btn-xoa" onclick="return confirm('Bạn có chắc muốn xoá khách hàng này không?')">Xoá</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align: center; padding: 20px;">Không tìm thấy khách hàng nào</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <!-- Popup hiển thị giỏ hàng -->
    <div id="popupCart" class="popup-cart">
        <h2 id="popupCartTitle"></h2>
        <div id="cartContent"></div>
        <div class="popup-buttons">
            <button class="close-button" onclick="closeCartPopup()">Đóng</button>
        </div>
    </div>

    <div id="popupOverlay" class="popup-overlay"></div>

    <script>
    function sortTable(column) {
        const url = new URL(window.location.href);
        const currentSort = url.searchParams.get('sort');
        const currentOrder = url.searchParams.get('order');
        
        // Xác định thứ tự sắp xếp mới
        let newOrder = 'ASC';
        if (currentSort === column) {
            newOrder = currentOrder === 'ASC' ? 'DESC' : 'ASC';
        }
        
        // Cập nhật tham số URL
        url.searchParams.set('sort', column);
        url.searchParams.set('order', newOrder);
        
        // Chuyển hướng đến URL mới
        window.location.href = url.toString();
    }

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