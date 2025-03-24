<?php 
    class myDBClass {

        private $serverName;
        private $userName;
        private $password;
        private $databaseName;

        private $conn;

        public function __construct($sn, $urs, $pwd, $db) {
            $this->serverName = $sn;
            $this->userName = $urs;
            $this->password = $pwd;
            $this->databaseName = $db;
        }

        public function connectDB() {
            $this->conn = new mysqli($this->serverName, $this->userName, $this->password, $this->databaseName);
            if($this->conn->connect_error) {
                echo "Kết nối thất bại";
            } else {
                echo "Kêt nối thánh công";
            }
        }

        public function runQuery($query) {
            $result = $this->conn->query($query);
            $data = [];
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
            }
            return $data;
        }

        public function closeDB() {
            $this->conn->close();
        }
    }

    echo '<pre>';
    echo print_r($_POST);
    echo '</pre>';
    echo '<pre>';
    echo $_POST['filterCategory'];

?>