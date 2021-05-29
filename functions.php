<?php


function getData($table, $fields = '*', $where = '1') {
    require 'db_connect.php';
    if(is_array($fields)) {
        $fields = implode(', ', $fields);
    }
    $result = $conn->query("SELECT $fields FROM `$table` WHERE $where") or die ($conn->error);

    if($result->num_rows == 0) return [];

    $field_count = $result->field_count;
    while($row = $field_count > 1 ? $result->fetch_assoc() : $result->fetch_row() ){
        $list[] = $field_count > 1 ? $row : $row[0];
    }


    return count($list) > 1 ? $list : $list[0];
}




function setData($table, $array_assoc, $where = null) {
    require 'db_connect.php';

    if(!isset($where)) {
        //  INSERT
        foreach ($array_assoc as $key => $value) {
            $keys[] = $key;
            $values[] = is_string($value) ? "'".addslashes($value)."'" : $value;
        }
    
        $keys = implode(', ', $keys);
        $values = implode(', ', $values);
    
        return $result = $conn->query("INSERT INTO `$table` ($keys) VALUES ($values)") or die($conn->error);
    }

    // UPDATE
    $what = [];
    foreach($array_assoc as $key => $value){ 
        $what[] = $key . "=" . (is_string($value) ? "'".addslashes($value)."'" : $value);
    }

    $what = implode(", ", $what);

    return $result = $conn->query("UPDATE `$table` SET $what WHERE $where") or die($conn->error);


}

function delData($table, $where) {
    require 'db_connect.php';

    return $result = $conn->query("DELETE FROM `$table` WHERE $where") or die($conn->error);
}