<?php 
    class ProductModel extends BaseModel {
        const TABLE = "products";

        public function getAll($select = ['*'], $orderBy = [] ,$limit = 15) {
            return $this->get(self::TABLE, $select, $orderBy, $limit);
        }

        public function findById($id) {
            return $this->find(self::TABLE, "MaSP", $id);
        }

        public function deleteProduct($data) {
            $this->delete(self::TABLE, "MaSP", $data);
        }

        public function add($data) {
            $this->create(self::TABLE, $data);
        }

        public function updateProduct($data, $id) {
            $this->update(self::TABLE, $data, "MaSP", $id);
        }

        public function getProductsByCategoryId($categoryID, $limit = 50, $offset = 0, $orderBy = []) {
            $orderClause = '';
            if (!empty($orderBy)) {
                // Ví dụ: ['Gia DESC', 'TenSanPham ASC']
                $orderClause = "ORDER BY " . implode(", ", $orderBy);
            }
        
            $query = "SELECT * FROM " . self::TABLE . "
                      WHERE MaLoai = '$categoryID'
                      $orderClause
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