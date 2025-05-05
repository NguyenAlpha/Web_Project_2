<?php 
    class UserModel extends BaseModel {
        private $table = "users";

        public function checkUser($username, $password) {
            $sql = "SELECT * FROM $this->table WHERE username = '$username' AND password = '$password'";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0) {
                //print_r($result->fetch_assoc());
                return $result->fetch_assoc();
            } else  {
                return "";
            }
        }
        public function addUser($name, $password, $phone, $sex, $dob) {
            $sql = "INSERT INTO $this->table (username, password, phonenumber, sex, date_of_birth) VALUES ('$name','$password','$phone', '$sex', '$dob')";
            $this->add($sql);
        }
        
    }
    
?>