<?php
class AdminController extends BaseController {
    protected $conn;
    public function login() {
        if (isset($_POST["admin"])) {
            header("Location: ./index.php");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->loadModel("AdminModel");
            $adminModel = new AdminModel;
            $admin = $adminModel->checkuser($_POST["username"],$_POST["password"]);
            if(empty($admin)) {
                echo "Tên hoặc mật khẩu không chính xác";
            }
            else {
                $_SESSION["admin"] = $admin;
                header("Location: ./index.php");
            }
        } 
        return $this->loadView('partitions/frontend/formadminlogin.php');
    }
    public function usersmanage() {
        echo 'Đây là trang quản lý người dùng';
        return $this->loadView('frontend/admin/usersmanage.php');
    }
    public function productsmanage() {
        return $this->loadView('frontend/product/productsmanage.php');
    }
    public function addProductPage() {
        return $this->loadView('frontend/product/addProduct.php');
    }
    public function dashboard() {
        echo 'Đây là trang quản lý Dashboard';
        return $this->loadView('frontend/admin/dashboard.php');
    }
    public function logout() {
        session_destroy();
        header('Location: ./index.php');
        exit;
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
public function getTableFields()
{
    if (!isset($_GET['type']) || empty($_GET['type'])) {
        echo json_encode([]);
        return;
    }

    $MaLoai = $_GET['type'];
    $tableName = strtolower($MaLoai) . 'details';

    $conn = new mysqli("localhost", "root", "", "tmdt");
    if ($conn->connect_error) {
        echo json_encode([]);
        return;
    }

    // Kiểm tra bảng tồn tại
    $check = $conn->query("SHOW TABLES LIKE '$tableName'");
    if (!$check || $check->num_rows == 0) {
        echo json_encode([]);
        return;
    }

    $columns = [];
    $result = $conn->query("SHOW COLUMNS FROM `$tableName`");

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $fieldName = $row['Field'];
            if ($fieldName !== 'MaSP') { // Bỏ khóa ngoại
                $columns[] = $fieldName;
            }
        }
    }

    header('Content-Type: application/json');
    echo json_encode($columns);
}

public function addProduct() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $conn = new mysqli("localhost", "root", "", "tmdt");
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }

        // XỬ LÝ UPLOAD ẢNH
        $target_dir = "/assets/uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true); // tạo folder nếu chưa có
        }

        $filename = basename($_FILES["AnhMoTaSP"]["name"]);
        $newFileName = time() . "_" . $filename;
        $target_file = $target_dir . $newFileName;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["AnhMoTaSP"]["tmp_name"]);
        if ($check === false) {
            die("File không phải là ảnh.");
        }

        $allowed = ['jpg', 'jpeg', 'png'];
        if (!in_array($imageFileType, $allowed)) {
            die("Chỉ cho phép định dạng JPG, JPEG, PNG.");
        }

        if (!move_uploaded_file($_FILES["AnhMoTaSP"]["tmp_name"], $target_file)) {
            die("Lỗi khi upload ảnh.");
        }

        // INSERT VÀO BẢNG `products` VỚI LINK ẢNH ĐÃ XỬ LÝ
        $AnhMoTaSP = $target_file;
        $stmt = $conn->prepare("INSERT INTO products (TenSP, AnhMoTaSP, SoLuong, Gia, MaLoai) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiis", $_POST['TenSP'], $AnhMoTaSP, $_POST['SoLuong'], $_POST['Gia'], $_POST['MaLoai']);    

        $stmt->execute();
        $MaSP = $stmt->insert_id;
        $stmt->close();
        switch ($_POST['MaLoai']) {
            case "Laptop":
                $stmt = $conn->prepare("INSERT INTO laptopdetails (MaSP, ThuongHieu, CPU, GPU, RAM, DungLuong, KichThuocManHinh, DoPhanGiai) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("isssssss", $MaSP, $_POST['ThuongHieu'], $_POST['CPU'], $_POST['GPU'], $_POST['RAM'], $_POST['DungLuong'], $_POST['KichThuocManHinh'], $_POST['DoPhanGiai']);
                break;
            case "Laptop Gaming":
                $stmt = $conn->prepare("INSERT INTO laptopgamingdetails (MaSP, ThuongHieu, CPU, GPU, RAM, DungLuong, KichThuocManHinh, DoPhanGiai) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("isssssss", $MaSP, $_POST['ThuongHieu'], $_POST['CPU'], $_POST['GPU'], $_POST['RAM'], $_POST['DungLuong'], $_POST['KichThuocManHinh'], $_POST['DoPhanGiai']);
                break;
            case "GPU":
                $stmt = $conn->prepare("INSERT INTO gpudetails (MaSP, ThuongHieu, GPU, CUDA, TocDoBoNho, BoNho, Nguon) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("issssss", $MaSP, $_POST['ThuongHieu'], $_POST['GPU'], $_POST['CUDA'], $_POST['TocDoBoNho'], $_POST['BoNho'], $_POST['Nguon']);
                break;
            case "ManHinh":
                $stmt = $conn->prepare("INSERT INTO manhinhdetails (MaSP, ThuongHieu, KichThuocManHinh, TangSoQuet, TiLe, TamNen, DoPhanGiai, KhoiLuong) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("isssssss", $MaSP, $_POST['ThuongHieu'], $_POST['KichThuocManHinh'], $_POST['TangSoQuet'], $_POST['TiLe'], $_POST['TamNen'], $_POST['DoPhanGiai'], $_POST['KhoiLuong']);
                break;
        }

        if ($stmt && $stmt->execute()) {
            echo "<script>alert('Thêm sản phẩm thành công!'); window.location.href='index.php?controller=admin&action=productsmanage';</script>";
        } else {
            echo "Lỗi khi thêm chi tiết sản phẩm: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        include('./Views/Frontend/Admin/addProduct.php');
    }
}

public function editProduct() {
    if (!isset($_GET['MaSP'])) {
        echo "Thiếu mã sản phẩm.";
        return;
    }

    return $this->loadView('frontend/admin/editProduct.php');
}

public function deleteProduct() {
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['MaSP'])) {
        $MaSP = intval($_GET['MaSP']);

        $conn = new mysqli("localhost", "root", "", "tmdt");
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }

        // Lấy loại sản phẩm để biết cần xóa chi tiết ở bảng nào
        $stmt = $conn->prepare("SELECT MaLoai FROM products WHERE MaSP = ?");
        $stmt->bind_param("i", $MaSP);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            die("Sản phẩm không tồn tại.");
        }

        $row = $result->fetch_assoc();
        $MaLoai = $row['MaLoai'];
        $stmt->close();

        // Xóa chi tiết sản phẩm dựa vào loại
        switch ($MaLoai) {
            case "Laptop":
                $conn->query("DELETE FROM laptopdetails WHERE MaSP = $MaSP");
                break;
            case "LaptopGaming":
                $conn->query("DELETE FROM laptopgamingdetails WHERE MaSP = $MaSP");
                break;
            case "GPU":
                $conn->query("DELETE FROM gpudetails WHERE MaSP = $MaSP");
                break;
            case "Manhinh":
                $conn->query("DELETE FROM manhinhdetails WHERE MaSP = $MaSP");
                break;
        }

        // Xóa ảnh mô tả (nếu cần)
        $stmt = $conn->prepare("SELECT AnhMoTaSP FROM products WHERE MaSP = ?");
        $stmt->bind_param("i", $MaSP);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $anh = $row['AnhMoTaSP'];
            if (file_exists($anh)) {
                unlink($anh); // xóa file ảnh
            }
        }
        $stmt->close();

        // Xóa sản phẩm chính
        $stmt = $conn->prepare("DELETE FROM products WHERE MaSP = ?");
        $stmt->bind_param("i", $MaSP);
        if ($stmt->execute()) {
            echo "<script>
            alert('Xóa sản phẩm thành công!');
            window.location.href='index.php?controller=admin&action=productsmanage&deleted=true';
            </script>";

        } else {
            echo "Lỗi khi xóa sản phẩm: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Yêu cầu không hợp lệ.";
    }
}
public function hideproduct() {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        // Gọi model để ẩn sản phẩm
        require_once 'Models/ProductModel.php';
        $productModel = new ProductModel();
        $productModel->hideProductById($id);
    }
    // Quay lại trang quản lý sản phẩm
    header('Location: ?controller=admin&action=productsmanage');
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
    .Cartnull
    {
        text-align: center;       /* Căn giữa ngang */
        font-weight: bold;        /* In đậm */
        padding: 20px;            /* Thêm khoảng cách bên trong cho đẹp */
        font-size: 20px;          /* Cỡ chữ vừa phải */
        color: #333;              /* Màu chữ đậm hơn một chút */
    }
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
                <img src="' . '.' ($item['productPicture']) . '" alt="Ảnh mô tả sản phẩm" style="width:100px;">
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