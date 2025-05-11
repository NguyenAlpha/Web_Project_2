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

// Lấy danh sách (nếu cần)
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

$customers = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $customers[] = $row;
    }
}
?>
<style>
.form-update {
    width: 100%;
    max-width: 500px;
    margin: 0 auto;
    padding: 30px;
    background-color: #f0f4ff;
    border-radius: 12px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    font-family: 'Segoe UI', sans-serif;
    margin-top: 50px; /* đẩy form xuống cách top một chút */
}

.form-update h2 {
    text-align: center;
    color: rgb(4, 28, 52);
    margin-bottom: 20px;
}

.form-update label {
    display: block;
    margin-top: 15px;
    font-weight: 600;
    color: #34495e;
}

.form-update input,
.form-update select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 6px;
}

.form-update button {
    margin-top: 25px;
    width: 100%;
    padding: 12px;
    background-color: #2980b9;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s ease;
}

.form-update button:hover {
    background-color: #1c5980;
}

</style>



<form action="index.php?controller=admin&action=addCustomer" method="post" class="form-update">
<h2>Thêm khách hàng</h2>
    <label>Username:</label>
    <input type="text" name="username" required>

    <label>Password:</label>
    <input type="text" name="password" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Giới tính:</label>
    <select name="sex" required>
        <option value="">-- Chọn giới tính --</option>
        <option value="Nam">Nam</option>
        <option value="Nữ">Nữ</option>
    </select>
    <label>Số điện thoại:</label>
    <input type="tel" name="phonenumber" required>

    <label>Ngày sinh:</label>
    <input type="date" name="dob" required>

    <label>Địa chỉ:</label>
    <input type="text" name="address" required>

    <button type="submit">Thêm khách hàng</button>
</form>
