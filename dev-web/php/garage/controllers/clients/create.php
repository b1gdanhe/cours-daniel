<?php

const SUBMIT_VALUE = 'Enregistrer';
$filiers = [];
$errors = [];

$post_data = $_POST;
$server = $_SERVER;
$file_data = $_FILES;

if ($server['REQUEST_METHOD'] == "POST") {
    if (!isset($post_data['my-create-client-form']) || $post_data['my-create-client-form'] !== SUBMIT_VALUE) {
        $erros[] = 'Veuillez soumettre de forlumaire';
    } else {
        $rules = [
            'last_name' => 'string',
            'first_name' => 'string',
            'email' => 'email',
            'phone' => 'string'
        ];
        $validateData = validateData($_POST, $rules);
        if ($validateData['hasError']) {
            dd($validateData);
        } else {
            $datas = $validateData['datas'];
            dd($datas);
            try {
                $query = "INSERT INTO clients (last_name, first_name, email, phone) VALUES (:last_name, :first_name, :email, :phone)";
                $new_city = storeNew($db, $query, $datas);
                header("Location: /");
            } catch (\Throwable $th) {
                dd($th->getMessage());
            }
        }
    }
};


require 'pages/clients/create.page.php';
