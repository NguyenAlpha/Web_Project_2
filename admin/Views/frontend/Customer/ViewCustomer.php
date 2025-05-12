<?php include "./Views/partitions/frontend/headerAdmin.php"; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết khách hàng</title>
    <style>
        .container {
            width: 60%;
            margin: 30px auto;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .info-row {
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
        }

        .label {
            font-weight: bold;
            color: #555;
        }

        .value {
            color: #000;
        }

        .btn-group {
            text-align: center;
            margin-top: 20px;
        }

        .btn {
            padding: 8px 16px;
            margin: 0 8px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            color: white;
        }

        .btn-edit {
            background-color: #007bff;
        }

        .btn-delete {
            background-color: #dc3545;
        }

        .btn-hide {
            background-color: #6c757d;
        }
        .tong{
            margin-left: 250px;
        padding: 20px;
        margin-top: 60px;
        }
    </style>
</head>
<body>
    <div class="tong">
    <div class="container">
        <h2>Chi tiết khách hàng</h2>

        <div class="info-row"><span class="label">ID:</span> <span class="value"><?= $customers['ID'] ?></span></div>
        <div class="info-row"><span class="label">Tên đăng nhập:</span> <span class="value"><?= $customers['username'] ?></span></div>
        <div class="info-row"><span class="label">Mật khẩu:</span> <span class="value"><?= $customers['password'] ?></span></div>
        <div class="info-row"><span class="label">Email:</span> <span class="value"><?= $customers['email'] ?></span></div>
        <div class="info-row"><span class="label">Giới tính:</span> <span class="value"><?= $customers['sex'] ?? 'Chưa có' ?></span></div>
        <div class="info-row"><span class="label">Số điện thoại:</span> <span class="value"><?= $customers['phonenumber'] ?></span></div>
        <div class="info-row"><span class="label">Ngày sinh:</span> <span class="value"><?= $customers['date_of_birth'] ?></span></div>
        <div class="info-row"><span class="label">Trạng thái:</span> <span class="value"><?= $customers['TrangThai'] ?></span></div>

        <div class="btn-group">
            <a href="index.php?controller=admin&action=EditCustomer&id=<?= $customers['ID'] ?>" class="btn btn-edit">Sửa thông tin</a>
            <a href="index.php?controller=admin&action=changeCustomerStatus&id=<?= $customers['ID'] ?>" class="btn btn-hide">Đổi trạng thái</a>
            <a href="index.php?controller=admin&action=deleteCustomer&id=<?= $customers['ID'] ?>" class="btn btn-delete" onclick="return confirm('Bạn có chắc chắn muốn xoá khách hàng này?')">Xoá khách hàng</a>
        </div>
    </div>
    </div>
</body>
</html>
