<?php 
    // session_start();

    // if(isset($_SESSION["username"])) {
    //     $username = $_SESSION["username"];
    // }
    require "./Core/Database.php";
    require "./Models/BaseModel.php";
    
    require "./Controllers/BaseController.php";
    
    $controllerName = (ucfirst($_GET["controller"] ?? "product"))  . "Controller";
    
    require "./Controllers/".$controllerName.".php";
    $controllerObject = new $controllerName;
    $action = $_GET["action"] ?? "index";
    $controllerObject->$action();

    include "./Views/partitions/fontend/footer.php";
?>


