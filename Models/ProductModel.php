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
    }
?>