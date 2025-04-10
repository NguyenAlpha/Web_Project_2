<?php
session_start();
    require("./db_connect.php");
if(empty($_POST["user"])){  
    die("name is required");
}


$user = $_POST['user'];
$pass = $_POST['pass'];
$sql = "SELECT * FROM `user` WHERE username = '$user' AND password = '$pass';";
$result = $conn->query($sql);
if($result->num_rows>0){
    $_SESSION['user']= $result->fetch_assoc();
    
    header("Location: ../index.php");
    
}

print_r($_POST);
?>