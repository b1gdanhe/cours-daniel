<?php

require '../utils/database.php';
$db  = connectToDB();
$users = [];
$server = $_SERVER;
$post_data = $_POST;
if ($server['REQUEST_METHOD'] === 'POST') {

    if (isset($post_data['my-search-button']) && $post_data['my-search-button'] === 'Filter') {
  //      dd([$params, $query]);

        $query = "SELECT * FROM users ";
        $params = [];
        if ($search_key = validate($post_data['search_key'])) {
            $query .= "WHERE first_name LIKE :search_key OR last_name LIKE :search_key OR description LIKE :search_key OR age LIKE :search_key OR degree LIKE :search_key ";
            $params['search_key'] = '%' . $search_key . '%';
        }
        if ($name_search_key = validate($post_data['name_search_key'])) {
            $query .= (str_contains($query, 'WHERE') ? "AND" : "WHERE") . " last_name LIKE :name_search_key";
            $params['name_search_key'] = '%' . $name_search_key . '%';
        }
        $users = getList($db, $query, $params);
    } else if (isset($post_data['my-btn-delete']) && $post_data['my-btn-delete'] === 'Delete') {
        try {
            $query = "DELETE FROM users WHERE id = :id";
            $new_city = storeNew($db, $query, ['id' => $post_data['id']]);
            header("Location: /list");
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    } else if (isset($post_data['my-clearSearch-button']) && $post_data['my-clearSearch-button'] === 'Clear') {
        $query = 'SELECT * FROM users';
        $users = getList($db, $query);
    }
} else {
    $query = 'SELECT * FROM users';
    $users = getList($db, $query);
}
require 'views/list.view.php';
