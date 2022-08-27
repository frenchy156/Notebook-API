<?php

function getNotebook($connection) {
    $notebook = mysqli_query($connection, "SELECT * FROM `notebook`");

    $notebookList = [];

    while ($note = mysqli_fetch_assoc($notebook)) {
        $notebookList[] = $note;
    }
    
    echo json_encode($notebookList);
}

function getNote($connection, $id) {
    $note = mysqli_query($connection, "SELECT * FROM `notebook` WHERE `id` = $id");

    if (mysqli_num_rows($note) === 0) {
        http_response_code(404);

        $result_message = [
            'status' => false,
            'text' => 'Note was not found'
        ];

        echo json_encode($result_message);

    } else {
        $note = mysqli_fetch_assoc($note);

        echo json_encode($note);
    }

}

function addNote($connection, $data) {

    if ($data['name']) {
        $name = $data['name'];
    } else {
        throw new Exception('Value was not set');
    }

    if ($data['phone_number']) {
        $phone_number = $data['phone_number'];
    } else {
        throw new Exception('Value was not set');
    }

    if ($data['email']) {
        $email = $data['email'];
    } else {
        throw new Exception('Value was not set');
    }

    $company = $data['company'];
    $birth_date = $data['birth_date'] ?? '1000-01-01';
 
    mysqli_query($connection, "INSERT INTO `notebook` (`id`, `name`, `company`, 
    `phone_number`, `email`, `birth_date`) VALUES (NULL, '$name', '$company', 
    '$phone_number', '$email', '$birth_date')");

    if (mysqli_errno($connection) === 0) {
        http_response_code(201);

        $result_message = [
            'status' => true,
            'text' => mysqli_insert_id($connection)
        ];

        echo json_encode($result_message);

    } else {
        echo mysqli_errno($connection);
    }
    
}

function updateNote($connection, $id, $data) {
    $name = $data['name'];
    $company = $data['company'];
    $phone_number = $data['phone_number'];
    $email = $data['email'];
    $birth_date = $data['birth_date'] ?? '1000-01-01';
    
    mysqli_query($connection, "UPDATE `notebook` SET `name` = '$name', `company` = '$company',  
    `phone_number` = '$phone_number', `email` = '$email', `birth_date` = $birth_date,
     WHERE `notebook`.`id` = '$id'");

    if (mysqli_errno($connection) === 0) {
        http_response_code(200);

        $result_message = [
        'status' => true,
        'text' => 'Note is updated'
        ];

    echo json_encode($result_message);

    } else {
        echo mysqli_errno($connection);
    }

}

function deleteNote($connection, $id) {
    mysqli_query($connection, "DELETE FROM `notebook` WHERE `notebook`.`id` = '$id'");

    if (mysqli_errno($connection) === 0) {
        http_response_code(200);

        $result_message = [
        'status' => true,
        'text' => 'Note is deleted'
        ];

    echo json_encode($result_message);

    } else {
        echo mysqli_errno($connection);
    }
}