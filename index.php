<?php 
    session_start();

    // if(isset($_SESSION["admin"])) {
    //     header("Location: index.php?controller=Admin&action=homepageadmin");
    //     echo "13532 ";
    // }
    require "./Core/Database.php";
    require "./Models/BaseModel.php";
    
    require "./Controllers/BaseController.php";
    
    $controllerName = (ucfirst($_GET["controller"] ?? "product"))  . "Controller";
    
    require "./Controllers/".$controllerName.".php";
    $controllerObject = new $controllerName;
    $action = $_GET["action"] ?? "index";
    $controllerObject->$action();
    if(!$_GET["controller"]=='admin'){
        include "./Views/partitions/fontend/footer.php";
    }
?>


