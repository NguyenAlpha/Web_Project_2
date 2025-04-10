<!-- <?php
include ('../../../Core/Database.php');
$sql = "SELECT * FROM customers";
// $result = $->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Danh sách sản phẩm</title>
  <style>
    .product {
      border: 1px solid #ccc;
      padding: 10px;
      margin: 10px;
      display: inline-block;
      width: 200px;
      text-align: center;
    }
    .product img {
      width: 100%;
      height: auto;
    }
  </style>
</head>
<body>
  <h2>Danh sách sản phẩm</h2>



  $conn->close();
  ?>
</body>
</html> -->
<h1>danh sách khách hàng</h1>
<table>

  <?php foreach($customer as $value):?>
    <tr>
      <td><?php echo $value['username']?></td>
      <td><?php echo $value['password']?></td>
      <td><button>sửa thông tin</button></td>
    </tr>
  <?php endforeach;?>
</table>
      