<?php 
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "test1";

    $conn = new mysqli($host, $username, $password, $database);

    $result = $conn->query("SELECT * FROM laptopdetails");

    $data = [];
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    // echo "<pre>";
    // echo print_r($data);
    // echo "</pre>";
    
    $find = 'cpu';
    $have = 'core';
    
    // foreach($data as $item) {
    //     foreach($item as $attribute => $value) {
    //         if(strtolower($attribute) == strtolower($find)
    //            && str_contains(strtolower($value), strtolower($have))) {
    //             echo "<pre>";
    //             echo print_r($item);
    //             echo "</pre>";
                
    //         }
    //     }
    // }

    // $arr = [
    //     "Màn Hình" => "ManHinh",
    //     "GPU" => ["RTX 5070", "RTX 2060", "RTX 4070"]
    // ];

    // echo "<pre>";
    // echo print_r($arr);
    // echo "</pre>";

?>