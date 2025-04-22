<?php
include_once(__DIR__ . '/../../../Core/Database.php');
include "./Views/partitions/fontend/headerAdmin.php";
?>
<style>
    .head{
        display: flex;
        text-align: center; 
        margin: auto auto; 
    }
    .header {
    display: flex;
    justify-content: center;
    font-size: 24px;
    color: #2c3e50;
    margin-bottom: 20px;
}
    .form-update {
    width: 400px;
    margin: 30px auto;
    padding: 20px 30px;
    background-color: #f0f4ff;
    border-radius: 12px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    font-family: 'Segoe UI', sans-serif;
}

.form-update h2 {
    display: flex;
    text-align: center;
    color:rgb(4, 28, 52);
}

.form-update label {
    display: block;
    margin-top: 15px;
    font-weight: 600;
    color: #34495e;
}

.form-update input[type="text"],
.form-update input[type="email"] {
    width: 100%;
    padding: 8px 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 6px;
    box-sizing: border-box;
}

.form-update button {
    margin-top: 20px;
    width: 100%;
    padding: 10px;
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
<h2>Sửa thông tin khách hàng</h2>
<form action="index.php?controller=admin&action=updateCustomer" method="post" class="form-update">
    <!-- <?php foreach( $customer as $value): ?> -->
    <input type="hidden" name="id" value="<?php $value['id'] ?>">
      
    <label>Username:</label>
    <input type="text" name="username" value="<?php $value['username'] ?>"><br>

    <label>Password:</label>
    <input type="text" name="password" value="<?php $value['password'] ?>"><br>

    <label>Email:</label>
    <input type="email" name="email" value="<?php $value['email'] ?>"><br>

    <label>Address:</label>
    <input type="text" name="address" value="<?php $value['address'] ?>"><br>

    <button type="submit">Cập nhật</button>
    <!-- <?php endforeach; ?> -->
</form>

