<?php 
    class CategoryModel extends BaseModel {
        const TABLE = "categories";

        public function getAll($select = ['*'], $orderBy = [] ,$limit = 15) {
            return $this->get(self::TABLE, $select, $orderBy, $limit);
        }

        public function findById($id) {
            return $this->find(self::TABLE, "MaLoai", $id);
        }

        public function store() {
            
        }

        public function getFiltersByCategoryId($id) {
            switch ($id) {
                case 'Laptop':
                    return [
                        'Thương hiệu' => 'ThuongHieu',
                        'CPU' => 'CPU', 
                        'GPU' => 'GPU', 
                        'RAM' => 'RAM', 
                        'Dung lượng' => 'DungLuong', 
                        'Kích thước màn hình' => 'KichThuocManHinh', 
                        'Độ phân giải' => 'DoPhanGiai'
                    ];
                case 'LaptopGaming':
                    return [
                        'Thương hiệu' => 'ThuongHieu',
                        'CPU' => 'CPU', 
                        'GPU' => 'GPU'
                    ];
                default:
                    return [];
            }
        }
    }
?>