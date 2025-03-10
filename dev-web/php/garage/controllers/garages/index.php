<?php

$db = connectToDb();
$post_data = $_POST;
$server = $_SERVER;

$garages = [];
$getgaragequery = "SELECT * FROM garages";
$params = [];

if ($server['REQUEST_METHOD'] === 'POST') {

    if (isset($post_data['my-delete-garage-form']) && $post_data['my-delete-garage-form'] === 'Delete garage') {

        try {
            $deletegarageQuery = "DELETE FROM garages WHERE id = :id";
            storeNew($db, $deletegarageQuery, ['id' => $post_data['id']]);
            header("Location: /garages");
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    if (isset($post_data['my-search-button']) && $post_data['my-search-button'] === 'Filter') {

        if ($search_key = validate($post_data['search_key'])) {
            $getgaragequery .=  (str_contains($getgaragequery, 'WHERE') ? "AND" : "WHERE") . "(first_name LIKE :search_key OR last_name LIKE :search_key OR email LIKE :search_key)";
            $params['search_key'] = '%' . $search_key . '%';
        }
        //dd($getgaragequery);
    }
}

try {
    $garages = getAll($db, $getgaragequery, $params);
} catch (\Throwable $th) {
    dd($th->getMessage());
}


require 'pages/garages/index.page.php';
