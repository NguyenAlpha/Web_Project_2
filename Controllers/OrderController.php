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
        $orders = $this->orderModel->getOrderByUserID($_SESSION['user']['ID']);
        $this->loadView("frontend/order/show.php", [
            'orders' => $orders,
            'user' => $_SESSION['user'],
            'listMaDon' => $this->orderModel->getListMaDon($_SESSION['user']['ID'])
        ]);
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
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $now = date('Y-m-d H:i:s');
        $this->cartModel->deleteCartByUserID($userID);
        $this->orderModel->addOrder($carts,$userID, $address, $TongTien, $pay, $now);
        header("Location: ?controller=order&action=show&userID=$userID");
    }


   public function confirmDelivered() {
    $maDon = $_GET['MaDon'] ?? null;

    if ($maDon) {
        require_once "./Models/OrderModel.php";
        $model = new OrderModel();
        $model->updateStatus($maDon, "Đã nhận hàng");
    }

    $maDon = (int)$_GET['id'];
    $this->loadModel('OrderModel');
    $orderModel = new OrderModel();
    // $orderModel->updateStatusToConfirmed($maDon);

    echo "✅ Đã xác nhận đơn #$maDon";
}

    
    // Quay lại danh sách đơn hàng
    $userID = $_SESSION['user']['ID'];
    header("Location: index.php?controller=order&action=show&userID=" . $userID);
    exit;
}


}


?>