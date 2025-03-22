<?php 
    class ProductController extends BaseController {
        private $productModel;
        private $categoryModel;
        private $productDetailModel;

        public function __construct() {
            $this->loadModel("ProductModel");   //load productModel để tạo đối tượng productModel dòng 9
            $this->loadModel("CategoryModel");  //load categoryModel để tạo đối tượng categoryModel dòng 10
            $this->productModel = new ProductModel(); //tạo đối tượng productModel
            $this->categoryModel = new CategoryModel(); //tạo đối tượng categoryModel

            // load header
            $this->loadView("partitions/fontend/header.php",[
                "menus" => $this->categoryModel->getAll()
            ]);
        }
        public function index() {
            $products = $this->productModel->getAll(['*'], [],50);

            return $this->loadView("fontend/products/index.php",[
                "products" => $products
            ]);
        }

        public function show() {
            $id = $_GET['id'];
            // Lấy thông tin sản phẩm
            $product = $this->productModel->findById($id);

            // lấy thông tin chi tiết sản phẩm
            $this->loadModel("ProductDetailModel");
            $this->productDetailModel = new ProductDetailModel();
            $detail = $this->productDetailModel->getProductDetail($product);

            return $this->loadView("fontend/products/show.php",[
                'product' => $product,
                "detail" => $detail
            ]);
        }

        public function store() {
            $this->productModel->add([
                "TenSP" => "Card màn hình MSI GeForce RTX 5090 32G GAMING TRIO OC",
                "LoaiSP" => "GPU",
                "Gia" => 97990000,
                "SoLuong" => 2,
            ]);
        }

        public function update() {
            $this->productModel->updateProduct([
                "TenSP" => "Card màn hình MSI GeForce RTX 5090 32G GAMING TRIO OC",
                "LoaiSP" => "GPU",
                "Gia" => 97990000,
                "SoLuong" => 2,
            ], 6);
        }

        public function delete() {
            $this->productModel->deleteProduct(6);
        }
    }
?>