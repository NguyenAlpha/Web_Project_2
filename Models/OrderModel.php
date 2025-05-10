<?php 
class OrderModel extends BaseModel {
    public function addOrder(array $carts,$userID, $address, $TongTien, $pay) {
        $transfer = [
            'transfer' => 'chuyển khoản',
            'cash' => 'tiền mặt'
        ];
        $sql = "INSERT INTO orders (UserID, DiaChi, TongTien, TrangThai, ThanhToan) VALUES ($userID,'$address',$TongTien,'chờ xác nhận', '$transfer[$pay]');";
        // echo $sql;
        // die;
        $this->conn->query($sql);
        $orderID = $this->conn->insert_id;
        $sql2 = "INSERT INTO listproduct (MaDon, MaSP, SoLuong) VALUES ";
        $values = [];

        foreach ($carts as $cart) {
            $maSP = (int)$cart['MaSP'];
            $soLuong = (int)$cart['SoLuong'];
            $values[] = "($orderID, $maSP, $soLuong)";
        }

        $sql2 .= implode(', ', $values) . ';';
        $this->conn->query($sql2);
    }

    public function getOrderByUserID() {
        $sql = "SELECT * ";
        $this->getByQuery($sql);
    }
}

?>