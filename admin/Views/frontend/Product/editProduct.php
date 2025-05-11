<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tmdt";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra quyền admin
if (!isset($_SESSION['admin'])) {
    header("Location: index.php?controller=admin&action=login");
    exit;
}

// Tạo CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Lấy thông tin sản phẩm cần chỉnh sửa
$product = [];
$details = [];
$detailFields = [];

if (isset($_GET['MaSP'])) {
    $MaSP = $conn->real_escape_string($_GET['MaSP']);
    
    // Lấy thông tin cơ bản sản phẩm
    $sql = "SELECT * FROM products WHERE MaSP = $MaSP";
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        $product = $result->fetch_assoc();
        
        // Lấy thông tin chi tiết theo loại sản phẩm
        $detailTable = strtolower($product['MaLoai']) . 'details';
        $sql = "SELECT * FROM $detailTable WHERE MaSP = $MaSP";
        $result = $conn->query($sql);
        
        if ($result && $result->num_rows > 0) {
            $details = $result->fetch_assoc();
        }
        
        // Lấy danh sách trường chi tiết
        $sql = "SHOW COLUMNS FROM $detailTable";
        $result = $conn->query($sql);
        
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['Field'] != 'MaSP') {
                    $detailFields[] = $row['Field'];
                }
            }
        }
    } else {
        $_SESSION['error'] = "Không tìm thấy sản phẩm";
        header("Location: index.php?controller=admin&action=productsmanage");
        exit;
    }
} else {
    $_SESSION['error'] = "Thiếu thông tin sản phẩm";
    header("Location: index.php?controller=admin&action=productsmanage");
    exit;
}

// Lấy danh sách danh mục
$categories = [];
$sql = "SELECT MaLoai, TenLoai FROM categories ORDER BY TenLoai";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}

include "./Views/partitions/frontend/headerAdmin.php";
?>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<div class="container py-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4><i class="bi bi-pencil-square"></i> Chỉnh sửa sản phẩm</h4>
        </div>
        
        <div class="card-body">
            <?php if (isset($_SESSION['form_errors'])): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($_SESSION['form_errors'] as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php unset($_SESSION['form_errors']); ?>
            <?php endif; ?>

            <form method="post" action="?controller=admin&action=updateProduct" enctype="multipart/form-data" class="needs-validation" novalidate>
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                <input type="hidden" name="MaSP" value="<?= $product['MaSP'] ?>">
                <input type="hidden" name="current_image" value="<?= htmlspecialchars($product['AnhMoTaSP']) ?>">
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5>Thông tin cơ bản</h5>
                        
                        <div class="mb-3">
                            <label class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                            <input type="text" name="TenSP" class="form-control" 
                                   value="<?= htmlspecialchars($product['TenSP']) ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Loại Sản phẩm <span class="text-danger">*</span></label>
                            <select name="MaLoai" class="form-select" id="categorySelect" required>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= $cat['MaLoai'] ?>" 
                                        <?= $cat['MaLoai'] == $product['MaLoai'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($cat['TenLoai']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Số lượng <span class="text-danger">*</span></label>
                            <input type="number" name="SoLuong" class="form-control" 
                                   value="<?= $product['SoLuong'] ?>" min="0" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Giá (₫) <span class="text-danger">*</span></label>
                            <input type="number" name="Gia" class="form-control" 
                                   value="<?= $product['Gia'] ?>" min="0" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Trạng thái <span class="text-danger">*</span></label>
                            <select name="TrangThai" class="form-select" required>
                                <option value="hiện" <?= $product['TrangThai'] == 'hiện' ? 'selected' : '' ?>>Hiển thị</option>
                                <option value="ẩn" <?= $product['TrangThai'] == 'ẩn' ? 'selected' : '' ?>>Ẩn</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <h5>Hình ảnh sản phẩm</h5>
                        
                        <!-- Ảnh hiện tại -->
                        <div class="mb-3">
                            
                            <label` class="form-label">Ảnh hiện tại</label>
                            <div class="text-center border p-2 rounded bg-light">
                                <?php if (!empty($product['AnhMoTaSP'])): ?>
                                    <?php
                                    // Xử lý đường dẫn ảnh giống như trong productsmanage.php
                                    $imagePath = '.' . $product['AnhMoTaSP'];
                                    // Loại bỏ các dấu gạch chéo kép nếu có
                                    $imagePath = str_replace('//', '/', $imagePath);
                                    ?>
                                    <img src="<?= htmlspecialchars($imagePath) ?>" 
                                        class="img-thumbnail" 
                                        style="max-height: 200px;"
                                        id="currentImage"
                                        onerror="this.src='../assets/image/no-image.jpg'; this.onerror=null;">
                                    <div class="mt-2">
                                        <small class="text-muted"><?= htmlspecialchars(basename($product['AnhMoTaSP'])) ?></small>
                                    </div>
                                <?php else: ?>
                                    <div class="alert alert-warning py-4">Không có ảnh hiện tại</div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- Ảnh mới sẽ thay thế -->
                        <div class="mb-3">
                            <label class="form-label">Ảnh mới (nếu thay đổi)</label>
                            <input type="file" name="AnhMoTaSP" id="imageUpload" class="form-control" accept="image/*">
                            <small class="text-muted">Định dạng: JPG, PNG, JPEG. Tối đa 2MB</small>
                            
                            <!-- Container hiển thị ảnh xem trước -->
                            <div class="mt-3 text-center border p-2 rounded bg-light" id="newImageContainer" style="display: none;">
                                <h6 class="text-primary mb-3">Ảnh sẽ được cập nhật thành:</h6>
                                <img id="imagePreview" class="img-thumbnail" style="max-height: 200px;">
                                <div class="mt-3">
                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="cancelImageUpload()">
                                        <i class="bi bi-x-circle"></i> Hủy thay đổi
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mb-4" id="specsSection">
                    <h5>Thông số kỹ thuật</h5>
                    <div id="dynamicFields">
                        <?php foreach ($detailFields as $field): ?>
                            <div class="mb-3">
                                <label class="form-label"><?= ucfirst(str_replace('_', ' ', $field)) ?></label>
                                <input type="text" name="<?= $field ?>" class="form-control" 
                                       value="<?= htmlspecialchars($details[$field] ?? '') ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <div class="text-end">
                    <a href="?controller=admin&action=productsmanage" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Quay lại
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Lưu thay đổi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Tải động form thông số khi thay đổi danh mục
document.getElementById('categorySelect').addEventListener('change', function() {
    const category = this.value;
    const productId = <?= $product['MaSP'] ?>;
    
    fetch(`?controller=admin&action=getSpecFields&category=${category}&MaSP=${productId}`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('dynamicFields').innerHTML = html;
        })
        .catch(error => console.error('Error:', error));
});

// Xử lý xem trước ảnh mới
document.getElementById('imageUpload').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('imagePreview');
    const container = document.getElementById('newImageContainer');
    
    if (file) {
        // Kiểm tra loại file
        if (!file.type.match('image.*')) {
            alert('Vui lòng chọn file ảnh (JPG, PNG, JPEG)');
            this.value = '';
            return;
        }
        
        // Kiểm tra kích thước file
        if (file.size > 2 * 1024 * 1024) {
            alert('File ảnh không được vượt quá 2MB');
            this.value = '';
            return;
        }
        
        // Hiển thị ảnh xem trước
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            container.style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
});

// Hủy thay đổi ảnh
function cancelImageUpload() {
    document.getElementById('imageUpload').value = '';
    document.getElementById('newImageContainer').style.display = 'none';
}
</script>
<style>
/* === CORE STYLES === */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f5f7fa;
    color: #333;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 1200px;
    margin: 20px auto;
    padding: 0 15px;
}

.card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.card-header {
    background-color: #00268c;
    color: white;
    padding: 15px 20px;
    font-size: 1.25rem;
    font-weight: 600;
}

.card-header h4 {
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.card-header .bi {
    font-size: 1.5rem;
}

.card-body {
    padding: 25px;
    background-color: white;
}

/* === FORM STYLES === */
.form-label {
    font-weight: 500;
    color: #495057;
    margin-bottom: 8px;
    display: block;
}

.form-control, .form-select {
    border: 1px solid #ced4da;
    border-radius: 6px;
    padding: 10px 12px;
    width: 100%;
    transition: all 0.3s;
    font-size: 1rem;
}

.form-control:focus, .form-select:focus {
    border-color: #00268c;
    box-shadow: 0 0 0 0.25rem rgba(0, 38, 140, 0.25);
    outline: none;
}

.text-danger {
    color: #dc3545;
}

/* === IMAGE PREVIEW === */
.img-thumbnail {
    max-height: 200px;
    max-width: 100%;
    object-fit: contain;
    border: 1px solid #dee2e6;
    background-color: #fff;
    padding: 4px;
    border-radius: 4px;
}

#newImageContainer, .bg-light {
    background-color: #f8f9fa !important;
    border-radius: 8px;
    padding: 15px;
    margin-top: 10px;
    border: 1px solid #dee2e6;
    transition: all 0.3s;
}

#newImageContainer:hover {
    border-color: #00268c;
}

/* === BUTTONS === */
.btn {
    padding: 10px 20px;
    border-radius: 6px;
    font-weight: 500;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 0.9rem;
}

.btn-primary {
    background-color: #00268c;
    border-color: #00268c;
    color: white;
}

.btn-primary:hover {
    background-color: #001a63;
    border-color: #001a63;
    color: white;
}

.btn-secondary {
    background-color: #6c757d;
    border-color: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background-color: #5a6268;
    border-color: #545b62;
    color: white;
}

.btn-outline-danger {
    border-color: #dc3545;
    color: #dc3545;
    background-color: transparent;
}

.btn-outline-danger:hover {
    background-color: #dc3545;
    color: white;
}

/* === ALERTS === */
.alert {
    border-radius: 8px;
    padding: 12px 15px;
    margin-bottom: 1rem;
}

.alert-danger {
    background-color: #f8d7da;
    border-color: #f5c6cb;
    color: #721c24;
}

.alert-warning {
    background-color: #fff3cd;
    border-color: #ffeeba;
    color: #856404;
}

/* === GRID & LAYOUT === */
.row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.col-md-6 {
    flex: 0 0 50%;
    max-width: 50%;
    padding-right: 15px;
    padding-left: 15px;
}

.mb-3 {
    margin-bottom: 1rem !important;
}

.mb-4 {
    margin-bottom: 1.5rem !important;
}

.mt-2 {
    margin-top: 0.5rem !important;
}

.mt-3 {
    margin-top: 1rem !important;
}

.text-end {
    text-align: right !important;
}

/* === DETAILS SECTION === */
#specsSection {
    background-color: #f8f9fa;
    border-radius: 8px;
    padding: 20px;
    margin-top: 20px;
}

#dynamicFields {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 15px;
    margin-top: 15px;
}

/* === VALIDATION === */
.invalid-feedback {
    display: none;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 0.875em;
    color: #dc3545;
}

.was-validated .form-control:invalid ~ .invalid-feedback,
.was-validated .form-control:invalid ~ .invalid-tooltip {
    display: block;
}

.was-validated .form-control:invalid,
.was-validated .form-select:invalid {
    border-color: #dc3545;
}

.was-validated .form-control:invalid:focus,
.was-validated .form-select:invalid:focus {
    box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
}

/* === RESPONSIVE === */
@media (max-width: 768px) {
    .col-md-6 {
        flex: 0 0 100%;
        max-width: 100%;
    }
    
    .card-body {
        padding: 15px;
    }
    
    .btn {
        padding: 8px 15px;
        font-size: 0.9rem;
    }
    
    #dynamicFields {
        grid-template-columns: 1fr;
    }
}
</style>