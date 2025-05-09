function bindEditDeleteButtons() {
    document.querySelectorAll('.btn-edit').forEach(btn => {
      btn.addEventListener('click', function () {
        const id = this.dataset.id;
        // Gọi Ajax để lấy địa chỉ theo ID và hiển thị trong form
        fetch(`Views/frontend/user/get_address.php?id=${id}`)
          .then(res => res.json())
          .then(data => {
            document.querySelector('input[name="address"]').value = data.address;
            document.querySelector('input[name="city"]').value = data.city;
            document.getElementById('addAddressForm').style.display = 'block';
  
            // Bạn có thể thêm hidden input để lưu ID nếu đang sửa
            if (!document.getElementById('addressId')) {
              const hidden = document.createElement('input');
              hidden.type = 'hidden';
              hidden.name = 'id';
              hidden.id = 'addressId';
              document.getElementById('addAddressForm').appendChild(hidden);
            }
            document.getElementById('addressId').value = id;
          });
      });
    });
  
    document.querySelectorAll('.btn-delete').forEach(btn => {
      btn.addEventListener('click', function () {
        const id = this.dataset.id;
        if (confirm('Bạn có chắc muốn xoá địa chỉ này không?')) {
          fetch(`Views/frontend/user/delete_address.php?id=${id}`, { method: 'GET' })
            .then(res => res.text())
            .then(msg => {
              alert(msg);
              location.reload(); // hoặc load lại bảng qua Ajax
            });
        }
      });
    });
  }
  