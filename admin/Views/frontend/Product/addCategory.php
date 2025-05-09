<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test2";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $MaLoai = $_POST['MaLoai'];
    $TenLoai = $_POST['TenLoai'];
    $fields = $_POST['fields'];

    // Validate MaLoai: không dấu, không khoảng trắng
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $MaLoai)) {
        echo "<script>alert('Mã loại chỉ được chứa chữ, số và dấu gạch dưới!');</script>";
        exit;
    }

    // Kiểm tra trùng
    $stmt = $conn->prepare("SELECT * FROM categories WHERE MaLoai = ?");
    $stmt->bind_param("s", $MaLoai);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Mã loại đã tồn tại!');</script>";
    } else {
        // Thêm vào bảng categories
        $getSTT = $conn->query("SELECT MAX(STT) AS maxSTT FROM categories");
        $row = $getSTT->fetch_assoc();
        $newSTT = $row['maxSTT'] + 1;

        $stmt = $conn->prepare("INSERT INTO categories (STT, MaLoai, TenLoai) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $newSTT, $MaLoai, $TenLoai);
        $stmt->execute();

        // Tạo bảng chi tiết
        $tableName = strtolower($MaLoai) . "details";
        $columns = ["MaSP INT(11) NOT NULL"];

        foreach ($fields as $field) {
            $col = isset($field['name']) ? preg_replace('/[^a-zA-Z0-9_]/', '', $field['name']) : null;
            $type = isset($field['type']) ? strtoupper($field['type']) : null;
        
            if ($col && in_array($type, ['VARCHAR(255)', 'TEXT', 'INT', 'FLOAT'])) {
                $columns[] = "`$col` $type";
            }
        }
        
        // Thêm khóa chính và ràng buộc khóa ngoại
        $columns[] = "PRIMARY KEY (MaSP)";
        $columns[] = "CONSTRAINT `fk_{$tableName}_product` FOREIGN KEY (MaSP) REFERENCES products(MaSP) ON DELETE CASCADE";
        
        // Gộp lại thành câu lệnh SQL hoàn chỉnh
        $sqlCreate = "CREATE TABLE `$tableName` (\n" . implode(",\n", $columns) . "\n) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";        
        if ($conn->query($sqlCreate)) {
            echo "<script>alert('Thêm loại và bảng chi tiết thành công!'); window.location='index.php?controller=admin&action=productsmanage';</script>";
        } else {
            echo "Lỗi khi tạo bảng chi tiết: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Loại Sản Phẩm</title>
    <style>
        body { font-family: Arial; padding: 20px; background-color: #f2f2f2; }
        form { background: white; padding: 20px; border-radius: 10px; width: 600px; margin: auto; }
        input, select { width: 100%; padding: 8px; margin: 5px 0 15px; }
        button, .back-btn { padding: 10px 15px; border: none; border-radius: 5px; background: #007bff; color: white; cursor: pointer; }
        .back-btn { text-decoration: none; display: inline-block; margin-top: 15px; }
        .field-group { margin-bottom: 15px; border-bottom: 1px dashed #ccc; padding-bottom: 10px; }
    </style>
</head>
<body>
    <form method="POST">
        <h2>Thêm Loại Sản Phẩm Mới</h2>
        <label>Mã loại:</label>
        <input type="text" name="MaLoai" required>

        <label>Tên loại:</label>
        <input type="text" name="TenLoai" required>

        <h3>Thông tin chi tiết</h3>
        <div id="fields"></div> <!-- CHỈ GIỮ LẠI DÒNG NÀY -->
        <script>
        function addField() {
            const container = document.getElementById('fields');
            const div = document.createElement('div');
            div.className = 'field-group';
            div.innerHTML = `
                <input type="text" name="fields[][name]" placeholder="Tên cột (VD: CPU, RAM)" required>
                <select name="fields[][type]">
                    <option value="VARCHAR(255)">Text</option>
                    <option value="TEXT">Đoạn văn bản</option>
                    <option value="INT">Số nguyên</option>
                    <option value="FLOAT">Số thực</option>
                </select>
                <button type="button" onclick="this.parentElement.remove()">❌ Xóa</button>
            `;
            container.appendChild(div);
        }
        </script>
        </div>
        <button type="button" onclick="addField()">➕ Thêm dòng thông tin</button>
        <br><br>
        <input type="submit" value="Thêm loại sản phẩm">
        <a href="index.php?controller=admin&action=productsmanage" style="
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
