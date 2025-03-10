<?php

$db = connectToDb();
$post_data = $_POST;
$server = $_SERVER;

$cars = [];
$getcarquery = "SELECT * FROM cars,clients,garages WHERE (cars.client_id = clients.id AND cars.garage_id = garages.id)";
$params = [];

if ($server['REQUEST_METHOD'] === 'POST') {

    if (isset($post_data['my-delete-car-form']) && $post_data['my-delete-car-form'] === 'Delete car') {

        try {
            $deletecarQuery = "DELETE FROM cars WHERE id = :id";
            storeNew($db, $deletecarQuery, ['id' => $post_data['id']]);
            header("Location: /cars");
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    if (isset($post_data['my-search-button']) && $post_data['my-search-button'] === 'Filter') {

        if ($search_key = validate($post_data['search_key'])) {
            $getcarquery .=  (str_contains($getcarquery, 'WHERE') ? "AND" : "WHERE") . "(first_name LIKE :search_key OR last_name LIKE :search_key OR email LIKE :search_key)";
            $params['search_key'] = '%' . $search_key . '%';
        }
        //dd($getcarquery);
    }
}

try {
    $cars = getAll($db, $getcarquery, $params);
} catch (\Throwable $th) {
    dd($th->getMessage());
}
//dd($cars);


require 'pages/cars/index.page.php';
