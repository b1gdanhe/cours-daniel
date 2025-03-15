<?php

$errors = [];
$immeubles = [];
$post_data = $_POST;
$server = $_SERVER;
$file_data = $_FILES;
$form_name = 'create-person';
$form_value = 'Enregistrer';

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
} catch (\Throwable $th) {
    //throw $th;
}






if ($server['REQUEST_METHOD'] == "POST") {
    if (!isset($post_data[$form_name]) || $post_data[$form_name] !== $form_value) {
        $erros[] = 'Veuillez soumettre de forlumaire';
    } else {
       // dd($post_data['appartement_id']);
        $rules = [
            'lastname' => 'string',
            'firstname' => 'string',
            'jobs' => 'string',
            'appartement_id' => 'int|exists:appartements,id,' . $post_data['appartement_id'],
        ];

        $validateData = validateData($post_data, $rules);
        if ($validateData['hasError']) {
            $errors = $validateData['errors'];
        }
        if (!$validateData['hasError']) {
            $datas = $validateData['datas'];
            try {

                $new_city = store("persons", $datas);
                header("Location: /persons");
            } catch (\Throwable $th) {
                dd($th->getMessage());
            }
        }
    }
};

page("persons/create.page.php", [
    'errors' => $errors,

    "post_datas" => $post_data,
    'form_name' => $form_name,
    'form_value' => $form_value,
    'appartements' => $appartements
]);
