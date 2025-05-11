
<?php 
class OrderModel extends BaseModel{
      const  TABLE = "orders";
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
<<<<<<< HEAD
public function getOrderByUserID($userID) {
    $sql = "SELECT *, listproduct.SoLuong AS SoLuongOrder, orders.TrangThai AS TrangThaiDon, orders.MaDon AS MaOrder FROM orders 
    INNER JOIN listproduct ON listproduct.MaDon = orders.MaDon
    INNER JOIN products ON products.MaSP = listproduct.MaSP 
    WHERE UserID = $userID";
    return $this->getByQuery($sql);
=======







>>>>>>> 501786223ad7f3e1d2e29c19c6910968b2b9cafe
}
   public function deleteOrder($userID) {
      return $this->delete(self::TABLE,'userID',$userID);
   }




}