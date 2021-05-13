<?php
require_once 'functions.php';


$request = $_GET['q'];

switch ($request) {
    case '/' :
    case '' :
        require __DIR__ . '/views/index.php';
        break;
    case 'admin' :
        require 'db_connect.php';
        require __DIR__ . '/views/admin.php';
        break;
    case 'dipendenti':
    case 'dipendenti/':
        if(isset($_POST['nome']) && !empty($_POST['nome'])){
            $result = setData('dipendenti', ['nome' => $_POST['nome'] ]);
            if($result) {
                $row = getData('dipendenti', '*', '1 ORDER BY id DESC LIMIT 1');
                echo json_encode($row, JSON_PRETTY_PRINT);
            }
            break;
        }
        $list = getData('dipendenti');
        echo json_encode($list, JSON_PRETTY_PRINT);
        break;
    case (preg_match('/dipendenti\/(\d+)/', $request) ? true : false ) :
        $id = preg_replace('/dipendenti\/(\d+)/', '$1', $request);
        $row = getData('dipendenti', '*', "id=$id");
        echo json_encode($row, JSON_PRETTY_PRINT);
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}