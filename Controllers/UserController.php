<?php

class UserController extends BaseController {
    private $userModel;
    private $categoryModel;
    public function __construct() {
            $this->loadModel("UserModel");   //load productModel để tạo đối tượng productModel dòng 9
            $this->userModel = new UserModel(); //tạo đối tượng categoryModel
            $this->loadModel("CategoryModel");  //load categoryModel để tạo đối tượng categoryModel dòng 10
            $this->categoryModel = new CategoryModel(); //tạo đối tượng categoryModel


            $this->loadView("partitions/frontend/header.php",[
                "menus" => $this->categoryModel->getAll(['*'],['STT'])
            ]);
    }

    public function login() {
        $erroLogin = '';
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
                $erroLogin = "Tên đăng nhập hoặc mật khẩu không đúng!";
            }
        }
        $this->loadView("partitions/frontend/login.php", [
            'erroLogin' => $erroLogin
        ]
    );
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
            $sex = $_POST['sex'];
            $dob= $_POST['date_of_birth'];
            $this->userModel->addUser($name, $password, $phone, $sex, $dob);
            $user = $this->userModel->checkUser($name, $password);
            $_SESSION['user'] = $user;
            header("Location: ./index.php");
        }
        $this->loadView("partitions/frontend/register.php");
    }  

    public function logout() {
        if(isset($_SESSION['user'])) {
            session_destroy();
            header("Location: ./index.php");
            exit;
        }
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

    public function update() {

        $this->userModel->updateUser($_GET['userID'], $_POST['username'], $_POST['phonenumber'], $_POST['sex'], $_POST['dob'], $_POST['email']);
        $_SESSION['user'] = $this->userModel->getUser((int)($_SESSION['user']['ID']));
        header("Location: ./index.php?controller=user&action=show");
        // echo '<pre>';
        // print_r($_POST);
    }

}
?>