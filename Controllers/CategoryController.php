<?php 
    class CategoryController extends BaseController {
        private $categoryModel;

        private $productModel;
        
        private $productDetailModel;

        public function __construct() {
            $this->loadModel("CategoryModel");
            $this->loadModel("ProductModel");
            $this->loadModel("productDetailModel");
            $this->categoryModel = new CategoryModel();
            $this->productModel = new ProductModel();
            $this->productDetailModel = new productDetailModel();

            // load header
            $this->loadView("partitions/fontend/header.php",[
                "menus" => $this->categoryModel->getAll()
            ]);
        }
        
        // Hiển thị danh sách danh mục
        public function index() {
            $category = $this->categoryModel->getAll();
            return $this->loadView("fontend/categories/index.php",[
                "title" => "Danh sách danh mục",
                "category" => $category,
            ]);
        }

        // Hiển thị danh mục cụ thể và sản phẩm của danh mục đó
        public function show() {
            $categoryId = $_GET['id'];
            $products = $this->productModel->getProductsByCategoryId($categoryId);

            // Lấy thông tin filter của danh mục theo mã danh mục
            $filters = $this->categoryModel->getFiltersByCategoryId($categoryId);

            $filters = $this->productDetailModel->getCategoryFilters($filters, $categoryId);
            return $this->loadView("fontend/categories/show.php", [
                "title" => "Chi tiết danh mục",
                "products" => $products,
                "filters" => $filters
            ]);
        }
    }
?>