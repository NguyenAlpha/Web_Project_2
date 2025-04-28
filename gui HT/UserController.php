<?php

class UserController extends BaseController {
    private $userModel;
    private $categoryModel;
    public function __construct() {
            $this->loadModel("UserModel");   //load productModel để tạo đối tượng productModel dòng 9
            $this->userModel = new UserModel(); //tạo đối tượng categoryModel
            $this->loadModel("CategoryModel");  //load categoryModel để tạo đối tượng categoryModel dòng 10
            $this->categoryModel = new CategoryModel(); //tạo đối tượng categoryModel


            $this->loadView("layouts/header.php",[
                "menus" => $this->categoryModel->getAll(['*'],['STT'])
            ]);
    }

    public function login() {
        // nếu đã đăng nhập thì chuyển hướng về trang chủ
        if(isset($_SESSION['user'])) {
            header("Location: ./index.php?controller=user&action=show");
            exit;
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['username'];
            $password = $_POST['password'];
            
            $user = $this->userModel->checkUser($name, $password);

            if(!empty($user)) {
                $_SESSION['user'] = $user;
                if(str_contains($_SERVER['HTTP_REFERER'], 'controller=cart&action=show')) {
                    header("Location: ./index.php?controller=cart&action=show");
                    exit;
                } else {
                    header("Location: ./index.php");
                    exit;
                }
            } else {
                echo "Đăng nhập thất bại";
            }
        }
        $this->loadView("layouts/login.php");
    }

    public function register() {
        // nếu đã đăng nhập thì chuyển hướng về trang chủ
         if(isset($_SESSION['user'])) {
            header("Location: ./index.php?controller=user&action=show");
            exit;
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['username'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $this->userModel->addUser($name, $password, $phone);
            $user = $this->userModel->checkUser($name, $password);
            $_SESSION['user'] = $user;
            header("Location: ./index.php");
        }
        $this->loadView("layouts/register.php");
    }  

    public function logout() {
        session_destroy();
        header("Location: ./index.php");
        exit;
    }

    public function show() {
        // nếu chưa đăng nhập thì chuyển hướng về trang login
        if(!isset($_SESSION['user'])) {
            header("Location: ./index.php?controller=user&action=login");
            exit;
        }
        $this->loadView("frontend/user/show.php", [
            'user' => $_SESSION['user']
        ]);
    }
}
?>