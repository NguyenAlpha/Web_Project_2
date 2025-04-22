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

        // Hiển thị danh mục cụ thể và sản phẩm của danh mục đó
        public function show() {
            $categoryId = $_GET['id'];
            $page = $_GET['page'] ?? 1;
            $limit = 40;
            $offset = ($page - 1) * $limit;

            // Lấy thông tin filter của danh mục theo mã danh mục
            $attributes = $this->categoryModel->getFiltersByCategoryId($categoryId);
            
            if(isset($_POST['submit']) && $_POST['submit'] == 'filter') {
                
                $products = $this->productDetailModel->
                getProductByCategoryFilters($categoryId, $attributes, $_POST, $limit, $offset);

                $totalProducts = $this->productDetailModel->
                getCountProductWithFilters($categoryId, $attributes, $_POST);
            } else {
                $products = $this->productModel->
                getProductsByCategoryId($categoryId, $limit, $offset);

                $totalProducts = $this->productModel->
                getProductCountByCategory($categoryId);
            }

            $filters = $this->productDetailModel->getCategoryFilters($attributes, $categoryId);
            $totalPages = ceil($totalProducts / $limit);

            return $this->loadView('fontend/categories/show.php', [
                'products' => $products,
                'filters' => $filters,
                'attributes' => $attributes,
                'selectedAttribute' => $_POST,
                'totalPages' => $totalPages,
                'currentPage' => $page
            ]);
        }

        public function filter() {
            
        }
    }
?>