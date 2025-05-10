<div class="container py-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4><i class="bi bi-pencil-square"></i> Chỉnh sửa sản phẩm</h4>
        </div>
        
        <div class="card-body">
            <form method="post" action="?controller=admin&action=updateProduct" enctype="multipart/form-data">
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
                            <label class="form-label">Danh mục <span class="text-danger">*</span></label>
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
                        
                        <div class="mb-3">
                            <label class="form-label">Ảnh hiện tại</label>
                            <div class="text-center">
                                <?php if (!empty($product['AnhMoTaSP'])): ?>
                                    <img src="<?= $product['AnhMoTaSP'] ?>" class="img-thumbnail" style="max-height: 200px;">
                                <?php else: ?>
                                    <div class="alert alert-warning">Không có ảnh</div>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Thay đổi ảnh</label>
                            <input type="file" name="AnhMoTaSP" class="form-control" accept="image/*">
                            <small class="text-muted">Định dạng: JPG, PNG, JPEG. Tối đa 2MB</small>
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
</script>