<?php 
class DashboardController extends BaseController {
    public function __construct() {

    }

    public function index() {
        // session_destroy();
        if(!isset($_SESSION['admin'])) {
            header('Location: ./index.php?controller=admin&action=login');
            exit;
        }
        $this->loadView('frontend/dashboard/index.php');
    }
}
?>