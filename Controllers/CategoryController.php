<?php 
    class CategoryController extends BaseController {
        private $categoryModel;
        private $productModel;


        public function __construct() {
            $this->loadModel("CategoryModel");
            $this->loadModel("ProductModel");
            $this->categoryModel = new CategoryModel();
            $this->productModel = new ProductModel();

            // load header
            $this->loadView("partitions/fontend/header.php",[
                "menus" => $this->categoryModel->getAll()
            ]);
        }

        public function index() {
            $category = $this->categoryModel->getAll();
            return $this->loadView("fontend/categories/index.php",[
                "title" => "Danh sách danh mục",
                "category" => $category,
            ]);
        }

        public function show() {
            $products = $this->productModel->getProductsByCategory($_GET['id']);
            return $this->loadView("fontend/categories/show.php", [
                "title" => "Chi tiết danh mục",
                "products" => $products,
            ]);
        }
    }
?>