<?php
include_once(__DIR__ . '/../../../Core/Database.php');
include "./Views/partitions/frontend/headerAdmin.php";
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
    td div img {
    width: 70px;
    height: 70px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 5px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

td div {
    display: flex;
    /* flex-direction: column;
    align-items: center; */
}
.con{
    display: flex;
    align-items: center;
    gap: 12px;

}
.sumPrice
{
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    color: #00268c;
    margin-top: 30px;
    padding: 15px 20px;
    background-color: #e6f0ff;
    border: 2px solid #00268c;
    border-radius: 10px;
    width: fit-content;
    margin-left: auto;
    margin-right: auto;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
    .thaotac
    {
        display: flex;
    }
</style>

<h1>Giỏ hàng của khách hàng <?= $customerName['username'] ?></h1>

<table>
    <tr>
        <th>Sản phẩm</th>
        <th>Đơn giá</th>
        <th>Số lượng</th>
        <th>Thành tiền</th>
        <th>Thao tác</th>
    </tr>
    <?php foreach($carts as $value): ?>
        <tr>
            <td> 
                <div class="con">
                <div>
                   <a href="index.php?controller=product&action=show&id=<?=$value['MaSP']?>" target="_blank"> <img src="<?php echo $value['productPicture']?>" alt="Ảnh mô tả sản phẩm"></a>
                </div>
                <div>
                <a href="index.php?controller=product&action=show&id=<?=$value['MaSP']?>" target="_blank">
                    <?= htmlspecialchars($value['productName']) ?>
                </a>
                </div>
                </div>
            </td>
            <td><?= number_format($value['productPrice'], 0, ',', '.') ?> đ</td>
            <td><?= $value['SoLuong'] ?></td>
            <td><?= number_format($value['sumPrice'], 0, ',', '.') ?> đ</td>
            <td>
                <div class="thaotac">
<div><a href="" class="btn-action">Sửa</a></div>
  <div><a href="" class="btn-xoa" onclick="return confirm('Bạn có chắc muốn xoá sản phẩm này không?')">Xoá</a></div>
  </div>
</td>
        </tr>
    <?php endforeach; ?>
</table>

<p class="sumPrice"><strong>Tổng tiền:</strong> <?= number_format($allPrice, 0, ',', '.') ?> đ</p>
