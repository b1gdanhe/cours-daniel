<?php
$persons = [];
$params = [];

$post_data = $_POST;
$server = $_SERVER;
$delete_form_name = 'delete-persons';
$delete_form_value = 'Delete';

$search_form_name = 'search';
$search_form_value = 'Filter';

$clear_search_name = 'clear-search';
$clear_search_value = 'Clear';
$columnSelects = [
    'persons.id',
    'persons.firstname',
    'persons.lastname',
    'persons.jobs',
    'persons.appartement_id',
    'immeubles.name',
    'appartements.number',
    'appartements.immeuble_id',

];

$columnSelects2 = ['appartements.id', 'immeubles.name', 'appartements.level', 'appartements.area', 'appartements.number', "immeubles.address",  'appartements.immeuble_id'];



if ($server['REQUEST_METHOD'] === 'POST') {
    if (isset($post_data[$delete_form_name]) && $post_data[$delete_form_name] === $delete_form_value) {
        try {

            delete('persons', 'id',  $post_data['id']);
            header("Location: /persons");
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    if (isset($post_data[$search_form_name]) && $post_data[$search_form_name] === $search_form_value) {
        if ($search_key = validate($post_data['search_key'])) {
            //   $params['search_key'] = '%' . $search_key . '%';

            $persons =   all("persons", $params, $search_key, ['firstname', 'lastname'], [
                [
                    'table' => 'appartements',
                    'type' => 'INNER',
                    'on' => 'persons.appartement_id = appartements.id'
                ],
                [
                    'table' => 'immeubles',
                    'type' => 'INNER',
                    'on' => 'appartements.immeuble_id = immeubles.id'
                ]
            ], $columnSelects);
        }
    }
    if (isset($post_data[$clear_search_name]) && $post_data[$clear_search_name] === $clear_search_value) {
        unset($post_data['search_key']);
        try {
            $persons = all(
                "persons",
                $params,
                null,
                [],
                [
                    [
                        'table' => 'appartements',
                        'type' => 'LEFT',
                        'on' => 'persons.appartement_id = appartements.id'
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
        $persons = all(
            "persons",
            $params,
            null,
            [],
            [
                [
                    'table' => 'appartements',
                    'type' => 'INNER',
                    'on' => 'persons.appartement_id = appartements.id'
                ],
                [
                    'table' => 'immeubles',
                    'type' => 'INNER',
                    'on' => 'appartements.immeuble_id = immeubles.id'
                ],
            ],
            $columnSelects
        );
    } catch (\Throwable $th) {
        dd($th->getMessage());
    }
}


page("persons/index.page.php", [
    'persons' => $persons,


    'delete_form_name' => $delete_form_name,
    'delete_form_value' => $delete_form_value,

    'search_form_name' => $search_form_name,
    'search_form_value' => $search_form_value,

    'clear_search_name' => $clear_search_name,
    'clear_search_value' => $clear_search_value,
]);
