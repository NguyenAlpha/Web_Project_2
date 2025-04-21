<?php
class AdminController extends BaseController {
    protected $conn;
    public function login() {
        if (isset($_POST["username"])) {
            $this->loadModel("AdminModel");
            $adminModel = new AdminModel;
            $admin = $adminModel->checkuser($_POST["username"],$_POST["password"]);
            echo print_r($admin);
            if(empty($admin)) {
                echo "Tên hoặc mật khẩu không chính xác";
            }
            else {
                $_SESSION["admin"] = $admin["username"];
                $_SESSION["password"] = $admin["password"];
                header("Location: index.php?controller=Admin&action=homepageadmin");
            }
        } 
        echo 'đây là trang đăng nhập';
        return $this->loadView('fontend/admin/formadminlogin.php');
    }
    public function homepageadmin() {
        echo 'Đây là trang admin';
        return $this->loadView('fontend/admin/adminhomepage.php');
    }
    public function usersmanage() {
        echo 'Đây là trang quản lý người dùng';
        return $this->loadView('fontend/admin/usersmanage.php');
    }
    public function productsmanage() {
        echo 'Đây là trang quản lý sản phẩm';
        return $this->loadView('fontend/admin/productsmanage.php');
    }
    public function dashboard() {
        echo 'Đây là trang quản lý Dashboard';
        return $this->loadView('fontend/admin/dashboard.php');
    }
    public function logout() {
        session_destroy();
        header('Location: index.php?controller=admin&action=login');
    }
    public function customer() {
        $this->loadModel("AdminModel"); 
        $AdminModel = new AdminModel() ;
        $customers = $AdminModel->customer();
        
        $this->loadView("fontend/Customer/ADMINCUSTOMER.php",
        [
            "customers"=> $customers 
        ]);
    }
    public function CustomerCart()
    {
        $this->loadModel("CartModel");
        $cartModel = new CartModel();
        $this->loadModel("AdminModel");
        $adminModel = new AdminModel;
        
        $this->loadModel("ProductModel");   //load productModel để tạo đối tượng productModel dòng 9
        $productModel = new ProductModel(); //tạo đối tượng productModel

        $carts = $cartModel -> getCartbyUserID($_GET["customerID"]);
        
        foreach($carts as $key => $cart) {
            $product = $productModel->findById($cart["MaSP"]);
            $carts[$key]["productName"] = $product["TenSP"];
            $carts[$key]["productPrice"] = $product["Gia"];
            $carts[$key]["sumPrice"] = $product["Gia"] * $cart["SoLuong"];
        }

        $this ->loadView("fontend/Customer/ViewCart.php", [
            "carts" => $carts,
            "customerName" => $adminModel->getCustomerByID($_GET["customerID"]),
            'allPrice' => array_sum(array_column($carts, 'sumPrice')),
        ]);
    }
}
?>