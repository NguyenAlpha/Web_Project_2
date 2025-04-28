<?php 
    // session_start();

    // if(isset($_SESSION["username"])) {
    //     $username = $_SESSION["username"];
    // }
    require "./Core/Database.php";
    require "./Models/BaseModel.php";
    
    require "./Controllers/BaseController.php";
    
    $controllerName = (ucfirst($_GET["controller"] ?? "home"))  . "Controller";
    
    require "./Controllers/".$controllerName.".php";
    $controllerObject = new $controllerName;
    $action = $_GET["action"] ?? "index";
    $controllerObject->$action();
    if(isset($_GET["controller"]) && $_GET["controller"]=='admin') {
    } else {
        include "./Views/partitions/frontend/footer.php";
    }
?>


