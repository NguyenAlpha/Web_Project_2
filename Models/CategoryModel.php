<?php 
    class CategoryModel extends BaseModel {
        const TABLE = "categories";

        public function getAll($select = ['*'], $orderBy = [] ,$limit = 15) {
            return $this->get(self::TABLE, $select, $orderBy, $limit);
        }

        public function findById($id) {
            return $this->find(self::TABLE, $id);
        }

        public function store() {
            
        }
    }
?>