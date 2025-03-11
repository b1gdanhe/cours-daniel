<?php

const SUBMIT_VALUE = 'Enregistrer';
$errors = [];


$rules = [
    'last_name' => 'string',
    'first_name' => 'string',
    'email' => 'email',
    'phone' => 'string'
];

$post_data = $_POST;
$server = $_SERVER;
$file_data = $_FILES;


if ($server['REQUEST_METHOD'] == "POST") {
    if (!isset($post_data['my-create-client-form']) || $post_data['my-create-client-form'] !== SUBMIT_VALUE) {
        $erros[] = 'Veuillez soumettre de forlumaire';
    } else {
        $validateData = validateData($_POST, $rules);
        if ($validateData['hasError']) {
            $errors = $validateData['errors'];
        }
        if (!$validateData['hasError']) {
            $datas = $validateData['datas'];
            try {
                $new_city = store("clients", $datas);
                header("Location: /");
            } catch (\Throwable $th) {
                dd($th->getMessage());
            }
        }
    }
};

page("clients/create.page.php", [
    'errors' => $errors,
    "post_datas" => $post_data
]);
