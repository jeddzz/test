<?php

function register(array $data)
{
    $values = [
        $data['name'],
        $data['email'],
        $data['territory'],
    ];

    return insert($values);
}

function validate(array $request)
{
    $errors = [];
	$user_card = '';
	$userEmailInfo = getUserByEmail($request['email']);
	
    if (!isset($request['email']) || strlen($request['email']) == 0) {
        $errors[]['email'] = 'Email не указан';
    } elseif (!filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[]['email'] = 'Неправильный формат email';
    } elseif (strlen($request['email']) < 4) {
        $errors[]['email'] = 'Email должен быть больше 4х символов';
    } /*elseif (isEmailAlreadyExists($request['email'])) {
        $errors[]['email'] = 'Email уже используется';
    }*/

	if ($userEmailInfo) {
		$errors[]['email'] = 'Email уже используется';
		$user_card = json_encode($userEmailInfo);
	}
	
	
    if (!isset($request['name']) || empty($request['name'])) {
        $errors[]['name'] = 'Имя не указано';
    }

    return array($errors, $user_card);
}

function isEmailAlreadyExists(string $email)
{
	$userEmailInfo = getUserByEmail($email);
	//print_r($userEmailInfo);
	
    if ($userEmailInfo) {
		//echo "Такое мыло уже есть!";
		
        return true;
    }

    return false;
}

