<?php

$errors = [];
$immeubles = [];
$post_data = $_POST;
$server = $_SERVER;
$file_data = $_FILES;
$form_name = 'create-sejour';
$form_value = 'Enregistrer';

$columnLogement = [
    'logements.code',
    'logements.nom',
];

$columnVoyageur = [
    'voyageurs.id_voyageur',
    'voyageurs.nom',
    'voyageurs.prenom',
];

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






if ($server['REQUEST_METHOD'] == "POST") {
    if (!isset($post_data[$form_name]) || $post_data[$form_name] !== $form_value) {
        $erros[] = 'Veuillez soumettre de forlumaire';
    } else {
        // dd($post_data['code_logement']);
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
            $datas = $validateData['datas'];
            try {
                $new_city = store("sejours", $datas);
                header("Location: /sejours");
            } catch (\Throwable $th) {
                dd($th->getMessage());
            }
        }
    }
};

page("sejours/create.page.php", [
    'errors' => $errors,

    "post_datas" => $post_data,
    'form_name' => $form_name,
    'form_value' => $form_value,
    'logements' => $logements,
    'voyageurs' => $voyageurs,
]);
