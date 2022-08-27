<?php 
require_once 'connection.php';
require_once 'functions.php';

$method = $_SERVER['REQUEST_METHOD'];

$query = $_GET['query'];
$query_parameters = explode('/', $query);

$type = $query_parameters[0];
$id = $query_parameters[1];

switch ($method) {
    case 'GET' :
        if ($type === 'notebook') {
            if (isset($id)) {
                getNote($connection, $id);
            } else {
                getNotebook($connection);  
            }
            
        }
        break;

    case 'POST' :
        if ($type === 'notebook') {
            addNote($connection, $_POST);
            
        }
        break;

    case 'PATCH' :
        if ($type === 'notebook') {
            if (isset($id)) {
                $data = file_get_contents('php://input');
                $data = json_decode($data, true);
                updateNote($connection, $id, $data);

            }
                
        }
        break;

    case 'DELETE' :
        if ($type === 'notebook') {
            if (isset($id)) {
                deleteNote($connection, $id);

            }
                
        }
        break;
}

