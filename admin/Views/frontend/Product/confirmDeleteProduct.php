<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-warning">
            <h4>Xác nhận xóa sản phẩm</h4>
        </div>
        <div class="card-body">
            <p>Bạn có chắc chắn muốn xóa sản phẩm <strong><?= htmlspecialchars($product['TenSP']) ?></strong>?</p>
            <p>Mã SP: <?= $product['MaSP'] ?></p>
            <p>Giá: <?= number_format($product['Gia'], 0, ',', '.') ?> ₫</p>
            
            <div class="mt-4">
                <a href="index.php?controller=admin&action=deleteProduct&MaSP=<?= $product['MaSP'] ?>&confirm=true" 
                   class="btn btn-danger">Xác nhận xóa</a>
                <a href="index.php?controller=admin&action=productsmanage" class="btn btn-secondary">Hủy bỏ</a>
            </div>
        </div>
    </div>
</div>