<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tmdt";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xử lý các tham số lọc và sắp xếp
$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';
$status = $_GET['status'] ?? '';
$sort = $_GET['sort'] ?? 'MaSP';
$order = $_GET['order'] ?? 'ASC';

// Xây dựng câu truy vấn SQL với các điều kiện lọc
$sql = "SELECT * FROM products WHERE 1=1";
$params = [];

if (!empty($search)) {
    $sql .= " AND TenSP LIKE ?";
    $params[] = "%$search%";
}

if (!empty($category)) {
    $sql .= " AND MaLoai = ?";
    $params[] = $category;
}

if (!empty($status)) {
    $sql .= " AND TrangThai = ?";
    $params[] = $status;
}

// Thêm phần sắp xếp
$validSortColumns = ['MaSP', 'TenSP', 'SoLuong', 'DaBan', 'Gia'];
$sort = in_array($sort, $validSortColumns) ? $sort : 'MaSP';
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

// Lấy danh sách loại sản phẩm cho dropdown
$categories = $conn->query("SELECT DISTINCT MaLoai FROM products")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .admin-container {
            display: flexbox;
            width: 80%;
            margin-left: 250px;
            padding: 20px;
            margin-top: 60px;
        }

        h1 {
            text-align: center;
            color: #00268c;
            font-size: 32px;
            margin-bottom: 40px;
        }

        .filter-section {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin-bottom: 20px;
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

        tr:hover {
            background-color: #f4f8ff;
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

        .btn-danger {
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

        .btn-danger:hover {
            background-color: rgb(208, 2, 2);
            color: white;
        }

        .btn-success {
            display: inline-block;
            padding: 8px 14px;
            margin-right: 6px;
            background-color: rgb(253, 253, 253);
            color: #28a745;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: background-color 0.3s ease;
            border: 1px solid #28a745;
        }

        .btn-success:hover {
            background-color: #28a745;
            color: white;
        }

        .btn-warning {
            display: inline-block;
            padding: 8px 14px;
            margin-right: 6px;
            background-color: rgb(253, 253, 253);
            color: #ffc107;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: background-color 0.3s ease;
            border: 1px solid #ffc107;
        }

        .btn-warning:hover {
            background-color: #ffc107;
            color: white;
        }

        .add-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: white;
            color: #001f6d;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            border: 1px solid #001f6d;
            margin: 20px auto;
            text-align: center;
        }

        .add-button:hover {
            background-color: #001f6d;
            color: white;
        }

        .product-image {
            max-width: 80px;
            max-height: 80px;
            display: block;
            margin: 0 auto;
            border-radius: 4px;
        }

        .status-active {
            color: green;
            font-weight: bold;
        }

        .status-inactive {
            color: #6c757d;
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .button-container {
            display: flex;
            justify-content: center;
            gap: 8px;
        }
        .admin-sidebar .dropdown-menu {
            background: #003a99;
            padding: 0;
        }

        .admin-sidebar .dropdown-menu a {
            color: white !important;
            padding: 10px 20px 10px 40px;
        }

        .admin-sidebar .dropdown-menu a:hover {
            background: #00268c !important;
        }
    </style>
    
</head>
<body>
    <div class="admin-sidebar">
        <?php
        include "./Views/partitions/frontend/headerAdmin.php";
        ?>
    </div>
    <div class="admin-container">
        <h1>Danh sách sản phẩm</h1>

    <!-- Phần lọc và tìm kiếm -->
    <div class="filter-section">
        <form method="GET" action="">
            <input type="hidden" name="controller" value="admin">
            <input type="hidden" name="action" value="productsmanage">
            
            <div class="row g-3">
                <div class="col-md-3">
                    <label for="search" class="form-label">Tìm kiếm theo tên</label>
                    <input type="text" class="form-control" id="search" name="search" 
                           value="<?= htmlspecialchars($search) ?>" placeholder="Nhập tên sản phẩm">
                </div>
                
                <div class="col-md-2">
                    <label for="category" class="form-label">Loại sản phẩm</label>
                    <select class="form-select" id="category" name="category">
                        <option value="">Tất cả</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= htmlspecialchars($cat['MaLoai']) ?>" 
                                <?= $category === $cat['MaLoai'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cat['MaLoai']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="col-md-2">
                    <label for="status" class="form-label">Trạng thái</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">Tất cả</option>
                        <option value="hiện" <?= $status === 'hiện' ? 'selected' : '' ?>>Hiển thị</option>
                        <option value="ẩn" <?= $status === 'ẩn' ? 'selected' : '' ?>>Ẩn</option>
                    </select>
                </div>
                
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="bi bi-funnel"></i> Lọc
                    </button>
                    <a href="?controller=admin&action=productsmanage" class="btn btn-secondary">
                        <i class="bi bi-arrow-counterclockwise"></i> Xóa lọc
                    </a>
                </div>
            </div>
        </form>
    </div>

    <div class="text-center">
        <a href="?controller=admin&action=addProductPage" class="add-button">
            <i class="bi bi-plus-circle"></i> Thêm sản phẩm
        </a>
    </div>
    
    <table>
        <thead>
            <tr>
                <th class="sortable" onclick="sortTable('MaSP')">
                    Mã SP
                    <?php if ($sort === 'MaSP'): ?>
                        <i class="bi bi-arrow-<?= $order === 'ASC' ? 'up' : 'down' ?> sort-icon"></i>
                    <?php endif; ?>
                </th>
                <th class="sortable" onclick="sortTable('TenSP')">
                    Tên sản phẩm
                    <?php if ($sort === 'TenSP'): ?>
                        <i class="bi bi-arrow-<?= $order === 'ASC' ? 'up' : 'down' ?> sort-icon"></i>
                    <?php endif; ?>
                </th>
                <th>Loại</th>
                <th>Ảnh</th>
                <th class="sortable" onclick="sortTable('SoLuong')">
                    Số lượng
                    <?php if ($sort === 'SoLuong'): ?>
                        <i class="bi bi-arrow-<?= $order === 'ASC' ? 'up' : 'down' ?> sort-icon"></i>
                    <?php endif; ?>
                </th>
                <th class="sortable" onclick="sortTable('DaBan')">
                    Đã bán
                    <?php if ($sort === 'DaBan'): ?>
                        <i class="bi bi-arrow-<?= $order === 'ASC' ? 'up' : 'down' ?> sort-icon"></i>
                    <?php endif; ?>
                </th>
                <th class="sortable" onclick="sortTable('Gia')">
                    Giá
                    <?php if ($sort === 'Gia'): ?>
                        <i class="bi bi-arrow-<?= $order === 'ASC' ? 'up' : 'down' ?> sort-icon"></i>
                    <?php endif; ?>
                </th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td class='text-center'>" . htmlspecialchars($row["MaSP"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["TenSP"]) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row["MaLoai"]) . "</td>";
                    echo "<td class='text-center'>";
                    if (!empty($row["AnhMoTaSP"])) {
                        echo "<img src='." . ($row["AnhMoTaSP"]) . "' class='product-image' alt='Ảnh sản phẩm'>";
                    } else {
                        echo "<span class='text-muted'>Không có ảnh</span>";
                    }
                    echo "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row["SoLuong"]) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($row["DaBan"]) . "</td>";
                    echo "<td class='text-center'>" . number_format($row["Gia"], 0, ',', '.') . " ₫</td>";
                    echo "<td class='text-center " . ($row["TrangThai"] == 'hiện' ? 'status-active' : 'status-inactive') . "'>" . htmlspecialchars($row["TrangThai"]) . "</td>";
                    echo "<td>";
                    echo "<div class='button-container'>";
                    
                    // Nút Sửa
                    echo "<a href='?controller=admin&action=editProduct&MaSP=" . urlencode($row["MaSP"]) . "' class='btn-action' title='Sửa'>";
                    echo "<i class='bi bi-pencil'></i>";
                    echo "</a>";
                    
                    // Nút Xóa/Ẩn/Hiện
                    if ($row["DaBan"] == 0) {
                        echo "<a href='?controller=admin&action=deleteProduct&MaSP=" . urlencode($row["MaSP"]) . "' class='btn-danger' ";
                        echo "onclick=\"return confirm('Bạn có chắc chắn muốn xoá sản phẩm: " . addslashes(htmlspecialchars($row["TenSP"])) . "?');\" title='Xóa'>";
                        echo "<i class='bi bi-trash'></i>";
                        echo "</a>";
                    } else {
                        if ($row["TrangThai"] == 'hiện') {
                            echo "<a href='?controller=admin&action=hideProduct&MaSP=" . urlencode($row["MaSP"]) . "' class='btn-warning' title='Ẩn'>";
                            echo "<i class='bi bi-eye-slash'></i>";
                            echo "</a>";
                        } else {
                            echo "<a href='?controller=admin&action=showProduct&MaSP=" . urlencode($row["MaSP"]) . "' class='btn-success' title='Hiện'>";
                            echo "<i class='bi bi-eye'></i>";
                            echo "</a>";
                        }
                    }
                    
                    echo "</div>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9' class='text-center'>Không tìm thấy sản phẩm nào.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
    
    // Giữ lại các tham số lọc khi sắp xếp
    document.addEventListener('DOMContentLoaded', function() {
        const sortLinks = document.querySelectorAll('th.sortable');
        sortLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const column = this.getAttribute('onclick').match(/sortTable\('(.*)'\)/)[1];
                sortTable(column);
            });
        });
    });
    </script>
</body>
</html>

<?php $conn->close(); ?>