<?php
class AdminModel extends BaseModel{
    const TABLE = "admins";
    public function checkuser($username, $password){
        $sql = "SELECT * FROM admins WHERE username = '$username' AND password = '$password'";
        return $this->getAdmin($sql);
    }
    public function customer(){
        $sql = "SELECT * FROM `users` WHERE 1";
        
    return $this->getByQuery( $sql);
    }

    public function getCustomerByID($id) {
        return $this->find('users','ID', $id);
    }
    
    public function updateCustomer($key) {
        $stmt = $this->conn->prepare("UPDATE users SET username = ?, password = ?, email = ?, sex = ?, phonenumber = ? WHERE ID = ?");
        $stmt->execute([
            $key['username'],
            $key['password'],
            $key['email'],
            $key['sex'],
            $key['phonenumber'],
            $key['ID'],
        ]);
    }
 
    public function addCustomer($username, $password, $email, $sex, $phonenumber, $date_of_birth) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO users (username, password, email, sex, phonenumber, date_of_birth) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $username, $password, $email, $sex, $phonenumber, $date_of_birth);
            return $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            // Ghi log nếu cần: error_log($e->getMessage());
            return false;
        }
    }
    
    public function deleteCustomer($id) {   
        $stmtCart = $this->conn->prepare("DELETE FROM carts WHERE userID = ?");
        $stmtCart->execute([$id]);
        $stmtAddress = $this->conn->prepare("DELETE FROM address WHERE userID = ?");
        $stmtAddress->execute([$id]);
        $stmtUser = $this->conn->prepare("DELETE FROM users WHERE ID = ?");
        return $stmtUser->execute([$id]);
}
   
}
?>