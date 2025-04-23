<?php
include_once(__DIR__ . '/../../../Core/Database.php');
include "./Views/partitions/fontend/headerAdmin.php";
?>

<style>
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f5f5f5;
        margin: 0;
        padding: 20px;
    }

    h1 {
        text-align: center;
        color: rgb(0,38,133);
        margin-bottom: 30px;
    }

    table {
        margin: 0 auto;
        border-collapse: collapse;
        width: 90%;
        max-width: 1000px;
        background-color: #ffffff;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        border-radius: 10px;
        overflow: hidden;
    }

    th, td {
        padding: 15px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: rgb(0,38,133);
        color: white;
        text-transform: uppercase;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    p {
        text-align: center;
        font-size: 18px;
        margin-top: 20px;
        font-weight: bold;
        color: rgb(0, 26, 86);
    }
    a{
        color: black;
        text-decoration-line: none;
    }
    a:hover
    {
       color: rgb(0, 38, 133);
    }
</style>

<h1>Giỏ hàng của khách hàng <?= $customerName['username'] ?></h1>

<table>
    <tr>
        <th>Tên sản phẩm</th>
        <th>Đơn giá</th>
        <th>Số lượng</th>
        <th>Thành tiền</th>
    </tr>
    <?php foreach($carts as $value): ?>
        <tr>
            <td>
                <a href="index.php?controller=product&action=show&id=<?=$value['maSP']?>" target="_blank">
                    <?= htmlspecialchars($value['productName']) ?>
                </a>
            </td>
            <td><?= number_format($value['productPrice'], 0, ',', '.') ?> đ</td>
            <td><?= $value['SoLuong'] ?></td>
            <td><?= number_format($value['sumPrice'], 0, ',', '.') ?> đ</td>
        </tr>
    <?php endforeach; ?>
</table>

<p><strong>Tổng tiền:</strong> <?= number_format($allPrice, 0, ',', '.') ?> đ</p>
