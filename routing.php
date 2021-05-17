<?php
require_once 'functions.php';


$request = $_GET['q'];
$tables = 'dipendenti|macchinari';
$api_regex = "/($tables)\/*$/";
$api_regex_id = "/($tables)\/(\d+)$/";

switch ($request) {
    case '/' :
    case '' :
        require __DIR__ . '/views/index.php';
        break;
    case 'admin' :
        require 'db_connect.php';
        require __DIR__ . '/views/admin.php';
        break;
    /* tables */
    case (preg_match($api_regex, $request) ? true : false ):
        $table = preg_replace($api_regex, '$1', $request);
        if(isset($_POST['nome']) && !empty($_POST['nome'])){
            if($result = setData($table, ['nome' => $_POST['nome'] ])) {
                $row = getData($table, '*', '1 ORDER BY id DESC LIMIT 1');
                echo json_encode($row, JSON_PRETTY_PRINT);
                break;
            }
        }
        if(isset($_POST['delete']) && !empty($_POST['delete'])) {
            delData($table, 1);
        }
        $list = getData($table);
        echo json_encode($list, JSON_PRETTY_PRINT);
        break;
    /* ids */
    case (preg_match($api_regex_id, $request) ? true : false ) :
        $table = preg_replace($api_regex_id, '$1', $request);
        $id = preg_replace($api_regex_id, '$2', $request);
        if($_POST['delete'] && !empty($_POST['delete'])) {
            delData($table, "id=$id");
            $list = getData($table);
            echo json_encode($list, JSON_PRETTY_PRINT);
            break;
        }

        $row = getData($table, '*', "id=$id");
        echo json_encode($row, JSON_PRETTY_PRINT);
        break;
    case 'pdf':
        require_once __DIR__ . '/genera_pdf.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}