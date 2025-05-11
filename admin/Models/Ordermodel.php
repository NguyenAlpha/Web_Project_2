
<?php 
class OrderModel extends BaseModel{
public function getAllOrders() {
    $sql = "SELECT * FROM orders ORDER BY MaDon DESC";
    return $this->getByQuery($sql);
}

public function confirmOrderById($id) {
    $sql = "UPDATE orders SET TrangThai = 'đã xác nhận' WHERE MaDon = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}






}