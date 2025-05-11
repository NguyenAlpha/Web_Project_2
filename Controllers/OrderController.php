<?php
class OrderController extends BaseController {
    private $orderModel;
    private $productModel;
    private $cartModel;
    private $categoryModel;
    private $userModel;
    public function __construct() {
        $this->loadModel('OrderModel');
        $this->loadModel('ProductModel');
        $this->loadModel('CartModel');
        $this->loadModel('CategoryModel');
        $this->loadModel('UserModel');
        $this->orderModel = new OrderModel();
        $this->cartModel = new CartModel();
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->userModel = new UserModel();
    }

    public function show() {
        $this->loadView("partitions/frontend/header.php",[
            "menus" => $this->categoryModel->getAll()
        ]);
        $this->orderModel
    }

    public function addOrder() {
        print_r($_POST);
        $userID = $_SESSION['user']['ID'];
        $address = $_POST['address'];
        $pay = $_POST['pay'];
        $carts = $this->cartModel->getCartbyUserID($userID);
        $TongTien = 0;
        foreach($carts AS $cr) {
            $TongTien += $cr['TongTien'];
        }
        $this->cartModel->deleteCartByUserID($userID);
        $this->orderModel->addOrder($carts,$userID, $address, $TongTien, $pay);
        header("Location: ./index.php");
    }
}
?>