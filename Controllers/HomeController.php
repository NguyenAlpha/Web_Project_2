<?php 
    class HomeController extends BaseController {
        private $productModel;
        private $categoryModel;

        public function __construct() {
            $this->loadModel("ProductModel");   //load productModel để tạo đối tượng productModel dòng 9
            $this->loadModel("CategoryModel");  //load categoryModel để tạo đối tượng categoryModel dòng 10
            $this->productModel = new ProductModel(); //tạo đối tượng productModel
            $this->categoryModel = new CategoryModel(); //tạo đối tượng categoryModel
            
            // load header
            if(isset($_GET['search'])) {
                $this->loadView("partitions/frontend/header.php",[
                    "menus" => $this->categoryModel->getAll(),
                    "textSearch" => $_GET['search']
                ]);

            } else {
                $this->loadView("partitions/frontend/header.php",[
                    "menus" => $this->categoryModel->getAll()
                ]);
            }
        }
        public function index() {
            $categories = $this->categoryModel->getAll(['*'],['STT']);
            $products = [];
            foreach($categories as $category) {
                $categoryProducts = $this->productModel->getProductsByCategoryId($category['MaLoai'], 30);
                $products = array_merge($products, $categoryProducts);
            }

            return $this->loadView("frontend/home/index.php",[
                "products" => $products,
                'categories' => $categories
            ]);
        }
        public function search() {
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $limit = 40;
            $offset = ($page - 1) * $limit;
            if(isset($_GET['search'])){
                $text = $_GET['search'];
            } else {
                header("Location: ./index.php");
                exit;
            }
            $products = $this->productModel->getProductBySearch($text, $limit, $offset);
            $totalProducts = $this->productModel->getCountProductBySearch($text);
            $totalPages = ceil($totalProducts / $limit);

            $this->loadView("frontend/home/search.php", [
                "products" => $products,
                'textSearch' => $text,
                'totalPages' => $totalPages,
                'currentPage' => $page
            ]);
        }
    }
?>