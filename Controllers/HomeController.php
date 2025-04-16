<?php 
    class HomeController extends BaseController {
        private $productModel;
        private $categoryModel;
        private $productDetailModel;
        private $homeModel;

        public function __construct() {
            $this->loadModel("ProductModel");   //load productModel để tạo đối tượng productModel dòng 9
            $this->loadModel("CategoryModel");  //load categoryModel để tạo đối tượng categoryModel dòng 10
            $this->loadModel("HomeModel");  //load categoryModel để tạo đối tượng categoryModel dòng 10
            $this->productModel = new ProductModel(); //tạo đối tượng productModel
            $this->categoryModel = new CategoryModel(); //tạo đối tượng categoryModel
            $this->homeModel = new HomeModel(); //tạo đối tượng categoryModel


            // load header
            $this->loadView("partitions/fontend/header.php",[
                "menus" => $this->categoryModel->getAll()
            ]);
        }
        public function index() {
            $products = $this->productModel->getAll(['*'], [],50);

            return $this->loadView("fontend/home/index.php",[
                "products" => $products,
                'categories' => $this->categoryModel->getAll(['*'],['STT'])
            ]);
        }
        public function search() {
            $search = $_POST['search'];
            $products = $this->homeModel->search($search);
            $this->loadView("fontend/home/search.php", [
                "products" => $products,
                'textSearch' => $search
            ]);
        }
    }
?>