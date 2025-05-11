    <!-- Views/admin/order/orderlist.php -->
    <?php
    include "./Views/partitions/frontend/headerAdmin.php";
    ?>



    <div class="container mt-5">
        <h2 class="mb-4">📋 Danh sách đơn hàng</h2>

        <table class="table table-bordered table-hover">
            <thead class="table-primary">
                <tr>
                    <th>Mã đơn</th>
                    <th>Người dùng</th>
                    <th>Địa chỉ</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td>#<?= $order['MaDon'] ?></td>
                        <td><?= $order['UserID'] ?></td>
                        <td><?= $order['DiaChi'] ?></td>
                        <td><?= $order['NgayDat'] ?? 'N/A' ?></td>
                        <td><?= number_format($order['TongTien'], 0, ',', '.') ?> đ</td>
                        <td>
                            <?php if ($order['TrangThai'] === 'đã xác nhận'): ?>
                                <span class="badge bg-success">Đã xác nhận</span>
                            <?php else: ?>
                                <span class="badge bg-warning text-dark"><?= $order['TrangThai'] ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                           <form method="post" action="index.php?controller=admin&action=updateOrderStatus">
                <input type="hidden" name="MaDon" value="<?= $order['MaDon'] ?>">
                    <select name="TrangThai" class="form-select form-select-sm" required>
                        <option value="chưa xử lý" <?= $order['TrangThai'] == 'chưa xử lý' ? 'selected' : '' ?>>Chưa xử lý</option>
                        <option value="đang giao" <?= $order['TrangThai'] == 'đang giao' ? 'selected' : '' ?>>Đang giao</option>
                        <option value="đã giao" <?= $order['TrangThai'] == 'đã giao' ? 'selected' : '' ?>>Đã giao</option>
                        <option value="đã xác nhận" <?= $order['TrangThai'] == 'đã xác nhận' ? 'selected' : '' ?>>Đã xác nhận</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-primary mt-1">Cập nhật</button>
                </form>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script>
function confirmOrder(maDon) {
    if (!confirm("Xác nhận đơn hàng này?")) return;
}
</script>

