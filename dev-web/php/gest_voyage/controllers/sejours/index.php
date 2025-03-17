<?php
$sejours = [];
$params = [];

$post_data = $_POST;
$server = $_SERVER;
$delete_form_name = 'delete-sejours';
$delete_form_value = 'Delete';

$search_form_name = 'search';
$search_form_value = 'Filter';

$clear_search_name = 'clear-search';
$clear_search_value = 'Clear';
$relations = [
    [
        'table' => 'logements',
        'type' => 'INNER',
        'on' => 'sejours.code_logement = logements.code'
    ],
    [
        'table' => 'voyageurs',
        'type' => 'INNER',
        'on' => 'sejours.id_voyageur = voyageurs.id_voyageur'
    ]
];

$columnSelects = [
    'sejours.id_sejour',
    'sejours.debut',
    'sejours.fin',
    'sejours.id_voyageur',
    'sejours.code_logement',
    'logements.nom',
    'logements.capacite',
    'voyageurs.prenom',
];




if ($server['REQUEST_METHOD'] === 'POST') {
    if (isset($post_data[$delete_form_name]) && $post_data[$delete_form_name] === $delete_form_value) {
        try {
            delete('sejours', 'id_sejour',  $post_data['id_sejour']);
            header("Location: /sejours");
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    if (isset($post_data[$search_form_name]) && $post_data[$search_form_name] === $search_form_value) {
        if ($search_key = validate($post_data['search_key'])) {
            //   $params['search_key'] = '%' . $search_key . '%';

            $sejours =   all("sejours", $params, $search_key, ['debut', 'fin', 'logements.nom', 'voyageurs.prenom'], $relations, $columnSelects);
        }
    }
    if (isset($post_data[$clear_search_name]) && $post_data[$clear_search_name] === $clear_search_value) {
        unset($post_data['search_key']);
        try {
            $sejours = all(
                "sejours",
                $params,
                null,
                [],
                $relations,
                $columnSelect
            );
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
} else {
    try {
        $sejours = all(
            "sejours",
            $params,
            null,
            [],
            $relations,
            $columnSelects
        );
    } catch (\Throwable $th) {
        dd($th->getMessage());
    }
}


page("sejours/index.page.php", [
    'sejours' => $sejours,
    'delete_form_name' => $delete_form_name,
    'delete_form_value' => $delete_form_value,

    'search_form_name' => $search_form_name,
    'search_form_value' => $search_form_value,

    'clear_search_name' => $clear_search_name,
    'clear_search_value' => $clear_search_value,
]);
