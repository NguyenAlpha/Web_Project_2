<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test2";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if (isset($_GET['MaSP'])) {
    $MaSP = $_GET['MaSP'];
    $sql = "SELECT * FROM products WHERE MaSP = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $MaSP);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $TenSP = $_POST['TenSP'];
    $MaLoai = $_POST['MaLoai'];
    $SoLuong = $_POST['SoLuong'];
    $Gia = $_POST['Gia'];

    // Giữ ảnh cũ nếu không upload ảnh mới
    $AnhMoTaSP = $product['AnhMoTaSP'];

    // Xử lý ảnh mới nếu có upload
    if (isset($_FILES['AnhMoTaSP']) && $_FILES['AnhMoTaSP']['error'] == 0) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $filename = basename($_FILES["AnhMoTaSP"]["name"]);
        $target_file = $target_dir . uniqid() . "_" . $filename;

        if (move_uploaded_file($_FILES["AnhMoTaSP"]["tmp_name"], $target_file)) {
            $AnhMoTaSP = $target_file;
        }
    }

    $sql = "UPDATE products SET TenSP=?, MaLoai=?, AnhMoTaSP=?, SoLuong=?, Gia=? WHERE MaSP=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssds", $TenSP, $MaLoai, $AnhMoTaSP, $SoLuong, $Gia, $MaSP);
    $stmt->execute();

    header("Location: productsmanage.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa sản phẩm</title>
</head>
<body>
    <h2>Sửa sản phẩm</h2>
    <form method="POST" enctype="multipart/form-data">
        Tên sản phẩm: <input type="text" name="TenSP" value="<?php echo htmlspecialchars($product['TenSP']); ?>"><br>
        Mã loại: <input type="text" name="MaLoai" value="<?php echo htmlspecialchars($product['MaLoai']); ?>"><br>

        <?php if (!empty($product['AnhMoTaSP'])): ?>
            <p>Ảnh hiện tại:</p>
            <img src="<?php echo htmlspecialchars($product['AnhMoTaSP']); ?>" alt="Ảnh SP" style="max-width: 150px;"><br>
        <?php endif; ?>

        Tải ảnh mới: <input type="file" name="AnhMoTaSP"><br>
        Số lượng: <input type="number" name="SoLuong" value="<?php echo htmlspecialchars($product['SoLuong']); ?>"><br>
        Giá: <input type="number" name="Gia" value="<?php echo htmlspecialchars($product['Gia']); ?>"><br>
        <input type="submit" value="Cập nhật">
        <a href="../admin/views/frontend/Product/productsmanage.php" style="
            display: inline-block;
            margin-top: 15px;
            padding: 8px 16px;
            background-color: #6c757d;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        ">⬅ Quay lại</a>
    </form>
</body>
</html>
