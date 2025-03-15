<?php
$appartements = [];
$params = [];

$post_data = $_POST;
$server = $_SERVER;
$delete_form_name = 'delete-appartements';
$delete_form_value = 'Delete';

$search_form_name = 'search';
$search_form_value = 'Filter';

$clear_search_name = 'clear-search';
$clear_search_value = 'Clear';
$columnSelects = ['appartements.id', 'immeubles.name', 'appartements.level', 'appartements.area', 'appartements.number', "immeubles.address",  'appartements.immeuble_id'];

if ($server['REQUEST_METHOD'] === 'POST') {
    if (isset($post_data[$delete_form_name]) && $post_data[$delete_form_name] === $delete_form_value) {
        try {

            delete('appartements', 'id',  $post_data['id']);
            header("Location: /appartements");
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    if (isset($post_data[$search_form_name]) && $post_data[$search_form_name] === $search_form_value) {
        if ($search_key = validate($post_data['search_key'])) {
            //   $params['search_key'] = '%' . $search_key . '%';


            $appartements =   all("appartements", $params, $search_key, ['name', 'address'], [
                [
                    'table' => 'immeubles',
                    'type' => 'INNER',
                    'on' => 'appartements.immeuble_id = immeubles.id'
                ]
            ]);
        }
    }
    if (isset($post_data[$clear_search_name]) && $post_data[$clear_search_name] === $clear_search_value) {
        unset($post_data['search_key']);
        try {
            $appartements = all(
                "appartements",
                $params,
                null,
                [],
                [
                    [
                        'table' => 'immeubles',
                        'type' => 'LEFT',
                        'on' => 'appartements.immeuble_id = immeubles.id'
                    ],

                ],
                $columnSelect
            );
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
} else {
    try {
        $appartements = all(
            "appartements",
            $params,
            null,
            [],
            [
                [
                    'table' => 'immeubles',
                    'type' => 'LEFT',
                    'on' => 'appartements.immeuble_id = immeubles.id'
                ],
            ],
            $columnSelects
        );
    } catch (\Throwable $th) {
        dd($th->getMessage());
    }
}


//dd($appartements);

page("appartements/index.page.php", [
    'appartements' => $appartements,

    'delete_form_name' => $delete_form_name,
    'delete_form_value' => $delete_form_value,

    'search_form_name' => $search_form_name,
    'search_form_value' => $search_form_value,

    'clear_search_name' => $clear_search_name,
    'clear_search_value' => $clear_search_value,
]);
