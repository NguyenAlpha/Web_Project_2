<?php
include_once(__DIR__ . '/../../../Core/Database.php');
include "./Views/partitions/fontend/headerAdmin.php";
?>

<style>
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f2f4f8;
        padding: 20px;
    }

    h1 {
        text-align: center;
        color:rgb(0, 0, 0);
        margin-bottom: 30px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: white; 
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        border-radius: 10px;
        overflow: hidden;
    }

    th, td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    tr:hover {
        background-color: #f1f5ff;
    }

    th {
        background-color: #00268c;
        color: white;
        text-transform: uppercase;
    }

    a {
        color: #0044cc;
        text-decoration: none;
        font-weight: bold;
    }

    a:hover {
        text-decoration: underline;
    }

    button {
        padding: 8px 15px;
        background-color: #00268c;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
    }

    button:hover {
        background-color: #002b8a;
    }
    table {
    margin: 40px auto; /* Căn giữa theo chiều ngang và tạo khoảng cách */
    border-collapse: collapse;
    width: 95%;
    max-width: 1200px;
    background-color: white;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    border-radius: 8px;
    overflow: hidden;
  }
</style>

<h1>Danh sách khách hàng</h1>
<table>
  <thead>
    <tr>
      <th>Username</th>
      <th>Password</th>
      <th>Email</th>
      <th>Địa chỉ</th>
      <th>Giỏ hàng</th>
      <th>Hành động</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach( $customers as $value ):?>
      <tr>
        <td><?php echo $value['username']?></td>
        <td><?php echo $value['password']?></td>
        <td><?php echo $value['email']?></td>
        <td><?php echo $value['address']?></td>
        <td>
          <a href="index.php?controller=admin&action=CustomerCart&customerID=<?php echo $value['id']?>">Xem giỏ hàng</a>
        </td>
        <td>
        <a href="index.php?controller=admin&action=Editcustomer&id=<?= $value['id'] ?>" 
   style="padding: 6px 12px; background-color: #00268c; color: white; border-radius: 4px; text-decoration: none; hover:rgb(1, 11, 39)">
   Sửa thông tin
</a>
</td>
      </tr>
    <?php endforeach;?>
  </tbody>
</table>
