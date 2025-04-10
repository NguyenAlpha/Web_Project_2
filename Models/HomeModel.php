<?php 
class HomeModel extends BaseModel {
    public function search($search) {
        $sql = "SELECT * FROM products WHERE TenSP LIKE '%$search%'";
        return $this->getByQuery($sql);
    }
}
?>