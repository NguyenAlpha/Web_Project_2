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
    <style>
        table {
            width: 95%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #999;
            padding: 10px;
            text-align: center;
        }
        img {
            max-width: 100px;
        }
        .btn {
            padding: 5px 8px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 13px;
            margin: 0 3px;
        }
        .edit-btn {
            background-color: #ffc107;
            color: #000;
        }
        .delete-btn {
            background-color: #dc3545;
            color: #fff;
        }
        .add-button {
            display: block;
            width: fit-content;
            margin: 15px auto;
            padding: 8px 14px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
        .addCategory-button {
            display: block;
            width: fit-content;
            margin: 15px auto;
            padding: 8px 14px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Danh sách sản phẩm</h2>
    <a href="?controller=admin&action=addProductPage" class="add-button">Thêm sản phẩm</a>
    <table>
        <thead>
            <tr>
                <th>Mã SP</th>
                <th>Tên sản phẩm</th>
                <th>Mã loại</th>
                <th>Ảnh mô tả</th>
                <th>Số lượng</th>
                <th>Giá</th>
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
                        echo "<img src='." . htmlspecialchars($row["AnhMoTaSP"]) . "' alt='Ảnh SP'>";
                    } else {
                        echo "Không có ảnh";
                    }
                    echo "</td>";
                    echo "<td>" . htmlspecialchars($row["SoLuong"]) . "</td>";
                    echo "<td>" . number_format($row["Gia"], 0, ',', '.') . " ₫</td>";
                    echo "<td>";
                    echo "<a class='btn edit-btn' href='editProduct.php?MaSP=" . urlencode($row["MaSP"]) . "'>Sửa</a>";
                    echo "<a class='btn delete-btn' href='?controller=admin&action=deleteProduct&MaSP=" . urlencode($row["MaSP"]) . "' onclick=\"return confirm('Bạn có chắc chắn muốn xoá sản phẩm: " . htmlspecialchars($row["TenSP"]) . "?');\">Xoá</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Không có sản phẩm nào.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php $conn->close(); ?>
