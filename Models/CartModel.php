<?php
 class CartModel extends BaseModel
 {
    const TABLE = "Cart";
    public function getCartbyUserID($userID)
    {
    $sql = "SELECT * FROM CART WHERE USERID = $userID";
    return $this -> getByQuery($sql);
    }
    
 }