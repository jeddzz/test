<?php
require 'bootstrap.php';

if (!empty($_POST)) {
    header('Content-Type: application/json');
	list($errors, $user_card) = validate($_POST);

    if (empty($errors)) {

        if (register($_POST)) {
            http_response_code(201);
            echo json_encode([
                'success' => true
            ]);
            exit();
        }
        http_response_code(500);
        echo json_encode([
            'success' => false
        ]);
        exit();
    }

    http_response_code(422);//422

    echo json_encode([
        'success' => false,
        'errors' => $errors,
        'user_card' => $user_card
    ]);

    exit();
}
