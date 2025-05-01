<?php 
    class Database {
        private $host = "localhost";
        private $username = "root";
        private $password = "";
        private $database = "test1";
        // Hàm kết nối database
        public function connect() {
            $conn = new mysqli($this->host, $this->username, $this->password, $this->database);
            if($conn->connect_error) {
                die("Kết nối DB thất bại: " . $conn->connect_error);
            }
            return $conn;
        }
    }
?>