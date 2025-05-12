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
    public function showQR() {
    $orderID = $_GET['order_id'] ?? null;
    
    if (!$orderID || !isset($_SESSION['pending_order'])) {
        header("Location: ?controller=cart");
        exit;
    }
    
    // Lấy thông tin đơn hàng
    $order = $this->orderModel->getOrderById($orderID);
    $user = $this->userModel->getUser($_SESSION['user']['ID']);
    
    $this->loadView("partitions/frontend/header.php", [
        "menus" => $this->categoryModel->getAll(),
        'title' => 'Thanh toán đơn hàng'
    ]);
    
    $this->loadView("frontend/payment/qr_payment.php", [
        'order' => $order,
        'user' => $user,
        // Các thông tin ngân hàng có thể lấy từ cấu hình
        'bankInfo' => [
            'name' => 'Vietcombank',
            'account' => '1234567890',
            'holder' => 'CÔNG TY TNHH ABC',
            'amount' => $order['TongTien'],
            'content' => 'THANHTOAN'.$orderID
        ]
    ]);
    
    $this->loadView("partitions/frontend/footer.php");
}

    public function verifyPayment() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderID = $_POST['order_id'] ?? null;
            
            if ($orderID && isset($_SESSION['pending_order'])) {
                // Cập nhật trạng thái đơn hàng
                $this->orderModel->updateStatus($orderID, "chờ xác nhận");
                
                // Xóa session pending
                unset($_SESSION['pending_order']);
                
                // Xóa giỏ hàng
                $this->cartModel->deleteCartByUserID($_SESSION['user']['ID']);
                
                header("Location: ?controller=order&action=show&payment_success=1");
                exit;
            }
        }
        
        header("Location: ?controller=cart");
        exit;
    }
    public function show() {
        $this->loadView("partitions/frontend/header.php",[
            "menus" => $this->categoryModel->getAll(),
            'title' => 'trang đơn hàng'
        ]);
        $orders = $this->orderModel->getOrderByUserID($_SESSION['user']['ID']);
        $this->loadView("frontend/order/show.php", [
            'orders' => $orders,
            'user' => $_SESSION['user'],
            'listMaDon' => $this->orderModel->getListMaDon($_SESSION['user']['ID'])
        ]);
    }

    public function addOrder() {
        $userID = $_SESSION['user']['ID'];
        $address = $_POST['address'];
        $payMethod = $_POST['pay'];
        $carts = $this->cartModel->getCartbyUserID($userID);
        
        // Tính tổng tiền
        $TongTien = array_reduce($carts, fn($sum, $item) => $sum + $item['TongTien'], 0);
        
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $now = date('Y-m-d H:i:s');
        
        // Xác định trạng thái đơn hàng
        $status = ($payMethod == 'transfer') ? 'chờ thanh toán' : 'chờ xác nhận';
        
        // Thêm đơn hàng
        $orderID = $this->orderModel->addOrder($carts, $userID, $address, $TongTien, $payMethod, $now, $status);
        
        // Xử lý riêng cho thanh toán chuyển khoản
        if ($payMethod == 'transfer') {
            $_SESSION['pending_order'] = [
                'order_id' => $orderID,
                'amount' => $TongTien,
                'timestamp' => time()
            ];
            
            // Chuyển hướng đến trang xác nhận thanh toán
            header("Location: ?controller=payment&action=showQR&order_id=$orderID");
            exit;
    }
    
    // Xóa giỏ hàng và chuyển hướng
    $this->cartModel->deleteCartByUserID($userID);
    header("Location: ?controller=order&action=show&userID=$userID");
    }

   public function confirmDelivered() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $maDon = $_POST['MaDon'] ?? null;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $now = date('Y-m-d H:i:s');
        if ($maDon) {
            $this->orderModel->updatetime($maDon, $now);
            $this->orderModel->updateStatus($maDon, "đã nhận hàng");
        }
        $userID = $_SESSION['user']['ID'];
        header("Location: index.php?controller=order&action=show&userID=" . $userID);
        exit;
    }
}







}


?>