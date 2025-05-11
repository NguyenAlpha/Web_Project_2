
<?php 
class OrderModel extends BaseModel{
public function getAllOrders() {
    $sql = "SELECT * FROM orders ORDER BY MaDon DESC";
    return $this->getByQuery($sql);
}

public function updateOrderStatus($maDon, $trangThai) {
    $sql = "UPDATE orders SET TrangThai = ? WHERE MaDon = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("si", $trangThai, $maDon);
    return $stmt->execute();
}


public function getOrderById($maDon) {
    $sql = "SELECT * FROM orders WHERE MaDon = ?";
    return $this->getOne($sql, [$maDon]); // gọn hơn
}

public function getProductsInOrder($maDon) {
    $sql = "
        SELECT listproduct.*, products.TenSP, products.DonGia
        FROM listproduct
        INNER JOIN products ON listproduct.MaSP = products.MaSP
        WHERE listproduct.MaDon = ?
    ";
    return $this->getMany($sql, [$maDon]);
}

public function getMany($sql, $params = []) {
    $stmt = $this->conn->prepare($sql);
    if (!$stmt) die("Lỗi prepare: " . $this->conn->error);

    if (!empty($params)) {
        $types = str_repeat('s', count($params));
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

public function getOne($sql, $params = []) {
    $rows = $this->getMany($sql, $params);
    return $rows[0] ?? null;
}


}