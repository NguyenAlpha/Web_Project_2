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
        return $this->loadView('frontend/admin/formadminlogin.php');
    }
    public function homepageadmin() {
        echo 'Đây là trang admin';
        return $this->loadView('frontend/admin/adminhomepage.php');
    }
    public function usersmanage() {
        echo 'Đây là trang quản lý người dùng';
        return $this->loadView('frontend/admin/usersmanage.php');
    }
    public function productsmanage() {
        echo 'Đây là trang quản lý sản phẩm';
        return $this->loadView('frontend/admin/productsmanage.php');
    }
    public function dashboard() {
        echo 'Đây là trang quản lý Dashboard';
        return $this->loadView('frontend/admin/dashboard.php');
    }
    public function logout() {
        session_destroy();
        header('Location: index.php?controller=admin&action=login');
    }
    public function customer() {
        $this->loadModel("AdminModel"); 
        $AdminModel = new AdminModel() ;
        $customers = $AdminModel->customer();
        
        $this->loadView("frontend/Customer/ADMINCUSTOMER.php",
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
            $product = $productModel->findById($cart["maSP"]);
            $carts[$key]["productName"] = $product["TenSP"];
            $carts[$key]["productPrice"] = $product["Gia"];
            $carts[$key]["sumPrice"] = $product["Gia"] * $cart["SoLuong"];
        }

        $this ->loadView("frontend/Customer/ViewCart.php", [
            "carts" => $carts,
            "customerName" => $adminModel->getCustomerByID($_GET["customerID"]),
            'allPrice' => array_sum(array_column($carts, 'sumPrice')),
        ]);
    }
    public function editCustomer() {
        $this->loadModel("AdminModel");
        $adminModel = new AdminModel();
        $customers = $adminModel -> customer();
        $id = $_GET['id'];
        $customer = $adminModel->getCustomerByID($id);
    
        $this->loadView("frontend/Customer/EditCustomer.php", [
            "customer" => $customer
        ]);
    }
    public function updateCustomer() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->loadModel("AdminModel");
            $adminModel = new AdminModel;
            $customers = $adminModel -> customer();
            $key = [
                'id' => $_POST['id'],
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'email' => $_POST['email'],
                'address' => $_POST['address']
            ];
    
            $adminModel->updateCustomer($key);
        }
    
        header("Location: index.php?controller=admin&action=customer");
        
    }
}
?>