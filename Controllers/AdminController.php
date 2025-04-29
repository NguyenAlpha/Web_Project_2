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
        $adminModel = new AdminModel();
        
        $this->loadModel("ProductModel");   //load productModel để tạo đối tượng productModel dòng 9
        $productModel = new ProductModel(); //tạo đối tượng productModel

        $carts = $cartModel -> getCartbyUserID($_GET["customerID"]);
        
        foreach($carts as $key => $cart) {
            $product = $productModel->findById($cart["MaSP"]);
            $carts[$key]["productPicture"]  = $product["AnhMoTaSP"];
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
                'ID' => $_POST['id'],
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'email' => $_POST['email'],
            ];
    
            $adminModel->updateCustomer($key);
        }
    
        header("Location: index.php?controller=admin&action=customer");
        
    }
    public function addCustomer()
    {
        $this->loadModel("AdminModel");
        $adminModel = new AdminModel();
        $customers = $adminModel->customer();
    
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $gender = $_POST['gender'] ?? '';
            $email = $_POST['email'] ?? '';
            $address = $_POST['address'] ?? '';
    
            $success = $adminModel->addCustomer($username, $password, $gender, $email, $address);
    
            if ($success) {
                // Có thể load lại danh sách luôn:
                $customers = $adminModel->customer();
                require_once "Views/frontend/Customer/addCustomer.php";
            } else {
                echo "Lỗi khi thêm khách hàng!";
            }
            return;
        }
    
     return require_once "Views/frontend/Customer/addCustomer.php";
    }
public function deleteCustomer()
{
    $this->loadModel('AdminModel');
    $adminModel = new AdminModel();
    $this->loadModel('CartModel');
    $CartModel = new CartModel();
    if (isset($_GET['ID'])) {
        $id = $_GET['ID'];
        $adminModel->deleteCustomer($id);

        // Sau khi xóa có thể redirect về danh sách khách hàng
        header("Location: index.php?controller=admin&action=customer");
        exit;
    } else {
        echo "Không tìm thấy ID khách hàng để xóa.";
    }
}

public function CustomerCartAjax()
{     
    $this->loadModel("AdminModel");
    $AdminModel = new AdminModel();
    
    $this->loadModel("CartModel");
    $cartModel = new CartModel();

    $this->loadModel("ProductModel");
    $productModel = new ProductModel();

    $customerID = $_GET["customerID"] ?? 0;
    
    // Lấy danh sách giỏ hàng
    $carts = $cartModel->getCartbyUserID($customerID);

    // Gắn thêm thông tin sản phẩm vào từng món trong giỏ
    foreach ($carts as $key => $cart) {
        $product = $productModel->findById($cart["MaSP"]);
        $carts[$key]["productPicture"] = $product["AnhMoTaSP"] ?? '';
        $carts[$key]["productName"] = $product["TenSP"] ?? '';
        $carts[$key]["productPrice"] = $product["Gia"] ?? 0;
        $carts[$key]["sumPrice"] = $carts[$key]["productPrice"] * $cart["SoLuong"];
    }

    // Nếu giỏ hàng trống
    if (empty($carts)) {
        echo "<p>Giỏ hàng trống.</p>";
        exit;
    }

    // In ra HTML dạng bảng
    echo "<style>
    table.cart-table {
        width: 100%;
        border-collapse: collapse;
    }
    table.cart-table th {
        background-color: #00268c;
        color: white;
        padding: 8px;
    }
    table.cart-table td {
        text-align: center;
        padding: 8px;
        border-bottom: 1px solid #ddd;
    }
    .cart-item {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    .cart-item img {
        width: 50px;
        height: auto;
    }
    .cart-total td {
        font-weight: bold;
        text-align: right;
        padding: 10px;
    }
    .motaSP {
    display: flex;
    align-items: center;
    gap: 10px; /* Khoảng cách giữa ảnh và tên sản phẩm */
}

.motaSP img {
     width: 20px;
    height: auto;
    border-radius: 8px;
    object-fit: cover;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
    transition: transform 0.3s ease, box-shadow 0.3s ease;

}
.motaSP img:hover {
    transform: scale(1.05); 
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3); 
}

.motaSP a {
    color: black;
    text-decoration: none;
    font-weight: 500;
    font-size: 16px;
}

.motaSP a:hover {
    text-decoration: none;
    color: black;
}

</style>";

// In ra HTML
echo "<table class='cart-table'>";
echo "<tr>
        <th>Sản phẩm</th><th>Giá</th><th>Số lượng</th><th>Thành tiền</th>
      </tr>";

foreach ($carts as $item) {
    echo '<tr>';
    echo '<td> <div class="motaSP">
            <div><a href="index.php?controller=product&action=show&id=' . $item['MaSP'] . '" target="_blank">
                <img src="' . htmlspecialchars($item['productPicture']) . '" alt="Ảnh mô tả sản phẩm" style="width:100px;">
            </a></div>
            <div><a href="index.php?controller=product&action=show&id=' . $item['MaSP'] . '" target="_blank">
                ' . htmlspecialchars($item['productName']) . '
            </a></div>
            </div>
          </td>';
    echo '<td>' . number_format($item['productPrice'], 0, ',', '.') . ' đ</td>';
    echo '<td>' . $item['SoLuong'] . '</td>';
    echo '<td>' . number_format($item['sumPrice'], 0, ',', '.') . ' đ</td>';
    echo '</tr>';
    
}

// Tính tổng tiền
$tongTien = array_sum(array_column($carts, 'sumPrice'));

echo "<tr class='cart-total'>
        <td colspan='4'>Tổng tiền: " . number_format($tongTien, 0, ',', '.') . " đ</td>
      </tr>";
}

}

?>