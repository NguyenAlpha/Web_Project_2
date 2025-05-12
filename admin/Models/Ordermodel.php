
<?php 
class OrderModel extends BaseModel{
    const  TABLE = "orders";
    public function getAllOrders() {
        $sql = "SELECT * FROM orders ORDER BY MaDon DESC";
        return $this->getByQuery($sql);
    }

    public function confirmOrderById($id) {
        $sql = "UPDATE orders SET TrangThai = 'đã xác nhận' WHERE MaDon = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function getOrderByUserID($userID) {
        $sql = "SELECT *, listproduct.SoLuong AS SoLuongOrder, orders.TrangThai AS TrangThaiDon, orders.MaDon AS MaOrder FROM orders 
        INNER JOIN listproduct ON listproduct.MaDon = orders.MaDon
        INNER JOIN products ON products.MaSP = listproduct.MaSP 
        WHERE UserID = $userID";
        return $this->getByQuery($sql);
    }

    public function deleteOrder($userID) {
        return $this->delete(self::TABLE,'userID',$userID);
    }

    public function updateOrderStatus($maDon, $trangThai) {
        $sql = "UPDATE orders SET TrangThai = ? WHERE MaDon = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $trangThai, $maDon);
        return $stmt->execute();
    }
    public function FilteredOrders($filters) {
        $sql = "SELECT * FROM orders WHERE 1=1";
        $params = [];
        $types = '';
        
        // Lọc theo trạng thái
        if (!empty($filters['status'])) {
            $sql .= " AND TrangThai = ?";
            $params[] = $filters['status'];
            $types .= 's';
        }
        
        // Lọc theo khoảng thời gian
        if (!empty($filters['from_date'])) {
            $sql .= " AND NgayDat >= ?";
            $params[] = $filters['from_date'];
            $types .= 's';
        }
        
        if (!empty($filters['to_date'])) {
            $sql .= " AND NgayDat <= ?";
            $params[] = $filters['to_date'];
            $types .= 's';
        }
        
        // Lọc theo địa điểm (giả sử DiaChi lưu dạng "Số nhà, Đường, Quận, Thành phố")
        if (!empty($filters['city'])) {
            $sql .= " AND DiaChi LIKE ?";
            $params[] = '%' . $filters['city'] . '%';
            $types .= 's';
        }
        
        if (!empty($filters['district'])) {
            $sql .= " AND DiaChi LIKE ?";
            $params[] = '%' . $filters['district'] . '%';
            $types .= 's';
        }
        
        $sql .= " ORDER BY NgayDat DESC";
        
        $stmt = $this->conn->prepare($sql);
        
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC);
    
    }
    public function getListMaDon($userID) {
        $sql = "SELECT * FROM orders WHERE UserID = $userID ORDER BY MaDon DESC";
        return $this->getByQuery($sql);
    }
    public function getAllCities() {
        // Giả sử lấy từ bảng địa điểm hoặc phân tích từ địa chỉ đơn hàng
        $sql = "SELECT DISTINCT 
                SUBSTRING_INDEX(SUBSTRING_INDEX(DiaChi, ', ', -1), ',', 1) AS city 
                FROM orders 
                WHERE DiaChi LIKE '%, %' 
                ORDER BY city";
        
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getDistrictsByCity($city) {
        // Giả sử lấy từ bảng địa điểm hoặc phân tích từ địa chỉ đơn hàng
        $sql = "SELECT DISTINCT 
                TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(DiaChi, ', ', -2), ', ') AS district 
                FROM orders 
                WHERE DiaChi LIKE ? 
                AND DiaChi LIKE '%, %, %' 
                ORDER BY district";
        
        $stmt = $this->conn->prepare($sql);
        $cityParam = "%$city%";
        $stmt->bind_param("s", $cityParam);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC);
}

}