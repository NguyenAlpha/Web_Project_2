<?php 
    class ProductDetailModel extends BaseModel {
        const TABLE = "details";

        function getProductDetail($product) {
            return $this->find($product['MaLoai'] . self::TABLE, "MaSP", $product['MaSP']);
        }

        function getCategoryFilters($filters, $categoryId) {
            foreach ($filters as $attributeName => $attributeId) {
                $query = "SELECT DISTINCT $attributeId FROM {$categoryId}details";
                $result = $this->getFilters($query);
                $filters[$attributeName] = $result;
            }
            return $filters;
        }
    }
?>