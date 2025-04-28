<?php 
class CartController extends BaseController {
    private $categoryModel;
    public function __construct() {
        $this->loadModel("CategoryModel");
        $this->categoryModel = new CategoryModel();

        $this->loadView("partitions/frontend/header.php",[
            "menus" => $this->categoryModel->getAll(['*'],['STT'])
        ]);
    }

    public function index() {

    }

    public function show() {
        if(!isset($_SESSION['user'])) {
            return $this->loadView('partitions/frontend/login.php', [
                'cartAlert' => "Đăng nhập để xem giỏ hàng"
            ]);
        }
        $this->loadView("frontend/cart/show.php", [
        ]);
    }
}
?>