<?php
$post_data = $_POST;
$get_data = $_GET;
$server = $_SERVER;
$file_data = $_FILES;
$form_name = 'edit-voyageur';
$form_value = 'Mettre à jour';

$errors = [];
$id = $get_data['id'];
$client = null;

$rules = [
    'name' => 'string',
    'address' => 'string',
];

try {
    $voyageur = one("voyageurs", "id", $id);
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
                $new_city = update("voyageurs",  $datas, "id", $id);
                header("Location: /");
            } catch (\Throwable $th) {
                dd($th->getMessage());
            }
        }
    }
};

page("voyageurs/edit.page.php", [
    'voyageur' => $voyageur,
    'errors' => $errors,
    'form_name' => $form_name,
    'form_value' => $form_value,
]);
