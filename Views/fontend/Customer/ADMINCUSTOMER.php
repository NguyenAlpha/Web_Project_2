 <?php
// include_once(__DIR__ . '/../../../Core/Database.php');
include "./Views/partitions/fontend/headerAdmin.php";

// include_once(__DIR__ . '/../../partitions/fontend/header.php');
// $sql = "SELECT * FROM customers";
// $result = $->query($sql);
?>

<h1>Danh sách khách hàng</h1>
<table>
<?php

?>
  <?php foreach( $customer as $value ):?>
    <tr>
      <td><?php echo $value['username']?></td>
      <td><?php echo $value['password']?></td>
      <td><button>sửa thông tin</button></td>
    </tr>
  <?php endforeach;?>
</table>
      