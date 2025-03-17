<?php

$errors = [];
$immeubles = [];
$post_data = $_POST;
$server = $_SERVER;
$file_data = $_FILES;
$form_name = 'create-owner';
$form_value = 'Enregistrer';
$columnSelects3 = [
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
try {
    $appartements =   all(
        "appartements",
        [],
        null,
        ['name', 'address'],
        [
            [
                'table' => 'immeubles',
                'type' => 'INNER',
                'on' => 'appartements.immeuble_id = immeubles.id'
            ],
        ],
        $columnSelects2
    );
    $persons  = all(
        "persons",
        [],
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
        $columnSelects3
    );
} catch (\Throwable $th) {
    //throw $th;
}






if ($server['REQUEST_METHOD'] == "POST") {
    if (!isset($post_data[$form_name]) || $post_data[$form_name] !== $form_value) {
        $erros[] = 'Veuillez soumettre de forlumaire';
    } else {
        // dd($post_data['appartement_id']);
        $rules = [
            'appartement_id' => 'int|exists:appartements,id,' . $post_data['appartement_id'],
            'person_id' => 'int|exists:persons,id,' . $post_data['person_id'],
            'quote_part' => 'int',
        ];

        $validateData = validateData($post_data, $rules);
        if ($validateData['hasError']) {
            $errors = $validateData['errors'];
        }
        if (!$validateData['hasError']) {
            $datas = $validateData['datas'];
            try {

                $new_city = store("owners", $datas);
                header("Location: /owners");
            } catch (\Throwable $th) {
                dd($th->getMessage());
            }
        }
    }
};

page("owners/create.page.php", [
    'errors' => $errors,

    "post_datas" => $post_data,
    'form_name' => $form_name,
    'form_value' => $form_value,
    'appartements' => $appartements,
    'persons' => $persons

]);
