<?php
class CartModel extends BaseModel{
   const TABLE = "carts";

   public function getCartbyUserID($userID){
      $sql = "SELECT *, c.SoLuong AS SoLuong, (c.SoLuong * p.Gia) AS TongTien FROM carts AS c
      INNER JOIN products AS p ON c.MaSP = p.MaSP WHERE c.userID = $userID";

      $carts = $this -> getByQuery($sql);
      return $carts;
   }

   public function addProduct($userID, $productID, $Soluong){
      $sql = "INSERT INTO carts (userID, MaSP, SoLuong) VALUES ($userID, $productID, $Soluong)";
      return $this->add($sql);
   }
}