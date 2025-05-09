<?php 
class CartController extends BaseController {
    private $categoryModel;
    private $cartModel;
    public function __construct() {
        $this->loadModel("CategoryModel");
        $this->categoryModel = new CategoryModel();
        $this->loadModel("CartModel");
        $this->cartModel = new CartModel();

        $this->loadView("partitions/frontend/header.php",[
            "menus" => $this->categoryModel->getAll(['*'],['STT'])
        ]);
    }

    public function index() {

    }
    public function addProduct() {
        if(!isset($_SESSION['user'])) {
            return $this->loadView('partitions/frontend/login.php', [
                'cartAlert' => "Đăng nhập để thêm sản phẩm vào giỏ hàng"
            ]);
        }
        
        $MaSP = $_GET['MaSP'];
        $Soluong = $_GET['quantity'];
        $this->cartModel->addProduct($_SESSION['user']['ID'], $MaSP, $Soluong);

        header("Location: ./index.php?controller=cart&action=show");
        exit;
    }
    public function show() {
        if(!isset($_SESSION['user'])) {
            return $this->loadView('partitions/frontend/login.php', [
                'cartAlert' => "Đăng nhập để xem giỏ hàng"
            ]);
        }

        $this->loadView("frontend/cart/show.php", [
            'carts' => $this->cartModel->getCartbyUserID($_SESSION['user']['ID']),
        ]);
    }


}
?>