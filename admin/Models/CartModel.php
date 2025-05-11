<?php
 class CartModel extends BaseModel
 {
    const TABLE = "carts";
    public function getCartbyUserID($userID)
    {
    $sql = "SELECT * FROM carts WHERE userID = $userID";
    return $this -> getByQuery($sql);
    }
    public function deleteByProductId($productId) {
        $sql = "DELETE FROM carts WHERE MaSP = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $productId);
        return $stmt->execute();
    }
 }