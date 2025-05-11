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

// Lấy danh sách danh mục
$categories = [];
$sql = "SELECT MaLoai, TenLoai FROM categories ORDER BY TenLoai";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
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

include "./Views/partitions/frontend/headerAdmin.php";

// Tạo CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Lấy danh sách danh mục từ controller
$categories = $categories ?? [];
?>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<div class="container py-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4><i class="bi bi-plus-circle"></i> Thêm sản phẩm mới</h4>
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

            <form method="post" action="?controller=admin&action=addProduct" enctype="multipart/form-data" class="needs-validation" novalidate>
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5>Thông tin cơ bản</h5>
                        
                        <div class="mb-3">
                            <label class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                            <input type="text" name="TenSP" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Danh mục <span class="text-danger">*</span></label>
                            <select name="MaLoai" class="form-select" id="categorySelect" required>
                                <option value="">-- Chọn danh mục --</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= $cat['MaLoai'] ?>">
                                        <?= htmlspecialchars($cat['TenLoai']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Số lượng <span class="text-danger">*</span></label>
                            <input type="number" name="SoLuong" class="form-control" min="0" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Giá (₫) <span class="text-danger">*</span></label>
                            <input type="number" name="Gia" class="form-control" min="0" required>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <h5>Hình ảnh sản phẩm</h5>
                        
                        <div class="mb-3">
                            <label class="form-label">Ảnh sản phẩm <span class="text-danger">*</span></label>
                            <input type="file" name="AnhMoTaSP" id="imageUpload" class="form-control" accept="image/*" required>
                            <small class="text-muted">Định dạng: JPG, PNG, JPEG. Tối đa 2MB</small>
                            
                            <!-- Container hiển thị ảnh xem trước -->
                            <div class="mt-3 text-center border p-2 rounded bg-light" id="imagePreviewContainer" style="display: none;">
                                <h6 class="text-primary mb-3">Ảnh sẽ được tải lên:</h6>
                                <img id="imagePreview" class="img-thumbnail" style="max-height: 200px;">
                                <div class="mt-3">
                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="cancelImageUpload()">
                                        <i class="bi bi-x-circle"></i> Hủy chọn
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mb-4" id="specsSection">
                    <h5>Thông số kỹ thuật</h5>
                    <div id="dynamicFields">
                        <div class="alert alert-info">
                            Vui lòng chọn danh mục sản phẩm để hiển thị thông số chi tiết
                        </div>
                    </div>
                </div>
                
                <div class="text-end">
                    <a href="?controller=admin&action=productsmanage" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Quay lại
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Thêm sản phẩm
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
    const container = document.getElementById('dynamicFields');
    
    if (!category) {
        container.innerHTML = '<div class="alert alert-info">Vui lòng chọn danh mục sản phẩm</div>';
        return;
    }
    
    container.innerHTML = `
        <div class="text-center my-4">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p>Đang tải thông số...</p>
        </div>`;
    
    fetch(`?controller=admin&action=getTableFields&type=${category}`)
        .then(response => response.json())
        .then(fields => {
            if (fields.length > 0) {
                let html = '<div class="row">';
                fields.forEach(field => {
                    html += `
                        <div class="col-md-6 mb-3">
                            <label class="form-label">${field.replace(/_/g, ' ')}</label>
                            <input type="text" name="${field}" class="form-control" placeholder="${field.replace(/_/g, ' ')}" required>
                        </div>`;
                });
                html += '</div>';
                container.innerHTML = html;
            } else {
                container.innerHTML = '<div class="alert alert-warning">Không có thông số chi tiết cho danh mục này</div>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            container.innerHTML = '<div class="alert alert-danger">Lỗi khi tải thông số</div>';
        });
});

// Xử lý xem trước ảnh
document.getElementById('imageUpload').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('imagePreview');
    const container = document.getElementById('imagePreviewContainer');
    
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

// Hủy chọn ảnh
function cancelImageUpload() {
    document.getElementById('imageUpload').value = '';
    document.getElementById('imagePreviewContainer').style.display = 'none';
}

// Client-side validation
(function () {
    'use strict'
    
    const forms = document.querySelectorAll('.needs-validation')
    
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            
            form.classList.add('was-validated')
        }, false)
    })
})()
</script>

<style>
/* === CORE STYLES === */
body {
    display: flexbox;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f5f7fa;
    color: #333;
    width: 80%;
    margin-left: 250px;
    padding: 20px;
    margin-top: 60px;
}

.container {
    max-width: 80%;
    margin-top: 20px;
}

.card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.card-header {
    background-color: #00268c;
    color: white;
    border-radius: 10px 10px 0 0 !important;
    padding: 15px 20px;
    font-weight: 600;
}

.card-header h4 {
    margin: 0;
    font-size: 1.5rem;
}

.card-body {
    padding: 25px;
}

/* === FORM STYLES === */
.form-label {
    font-weight: 500;
    color: #495057;
    margin-bottom: 8px;
}

.form-control, .form-select {
    border: 1px solid #ced4da;
    border-radius: 6px;
    padding: 10px 12px;
    transition: all 0.3s;
}

.form-control:focus, .form-select:focus {
    border-color: #00268c;
    box-shadow: 0 0 0 0.25rem rgba(0, 38, 140, 0.25);
}

.text-danger {
    color: #dc3545;
}
.text-end{
    display: flex;
}
/* === IMAGE PREVIEW === */
.img-thumbnail {
    max-height: 200px;
    max-width: 100%;
    object-fit: contain;
    border: 1px solid #dee2e6;
    background-color: #fff;
    padding: 4px;
}

#imagePreviewContainer, .current-image-container {
    background-color: #f8f9fa;
    border-radius: 8px;
    padding: 15px;
    margin-top: 10px;
    border: 1px dashed #adb5bd;
    transition: all 0.3s;
}

#imagePreviewContainer:hover, .current-image-container:hover {
    border-color: #00268c;
}

/* === BUTTONS === */
.btn {
    padding: 10px 20px;
    border-radius: 6px;
    font-weight: 500;
    transition: all 0.3s;
}

.btn-primary {
    color: white;
    background-color:rgb(66, 105, 213);
    border-color:rgb(43, 91, 224);
}

.btn-primary:hover {
    background-color: #001a63;
    border-color: #001a63;
}

.btn-secondary {
    color: white;
    background-color: #6c757d;
    border-color: #6c757d;
}

.btn-outline-danger {
    border-color: #dc3545;
    color: #dc3545;
}

.btn-outline-danger:hover {
    background-color: #dc3545;
    color: white;
}

/* === ALERTS === */
.alert {
    border-radius: 8px;
    padding: 12px 15px;
}

.alert-info {
    background-color: #e7f5ff;
    border-color: #d0ebff;
    color: #1864ab;
}

.alert-warning {
    background-color: #fff9db;
    border-color: #ffec99;
    color: #e67700;
}

/* === SPINNER === */
.spinner-border {
    width: 2rem;
    height: 2rem;
    border-width: 0.2em;
}

/* === INVALID FEEDBACK === */
.invalid-feedback {
    font-size: 0.85rem;
    color: #dc3545;
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
    .card-body {
        padding: 15px;
    }
    
    .btn {
        padding: 8px 15px;
        font-size: 0.9rem;
    }
}
</style>