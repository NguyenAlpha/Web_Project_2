<?php
class CartModel extends BaseModel {
   const TABLE = "carts";

   public function getCartbyUserID($userID){
      $sql = "SELECT *, c.SoLuong AS SoLuong, (c.SoLuong * p.Gia) AS TongTien, p.SoLuong AS quantity FROM carts AS c
      INNER JOIN products AS p ON c.MaSP = p.MaSP WHERE c.userID = $userID";

      $carts = $this->getByQuery($sql);
      return $carts;
   }

   public function addProduct($userID, $productID, $Soluong){
      if($this->checkAlreadyExists($userID, $productID)) {
         $sql = "UPDATE carts SET SoLuong = SoLuong + $Soluong WHERE UserID = $userID AND MaSP = $productID";
      } else {
         $sql = "INSERT INTO carts (userID, MaSP, SoLuong) VALUES ($userID, $productID, $Soluong)";
      }
      return $this->add($sql);
   }

   public function deleteCart($id) {
      return $this->delete(self::TABLE,'ID',$id);
   }

   public function checkAlreadyExists(int $id, int $MaSP) {
      $sql = "SELECT * FROM carts WHERE userID = $id AND MaSP = $MaSP";
      $result = $this->conn->query($sql);
      if($result->num_rows > 0) {
         return (boolean) true;
      }

      return (boolean) false;
   }

   public function updateQuantityByID($id, $quantity) {
      $this->update('carts',['SoLuong' => $quantity],'ID',$id);
   }
}