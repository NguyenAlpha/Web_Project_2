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
        $this->cartModel->deleteCartByUserID($userID);
        $this->orderModel->addOrder($carts,$userID, $address, $TongTien, $pay);
        header("Location: ./index.php");
    }
}
?>

<!-- Array
(
    [0] => Array
        (
            [MaDon] => 2
            [UserID] => 2
            [DiaChi] => 229 cao thăng, p13, q4, hcm
            [NgayDat] => 2025-05-10 11:49:45
            [TongTien] => 32070000
            [TrangThai] => hiện
            [ThanhToan] => chuyển khoản
            [MaSP] => 9
            [SoLuong] => 30
            [TenSP] => Card màn hình ASUS Dual GeForce RTX™ 3060 V2 12GB GDDR6
            [MaLoai] => GPU
            [AnhMoTaSP] => ./assets/image/imagertx3060V2_12GB.png
            [DaBan] => 13
            [Gia] => 7790000
            [SoLuongOrder] => 2
        )

    [1] => Array
        (
            [MaDon] => 2
            [UserID] => 2
            [DiaChi] => 229 cao thăng, p13, q4, hcm
            [NgayDat] => 
            [TongTien] => 94860000
            [TrangThai] => hiện
            [ThanhToan] => tiền mặt
            [MaSP] => 9
            [SoLuong] => 30
            [TenSP] => Card màn hình ASUS Dual GeForce RTX™ 3060 V2 12GB GDDR6
            [MaLoai] => GPU
            [AnhMoTaSP] => ./assets/image/imagertx3060V2_12GB.png
            [DaBan] => 13
            [Gia] => 7790000
            [SoLuongOrder] => 2
        )

    [2] => Array
        (
            [MaDon] => 2
            [UserID] => 2
            [DiaChi] => 229 cao thăng, p13, q4, hcm
            [NgayDat] => 2025-05-10 11:49:45
            [TongTien] => 32070000
            [TrangThai] => hiện
            [ThanhToan] => chuyển khoản
            [MaSP] => 8
            [SoLuong] => 100
            [TenSP] => Màn Hình Gaming GIGABYTE GS27F
            [MaLoai] => ManHinh
            [AnhMoTaSP] => ./assets/image/man_hinh_gaming_gigabyte_gs27f__5_.jpg
            [DaBan] => 1
            [Gia] => 3298000
            [SoLuongOrder] => 5
        )

    [3] => Array
        (
            [MaDon] => 2
            [UserID] => 2
            [DiaChi] => 229 cao thăng, p13, q4, hcm
            [NgayDat] => 
            [TongTien] => 94860000
            [TrangThai] => hiện
            [ThanhToan] => tiền mặt
            [MaSP] => 8
            [SoLuong] => 100
            [TenSP] => Màn Hình Gaming GIGABYTE GS27F
            [MaLoai] => ManHinh
            [AnhMoTaSP] => ./assets/image/man_hinh_gaming_gigabyte_gs27f__5_.jpg
            [DaBan] => 1
            [Gia] => 3298000
            [SoLuongOrder] => 5
        ) -->
