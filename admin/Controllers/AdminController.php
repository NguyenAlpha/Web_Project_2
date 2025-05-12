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
    public function adminInfo() {
        return $this->loadView('partitions/frontend/adminInfo.php');
    }
    public function usersmanage() {
        return $this->loadView('frontend/admin/usersmanage.php');
    }
    public function productsmanage() {
        return $this->loadView('frontend/product/productsmanage.php');
    }
    public function addProductPage() {
        return $this->loadView('frontend/product/addProduct.php');
    }
    public function dashboard() {
        return $this->loadView('frontend/dashboard/index.php');
    }
    public function logout() {
        unset($_SESSION['admin']);
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
    public function CustomerID(){
        $this->loadModel("AdminModel");
        $adminModel = new AdminModel();
        $customers = $adminModel->getCustomerByID($_GET["id"]);
        
        // Truyền dữ liệu sang view
        $this->loadView ("frontend/Customer/ViewCustomer.php", [
            "customers" => $customers
            
        ]);;
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
                'sex' => $_POST['sex'],
                'phonenumber' => $_POST['phonenumber'],
                'date_of_birth' => $_POST['dob']
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
            $email = $_POST['email'] ?? '';
            $gender = $_POST['gender'] ?? '';
            $sex = $_POST['sex'] ?? '';
            $phonenumber = $_POST['phonenumber'] ?? '';
            $date_of_birth = $_POST['dob']?? '';
    
            $success = $adminModel->addCustomer($username, $password, $email,$sex, $phonenumber, $date_of_birth);
    
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
    public function changeCustomerStatus(){
        $this->loadModel("AdminModel");
        $adminModel = new AdminModel();
        
        $id = $_GET['id'];
        $result = $adminModel->changeCustomerStatus($id);
        if ($result) {
            header("Location: index.php?controller=admin&action=CustomerID&id=$id");
        } else {
            header("Location: customer_list.php?error=Có lỗi xảy ra");
        }
        exit();
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
    // echo '<pre>';
    // print_r($_FILES["AnhMoTaSP"]);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $conn = new mysqli("localhost", "root", "", "tmdt");
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }

        // XỬ LÝ UPLOAD ẢNH
        $target_dir = "./assets/image/";

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

        if (!move_uploaded_file($_FILES["AnhMoTaSP"]["tmp_name"], __DIR__. '/../../assets/image/'. $newFileName)) {
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
    if (!isset($_SESSION['admin'])) {
        header("Location: index.php?controller=admin&action=login");
        exit;
    }

    $MaSP = (int)($_GET['MaSP'] ?? 0);
    if ($MaSP <= 0) {
        $_SESSION['error'] = "Mã sản phẩm không hợp lệ";
        header("Location: index.php?controller=admin&action=productsmanage");
        exit;
    }

    // Kết nối database
    $conn = new mysqli("localhost", "root", "", "tmdt");
    if ($conn->connect_error) die("Kết nối thất bại: " . $conn->connect_error);

    // Lấy thông tin sản phẩm chính
    $product = $conn->query("SELECT * FROM products WHERE MaSP = $MaSP")->fetch_assoc();
    if (!$product) {
        $_SESSION['error'] = "Không tìm thấy sản phẩm";
        header("Location: index.php?controller=admin&action=productsmanage");
        exit;
    }

    // Lấy thông tin chi tiết
    $detailTable = strtolower($product['MaLoai']) . 'details';
    $details = $conn->query("SELECT * FROM $detailTable WHERE MaSP = $MaSP")->fetch_assoc();

    // Lấy danh sách trường chi tiết động
    $detailFields = [];
    $res = $conn->query("SHOW COLUMNS FROM $detailTable");
    while ($row = $res->fetch_assoc()) {
        if ($row['Field'] != 'MaSP') {
            $detailFields[] = $row['Field'];
        }
    }

    // Lấy danh sách danh mục
    $categories = $conn->query("SELECT * FROM categories")->fetch_all(MYSQLI_ASSOC);

    require_once "Views/frontend/product/editProduct.php";
    $conn->close();
}

public function updateProduct() {
    if (!isset($_SESSION['admin'])) {
        header("Location: index.php?controller=admin&action=login");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $_SESSION['error'] = "Phương thức không hợp lệ";
        header("Location: index.php?controller=admin&action=productsmanage");
        exit;
    }

    $MaSP = (int)$_POST['MaSP'];
    $conn = new mysqli("localhost", "root", "", "tmdt");
    if ($conn->connect_error) die("Kết nối thất bại: " . $conn->connect_error);

    // Xử lý upload ảnh
    $imagePath = $_POST['current_image'] ?? '';
    if (isset($_FILES['AnhMoTaSP']) && $_FILES['AnhMoTaSP']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "assets/image/";
        $newFileName = uniqid() . '_' . basename($_FILES['AnhMoTaSP']['name']);
        if (move_uploaded_file($_FILES['AnhMoTaSP']['tmp_name'], $targetDir . $newFileName)) {
            $imagePath = $targetDir . $newFileName;
            if (!empty($_POST['current_image']) && file_exists($_POST['current_image'])) {
                unlink($_POST['current_image']);
            }
        }
    }

    // Bắt đầu transaction
    $conn->begin_transaction();

    try {
        // 1. Cập nhật thông tin cơ bản
        $stmt = $conn->prepare("UPDATE products SET TenSP=?, MaLoai=?, AnhMoTaSP=?, SoLuong=?, Gia=?, TrangThai=? WHERE MaSP=?");
        $stmt->bind_param("sssiisi", $_POST['TenSP'], $_POST['MaLoai'], $imagePath, $_POST['SoLuong'], $_POST['Gia'], $_POST['TrangThai'], $MaSP);
        $stmt->execute();

        // 2. Cập nhật thông tin chi tiết
        $detailTable = strtolower($_POST['MaLoai']) . 'details';
        
        // Lấy danh sách trường chi tiết
        $detailFields = [];
        $res = $conn->query("SHOW COLUMNS FROM $detailTable");
        while ($row = $res->fetch_assoc()) {
            if ($row['Field'] != 'MaSP') $detailFields[] = $row['Field'];
        }

        // Xóa chi tiết cũ và thêm mới
        $conn->query("DELETE FROM $detailTable WHERE MaSP = $MaSP");
        
        $fields = ['MaSP'];
        $values = [$MaSP];
        $types = 'i'; // MaSP là integer
        
        foreach ($detailFields as $field) {
            if (isset($_POST[$field])) {
                $fields[] = $field;
                $values[] = $_POST[$field];
                $types .= 's'; // Các trường khác là string
            }
        }
        
        $fieldsStr = implode(', ', $fields);
        $placeholders = implode(', ', array_fill(0, count($fields), '?'));
        
        $stmt = $conn->prepare("INSERT INTO $detailTable ($fieldsStr) VALUES ($placeholders)");
        $stmt->bind_param($types, ...$values);
        $stmt->execute();

        $conn->commit();
        $_SESSION['success'] = "Cập nhật sản phẩm thành công";
    } catch (Exception $e) {
        $conn->rollback();
        $_SESSION['error'] = "Lỗi khi cập nhật: " . $e->getMessage();
    }

    $conn->close();
    header("Location: index.php?controller=admin&action=productsmanage");
    exit;
}
public function getSpecFields() {
    if (!isset($_GET['category']) || !isset($_GET['MaSP'])) {
        die("Thiếu tham số");
    }

    $category = $_GET['category'];
    $MaSP = (int)$_GET['MaSP'];
    $conn = new mysqli("localhost", "root", "", "tmdt");
    
    if ($conn->connect_error) die("Kết nối thất bại");

    // Lấy các trường của bảng chi tiết
    $table = strtolower($category) . 'details';
    $fields = [];
    $res = $conn->query("SHOW COLUMNS FROM $table");
    while ($row = $res->fetch_assoc()) {
        if ($row['Field'] != 'MaSP') $fields[] = $row['Field'];
    }

    // Lấy giá trị hiện tại nếu có
    $details = [];
    if ($MaSP > 0) {
        $details = $conn->query("SELECT * FROM $table WHERE MaSP = $MaSP")->fetch_assoc();
    }

    // Render các trường input
    foreach ($fields as $field) {
        echo '<div class="mb-3">';
        echo '<label class="form-label">'.ucfirst(str_replace('_', ' ', $field)).'</label>';
        echo '<input type="text" name="'.$field.'" class="form-control" ';
        echo 'value="'.htmlspecialchars($details[$field] ?? '').'">';
        echo '</div>';
    }

    $conn->close();
    exit;
}

public function deleteProduct() {
    if (!isset($_SESSION['admin'])) {
        header("Location: index.php?controller=admin&action=login");
        exit;
    }

    $MaSP = intval($_GET['MaSP'] ?? 0);
    
    // Nếu chưa confirm, hiển thị trang xác nhận
    if (!isset($_GET['confirm']) || $_GET['confirm'] !== 'true') {
        $this->loadModel("ProductModel");
        $productModel = new ProductModel();
        $product = $productModel->findById($MaSP);
        
        if (!$product) {
            $_SESSION['error'] = "Sản phẩm không tồn tại";
            header("Location: index.php?controller=admin&action=productsmanage");
            exit;
        }
        
        return $this->loadView('frontend/product/confirmDeleteProduct.php', [
            'product' => $product
        ]);
    }
    
    // Nếu đã confirm, thực hiện xóa
    $this->loadModel("ProductModel");
    $this->loadModel("CartModel");
    
    $productModel = new ProductModel();
    $cartModel = new CartModel();
    
    try {
        // 1. Xóa các mục trong giỏ hàng liên quan
        $cartModel->deleteByProductId($MaSP);
        
        // 2. Xóa sản phẩm (hàm này đã được cập nhật để xóa cả bảng chi tiết)
        if ($productModel->deleteProduct($MaSP)) {
            $_SESSION['success'] = "Đã xóa sản phẩm thành công";
        } else {
            $_SESSION['error'] = "Không thể xóa sản phẩm";
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "Lỗi khi xóa sản phẩm: " . $e->getMessage();
    }
    
    header("Location: index.php?controller=admin&action=productsmanage");
    exit;
}
public function showProduct() {
    // Kiểm tra quyền admin
    if (!isset($_SESSION['admin'])) {
        header("Location: index.php?controller=admin&action=login");
        exit;
    }

    // Kiểm tra tham số
    if (!isset($_GET['MaSP'])) {
        $_SESSION['error'] = "Thiếu thông tin sản phẩm";
        header("Location: index.php?controller=admin&action=productsmanage");
        exit;
    }

    $MaSP = intval($_GET['MaSP']);
    $this->loadModel("ProductModel");
    $productModel = new ProductModel();

    // Cập nhật trạng thái sản phẩm thành 'hiện'
    if ($productModel->updateProductStatus($MaSP, 'hiện')) {
        $_SESSION['success'] = "Đã hiển thị lại sản phẩm thành công";
    } else {
        $_SESSION['error'] = "Có lỗi khi hiển thị sản phẩm";
    }

    header("Location: index.php?controller=admin&action=productsmanage");
    exit;
}
public function hideProduct() {
    // Kiểm tra quyền admin
    if (!isset($_SESSION['admin'])) {
        header("Location: index.php?controller=admin&action=login");
        exit;
    }

    // Kiểm tra tham số
    if (!isset($_GET['MaSP'])) {
        $_SESSION['error'] = "Thiếu thông tin sản phẩm";
        header("Location: index.php?controller=admin&action=productsmanage");
        exit;
    }

    $MaSP = intval($_GET['MaSP']);
    $this->loadModel("ProductModel");
    $productModel = new ProductModel();

    // Cập nhật trạng thái sản phẩm thành 'ẩn'
    if ($productModel->updateProductStatus($MaSP, 'ẩn')) {
        $_SESSION['success'] = "Đã ẩn sản phẩm thành công";
    } else {
        $_SESSION['error'] = "Có lỗi khi ẩn sản phẩm";
    }

    header("Location: index.php?controller=admin&action=productsmanage");
    exit;
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
public function manageorderlist() {
    $this->loadModel('OrderModel');
    $orderModel = new OrderModel();
    $orders = $orderModel->getAllOrders(); // chắc chắn hàm này tồn tại

    include './Views/frontend/orderlist/orderlist.php'; 

}


public function updateOrderStatus() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $maDon = $_POST['MaDon'] ?? null;
        $trangThai = $_POST['TrangThai'] ?? null;

        if ($maDon && $trangThai) {
            // Gọi model để cập nhật
            require_once "./Models/OrderModel.php";
            $orderModel = new OrderModel();

            $success = $orderModel->updateorderStatus($maDon, $trangThai);

            if ($success) {
                header("Location: index.php?controller=admin&action=manageorderlist");
            } else {
                echo "Cập nhật thất bại.";
            }
        } else {
            echo "Thiếu thông tin đơn hàng hoặc trạng thái.";
        }
    } else {
        echo "Phương thức không hợp lệ.";
    }
}
public function orderlist() {
    // Lấy các tham số lọc
    $status = $_GET['status'] ?? '';
    $fromDate = $_GET['from_date'] ?? '';
    $toDate = $_GET['to_date'] ?? '';
    $district = $_GET['district'] ?? '';
    $city = $_GET['city'] ?? '';
    
    $this->loadModel('OrderModel');
    $orderModel = new OrderModel();
    
    // Lấy danh sách đơn hàng với bộ lọc
    $orders = $orderModel->FilteredOrders([
        'status' => $status,
        'from_date' => $fromDate,
        'to_date' => $toDate,
        'district' => $district,
        'city' => $city
    ]);
    
    // Lấy danh sách thành phố và quận/huyện cho dropdown
    $cities = $orderModel->getAllCities();
    $districts = $district ? $orderModel->getDistrictsByCity($city) : [];
    
    // Load view
    $this->loadView('frontend/order/orderlist.php', [
        'orders' => $orders,
        'cities' => $cities,
        'districts' => $districts,
        'status' => $status,
        'from_date' => $fromDate,
        'to_date' => $toDate,
        'district' => $district,
        'city' => $city
    ]);
}


}
?>