<?php
require_once 'db_connect.php';
class DB  extends Connection{
    
    
    function getData($table, $fields = '*', $where = '1', $limit = 0, $offset = 0) {
        if(is_array($fields)) {
            $fields = implode(', ', $fields);
        }
    
        $limit_condition = $limit > 0 ? "LIMIT $limit" : "";
    
        $sql = "SELECT $fields FROM `$table` WHERE $where $limit_condition";
        $result = $this->connection->query($sql) or die ($this->connection->error."\n".$sql);
    
        if($result->num_rows == 0) return [];
    
        $field_count = $result->field_count;
        while($row = $field_count > 1 ? $result->fetch_assoc() : $result->fetch_row() ){
            $list[] = $field_count > 1 ? $row : $row[0];
        }
    
    
        return $limit != 1 ? $list : $list[0];
    }

    function setData($table, $array_assoc, $where = null) {
    
        if(!isset($where)) {
            //  INSERT
            foreach ($array_assoc as $key => $value) {
                $keys[] = $key;
                $values[] = $this->mySQLValueFilter($value);
            }
        
            $keys = implode(', ', $keys);
            $values = implode(', ', $values);

            $sql = "INSERT INTO `$table` ($keys) VALUES ($values)";
            return $result = $this->connection->query($sql) or die($this->connection->error . "\n" . $sql);
        }
    
        // UPDATE
        $what = [];
        foreach($array_assoc as $key => $value){ 
            $what[] = $key . "=" . $this->mySQLValueFilter($value);
        }
    
        $what = implode(", ", $what);
    
        $sql = "UPDATE `$table` SET $what WHERE $where";
        return $result = $this->connection->query($sql) or die($this->connection->error . "\n" . $sql);
    
    
    }
    
    function delData($table, $where = 1) {
    
        $sql = "DELETE FROM `$table` WHERE $where";
        return $result = $this->connection->query($sql) or die($this->connection->error . "\n" . $sql);
    }
    
    function mySQLValueFilter($value) {
        return is_string($value) ? "'".addslashes($value)."'" : $value;
    }
}



