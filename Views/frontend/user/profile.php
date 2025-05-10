<div class="card">
  <div class="card-header bg-white">
    <h5 class="mb-0">Thông tin tài khoản</h5>
  </div>
  <form action="index.php?controller=user&action=update&userID=<?= $user['ID'] ?>" method="post" id="myForm">
    <div class="card-body">
      <div class="form-group">
        <label>Tên tài khoản</label>
        <input type="text" class="form-control" name="username" value="<?= $user['username'] ?>">
      </div>

      <div class="form-group mt-3">
        <label>Giới tính</label><br>
        <input type="radio" name="sex" value="Nam" <?= $user['sex'] == 'Nam' ? 'checked' : '' ?>> Nam
        <input type="radio" name="sex" value="Nữ" <?= $user['sex'] == 'Nữ' ? 'checked' : '' ?>> Nữ
      </div>

      <div class="form-group mt-3">
        <label>Số điện thoại</label>
        <input type="text" class="form-control" name="phonenumber" value="<?= $user['phonenumber'] ?>">
      </div>

      <div class="form-group mt-3">
        <label>Email</label>
        <input type="email" class="form-control" name="email" value="<?= $user['email'] ?>">
      </div>

      <div class="form-group mt-3">
        <label>Ngày sinh</label>
        <?php 
          $dobArray = explode('-', $user['date_of_birth']);
          $day = $dobArray[2] ?? '';
          $month = $dobArray[1] ?? '';
          $year = $dobArray[0] ?? '';
        ?>
        <div class="row">
          <div class="col">
            <select class="form-control" name="dob[]">
              <option><?= $day ?: 'ngày' ?></option>
              <?php for($i = 1; $i <= 31; $i++) echo "<option>$i</option>"; ?>
            </select>
          </div>
          <div class="col">
            <select class="form-control" name="dob[]">
              <option><?= $month ?: 'tháng' ?></option>
              <?php for($i = 1; $i <= 12; $i++) echo "<option>$i</option>"; ?>
            </select>
          </div>
          <div class="col">
            <select class="form-control" name="dob[]">
              <option><?= $year ?: 'năm' ?></option>
              <?php for($i = 1970; $i <= date('Y'); $i++) echo "<option>$i</option>"; ?>
            </select>
          </div>
        </div>
      </div>

      <div class="mt-4 text-center">
        <button type="submit" class="btn btn-danger" id="submitBtnUser">LƯU THAY ĐỔI</button>
      </div>
    </div> 
  </form>
</div>
