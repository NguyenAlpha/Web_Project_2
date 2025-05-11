<?php
class AjaxController extends BaseController{
    private $userModel;
    private $categoryModel;
    public function getaddress(){
        $addresses = $this->userModel->getaddress($_SESSION['user']['ID']);
        $this->loadView("frontend/user/address.php", [
            'addresses' => $addresses
        ]);
    }
    public function __construct(){
        $this->loadModel("UserModel");   
        $this->userModel = new UserModel(); 
    }
    public function show() {
        // nếu chưa đăng nhập thì chuyển hướng về trang login
        if(!isset($_SESSION['user'])) {
            header("Location: ./index.php?controller=user&action=login");
            exit;
        }
        $this->loadView("frontend/user/profile.php", [
            'user' => $_SESSION['user']
        ]);
    }

    public function updateQuantity() {
        $this->loadModel("CartModel");
        $cartModel = new CartModel();
        $cartModel->updateQuantityByID($_GET['id'], $_GET['quantity']);
    }
        

}
?>