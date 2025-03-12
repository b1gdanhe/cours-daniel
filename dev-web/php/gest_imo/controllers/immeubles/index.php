<?php

$post_data = $_POST;
$server = $_SERVER;

$immeubles = [];
$params = [];

if ($server['REQUEST_METHOD'] === 'POST') {
    if (isset($post_data['my-delete-client-form']) && $post_data['my-delete-client-form'] === 'Delete client') {
        try {
            delete('immeubles', 'id',  $post_data['id']);
            header("Location: /");
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    if (isset($post_data['my-search-button']) && $post_data['my-search-button'] === 'Filter') {
        if ($search_key = validate($post_data['search_key'])) {
            $getClientquery .=  (str_contains($getClientquery, 'WHERE') ? "AND" : "WHERE") . "(first_name LIKE :search_key OR last_name LIKE :search_key OR email LIKE :search_key)";
            $params['search_key'] = '%' . $search_key . '%';
        }
    }
}

try {
    $immeubles = all("immeubles", $params);
} catch (\Throwable $th) {
    dd($th->getMessage());
}


page("immeubles/index.page.php", [
    'immeubles' => $immeubles
]);
