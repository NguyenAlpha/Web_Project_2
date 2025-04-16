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

        public function getProductsByCategoryId($categoryID, $limit = 25) {
            $query = "SELECT * FROM products
                      WHERE MaLoai = '$categoryID' LIMIT $limit";
            return $this->getByQuery($query);
        }
    }
?>