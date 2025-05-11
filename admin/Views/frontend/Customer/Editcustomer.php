<?php
include "./Views/partitions/frontend/headerAdmin.php";
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
h2 {
    text-align: center;
    color: #00268c;
    font-size: 28px;
    margin-top: 40px;
    margin-bottom: 30px;
    font-weight: bold;
    font-family: 'Roboto', sans-serif;
}
</style>
<h2>Sửa thông tin khách hàng</h2>
<form action="index.php?controller=admin&action=updateCustomer" method="post" class="form-update" style="max-width: 500px; margin: auto;">
    <input type="hidden" name="id" value="<?= $customers['ID'] ?>">
      
    <label>Username:</label>
    <input type="text" name="username" value="<?= $customers['username'] ?>" required><br><br>

    <label>Password:</label>
    <input type="text" name="password" value="<?= $customers['password'] ?>" required><br><br>

    <label>Email:</label>
    <input type="email" name="email" value="<?= $customers['email'] ?>" required><br><br>

    <label for="sex">Giới tính:</label><br>
    <select name="sex" id="sex" style="padding: 8px; border-radius: 5px; width: 100%;" required>
        <option value="Nam" <?= (isset($customers['sex']) && $customers['sex'] == 'Nam') ? 'selected' : '' ?>>Nam</option>
        <option value="Nữ" <?= (isset($customers['sex']) && $customers['sex'] == 'Nữ') ? 'selected' : '' ?>>Nữ</option>
    </select><br><br>

    <label>Phonenumber:</label>
    <input type="text" name="phonenumber" value="<?= $customers['phonenumber'] ?>" pattern="[0-9]{10}" maxlength="10" required
           placeholder="Nhập 10 chữ số"><br><br>

    <label>Ngày sinh:</label>
    <input type="date" name="dob" value="<?= $customers['date_of_birth'] ?>" required><br><br>

    <button type="submit" style="padding: 10px 20px; border-radius: 5px; background-color: #007bff; color: white; border: none;">Cập nhật</button>


</form>

