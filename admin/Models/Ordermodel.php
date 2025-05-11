
<?php 
class OrderModel extends BaseModel{
public function getAllOrders() {
    $sql = "SELECT * FROM orders ORDER BY MaDon DESC";
    return $this->getByQuery($sql);
}

public function updateOrderStatus($maDon, $trangThai) {
    $sql = "UPDATE orders SET TrangThai = ? WHERE MaDon = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("si", $trangThai, $maDon);
    return $stmt->execute();
}







}