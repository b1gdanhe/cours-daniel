<?php

require '../utils/functions.php';
require '../utils/database.php';
$db  = connectToDB();
$users = [];
$server = $_SERVER;
$post_data = $_POST;
if ($server['REQUEST_METHOD'] === 'POST') {
    $query = 'SELECT * FROM users';
    $params = [];
    if ($search_key = validate($post_data['search_key'])) {
        $query .= " WHERE first_name LIKE :search_key OR last_name LIKE :search_key OR description LIKE :search_key OR age LIKE :search_key OR degree LIKE :search_key";
        $params['search_key'] = '%'.$search_key.'%';
    }
    if ($name_search_key = validate($post_data['name_search_key'])) {
        $query .= ' AND (last_name LIKE ?)';
        $params['name_search_key'] = '%'.$name_search_key.'%';
    }
   // dd($query);
    $users = getList($db, $query, $params);
} else {
    $query = 'SELECT * FROM users';
    $users = getList($db, $query);
}




require 'list.view.php';
