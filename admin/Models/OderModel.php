<?php
class OrderModel extends BaseModel
{
    const TABLE = 'orders';

    // Lấy tất cả đơn hàng
    public function getAllOrders()
    {
        $sql = "SELECT * FROM " . self::TABLE . " ORDER BY MaDon DESC";
        return $this->queryAll($sql);
    }

    // Lấy đơn hàng theo UserID
    public function getOrdersByUserID($userID)
    {
        $sql = "SELECT * FROM " . self::TABLE . " WHERE UserID = ? ORDER BY MaDon DESC";
        return $this->queryAll($sql, [$userID]);
    }

    // Lấy 1 đơn hàng theo MaDon
    public function getOrderByID($maDon)
    {
        $sql = "SELECT * FROM " . self::TABLE . " WHERE MaDon = ?";
        return $this->queryOne($sql, [$maDon]);
    }
}
?>