<?php
$post_data = $_POST;
$get_data = $_GET;
$server = $_SERVER;
$file_data = $_FILES;
$form_name = 'edit-person';
$form_value = 'Mettre à jour';
$columnSelects2 = ['appartements.id', 'immeubles.name', 'appartements.level', 'appartements.area', 'appartements.number', "immeubles.address",  'appartements.immeuble_id'];

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


$errors = [];
$id = $get_data['id'];
$client = null;

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


try {
    $person = one(
        "persons",
        $id,
        "id",
        [
            [
                'table' => 'appartements',
                'type' => 'INNER',
                'on' => 'persons.appartement_id = appartements.id',
            ],
            [
                'table' => 'immeubles',
                'type' => 'INNER',
                'on' => 'appartements.immeuble_id = immeubles.id',
            ]
        ],
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
           // dd($datas);
            $datas = $validateData['datas'];
            try {
                $new_city = update("persons",  $datas, "id", $id);
                header("Location: /persons");
            } catch (\Throwable $th) {
                dd($th->getMessage());
            }
        }
    }
};
page("persons/edit.page.php", [
    'appartements' => $appartements,
    'person' => $person,
    'errors' => $errors,
    'form_name' => $form_name,
    'form_value' => $form_value,
]);
