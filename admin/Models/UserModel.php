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
        
        public function updateUser($userID, $username, $phonenumber, $sex, $dob, $email) {
            $sql = "UPDATE $this->table SET username = '$username', phonenumber = '$phonenumber', sex = '$sex', email = '$email', date_of_birth = '$dob[2]-$dob[1]-$dob[0]' WHERE ID = $userID";
            $this->conn->query($sql);
        }

        public function getUser($id) {
            $sql = "SELECT * FROM $this->table WHERE ID = $id";
            $result = $this->conn->query($sql);            
            if($result->num_rows > 0) {
                return $result->fetch_assoc();
            } else  {
                return "";
            }
        }
        public function getaddress($id){
            $sql = "SELECT * FROM address WHERE userID = $id";
            return $this->getByQuery($sql);
        }
    }
    
?>