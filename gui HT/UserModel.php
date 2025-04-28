<?php 
    class UserModel extends BaseModel {
        private $table = "users";

        public function checkUser($username, $password) {
            $sql = "SELECT * FROM $this->table WHERE username = '$username' AND password = '$password'";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0) {
                return $result->fetch_assoc();
            } else  {
                return "";
            }
        }

        public function addUser($name, $password, $phone) {
            $sql = "INSERT INTO $this->table (username, password, sdt) VALUES ('$name','$password','$phone')";
            $this->add($sql);
        }
    }
?>