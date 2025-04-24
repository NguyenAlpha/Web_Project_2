<?php
include_once(__DIR__ . '/../../../Core/Database.php');
include "./Views/partitions/fontend/headerAdmin.php";
?>

<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #eef2f7;
        margin: 0;
        padding: 30px;
    }

    h1 {
        text-align: center;
        color: #00268c;
        font-size: 32px;
        margin-bottom: 40px;
    }

    table {
        width: 95%;
        max-width: 1200px;
        margin: auto;
        border-collapse: collapse;
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    th, td {
        padding: 16px 20px;
        text-align: left;
        border-bottom: 1px solid #f0f0f0;
    }

    th {
        background-color: #00268c;
        color: white;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 14px;
    }

    tr:hover {
        background-color: #f4f8ff;
    }

    td a {
        color: #0056d2;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    td a:hover {
        color: #00268c;
        text-decoration: underline;
    }

    .btn-action {
        display: inline-block;
        padding: 8px 14px;
        margin-right: 6px;
        background-color:rgb(253, 253, 253);
        color:  #00268c;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
        transition: background-color 0.3s ease;
        border: 1px solid #00268c;
    }

    .btn-action:hover {
        background-color: #001f6d;
        color: white;
        text-decoration: none;

    }

    .addsp {
        text-align: center;
        margin-top: 30px;
    }

    .addsp a {
        display: inline-block;
        padding: 10px 20px;
        background-color:white;
        color: #001f6d;
        text-decoration: none;
        border-radius: 6px;
        font-weight: bold;
        transition: background-color 0.3s ease;
        border: 1px solid #001f6d;
    }

    .addsp a:hover {
        background-color: #001f6d;
        color: white;
    }
    .btn-xoa
    {
        display: inline-block;
        padding: 8px 14px;
        margin-right: 6px;
        background-color:rgb(253, 253, 253);
        color:rgb(208, 2, 2);
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
        transition: background-color 0.3s ease;
        border: 1px solid rgb(208, 2, 2);
    }
    .btn-xoa:hover
    {
        background-color:rgb(208, 2, 2);
        color: white;
        text-decoration: none;
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
      <th>Thao tác</th>
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
          <a href="index.php?controller=admin&action=CustomerCart&customerID=<?php echo $value['id']?>" class="btn-action">Xem</a>
        </td>
<td>
<a href="index.php?controller=admin&action=Editcustomer&id=<?= $value['id'] ?>" class="btn-action">Sửa</a>
  <a href="index.php?controller=admin&action=deleteCustomer&id=<?= $value['id'] ?>" class="btn-xoa" onclick="return confirm('Bạn có chắc muốn xoá khách hàng này không?')">Xoá</a>
</td>

      </tr>
      
    <?php endforeach;?>
    <script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("updateCustomerForm");

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        fetch("index.php?controller=admin&action=updateCustomer", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert("Cập nhật thành công!");
            // Bạn có thể xử lý thêm nếu muốn, ví dụ: hiển thị kết quả hoặc reload dữ liệu
        })
        .catch(error => {
            console.error("Lỗi:", error);
            alert("Có lỗi xảy ra khi cập nhật.");
        });
    });
});
</script>
  </tbody>
</table>
<div class="addsp">
    <a href="index.php?controller=admin&action=addCustomer">Thêm khách hàng</a>
</div>
