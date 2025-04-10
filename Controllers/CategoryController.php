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
            // Lấy thông tin filter của danh mục theo mã danh mục
            $attributes = $this->categoryModel->getFiltersByCategoryId($categoryId);
            

            if(isset($_POST['submit']) && $_POST['submit'] == 'filter') {
                // echo '<pre>';
                // echo print_r($_POST);
                // echo '</pre>';
                $products = $this->productDetailModel->getProductByCategoryFilters($categoryId, $attributes, $_POST);
            } else {
                $products = $this->productModel->getProductsByCategoryId($categoryId);
            }


            $filters = $this->productDetailModel->getCategoryFilters($attributes, $categoryId);
            return $this->loadView("fontend/categories/show.php", [
                "products" => $products,
                "filters" => $filters,
                "attributes" => $attributes,
                "selectedAttribute" => $_POST
            ]);
        }

        public function filter() {
            
        }
    }
?>