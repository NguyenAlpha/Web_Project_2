<?php
include_once(__DIR__ . '/../../../Core/Database.php');
include "./Views/partitions/fontend/headerAdmin.php";
?>

<h1>Giỏ hàng của khách hàng <?=$customerName['username']?>:</h1>
<?php
    echo "<pre>";
    echo print_r($carts);
    echo "</pre>";
?>

<p><?=number_format($allPrice, 0, ',', '.') . "đ"?></p>