<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tmdt";
include "./Views/partitions/frontend/headerAdmin.php";

// Kết nối CSDL
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách khách hàng</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn-action, .btn-xoa {
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            margin-right: 5px;
        }

        .btn-action {
            background-color: #4CAF50;
            color: white;
        }

        .btn-xoa {
            background-color: red;
            color: white;
        }
    </style>
</head>
<body>
    <h2>Danh sách khách hàng</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên đăng nhập</th>
                <th>Mật khẩu</th>
                <th>Email</th>
                <th>Giới tính</th>
                <th>Số điện thoại</th>
                <th>Ngày sinh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $value): ?>
                <tr>
                    <td><?= htmlspecialchars($value['ID']) ?></td>
                    <td><?= htmlspecialchars($value['username']) ?></td>
                    <td><?= htmlspecialchars($value['password']) ?></td>
                    <td><?= htmlspecialchars($value['email']) ?></td>
                    <td><?= htmlspecialchars($value['sex']) ?></td>
                    <td><?= htmlspecialchars($value['phonenumber']) ?></td>
                    <td><?= htmlspecialchars($value['date_of_birth']) ?></td>
                    <td>
                        <a href="javascript:void(0);" onclick="openCartPopup(<?= $value['ID'] ?>)" class="btn-action">Xem</a>
                        <a href="index.php?controller=admin&action=Editcustomer&id=<?= $value['ID'] ?>" class="btn-action">Sửa</a>
                        <a href="index.php?controller=admin&action=deleteCustomer&id=<?= $value['ID'] ?>" class="btn-xoa" onclick="return confirm('Bạn có chắc muốn xoá khách hàng này không?')">Xoá</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

