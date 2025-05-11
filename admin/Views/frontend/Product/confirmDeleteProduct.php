<div class="container py-4">
    <div class="card">
        <div class="card-header bg-danger text-white">
            <h4><i class="bi bi-exclamation-triangle"></i> Xác nhận xóa sản phẩm</h4>
        </div>
        <div class="card-body">
            <p>Bạn có chắc chắn muốn xóa sản phẩm <strong><?= htmlspecialchars($product['TenSP']) ?></strong>?</p>
            <p class="text-danger">Lưu ý: Hành động này sẽ xóa vĩnh viễn sản phẩm và tất cả các mục liên quan trong giỏ hàng của khách hàng!</p>
            
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="?controller=admin&action=productsmanage" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Hủy bỏ
                </a>
                <a href="?controller=admin&action=deleteProduct&MaSP=<?= $product['MaSP'] ?>&confirm=true" 
                   class="btn btn-danger"
                   onclick="showLoading()">
                    <i class="bi bi-trash"></i> Xác nhận xóa
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function showLoading() {
    // Hiển thị loading khi click xóa
    document.body.innerHTML = `
        <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2">Đang xóa sản phẩm, vui lòng chờ...</p>
            </div>
        </div>
    `;
}
</script>
<style>
/* === CORE STYLES === */
body {
    display: flex;
    justify-content: center;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f8f9fa;
    color: #212529;
}

.container {
    max-width: 800px;
    margin-top: 2rem;
}

/* === CARD STYLES === */
.card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.card-header {
    background-color: #dc3545;
    color: white;
    padding: 1.25rem 1.5rem;
    border-bottom: none;
}

.card-header h4 {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.card-header .bi {
    font-size: 1.75rem;
}

.card-body {
    padding: 2rem;
    background-color: #fff;
}

/* === CONTENT STYLES === */
.card-body p {
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 1rem;
}

.card-body strong {
    color: #dc3545;
    font-weight: 600;
}

.text-danger {
    color: #dc3545 !important;
    font-weight: 500;
    background-color: rgba(220, 53, 69, 0.1);
    padding: 0.75rem;
    border-radius: 6px;
    display: block;
    border-left: 4px solid #dc3545;
}

/* === BUTTON STYLES === */
.btn {
    padding: 0.625rem 1.5rem;
    border-radius: 6px;
    font-weight: 500;
    font-size: 1rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.2s ease;
}

.btn-secondary {
    background-color: #6c757d;
    border-color: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background-color: #5c636a;
    border-color: #565e64;
    color: white;
}

.btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
    color: white;
}

.btn-danger:hover {
    background-color: #bb2d3b;
    border-color: #b02a37;
    color: white;
}

/* === LOADING STYLES === */
.spinner-border {
    width: 3rem;
    height: 3rem;
    border-width: 0.25em;
}

/* === RESPONSIVE === */
@media (max-width: 576px) {
    .container {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    .card-header h4 {
        font-size: 1.25rem;
    }
    
    .card-body {
        padding: 1.5rem;
    }
    
    .btn {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }
}
</style>