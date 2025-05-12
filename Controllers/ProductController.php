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
            $this->loadView("partitions/frontend/header.php",[
                "menus" => $this->categoryModel->getAll(),
                'title' => 'chi tiết sản phẩm'
            ]);
        }

        public function show() {
            $id = $_GET['id'];
            // Lấy thông tin sản phẩm
            $product = $this->productModel->findById($id);

            // lấy thông tin chi tiết sản phẩm
            $this->loadModel("ProductDetailModel");
            $this->productDetailModel = new ProductDetailModel();
            $details = $this->productDetailModel->getProductDetail($product);

            $productNameExtension = '';
            // xáo các phần tử rổng trong mảng
            if(!empty($details)) {
                $details = array_filter($details);
                
                $productNameExtension = $details;
                unset($productNameExtension['MaSP']);
                unset($productNameExtension['ThuongHieu']);
                $productNameExtension = implode(" / ",$productNameExtension);
            }

            $categoryId = $product['MaLoai'];

            $ProductsOfTheSameCategory = $this->productModel->getProductsByCategoryId($categoryId, 20, 0, [], 'hiện');

            $bestSellingProducts = $this->productModel->getAll(['*'], ['DaBan DESC'], 15, 'hiện');
            // Lấy tên các thuộc tính của sản phẩm
            $attributes = $this->categoryModel->getFiltersByCategoryId($product['MaLoai']);

            return $this->loadView("frontend/products/show.php",[
                'product' => $product,
                'details' => $details,
                'attributes' => $attributes,
                'productNameExtension' => $productNameExtension,
                'PSC' => $ProductsOfTheSameCategory,
                'BSP' => $bestSellingProducts
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