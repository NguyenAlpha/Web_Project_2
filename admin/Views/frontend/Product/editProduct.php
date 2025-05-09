<?php
if (!isset($_GET['MaSP'])) {
    echo "Thiếu mã sản phẩm.";
    exit;
}

$MaSP = $_GET['MaSP'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tmdt";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$sql = "SELECT * FROM products WHERE MaSP = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $MaSP);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Không tìm thấy sản phẩm.";
    exit;
}

$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chỉnh sửa sản phẩm</title>
    <style>
        form {
            width: 500px;
            margin: 30px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        label {
            display: block;
            margin-top: 12px;
        }
        input, select {
            width: 100%;
            padding: 6px;
            margin-top: 4px;
        }
        .submit-btn {
            margin-top: 16px;
            padding: 10px 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        img {
            max-width: 150px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Chỉnh sửa sản phẩm</h2>

    <form action="?controller=admin&action=updateProduct" method="post" enctype="multipart/form-data">
        <input type="hidden" name="MaSP" value="<?= htmlspecialchars($product['MaSP']) ?>">

        <label for="TenSP">Tên sản phẩm:</label>
        <input type="text" id="TenSP" name="TenSP" value="<?= htmlspecialchars($product['TenSP']) ?>" required>

        <label for="MaLoai">Mã loại:</label>
        <input type="text" id="MaLoai" name="MaLoai" value="<?= htmlspecialchars($product['MaLoai']) ?>" required>

        <label for="SoLuong">Số lượng:</label>
        <input type="number" id="SoLuong" name="SoLuong" value="<?= htmlspecialchars($product['SoLuong']) ?>" required>

        <label for="Gia">Giá:</label>
        <input type="number" id="Gia" name="Gia" value="<?= htmlspecialchars($product['Gia']) ?>" required>

        <label>Ảnh mô tả hiện tại:</label>
        <?php if (!empty($product['AnhMoTaSP'])): ?>
            <img src="<?= htmlspecialchars($product['AnhMoTaSP']) ?>" alt="Ảnh hiện tại">
        <?php else: ?>
            <p>Không có ảnh</p>
        <?php endif; ?>

        <label for="AnhMoTaSP">Thay ảnh mới (nếu cần):</label>
        <input type="file" id="AnhMoTaSP" name="AnhMoTaSP" accept="image/*">

        <button type="submit" class="submit-btn">Cập nhật sản phẩm</button>
    </form>
</body>
</html>

<?php
$conn->close();
?>
