<div class="confirm-container">
    <div class="confirm-card">
        <div class="confirm-header">
            <h2><span class="warning-icon">⚠</span> Xác nhận xóa sản phẩm</h2>
        </div>
        <div class="confirm-body">
            <div class="product-info">
                <div class="product-image">
                    <?php if (!empty($product['AnhMoTaSP'])): ?>
                        <img src="<?= '.' . htmlspecialchars($product['AnhMoTaSP']) ?>" 
                             alt="<?= htmlspecialchars($product['TenSP']) ?>">
                    <?php endif; ?>
                </div>
                <div class="product-details">
                    <h3><?= htmlspecialchars($product['TenSP']) ?></h3>
                    <p><strong>Mã SP:</strong> <?= htmlspecialchars($product['MaSP']) ?></p>
                    <p><strong>Loại:</strong> <?= htmlspecialchars($product['MaLoai']) ?></p>
                    <p><strong>Giá:</strong> <?= number_format($product['Gia'], 0, ',', '.') ?> ₫</p>
                </div>
            </div>

            <div class="warning-message">
                <p><strong>Cảnh báo quan trọng!</strong></p>
                <p>Hành động này sẽ xóa vĩnh viễn sản phẩm và tất cả thông tin liên quan:</p>
                <ul>
                    <li>Thông tin chi tiết sản phẩm</li>
                    <li>Các mục trong giỏ hàng chứa sản phẩm này</li>
                </ul>
            </div>
            
            <div class="action-buttons">
                <a href="?controller=admin&action=productsmanage" class="cancel-btn">Hủy bỏ</a>
                <a href="?controller=admin&action=deleteProduct&MaSP=<?= $product['MaSP'] ?>&confirm=true" 
                   class="delete-btn"
                   onclick="showLoading()">Xác nhận xóa</a>
            </div>
        </div>
    </div>
</div>

<script>
function showLoading() {
    var overlay = document.createElement('div');
    overlay.className = 'loading-overlay';
    overlay.innerHTML = '<div class="loading-box"><div class="loading-spinner"></div><p>Đang xóa sản phẩm...</p></div>';
    document.body.appendChild(overlay);
}
</script>

<style type="text/css">
/* Reset cơ bản */
body, html {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
}

/* Container chính */
.confirm-container {
    width: 100%;
    max-width: 600px;
    margin: 30px auto;
    padding: 0 15px;
    box-sizing: border-box;
}

/* Card xác nhận */
.confirm-card {
    background: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

/* Header */
.confirm-header {
    background: #d9534f;
    color: white;
    padding: 15px 20px;
}

.confirm-header h2 {
    margin: 0;
    font-size: 18px;
}

.warning-icon {
    margin-right: 10px;
    font-size: 20px;
}

/* Body */
.confirm-body {
    padding: 20px;
}

/* Thông tin sản phẩm */
.product-info {
    display: table;
    width: 100%;
    margin-bottom: 20px;
}

.product-image, .product-details {
    display: table-cell;
    vertical-align: top;
}

.product-image {
    width: 120px;
    padding-right: 20px;
}

.product-image img {
    max-width: 100%;
    height: auto;
    border: 1px solid #ddd;
}

.product-details h3 {
    margin-top: 0;
    color: #333;
    font-size: 16px;
}

.product-details p {
    margin: 5px 0;
    font-size: 14px;
    color: #666;
}

/* Cảnh báo */
.warning-message {
    background: #fff3f3;
    border-left: 4px solid #d9534f;
    padding: 10px 15px;
    margin-bottom: 20px;
}

.warning-message p {
    margin: 5px 0;
    font-size: 14px;
}

.warning-message ul {
    margin: 10px 0 5px 20px;
    padding: 0;
}

.warning-message li {
    font-size: 13px;
    color: #d9534f;
}

/* Nút bấm */
.action-buttons {
    text-align: right;
}

.cancel-btn, .delete-btn {
    display: inline-block;
    padding: 8px 15px;
    margin-left: 10px;
    text-decoration: none;
    border-radius: 3px;
    font-size: 14px;
    cursor: pointer;
}

.cancel-btn {
    background: #f0f0f0;
    color: #333;
    border: 1px solid #ccc;
}

.cancel-btn:hover {
    background: #e0e0e0;
}

.delete-btn {
    background: #d9534f;
    color: white;
    border: 1px solid #d43f3a;
}

.delete-btn:hover {
    background: #c9302c;
}

/* Loading overlay */
.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.8);
    z-index: 1000;
    display: flex;
    justify-content: center;
    align-items: center;
}

.loading-box {
    text-align: center;
    background: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.loading-spinner {
    width: 40px;
    height: 40px;
    margin: 0 auto 10px;
    border: 4px solid #f3f3f3;
    border-top: 4px solid #3498db;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Responsive */
@media (max-width: 480px) {
    .product-info {
        display: block;
    }
    
    .product-image, .product-details {
        display: block;
        width: auto;
        padding-right: 0;
    }
    
    .product-image {
        margin-bottom: 15px;
        text-align: center;
    }
    
    .action-buttons {
        text-align: center;
    }
    
    .cancel-btn, .delete-btn {
        display: block;
        margin: 10px 0;
        width: 100%;
        box-sizing: border-box;
    }
}
</style>