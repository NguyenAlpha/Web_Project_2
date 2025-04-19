 <?php
include_once(__DIR__ . '/../../../Core/Database.php');
include "./Views/partitions/fontend/headerAdmin.php";
?>

<h1>Danh sách khách hàng</h1>
<table>
<?php

?>
  <?php foreach( $customer as $value ):?>
    <tr>
      <td><?php echo $value['username']?></td>
      <td><?php echo $value['password']?></td>
      <td><?php echo $value['email']?></td>
      <td><?php echo $value['address']?></td>
      <td><?php echo $value['email']?></td>
      <td><button>sửa thông tin</button></td>
    </tr>
  <?php endforeach;?>
</table>
      