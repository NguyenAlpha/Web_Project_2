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

    public function getOrderByUserID($userID) {
        $sql = "SELECT *, listproduct.SoLuong AS SoLuongOrder, orders.TrangThai AS TrangThaiDon, orders.MaDon AS MaOrder FROM orders 
        INNER JOIN listproduct ON listproduct.MaDon = orders.MaDon
        INNER JOIN products ON products.MaSP = listproduct.MaSP 
        WHERE UserID = $userID";
        return $this->getByQuery($sql);
    }

    public function getListMaDon($userID) {
        $sql = "SELECT * FROM orders WHERE UserID = $userID";
        return $this->getByQuery($sql);
    }
}

?>