<?php

$errors = [];
$immeubles = [];
$post_data = $_POST;
$server = $_SERVER;
$file_data = $_FILES;
$form_name = 'create-appartement';
$form_value = 'Enregistrer';

$immeubles = all('immeubles');





if ($server['REQUEST_METHOD'] == "POST") {
    if (!isset($post_data[$form_name]) || $post_data[$form_name] !== $form_value) {
        $erros[] = 'Veuillez soumettre de forlumaire';
    } else {
        $rules = [
            'number' => 'int',
            'area' => 'int',
            'level' => 'int',
            'immeuble_id' => 'int|exists:immeubles,id,' . $post_data['immeuble_id'],
        ];

        $validateData = validateData($post_data, $rules);
        if ($validateData['hasError']) {
            $errors = $validateData['errors'];
        }
        if (!$validateData['hasError']) {
            $datas = $validateData['datas'];
            try {
                $new_city = store("appartements", $datas);
                header("Location: /");
            } catch (\Throwable $th) {
                dd($th->getMessage());
            }
        }
    }
};

page("appartements/create.page.php", [
    'errors' => $errors,
    "post_datas" => $post_data,
    'form_name' => $form_name,
    'form_value' => $form_value,
    'immeubles' => $immeubles
]);
