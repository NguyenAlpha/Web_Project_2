<?php 

$address = $_GET['address'];

hello($_GET['id'], $address);

function hello($id, $address = '') {
    echo "Hello, World! $id" . "  $address  ";
}
?>