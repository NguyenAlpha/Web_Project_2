<?php

use Dba\Connection;
 class CartController extends BaseController {
   protected $conn;
   public function ViewCart(){
    echo "Xem giỏ hàng của khách hàng";
    if(isset($_POST["Viewcart"])){
    $this ->loadModel("CartModel");

   }
 }
}
?>