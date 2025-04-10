<?php 
    class BaseModel extends Database {
        protected $conn;
        public function __construct() {
            $this->conn = $this->connect();
        }

        protected function get($table, $select = ['*'], $orderBy = [], $limit = 20) {
            $select = implode(",", $select);

            $orderBy = implode(" ", $orderBy);
            if($orderBy) {
                $sql = "SELECT $select FROM $table ORDER BY $orderBy LIMIT $limit ";
            } else {
                $sql = "SELECT $select FROM $table LIMIT $limit";
            }
            $result = $this->conn->query($sql);
            $data = [];
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
            }
            return $data;
        }

        protected function find($table, $name, $id) {
            $sql = "SELECT * FROM  $table WHERE $name = $id";
            $result = $this->conn->query($sql);
            return $result->fetch_assoc();
        }

        protected function create($table, $data) {
            $columns = implode(",", array_keys($data));
            $values = "'" . implode("','", array_values($data)) . "'";
            $sql = "INSERT INTO $table ($columns) VALUES ($values)";
            $this->conn->query($sql);
        }

        protected function update($table, $data, $column, $id) {
            $newarr = [];
            foreach($data as $key => $value) {
                $newarr[] = "$key = '$value'";
            }
            $newarr = implode(",", $newarr);
            $sql = "UPDATE $table SET $newarr WHERE $column = $id";
            $this->conn->query($sql);
        }

        protected function delete($table, $column, $id) {
            $sql = "DELETE FROM $table WHERE $column = $id";
            $this->conn->query($sql);
        }

        protected function getByQuery($query) {
            $result = $this->conn->query($query);
            $data = [];

            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
            }

            return $data;
        }

        protected function getFilters($query) {
            $result = $this->conn->query($query);
            return ($result->num_rows > 0) ? array_merge(...$result->fetch_all()) : [];
        }
        protected function getAdmin($query){
            $result = $this->conn->query($query);
            if  ($result->num_rows > 0) {
            return $result->fetch_assoc();
            }
            else {
                return [];
            }
        }
    }
?>