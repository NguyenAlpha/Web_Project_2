<?php
// Kết nối DB
$conn = new mysqli("localhost", "root", "", "test2");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy danh sách loại sản phẩm
$categories = [];
$result = $conn->query("SELECT MaLoai, TenLoai FROM categories");
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}
?>

<form method="post" action="index.php?controller=admin&action=addProduct" id="addProductForm" enctype="multipart/form-data">
    <label>Tên sản phẩm:</label>
    <input type="text" name="TenSP" required><br>

    <label>Giá:</label>
    <input type="number" name="Gia" required><br>

    <label>Số lượng:</label>
    <input type="number" name="SoLuong" required><br>

    <label for="AnhMoTaSP">Ảnh mô tả:</label>
    <input type="file" name="AnhMoTaSP" id="AnhMoTaSP" required><br>

    <label>Loại sản phẩm:</label>
    <select name="MaLoai" id="productType" onchange="loadDetailsForm()" required>
        <option value="">--Chọn loại--</option>
        <?php foreach($categories as $cat): ?>
            <option value="<?= $cat['MaLoai'] ?>"><?= $cat['TenLoai'] ?></option>
        <?php endforeach; ?>
    </select>

    <div id="detailsForm"></div>

    <button type="submit">Thêm sản phẩm</button>
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

<script>
function loadDetailsForm() {
    const type = document.getElementById('productType').value;
    const container = document.getElementById('detailsForm');
    container.innerHTML = '';

    if (!type) return;

    fetch('index.php?controller=admin&action=getTableFields&type=' + type)
        .then(response => response.json())
        .then(fields => {
            if (fields.length > 0) {
                container.innerHTML = `<h4>Thông tin chi tiết:</h4>`;
                fields.forEach(field => {
                    container.innerHTML += `
                        <label>${field}:</label>
                        <input name="${field}" placeholder="${field}" required><br>
                    `;
                });
            } else {
                container.innerHTML = '<p>Không tìm thấy thông tin chi tiết.</p>';
            }
        })
        .catch(err => {
            container.innerHTML = '<p>Lỗi tải thông tin chi tiết.</p>';
            console.error(err);
        });
}
</script>
