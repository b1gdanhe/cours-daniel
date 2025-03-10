<?php

const SUBMIT_VALUE = 'Enregistrer';
$db = connectToDB();
$filiers = [];
$errors = [];

$post_data = $_POST;
$server = $_SERVER;
$file_data = $_FILES;

if ($server['REQUEST_METHOD'] == "POST") {
    if (!isset($post_data['my-create-garage-form']) || $post_data['my-create-garage-form'] !== SUBMIT_VALUE) {
        $erros[] = 'Veuillez soumettre de forlumaire';
    } else {
        if ($name = validate($post_data['name'])) {
            if ($address = validate($post_data['address'])) {
                if ($phone = validate($post_data['phone'])) {

                    $user_data = [
                        'name' => $name,
                        'address' => $address,
                        'phone' => $phone,
                    ];
                    try {
                        $query = "INSERT INTO garages (name, address, phone) VALUES (:name, :address, :phone)";
                        $new_city = storeNew($db, $query, $user_data);
                        header("Location: /garages");
                    } catch (\Throwable $th) {
                        dd($th->getMessage());
                    }
                } else {
                    $errors['phone'] = "Le téléphone est obligatoire";
                }
            } else {
                $errors['address'] = "L'address est obligatoire";
            }
        } else {
            $errors['name'] = "Le nom est obligatoire";
        }
    }
};


require 'pages/garages/create.page.php';
