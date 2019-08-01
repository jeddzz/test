<?php

/**
 * @return PDO
 */
function get_connection()
{
    return new PDO('mysql:host=fotolia.mysql.tools;dbname=fotolia_test;charset=utf8', 'fotolia_test', '+Cti2x3O6)');
}

function insert(array $data)
{
    $query = 'INSERT INTO users (name, email, territory) VALUES(?, ?, ?)';
    $db = get_connection();
    $stmt = $db->prepare($query);
    return $stmt->execute($data);
}

function getUserByEmail(string $email)
{
    $query = 'SELECT u.id, u.name, u.email, t.ter_address
		FROM `users` u
		LEFT JOIN `t_koatuu_tree` t
		ON u.territory = t.ter_id
		WHERE u.email = ?';

    $db = get_connection();
    $stmt = $db->prepare($query);
    $stmt->execute([$email]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
	
    if ($result) {
        return $result;
    }
    return false;
}

function getUsersList()
{
    $query = 'SELECT u.id, u.name, u.email, t.ter_address
		FROM `users` u
		LEFT JOIN `t_koatuu_tree` t
		ON u.territory = t.ter_id
		ORDER BY u.id DESC';

    $db = get_connection();
    return $db->query($query,PDO::FETCH_ASSOC);
}

# Получаем список областей страны
function getRegionsList()
{
    $query = 'select * from t_koatuu_tree where `ter_level` = 1';

    $db = get_connection();
    return $db->query($query,PDO::FETCH_ASSOC);
}