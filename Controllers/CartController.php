<?php 
class CartController extends BaseController {
    private $categoryModel;
    private $cartModel;
    public function __construct() {
        $this->loadModel("CategoryModel");
        $this->categoryModel = new CategoryModel();
        $this->loadModel("CartModel");
        $this->cartModel = new CartModel();

        
    }

    public function index() {

    }

    public function addProduct() {
        if(!isset($_SESSION['user'])) {
            $this->loadView("partitions/frontend/header.php",[
                "menus" => $this->categoryModel->getAll(['*'],['STT'])
            ]);
            return $this->loadView('partitions/frontend/login.php', [
                'cartAlert' => "Đăng nhập để thêm sản phẩm vào giỏ hàng"
            ]);
        }
        
        $this->cartModel->addProduct($_SESSION['user']['ID'], $_GET['MaSP'], $_GET['quantity']);

        header("Location: ./index.php?controller=cart&action=show");
        exit;
    }

    public function show() {
        $this->loadView("partitions/frontend/header.php",[
            "menus" => $this->categoryModel->getAll(['*'],['STT'])
        ]);
        if(!isset($_SESSION['user'])) {
            return $this->loadView('partitions/frontend/login.php', [
                'cartAlert' => "Đăng nhập để xem giỏ hàng"
            ]);
        }

        $this->loadView("frontend/cart/show.php", [
            'carts' => $this->cartModel->getCartbyUserID($_SESSION['user']['ID']),
        ]);
        return;
    }

    public function delete() {
        $this->cartModel->deleteCart($_GET['id']);
        header("Location: ./index.php?controller=cart&action=show");
        exit;
    }

}
?>