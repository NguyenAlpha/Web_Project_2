<?php 
    class ProductModel extends BaseModel {
        const TABLE = "products";

        public function getAll($select = ['*'], $orderBy = [] ,$limit = 15) {
            return $this->get(self::TABLE, $select, $orderBy, $limit);
        }

        public function findById($MaSP) {
        $sql = "SELECT * FROM products WHERE MaSP = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $MaSP);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    public function updateProductStatus($MaSP, $status) {
            $sql = "UPDATE products SET TrangThai = ? WHERE MaSP = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("si", $status, $MaSP);
            return $stmt->execute();
        }

    public function deleteProduct($MaSP) {
        // Lấy thông tin loại sản phẩm trước khi xóa
        $product = $this->findById($MaSP);
        if (!$product) return false;

        // Xóa từ bảng chi tiết trước
        $detailTable = strtolower($product['MaLoai']) . 'details';
        $sql = "DELETE FROM $detailTable WHERE MaSP = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $MaSP);
        $stmt->execute();

        // Xóa từ bảng products
        $sql = "DELETE FROM products WHERE MaSP = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $MaSP);
        return $stmt->execute();
    }

        public function add($data) {
            $this->create(self::TABLE, $data);
        }

        public function updateProduct($data, $id) {
            $this->update(self::TABLE, $data, "MaSP", $id);
        }
        
        public function getProductsByCategoryId($categoryID, $limit = 50, $offset = 0) {
            $query = "SELECT * FROM " . self::TABLE . "
                      WHERE MaLoai = '$categoryID'
                      LIMIT $limit OFFSET $offset";
            return $this->getByQuery($query);
        }
    
        // Lấy số lượng sản phẩm theo danh mục (phân trang)
        public function getProductCountByCategory($categoryID) {
            $sql = "SELECT COUNT(*) as count FROM " . self::TABLE . " WHERE MaLoai = '$categoryID'";
            $result = $this->conn->query($sql);
            if ($result) {
                $row = $result->fetch_assoc();
                return $row['count'];
            }
            return 0;
        }

        public function getProductBySearch($text, $limit = 25, $offset = 0) {
            $sql = "SELECT * FROM products WHERE TenSP LIKE '%$text%' LIMIT $limit OFFSET $offset";
            return $this->getByQuery($sql);
        }

        public function getCountProductBySearch($text) {
            $sql = "SELECT COUNT(*) AS count FROM products WHERE TenSP LIKE '%$text%'";
            $result = $this->conn->query($sql);
            if ($result) {
                $row = $result->fetch_assoc();
                return $row['count'];
            }
            return 0;
        }
    }
?>