<?php 
    session_start();
    $username = '';
    if(isset($_SESSION["user"])) {
        $username = $_SESSION["user"]['username'];
    }

    require "./Core/Database.php";
    require "./Models/BaseModel.php";
    require "./Controllers/BaseController.php";

    $controller = $_GET["controller"] ?? "home";
    $action = $_GET["action"] ?? "index";

    $controllerName = ucfirst($controller) . "Controller";
    $controllerFile = "./Controllers/" . $controllerName . ".php";

    // Kiểm tra xem file controller có tồn tại không
    if (file_exists($controllerFile)) {
        require $controllerFile;

        // Kiểm tra method (action) có tồn tại không
        if (method_exists($controllerName, $action) &&
        class_exists($controllerName)) {
            $controllerObject = new $controllerName;
            $controllerObject->$action();
            
            if(isset($_GET["controller"]) && $_GET["controller"]=='admin') {
            } else {
                include "./Views/partitions/frontend/footer.php";
            }
        } else {
            // Action không tồn tại
            include "./Views/errors/404.php";
        }
    } else {
        // File controller không tồn tại
        include "./Views/errors/404.php";
    }
?>
