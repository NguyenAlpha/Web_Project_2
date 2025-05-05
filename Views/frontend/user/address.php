<!-- views/user/address.php -->
<div class="card">
  <div class="card-header bg-white d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Sổ địa chỉ</h5>
    <a href="index.php?controller=user&action=add_address" class="btn btn-primary">+ Thêm địa chỉ mới</a>
  </div>
  <div class="card-body">
    <?php if (!empty($addresses)) : ?>
      <?php foreach ($addresses as $address) : ?>
        <div class="border-bottom py-3">
          <?php if ($address['is_default']) : ?>
            <span class="badge bg-danger">Mặc định</span>
          <?php endif; ?>
          <strong><?php echo $address['fullname']; ?></strong> | 
          <span><?php echo $address['phone']; ?></span><br>
          <span><?php echo $address['address']; ?>, <?php echo $address['city']; ?>, <?php echo $address['country']; ?></span><br>
          <a href="index.php?controller=user&action=edit_address&id=<?php echo $address['id']; ?>" class="text-primary">Cập nhật</a>
        </div>
      <?php endforeach; ?>
    <?php else : ?>
      <p>Bạn chưa có địa chỉ nào.</p>
    <?php endif; ?>
  </div>
</div>
