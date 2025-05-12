    <!-- Views/admin/order/orderlist.php -->
    <?php
    include "./Views/partitions/frontend/headerAdmin.php";
    $status = $_GET['status'] ?? '';
    $fromDate = $_GET['from_date'] ?? '';
    $toDate = $_GET['to_date'] ?? '';
    $district = $_GET['district'] ?? '';
    $city = $_GET['city'] ?? '';
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="orderlist.css">
<style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: Arial, sans-serif;
    }

    .dashboard {
      display: flex;
      min-height: 100vh;
    }

    .sidebar {
      width: 220px;
      background-color: #002f6c;
      color: white;
      padding: 20px;
      position: fixed;
      top: 0;
      left: 0;
      bottom: 0;
    }

    .main-content {
      margin-left: 220px; /* Khoảng trống bằng chiều rộng sidebar */
      padding: 20px;
      width: calc(100% - 220px);
      overflow-x: auto;
    }

    .table-container {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
        background-color: #00268c;
        color: white;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 14px;
        text-align: center;
        position: relative;
        }
    th.sortable:hover {
        background-color: #001a63;
        cursor: pointer;
    }

    th .sort-icon {
        margin-left: 5px;
    }


    button {
      margin-right: 5px;
    }
    .container {
    margin-left: 260px; /* hoặc đúng chiều rộng của sidebar */
    padding: 20px;
    }
    .filter-section {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
    
    .filter-row {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 15px;
    }
    
    .filter-group {
        flex: 1;
        min-width: 200px;
    }
    
    .filter-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: 500;
    }
    
    .filter-group select,
    .filter-group input {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    
    .filter-actions {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }
    
    .filter-btn {
        padding: 8px 16px;
        background-color: #00268c;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    
    .reset-btn {
        padding: 8px 16px;
        background-color: #6c757d;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    
    .badge {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
    }
    
    .bg-success {
        background-color: #28a745;
        color: white;
    }
    
    .bg-warning {
        background-color: #ffc107;
        color: #212529;
    }
    
    .bg-primary {
        background-color: #007bff;
        color: white;
    }
    
    .bg-info {
        background-color: #17a2b8;
        color: white;
    }
  </style>


    </head>
    <body>
      <div class="container mt-5">
        <h2 class="mb-4">📋 Danh sách đơn hàng</h2>
        
        <!-- Phần lọc đơn hàng -->
        <div class="filter-section">
            <form method="get" action="index.php">
              <input type="hidden" name="controller" value="admin">
              <input type="hidden" name="action" value="orderList">
                
                <div class="filter-row">
                    <!-- Lọc theo trạng thái -->
                    <div class="filter-group">
                        <label for="status">Trạng thái đơn hàng</label>
                        <select id="status" name="status">
                            <option value="">Tất cả trạng thái</option>
                            <option value="chưa xử lý" <?= $status === 'chưa xử lý' ? 'selected' : '' ?>>Chưa xử lý</option>
                            <option value="đang giao" <?= $status === 'đang giao' ? 'selected' : '' ?>>Đang giao</option>
                            <option value="đã giao" <?= $status === 'đã giao' ? 'selected' : '' ?>>Đã giao</option>
                            <option value="đã xác nhận" <?= $status === 'đã xác nhận' ? 'selected' : '' ?>>Đã xác nhận</option>
                        </select>
                    </div>
                    
                    <!-- Lọc theo khoảng thời gian -->
                    <div class="filter-group">
                        <label for="from_date">Từ ngày</label>
                        <input type="date" id="from_date" name="from_date" value="<?= $fromDate ?>">
                    </div>
                    
                    <div class="filter-group">
                        <label for="to_date">Đến ngày</label>
                        <input type="date" id="to_date" name="to_date" value="<?= $toDate ?>">
                    </div>
                </div>
                
                <div class="filter-row">
                    <!-- Lọc theo địa điểm -->
                    <div class="filter-group">
                        <label for="city">Thành phố</label>
                        <select id="city" name="city" onchange="loadDistricts(this.value)">
                            <option value="">Tất cả thành phố</option>
                            <?php foreach ($cities as $cityItem): ?>
                                <option value="<?= $cityItem ?>" <?= $city === $cityItem ? 'selected' : '' ?>>
                                    <?= $cityItem ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="district">Quận/Huyện</label>
                        <select id="district" name="district">
                            <option value="">Tất cả quận/huyện</option>
                            <?php foreach ($districts as $districtItem): ?>
                                <option value="<?= $districtItem ?>" <?= $district === $districtItem ? 'selected' : '' ?>>
                                    <?= $districtItem ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <div class="filter-actions">
                    <button type="submit" class="filter-btn">Lọc đơn hàng</button>
                    <a href="index.php?controller=admin&action=orderList" class="reset-btn">Xóa lọc</a>
                </div>
            </form>
        </div>
        
        <table class="table table-bordered table-hover">
            <thead class="table-primary">
                <tr>
                    <th>Mã đơn</th>
                    <th>Người dùng</th>
                    <th>Địa chỉ</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td>#<?= $order['MaDon'] ?></td>
                        <td><?= $order['UserID'] ?></td>
                        <td><?= $order['DiaChi'] ?></td>
                        <td><?= $order['NgayDat'] ?? 'N/A' ?></td>
                        <td><?= number_format($order['TongTien'], 0, ',', '.') ?> đ</td>
                        <td>
                            <?php if ($order['TrangThai'] === 'đã xác nhận'): ?>
                                <span class="badge bg-success">Đã xác nhận</span>
                            <?php elseif ($order['TrangThai'] === 'đã giao'): ?>
                                <span class="badge bg-primary">Đã giao</span>
                            <?php elseif ($order['TrangThai'] === 'đang giao'): ?>
                                <span class="badge bg-info">Đang giao</span>
                            <?php else: ?>
                                <span class="badge bg-warning"><?= $order['TrangThai'] ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <form method="post" action="index.php?controller=admin&action=updateOrderStatus" style="display: inline-block;">
                                <input type="hidden" name="MaDon" value="<?= $order['MaDon'] ?>">
                                <select name="TrangThai" class="form-select form-select-sm" required>
                                    <option value="chưa xử lý" <?= $order['TrangThai'] == 'chưa xử lý' ? 'selected' : '' ?>>Chưa xử lý</option>
                                    <option value="đang giao" <?= $order['TrangThai'] == 'đang giao' ? 'selected' : '' ?>>Đang giao</option>
                                    <option value="đã giao" <?= $order['TrangThai'] == 'đã giao' ? 'selected' : '' ?>>Đã giao</option>
                                    <option value="đã xác nhận" <?= $order['TrangThai'] == 'đã xác nhận' ? 'selected' : '' ?>>Đã xác nhận</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary mt-1">Cập nhật</button>
                            </form>
                            
                            <a href="index.php?controller=order&action=printInvoice&maDon=<?= $order['MaDon'] ?>" target="_blank" class="btn btn-info btn-sm">
                                🧾 In hóa đơn
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <script>
    // Hàm load quận/huyện theo thành phố (cần API hoặc dữ liệu từ server)
    function loadDistricts(city) {
        // Đây là ví dụ, cần thay bằng API thực tế
        const districtsByCity = {
            "Hà Nội": ["Ba Đình", "Hoàn Kiếm", "Hai Bà Trưng", "Đống Đa", "Cầu Giấy"],
            "Hồ Chí Minh": ["Quận 1", "Quận 3", "Quận 5", "Quận 10", "Phú Nhuận"],
            "Đà Nẵng": ["Hải Châu", "Thanh Khê", "Sơn Trà", "Ngũ Hành Sơn"]
        };
        
        const districtSelect = document.getElementById('district');
        districtSelect.innerHTML = '<option value="">Tất cả quận/huyện</option>';
        
        if (city && districtsByCity[city]) {
            districtsByCity[city].forEach(district => {
                const option = document.createElement('option');
                option.value = district;
                option.textContent = district;
                districtSelect.appendChild(option);
            });
        }
    }
    
    // Khởi tạo quận/huyện khi trang được tải
    document.addEventListener('DOMContentLoaded', function() {
        const citySelect = document.getElementById('city');
        if (citySelect.value) {
            loadDistricts(citySelect.value);
        }
    });
    </script>
    </body>
</html>

