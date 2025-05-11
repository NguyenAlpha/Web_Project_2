
<h2>HÓA ĐƠN MUA HÀNG</h2>


<p><strong>Mã đơn:</strong> <?= $orders['MaDon'] ?></p>
<p><strong>Ngày đặt:</strong> <?= $orders['NgayDat'] ?? 'Chưa có' ?></p>
<p><strong>Địa chỉ giao:</strong> <?= $orders['DiaChi'] ?></p>
<p><strong>Trạng thái:</strong> <?= $orders['TrangThai'] ?></p>

<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Thành tiền</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $tong = 0;
        foreach ($products as $p): 
            $thanhTien = $p['SoLuong'] * $p['DonGia'];
            $tong += $thanhTien;
        ?>
        <tr>
            <td><?= $p['TenSP'] ?></td>
            <td><?= $p['SoLuong'] ?></td>
            <td><?= number_format($p['DonGia']) ?>đ</td>
            <td><?= number_format($thanhTien) ?>đ</td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3"><strong>Tổng tiền</strong></td>
            <td style="color:red"><strong><?= number_format($tong) ?>đ</strong></td>
        </tr>
    </tbody>
</table>