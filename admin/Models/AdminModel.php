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
          return $this->delete(self::TABLE,'ID',$id);
}
public function getAllCustomers() {
    $sql = "SELECT * FROM users";
    $result = $this->conn->query($sql);
    $customers = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $customers[] = $row;
        }
    }

    return $customers;
}
    public function Viewcustomer() {
        $AdminModel = new AdminModel();
        $customers = $AdminModel->getAllCustomers();
        require_once "views/admin/customerList.php";
    }

    public function changeCustomerStatus($id) {
        $user = $this->getCustomerByID($id);
        if (!$user) return false;
        
        // Kiểm tra nếu TrangThai chưa có giá trị, mặc định sẽ là 'Hiện'
        $currentStatus = $user['TrangThai'] ?? 'mở';
        $newStatus = ($currentStatus == 'mở') ? 'khóa' : 'mở';
        
        $stmt = $this->conn->prepare("UPDATE users SET TrangThai = ? WHERE ID = ?");
        $stmt->bind_param("si", $newStatus, $id);
        return $stmt->execute();
    }
}
?>