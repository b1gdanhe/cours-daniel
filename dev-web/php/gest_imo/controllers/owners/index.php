<?php
$owners = [];
$params = [];

$post_data = $_POST;
$server = $_SERVER;
$delete_form_name = 'delete-owners';
$delete_form_value = 'Delete';

$search_form_name = 'search';
$search_form_value = 'Filter';

$clear_search_name = 'clear-search';
$clear_search_value = 'Clear';
$columnSelects = [
    'owners.quote_part',
    'owners.appartement_id',
    'owners.person_id',
    'appartements.number',
    'persons.lastname',
    'persons.firstname',
];




if ($server['REQUEST_METHOD'] === 'POST') {
    if (isset($post_data[$delete_form_name]) && $post_data[$delete_form_name] === $delete_form_value) {
        try {

            delete('owners', 'id',  $post_data['id']);
            header("Location: /owners");
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    if (isset($post_data[$search_form_name]) && $post_data[$search_form_name] === $search_form_value) {
        if ($search_key = validate($post_data['search_key'])) {
            //   $params['search_key'] = '%' . $search_key . '%';

            $owners =   all("owners", $params, $search_key, ['name', 'address'], [
                [
                    'table' => 'appartements',
                    'type' => 'INNER',
                    'on' => 'owners.appartement_id = appartements.id'
                ],
                [
                    'table' => 'persons',
                    'type' => 'INNER',
                    'on' => 'owners.person_id = persons.id'
                ]
            ]);
        }
    }
    if (isset($post_data[$clear_search_name]) && $post_data[$clear_search_name] === $clear_search_value) {
        unset($post_data['search_key']);
        try {
            $owners = all(
                "owners",
                $params,
                null,
                [],
                [
                    [
                        'table' => 'appartements',
                        'type' => 'INNER',
                        'on' => 'owners.appartement_id = appartements.id'
                    ],
                    [
                        'table' => 'persons',
                        'type' => 'INNER',
                        'on' => 'owners.person_id = persons.id'
                    ]

                ],
                $columnSelect
            );
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
} else {
    try {
        $owners = all(
            "owners",
            $params,
            null,
            [],
            [
                [
                    'table' => 'appartements',
                    'type' => 'INNER',
                    'on' => 'owners.appartement_id = appartements.id'
                ],
                [
                    'table' => 'persons',
                    'type' => 'INNER',
                    'on' => 'owners.person_id = persons.id'
                ]
            ],
            $columnSelects
        );
    } catch (\Throwable $th) {
        dd($th->getMessage());
    }
}



page("owners/index.page.php", [
    'owners' => $owners,


    'delete_form_name' => $delete_form_name,
    'delete_form_value' => $delete_form_value,

    'search_form_name' => $search_form_name,
    'search_form_value' => $search_form_value,

    'clear_search_name' => $clear_search_name,
    'clear_search_value' => $clear_search_value,
]);
