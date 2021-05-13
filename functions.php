<?php


function getData($table, $fields = '*', $where = '1') {
    require 'db_connect.php';
    if(is_array($fields)) {
        $fields = implode(', ', $fields);
    }
    $result = $conn->query("SELECT $fields FROM `$table` WHERE $where") or die ($conn->error);

    $multi_fields = preg_match('/,/', $fields) || $fields == '*';
    while($row = $multi_fields ? $result->fetch_assoc() : $result->fetch_row() ){
        $list[] = $multi_fields ? $row : $row[0];
    }

    return count($list) > 1 ? $list : $list[0];
}




function setData($table, $array_assoc) {
    require 'db_connect.php';

    foreach ($array_assoc as $key => $value) {
        $keys[] = $key;
        $values[] = is_string($value) ? "'".addslashes($value)."'" : $value;
    }

    $keys = implode(', ', $keys);
    $values = implode(', ', $values);

    return $result = $conn->query("INSERT INTO `$table` ($keys) VALUES ($values)") or die($conn->error);
}