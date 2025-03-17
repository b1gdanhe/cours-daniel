<?php
$post_data = $_POST;
$get_data = $_GET;
$server = $_SERVER;
$file_data = $_FILES;
$form_name = 'edit-logement';
$form_value = 'Mettre à jour';

$errors = [];
$id = $get_data['code'];
$client = null;

$rules = [
    'nom' => 'string',
    'capacite' => 'int',
    'type' => 'string',
    'lieu' => 'string',
];

try {
    $logement = one("logements", $id, "code");
} catch (\Throwable $th) {
    dd($th->getMessage());
}

if ($server['REQUEST_METHOD'] == "POST") {
    if (!isset($post_data[$form_name]) || $post_data[$form_name] !== $form_value) {
        $errors[] = 'Veuillez soumettre de forlumaire';
    } else {
        $validateData = validateData($post_data, $rules);
        if ($validateData['hasError']) {
            $errors = $validateData['errors'];
        }
        if (!$validateData['hasError']) {
            $datas = $validateData['datas'];
            try {
                $new_city = update("logements",  $datas, "code", $id);
                header("Location: /logements");
            } catch (\Throwable $th) {
                dd($th->getMessage());
            }
        }
    }
};

page("logements/edit.page.php", [
    'logement' => $logement,
    'errors' => $errors,
    'form_name' => $form_name,
    'form_value' => $form_value,
]);
