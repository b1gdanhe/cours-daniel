<?php
$immeubles = [];
$params = [];

$post_data = $_POST;
$server = $_SERVER;
$delete_form_name = 'delete-immeubles';
$delete_form_value = 'Delete';

$search_form_name = 'search';
$search_form_value = 'Filter';

$clear_search_name = 'clear-search';
$clear_search_value = 'Clear';

if ($server['REQUEST_METHOD'] === 'POST') {
    if (isset($post_data[$delete_form_name]) && $post_data[$delete_form_name] === $delete_form_value) {
        try {
            delete('immeubles', 'id',  $post_data['id']);
            header("Location: /");
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    if (isset($post_data[$search_form_name]) && $post_data[$search_form_name] === $search_form_value) {
        if ($search_key = validate($post_data['search_key'])) {
            //   $params['search_key'] = '%' . $search_key . '%';
            $immeubles = all("immeubles", $params, $search_key, ['name', 'address']);
        }
    }
    if (isset($post_data[$clear_search_name]) && $post_data[$clear_search_name] === $clear_search_value) {
        unset($post_data['search_key']);
        try {
            $immeubles = all("immeubles", $params);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
} else {
    try {
        $immeubles = all("immeubles", $params);
    } catch (\Throwable $th) {
        dd($th->getMessage());
    }
}




page("immeubles/index.page.php", [
    'immeubles' => $immeubles,

    'delete_form_name' => $delete_form_name,
    'delete_form_value' => $delete_form_value,

    'search_form_name' => $search_form_name,
    'search_form_value' => $search_form_value,

    'clear_search_name' => $clear_search_name,
    'clear_search_value' => $clear_search_value,
]);
