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
                           <?php if ($order['TrangThai'] !== 'đã xác nhận'): ?>
                       <form method="post" action="index.php?controller=admin&action=confirmOrder" onsubmit="return confirm('Xác nhận đơn hàng này?')">
                        <input type="hidden" name="id" value="<?= $order['MaDon'] ?>">
                        <button type="submit" onclick="confirmOrderById($id)" class="btn btn-sm btn-success">✔ Xác nhận</button>
                    </form>

                    <?php else: ?>
                        <span class="text-muted">✓ Đã xử lý</span>
                    <?php endif; ?>
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

