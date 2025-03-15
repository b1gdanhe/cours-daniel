<?php
$post_data = $_POST;
$get_data = $_GET;
$server = $_SERVER;
$file_data = $_FILES;
$form_name = 'edit-appartement';
$form_value = 'Mettre à jour';
$immeubles = all('immeubles');
$columnSelects = ['appartements.id', 'immeubles.name', 'appartements.level', 'appartements.area', 'appartements.number', "immeubles.address",  'appartements.immeuble_id'];


$errors = [];
$id = $get_data['id'];
$client = null;



try {
    $appartement = one(
        "appartements",
        $id,
        "id",
        [
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
            'number' => 'int',
            'area' => 'int',
            'level' => 'int',
            'immeuble_id' => 'exists:immeubles,id,' . $appartement['immeuble_id'],
        ];
        $validateData = validateData($post_data, $rules);
        if ($validateData['hasError']) {
            $errors = $validateData['errors'];
        }
        if (!$validateData['hasError']) {
            $datas = $validateData['datas'];
            try {
                $new_city = update("appartements",  $datas, "id", $id);
                header("Location: /appartements");
            } catch (\Throwable $th) {
                dd($th->getMessage());
            }
        }
    }
};

page("appartements/edit.page.php", [
    'immeubles' => $immeubles,
    'appartement' => $appartement,
    'errors' => $errors,
    'form_name' => $form_name,
    'form_value' => $form_value,
]);
