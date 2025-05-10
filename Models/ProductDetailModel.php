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

        function getProductByCategoryFilters($categoryId, $attributes = [], $postFilters = [], $limit = 50, $offset = 0, $TrangThai = '') {
            $sql = "SELECT DISTINCT products.* FROM {$categoryId}details
                    INNER JOIN products ON {$categoryId}details.MaSP = products.MaSP";
            
            $whereConditions = [];
    
            foreach($postFilters as $attributeId => $values) {
                if(in_array($attributeId, $attributes) && is_array($values)) {
                    $escapedValues = array_map(function($value) {
                        return "'" . addslashes($value) . "'";
                    }, $values);
                    
                    $whereConditions[] = "{$categoryId}details.$attributeId IN (" . implode(", ", $escapedValues) . ")";
                }
            }

            if(isset($postFilters['giaThap']) && isset($postFilters['giaCao']) && !empty($postFilters['giaThap']) && !empty($postFilters['giaCao'])) {
                $minPrice = (int) str_replace('.', '', $postFilters['giaThap']);
                $maxPrice = (int) str_replace('.', '', $postFilters['giaCao']);
                $whereConditions[] = "products.Gia BETWEEN $minPrice AND $maxPrice";
            
            } elseif(isset($postFilters['giaThap']) && !empty($postFilters['giaThap'])) {
                $minPrice = (int) str_replace('.', '', $postFilters['giaThap']);
                $whereConditions[] = "products.Gia >= $minPrice";
            
            } elseif(isset($postFilters['giaCao']) && !empty($postFilters['giaCao'])) {
                $maxPrice = (int) str_replace('.', '', $postFilters['giaCao']);
                $whereConditions[] = "products.Gia <= $maxPrice";
            }

            if(!empty($TrangThai)) {
                $TrangThai = "TrangThai = '$TrangThai'";
                $whereConditions[] = $TrangThai;
            }

            if (!empty($whereConditions)) {
                $sql .= " WHERE " . implode(" AND ", $whereConditions);
            }
            $sql .= " LIMIT $limit OFFSET $offset";
            return $this->getByQuery($sql);
        }
        
        // Lấy tổng số sản phẩm thỏa filter (cho phân trang)
        function getCountProductWithFilters($categoryId, $attributes = [], $postFilters = [], $TrangThai = '') {
            $sql = "SELECT COUNT(DISTINCT products.MaSP) as count FROM {$categoryId}details
                    INNER JOIN products ON {$categoryId}details.MaSP = products.MaSP";

            $whereConditions = [];

            foreach ($postFilters as $attributeId => $values) {
                if (in_array($attributeId, $attributes) && is_array($values)) {
                    $escapedValues = array_map(function($value) {
                        return "'" . addslashes($value) . "'";
                    }, $values);

                    $whereConditions[] = "{$categoryId}details.$attributeId IN (" . implode(", ", $escapedValues) . ")";
                }
            }

            if(isset($postFilters['giaThap']) && isset($postFilters['giaCao']) && !empty($postFilters['giaThap']) && !empty($postFilters['giaCao'])) {
                $minPrice = (int) str_replace('.', '', $postFilters['giaThap']);
                $maxPrice = (int) str_replace('.', '', $postFilters['giaCao']);
                $whereConditions[] = "products.Gia BETWEEN $minPrice AND $maxPrice";
            
            } elseif(isset($postFilters['giaThap']) && !empty($postFilters['giaThap'])) {
                $minPrice = (int) str_replace('.', '', $postFilters['giaThap']);
                $whereConditions[] = "products.Gia >= $minPrice";
            
            } elseif(isset($postFilters['giaCao']) && !empty($postFilters['giaCao'])) {
                $maxPrice = (int) str_replace('.', '', $postFilters['giaCao']);
                $whereConditions[] = "products.Gia <= $maxPrice";
            }

            if(!empty($TrangThai)) {
                $TrangThai = "TrangThai = '$TrangThai'";
                $whereConditions[] = $TrangThai;
            }

            if (!empty($whereConditions)) {
                $sql .= " WHERE " . implode(" AND ", $whereConditions);
            }

            $result = $this->conn->query($sql);
            $row = $result->fetch_assoc();
            return $row['count'] ?? 0;
        }
    }
?>