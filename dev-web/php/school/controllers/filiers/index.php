<?php
$db = connectToDb();
$post_data = $_POST;
$server = $_SERVER;

$filiers = [];
$getFilierquery = "SELECT * FROM filiers ";
$params = [];


if ($server['REQUEST_METHOD'] === 'POST') {

    if (isset($post_data['my-delete-filier-form']) && $post_data['my-delete-filier-form'] !== 'Delete Filier') {
        try {
            $deleteFilierQuery = "DELETE FROM filiers WHERE id = :id";
            storeNew($db, $deleteFilierQuery, ['id' => $post_data['id']]);
            header("Location: /filiers");
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    if (isset($post_data['my-search-button']) && $post_data['my-search-button'] === 'Filter') {

        if ($search_key = validate($post_data['search_key'])) {
            $getFilierquery .=  (str_contains($getFilierquery, 'WHERE') ? "AND" : "WHERE") . "(sigle LIKE :search_key OR wording LIKE :search_key)";
            $params['search_key'] = '%' . $search_key . '%';
        }
        //dd($getUserquery);
    }
}


$filiers = getList($db, $getFilierquery, $params);

require 'pages/filiers/index.page.php';
