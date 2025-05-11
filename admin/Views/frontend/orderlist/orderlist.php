    <!-- Views/admin/order/orderlist.php -->
    <?php
    include "./Views/partitions/frontend/headerAdmin.php";
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="orderlist.css">
<style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: Arial, sans-serif;
    }

    .dashboard {
      display: flex;
      min-height: 100vh;
    }

    .sidebar {
      width: 220px;
      background-color: #002f6c;
      color: white;
      padding: 20px;
      position: fixed;
      top: 0;
      left: 0;
      bottom: 0;
    }

    .main-content {
      margin-left: 220px; /* Khoảng trống bằng chiều rộng sidebar */
      padding: 20px;
      width: calc(100% - 220px);
      overflow-x: auto;
    }

    .table-container {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
        background-color: #00268c;
        color: white;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 14px;
        text-align: center;
        position: relative;
        }
    th.sortable:hover {
        background-color: #001a63;
        cursor: pointer;
    }

    th .sort-icon {
        margin-left: 5px;
    }


    button {
      margin-right: 5px;
    }
    .container {
    margin-left: 260px; /* hoặc đúng chiều rộng của sidebar */
    padding: 20px;
    }
  </style>


    </head>
    <body>
        
        
        
        
        
        <div class="container mt-5">
            <h2 class="mb-4">📋 Danh sách đơn hàng</h2>
            
            <table class="table table-bordered table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>Mã đơn</th>
                        <th>Người dùng</th>
                        <th>Địa chỉ</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td>#<?= $order['MaDon'] ?></td>
                            <td><?= $order['UserID'] ?></td>
                            <td><?= $order['DiaChi'] ?></td>
                            <td><?= $order['NgayDat'] ?? 'N/A' ?></td>
                            <td><?= number_format($order['TongTien'], 0, ',', '.') ?> đ</td>
                            <td>
                                <?php if ($order['TrangThai'] === 'đã xác nhận'): ?>
                                    <span class="badge bg-success">Đã xác nhận</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark"><?= $order['TrangThai'] ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <form method="post" action="index.php?controller=admin&action=updateOrderStatus">
                                            <input type="hidden" name="MaDon" value="<?= $order['MaDon'] ?>">
                                            <select name="TrangThai" class="form-select form-select-sm" required>
                                                <option value="chưa xử lý" <?= $order['TrangThai'] == 'chưa xử lý' ? 'selected' : '' ?>>Chưa xử lý</option>
                                                <option value="đang giao" <?= $order['TrangThai'] == 'đang giao' ? 'selected' : '' ?>>Đang giao</option>
                                                <option value="đã giao" <?= $order['TrangThai'] == 'đã giao' ? 'selected' : '' ?>>Đã giao</option>
                                                <option value="đã xác nhận" <?= $order['TrangThai'] == 'đã xác nhận' ? 'selected' : '' ?>>Đã xác nhận</option>
                                            </select>
                                            <button type="submit" class="btn btn-sm btn-primary mt-1">Cập nhật</button>
                                            <a href="index.php?controller=order&action=printInvoice&maDon=<?= $order['MaDon'] ?>" target="_blank">
                                                <button class="btn btn-info">🧾 In hóa đơn</button>
                                            </a>
                                            
                                        </form>
                                        
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    </body>
                    </html>
                    <script>
                        function confirmOrder(maDon) {
                            if (!confirm("Xác nhận đơn hàng này?")) return;
                        }
                    </script>

