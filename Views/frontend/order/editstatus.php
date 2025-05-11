<?php
if (!isset($order) || !$order) {
    echo "<p>Không tìm thấy đơn hàng.</p>";
    return;
}
?>

<p>Mã đơn: <?= $order['MaDon'] ?></p>
<p>Trạng thái: <?= $order['TrangThai'] ?></p>

<?php if ($order['TrangThai'] === 'đã xác nhận'): ?>
    <p>✔ Đã xác nhận</p>
<?php else: ?>
    <p>Chờ xác nhận</p>
<?php endif; ?>
