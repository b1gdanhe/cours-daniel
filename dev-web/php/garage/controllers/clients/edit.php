<?php
$post_data = $_POST;
$get_data = $_GET;
$server = $_SERVER;
$file_data = $_FILES;


const SUBMIT_VALUE = 'Mettre à jour';
$errors = [];
$id = $get_data['id'];
$client = null;

$rules = [
    'last_name' => 'string',
    'first_name' => 'string',
    'email' => 'email',
    'phone' => 'string'
];

try {
    $client = one("clients", "id", $id);
} catch (\Throwable $th) {
    dd($th->getMessage());
}

if ($server['REQUEST_METHOD'] == "POST") {
    if (!isset($post_data['my-create-client-form']) || $post_data['my-create-client-form'] !== SUBMIT_VALUE) {
        $errors[] = 'Veuillez soumettre de forlumaire';
    } else {

        $validateData = validateData($post_data, $rules);
        if ($validateData['hasError']) {
            $errors = $validateData['errors'];
        }
        if (!$validateData['hasError']) {
            $datas = $validateData['datas'];
            try {
                $new_city = update("clients",  $datas, "id", $id);
                header("Location: /");
            } catch (\Throwable $th) {
                dd($th->getMessage());
            }
        }
    }
};


page("clients/edit.page.php", [
    'client' => $client,
    'errors' => $errors
]);
