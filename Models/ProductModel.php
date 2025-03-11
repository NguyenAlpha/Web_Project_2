<?php 
    class ProductModel extends BaseModel {
        const TABLE = "products";

        public function getAll($select = ['*'], $orderBy = [] ,$limit = 15) {
            return $this->get(self::TABLE, $select, $orderBy, $limit);
        }

        public function findById($id) {
            
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

        public function getProductsByCategory($categoryID) {
            $query = "SELECT products.*, categories.TenLoai FROM products
                      JOIN categories ON categories.MaLoai = products.MaLoai
                      WHERE products.MaLoai = $categoryID;";
            
            return $this->getByQuery($query);
        }
    }
?>