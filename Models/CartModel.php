<?php
 class CartModel extends BaseModel
 {
    const TABLE = "carts";
    public function getCartbyUserID($userID)
    {
    $sql = "SELECT * FROM carts WHERE userID = $userID";
    return $this -> getByQuery($sql);
    }
    public function addProduct($userID)
    {
      
    }
 }