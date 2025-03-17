<?php

$errors = [];
$post_data = $_POST;
$server = $_SERVER;
$file_data = $_FILES;
$form_name = 'create-logement';
$form_value = 'Enregistrer';


$rules = [
    'nom' => 'string',
    'capacite' => 'int',
    'type' => 'string',
    'lieu' => 'string',
];



if ($server['REQUEST_METHOD'] == "POST") {
    if (!isset($post_data[$form_name]) || $post_data[$form_name] !== $form_value) {
        $erros[] = 'Veuillez soumettre de forlumaire';
    } else {
        $validateData = validateData($_POST, $rules);
        if ($validateData['hasError']) {
            $errors = $validateData['errors'];
        }
        if (!$validateData['hasError']) {
            $datas = $validateData['datas'];
            try {
                $new_city = store("logements", $datas);
                header("Location: /");
            } catch (\Throwable $th) {
                dd($th->getMessage());
            }
        }
    }
};

page("logements/create.page.php", [
    'errors' => $errors,
    "post_datas" => $post_data,
    'form_name' => $form_name,
    'form_value' => $form_value,
]);
