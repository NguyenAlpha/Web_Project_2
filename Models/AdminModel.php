<?php
class AdminModel extends BaseModel{
    const TABLE = "admins";
    public function checkuser($username, $password){
        $sql = "SELECT * FROM admins WHERE username = '$username' AND password = '$password'";
        return $this->getAdmin($sql);
    }
    public function customer(){
        $sql = "SELECT * FROM `user` WHERE 1";
        
    return $this->getByQuery( $sql);
    }

    public function getCustomerByID($id) {
        return $this->find('user','id', $id);
    }
    
    public function updateCustomer($key) {
        $stmt = $this->conn->prepare("UPDATE user SET username = ?, password = ?, email = ?, address = ? WHERE id = ?");
        $stmt->execute([
            $key['username'],
            $key['password'],
            $key['email'],
            $key['address'],
            $key['id'],
        ]);
    }
 
        public function addCustomer($username, $password, $gender, $email, $address) {
            try {
                $stmt = $this->conn->prepare("INSERT INTO user (username, password, gender, email, address) VALUES (?, ?, ?, ?, ?)");
                return $stmt->execute([$username, $password, $gender, $email, $address]);
            } catch (PDOException $e) {
                // Ghi log nếu cần: error_log($e->getMessage());
                return false;
            }
        }
        
    public function deleteCustomer($id) {   
        $stmtCart = $this->conn->prepare("DELETE FROM cart WHERE userID = ?");
        $stmtCart->execute([$id]);
        $stmtUser = $this->conn->prepare("DELETE FROM user WHERE id = ?");
        return $stmtUser->execute([$id]);
}
}
?>