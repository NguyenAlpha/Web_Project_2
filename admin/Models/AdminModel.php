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
 
    public function addCustomer($username, $password, $sex, $email, $phonenumber) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO users (username, password, email, sex, phonenumber) VALUES (?, ?, ?, ?, ?)");
            return $stmt->execute([$username, $password, $email ,$sex, $phonenumber]);
        } catch (PDOException $e) {
            
            return false;
        }
    }
        
    public function deleteCustomer($id) {   
        $stmtCart = $this->conn->query("DELETE FROM carts WHERE userID = $id");
        $stmtUser = $this->conn->query("DELETE FROM users WHERE ID = $id");
        header("Location: index.php?controller=admin&action=customer");
}
    public function AddProductCustomer($id)
    {
    

    // Kết nối database (giả sử có $this->db)
    $maSP = (int)$id;
    
    // Kiểm tra xem sản phẩm đã có trong giỏ chưa
    $sql = "SELECT SoLuong FROM cart WHERE maSP = :maSP AND userID = :userID";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
        ':maSP' => $maSP,
        ':userID' => $_SESSION['userID'] 
    ]);
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Nếu đã có, thì tăng số lượng lên 1
        $newQuantity = $result['SoLuong'] + 1;
        $updateSql = "UPDATE carts SET SoLuong = :SoLuong WHERE maSP = :maSP AND userID = :userID";
        $updateStmt = $this-> conn ->prepare($updateSql);
        $updateStmt->execute([
            ':SoLuong' => $newQuantity,
            ':maSP' => $maSP,
            ':userID' => $_SESSION['userID']
        ]);
    } else {
        // Nếu chưa có, thêm mới sản phẩm vào giỏ hàng với số lượng = 1
        $insertSql = "INSERT INTO carts (maSP, userID, SoLuong) VALUES (:maSP, :userID, 1)";
        $insertStmt = $this->conn->prepare($insertSql);
        $insertStmt->execute([
            ':maSP' => $maSP,
            ':userID' => $_SESSION['userID']
        ]);
    }


    } 
}
?>