<?php
require_once 'functions.php';


$request = $_GET['q'];
$tables = 'cause_guasto|componenti|dipendenti|esterni|macchinari|settori|soluzioni_adottabili|tipi_intervento';
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
        if(isset($_POST['delete']) && !empty($_POST['delete'])) {
            delData($table, "id=$id");
            $list = getData($table);
            echo json_encode($list, JSON_PRETTY_PRINT);
            break;
        }

        if(isset($_POST['nome']) && !empty($_POST['nome'])){
            setData($table, ['nome' => $_POST['nome'] ], "id=$id" );
        }

        $row = getData($table, '*', "id=$id");
        echo json_encode($row, JSON_PRETTY_PRINT);
        break;
    case 'pdf':
        $campi_obbligatori = ["luogo", "nomi", "data", "macchinario", "componente", "causa-guasto", "tipo-intervento", "soluzione-adottata", "tempo-intervento", "straordinari", "verifiche"];
        $condizione = true;
        foreach($campi_obbligatori as $item) {
            if(!isset($_POST[$item]) || empty($_POST[$item])){
                $condizione = false;
                break;
            } 
        }
        if(!$condizione) {
            header('Location: ./list', true);
            die;
        }
        require_once __DIR__ . '/genera_pdf.php';
        break;
    case 'list':
        $files = scandir(__DIR__ . '/docs', SCANDIR_SORT_DESCENDING);
        $files = array_filter($files, function($f) {return !in_array($f, ['.', '..']);});
        require_once __DIR__ . '/views/list.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}