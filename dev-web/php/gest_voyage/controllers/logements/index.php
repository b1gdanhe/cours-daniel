<?php
$logements = [];
$params = [];

$post_data = $_POST;
$server = $_SERVER;
$delete_form_name = 'delete-logements';
$delete_form_value = 'Delete';

$search_form_name = 'search';
$search_form_value = 'Filter';

$clear_search_name = 'clear-search';
$clear_search_value = 'Clear';


if ($server['REQUEST_METHOD'] === 'POST') {
    if (isset($post_data[$delete_form_name]) && $post_data[$delete_form_name] === $delete_form_value) {
        try {
            delete('logements', 'id_logement',  $post_data['id_logement']);
            header("Location: /");
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    if (isset($post_data[$search_form_name]) && $post_data[$search_form_name] === $search_form_value) {
        if ($search_key = validate($post_data['search_key'])) {
            //   $params['search_key'] = '%' . $search_key . '%';
            $logements = all("logements", $params, $search_key, ['nom', 'lieu']);
        }
    }
    if (isset($post_data[$clear_search_name]) && $post_data[$clear_search_name] === $clear_search_value) {
        unset($post_data['search_key']);
        try {
            $logements = all("logements", $params);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
} else {
    try {
        $logements = all("logements", $params);
    } catch (\Throwable $th) {
        dd($th->getMessage());
    }
}




page("logements/index.page.php", [
    'logements' => $logements,

    'delete_form_name' => $delete_form_name,
    'delete_form_value' => $delete_form_value,

    'search_form_name' => $search_form_name,
    'search_form_value' => $search_form_value,

    'clear_search_name' => $clear_search_name,
    'clear_search_value' => $clear_search_value,
]);
