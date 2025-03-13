<?php 
    class ProductDetailModel extends BaseModel {
        const TABLE = "details";

        function getProductDetail($id, $categoryName) {
            return $this->find($categoryName . SELF::TABLE, "MaSP", $id);
        }
    }
?>