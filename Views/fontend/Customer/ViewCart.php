<?php
include_once(__DIR__ . '/../../../Core/Database.php');
include "./Views/partitions/fontend/headerAdmin.php";
?>

<h1>Giỏ hàng của khách hàng</h1>

<?php foreach($cart as $userID => $cartItems): ?>
    <h2>Khách hàng ID: <?= $userID ?></h2>
    <table >
        <tr>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Thành tiền</th>
        </tr>
        <?php foreach($cartItems as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['product_name']) ?></td>
                <td><?= $item['quantity'] ?></td>
                <td><?= number_format($item['price'], 0, ',', '.') ?> đ</td>
                <td><?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?> đ</td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
<?php endforeach; ?>