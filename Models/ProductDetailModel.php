<?php 
    class ProductDetailModel extends BaseModel {
        const TABLE = "details";

        function getProductDetail($product) {
            return $this->find($product['MaLoai'] . self::TABLE, "MaSP", $product['MaSP']);
        }

        function getCategoryFilters($attribute, $categoryId) {
            foreach ($attribute as $attributeName => $attributeId) {
                $query = "SELECT DISTINCT $attributeId FROM {$categoryId}details";
                $result = $this->getFilters($query);
                $attribute[$attributeName] = $result;
            }
            return $attribute;
        }

        function getProductByCategoryFilters($categoryId, $attributes = null, $postFilters = null) {
            $sql = "SELECT DISTINCT * FROM {$categoryId}details
            INNER JOIN products ON {$categoryId}details.MaSP = products.MaSP";
            $whereConditions = [];
            foreach ($postFilters as $attributeId => $values) {
                if(in_array($attributeId, $attributes)) {
                    // Escape dữ liệu đầu vào để tránh SQL Injection
                    $escapedValues = array_map(function($value) {
                        return "'" . $value . "'";
                    }, $values);
            
                    // Tạo chuỗi điều kiện với IN
                    $whereConditions[] = "$attributeId IN (" . implode(", ", $escapedValues) . ")";
                }
            }
            $whereClause = implode(" AND ", $whereConditions);
            $sql .= " WHERE " . $whereClause;
            return $this->getByQuery($sql);
        }
    }
?>