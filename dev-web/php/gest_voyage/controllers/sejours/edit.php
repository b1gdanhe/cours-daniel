<?php
$post_data = $_POST;
$get_data = $_GET;
$server = $_SERVER;
$file_data = $_FILES;
$form_name = 'edit-sejour';
$form_value = 'Mettre à jour';
$columnLogement = [
    'logements.code',
    'logements.nom',
];

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

$columnVoyageur = [
    'voyageurs.id_voyageur',
    'voyageurs.nom',
    'voyageurs.prenom',
];


$errors = [];
$id = $get_data['id_sejour'];
$client = null;

try {
    $logements =   all(
        "logements",
        [],
        null,
        [],
        [],
        $columnLogement
    );
    $voyageurs =   all(
        "voyageurs",
        [],
        null,
        [],
        [],
        $columnVoyageur
    );
} catch (\Throwable $th) {
    //throw $th;
}

try {
    $sejour = one(
        "sejours",
        $id,
        "id_sejour",
        $relations,
        $columnSelects
    );
} catch (\Throwable $th) {
    dd($th->getMessage());
}

if ($server['REQUEST_METHOD'] == "POST") {

    if (!isset($post_data[$form_name]) || $post_data[$form_name] !== $form_value) {
        $errors[] = 'Veuillez soumettre de forlumaire';
    } else {
        $rules = [
            'fin' => '',
            'debut' => '',
            'id_voyageur' => 'int|exists:voyageurs,id_voyageur,' . $post_data['id_voyageur'],
            'code_logement' => 'int|exists:logements,code,' . $post_data['code_logement'],
        ];
        $validateData = validateData($post_data, $rules);
        if ($validateData['hasError']) {
            $errors = $validateData['errors'];
        }
        if (!$validateData['hasError']) {
            // dd($datas);
            $datas = $validateData['datas'];
            try {
                $new_city = update("sejours",  $datas, "id_sejour", $id);
                header("Location: /sejours");
            } catch (\Throwable $th) {
                dd($th->getMessage());
            }
        }
    }
};
page("sejours/edit.page.php", [
    'logements' => $logements,
    'voyageurs' => $voyageurs,
    'sejour' => $sejour,
    'errors' => $errors,
    'form_name' => $form_name,
    'form_value' => $form_value,
]);
