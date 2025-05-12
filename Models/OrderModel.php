<?php 
class OrderModel extends BaseModel {
    public function addOrder(array $carts,$userID, $address, $TongTien, $pay, $time, $status) {
        $transfer = [
            'transfer' => 'chuyển khoản',
            'cash' => 'tiền mặt'
        ];
        $sql = "INSERT INTO orders (UserID, DiaChi, TongTien, TrangThai='$status', ThanhToan, NgayDat) VALUES ($userID,'$address',$TongTien,'chờ xác nhận', '$transfer[$pay]', '$time');";
        $this->conn->query($sql);
        $orderID = $this->conn->insert_id;
        $sql2 = "INSERT INTO listproduct (MaDon, MaSP, SoLuong) VALUES ";
        $values = [];

        foreach ($carts as $cart) {
            $maSP = (int)$cart['MaSP'];
            $soLuong = (int)$cart['SoLuong'];
            $values[] = "($orderID, $maSP, $soLuong)";
        }

        $sql2 .= implode(', ', $values) . ';';
        $this->conn->query($sql2);
        return $this->conn->insert_id;
    }

    public function getOrderByUserID($userID) {
        $sql = "SELECT *, listproduct.SoLuong AS SoLuongOrder, orders.TrangThai AS TrangThaiDon, orders.MaDon AS MaOrder FROM orders 
        INNER JOIN listproduct ON listproduct.MaDon = orders.MaDon
        INNER JOIN products ON products.MaSP = listproduct.MaSP 
        WHERE UserID = $userID";
        return $this->getByQuery($sql);
    }

    public function getListMaDon($userID) {
        $sql = "SELECT * FROM orders WHERE UserID = $userID ORDER BY MaDon DESC";
        return $this->getByQuery($sql);
    }

  public function getOrderById($maDon) {
    $stmt = $this->conn->prepare("SELECT * FROM orders WHERE MaDon = ?");
    $stmt->bind_param("i", $maDon);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

public function updateStatus($maDon, $trangThai) {
    // 1. Cập nhật trạng thái đơn hàng
    $sql = "UPDATE orders SET TrangThai = ? WHERE MaDon = ?";
    $stmt = $this->conn->prepare($sql);
    if (!$stmt) {
        die("Lỗi prepare UPDATE orders: " . $this->conn->error);
    }
    $stmt->bind_param("si", $trangThai, $maDon);
    $stmt->execute();

    // 2. Nếu trạng thái là "đã nhận hàng" thì thực hiện trừ kho + cộng số đã bán
    if ($trangThai === 'đã nhận hàng') {
        // Truy vấn danh sách sản phẩm trong đơn hàng
        $getItems = $this->getByQuery(
            "SELECT listproduct.SoLuong, listproduct.MaSP 
             FROM orders 
             INNER JOIN listproduct ON orders.MaDon = listproduct.MaDon 
             WHERE orders.MaDon = ?", 
            [$maDon]
        );

        foreach ($getItems as $don) {
            $soLuong = (int)$don["SoLuong"];
            $maSP = (int)$don["MaSP"];

            // Cập nhật tồn kho và số lượng đã bán (dùng prepare để an toàn hơn)
            $sqlUpdate = "
                UPDATE products 
                SET SoLuong = SoLuong - ?, 
                    DaBan = DaBan + ? 
                WHERE MaSP = ?";
            $stmtUpdate = $this->conn->prepare($sqlUpdate);
            if (!$stmtUpdate) {
                die("Lỗi prepare UPDATE products: " . $this->conn->error);
            }
            $stmtUpdate->bind_param("iii", $soLuong, $soLuong, $maSP);
            $stmtUpdate->execute();
        }
    }
}

// Hàm hỗ trợ lấy dữ liệu với câu truy vấn chứa ?
public function getByQuery($sql, $params = []) {
    $stmt = $this->conn->prepare($sql);
    if (!$stmt) {
        die("Lỗi prepare SELECT: " . $this->conn->error);
    }

    if (!empty($params)) {
        $types = str_repeat("s", count($params)); // hoặc tự điều chỉnh kiểu nếu biết rõ
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    return $rows;
}
public function updatetime($maDon, $time){
$sql =" UPDATE orders SET NgayGiao = '$time'";
$this->add($sql);
}

}
?>
