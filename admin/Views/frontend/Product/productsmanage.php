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
    <title>Quản lý sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #eef2f7;
            margin: 0;
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
            text-align: center;
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
    </style>
</head>
<body>
    <h1>Danh sách sản phẩm</h1>

    <div class="text-center">
        <a href="?controller=admin&action=addProductPage" class="add-button">
            <i class="bi bi-plus-circle"></i> Thêm sản phẩm
        </a>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Mã SP</th>
                <th>Tên sản phẩm</th>
                <th>Loại</th>
                <th>Ảnh</th>
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
                echo "<tr><td colspan='9' class='text-center'>Không có sản phẩm nào.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>