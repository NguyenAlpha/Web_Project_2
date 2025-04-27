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
        $updateSql = "UPDATE cart SET SoLuong = :SoLuong WHERE maSP = :maSP AND userID = :userID";
        $updateStmt = $this-> conn ->prepare($updateSql);
        $updateStmt->execute([
            ':SoLuong' => $newQuantity,
            ':maSP' => $maSP,
            ':userID' => $_SESSION['userID']
        ]);
    } else {
        // Nếu chưa có, thêm mới sản phẩm vào giỏ hàng với số lượng = 1
        $insertSql = "INSERT INTO cart (maSP, userID, SoLuong) VALUES (:maSP, :userID, 1)";
        $insertStmt = $this->conn->prepare($insertSql);
        $insertStmt->execute([
            ':maSP' => $maSP,
            ':userID' => $_SESSION['userID']
        ]);
    }


    } 
}
?>