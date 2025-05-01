<?php 
    session_start();

    require "../Core/Database.php";
    require "./Models/BaseModel.php";
    require "./Controllers/BaseController.php";

    $controller = $_GET["controller"] ?? "dashboard";
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
        } else {
            // Action không tồn tại
        }
    } else {
        // File controller không tồn tại
    }
?>