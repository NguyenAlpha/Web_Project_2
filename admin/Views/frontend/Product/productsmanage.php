<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tmdt";
include "./Views/partitions/frontend/headerAdmin.php";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        table {
            width: 95%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        img {
            max-width: 100%;
            height: auto;
        }
        .btn-action {
            padding: 5px 8px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 13px;
            margin: 0 3px;
            display: inline-flex;
            align-items: center;
        }
        .btn-action i {
            margin-right: 3px;
        }
        .add-button {
            display: inline-flex;
            align-items: center;
            margin: 15px;
            padding: 8px 14px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
        .status-active {
            color: green;
            font-weight: bold;
        }
        .status-inactive {
            color: #6c757d;
            font-weight: bold;
        }
        .button-container {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .product-image-container {
            width: 60px;
            height: 60px;
            margin: 0 auto;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-image {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center my-4">Danh sách sản phẩm</h2>
        <div class="text-center">
            <a href="?controller=admin&action=addProductPage" class="add-button">
                <i class="bi bi-plus-circle"></i> Thêm sản phẩm
            </a>
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Mã SP</th>
                        <th>Tên sản phẩm</th>
                        <th>Mã loại</th>
                        <th>Ảnh mô tả</th>
                        <th>Số lượng</th>
                        <th>Đã bán</th>
                        <th>Giá</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result && $result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row["MaSP"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["TenSP"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["MaLoai"]) . "</td>";
                            echo "<td>";
                            if (!empty($row["AnhMoTaSP"])) {
                                echo "<div style='width: 60px; height: 60px; margin: 0 auto; overflow: hidden; display: flex; align-items: center; justify-content: center;'>";
                                echo "<img src='." . htmlspecialchars($row["AnhMoTaSP"]) . "' alt='Ảnh SP' style='max-width: 100%; max-height: 100%; object-fit: contain;'>";
                                echo "</div>";
                            } else {
                                echo "<span class='text-muted'>Không có ảnh</span>";
                            }
                            echo "</td>";
                            echo "<td>" . htmlspecialchars($row["SoLuong"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["DaBan"]) . "</td>";
                            echo "<td>" . number_format($row["Gia"], 0, ',', '.') . " ₫</td>";
                            echo "<td class='" . ($row["TrangThai"] == 'hiện' ? 'status-active' : 'status-inactive') . "'>" . htmlspecialchars($row["TrangThai"]) . "</td>";
                            echo "<td>";
                            echo "<div class='button-container'>";
                            
                            // Nút Sửa - luôn hiển thị
                            echo "<a class='btn-action btn-primary' href='editProduct.php?MaSP=" . urlencode($row["MaSP"]) . "' title='Sửa'>";
                            echo "<i class='bi bi-pencil'></i>";
                            echo "</a>";
                            
                            // Logic hiển thị nút Xóa/Ẩn/Hiện
                            if ($row["DaBan"] == 0) {
                                // Sản phẩm chưa bán -> hiển thị nút Xóa
                                echo "<a class='btn-action btn-danger' href='?controller=admin&action=deleteProduct&MaSP=" . urlencode($row["MaSP"]) . "' ";
                                echo "onclick=\"return confirm('Bạn có chắc chắn muốn xoá sản phẩm: " . addslashes(htmlspecialchars($row["TenSP"])) . "?');\" title='Xóa'>";
                                echo "<i class='bi bi-trash'></i>";
                                echo "</a>";
                            } else {
                                // Sản phẩm đã bán -> hiển thị nút Ẩn/Hiện tùy trạng thái
                                if ($row["TrangThai"] == 'hiện') {
                                    echo "<a class='btn-action btn-warning' href='?controller=admin&action=hideProduct&MaSP=" . urlencode($row["MaSP"]) . "' title='Ẩn'>";
                                    echo "<i class='bi bi-eye-slash'></i>";
                                    echo "</a>";
                                } else {
                                    echo "<a class='btn-action btn-success' href='?controller=admin&action=showProduct&MaSP=" . urlencode($row["MaSP"]) . "' title='Hiện'>";
                                    echo "<i class='bi bi-eye'></i>";
                                    echo "</a>";
                                }
                            }
                            
                            echo "</div>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9' class='text-center'>Không có sản phẩm nào.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>