<?php

const SUBMIT_VALUE = 'Enregistrer';
$db = connectToDB();
$filiers = [];
$errors = [];

$post_data = $_POST;
$server = $_SERVER;
$file_data = $_FILES;

if ($server['REQUEST_METHOD'] == "POST") {
    if (!isset($post_data['my-create-client-form']) || $post_data['my-create-client-form'] !== SUBMIT_VALUE) {
        $erros[] = 'Veuillez soumettre de forlumaire';
    } else {
        if ($last_name = validate($post_data['last_name'])) {
            if ($first_name = validate($post_data['first_name'])) {
                if ($email = validate($post_data['email'])) {
                    if ($phone = validate($post_data['phone'])) {

                        $user_data = [
                            'last_name' => $last_name,
                            'first_name' => $first_name,
                            'email' => $email,
                            'phone' => $phone,
                        ];
                        try {
                            $query = "INSERT INTO clients (last_name, first_name, email, phone) VALUES (:last_name, :first_name, :email, :phone)";
                            $new_city = storeNew($db, $query, $user_data);
                            header("Location: /");
                        } catch (\Throwable $th) {
                            dd($th->getMessage());
                        }
                    } else {
                        $errors['phone'] = "Le téléphone est obligatoire";
                    }
                } else {
                    $errors['email'] = "L'email est obligatoire";
                }
            } else {
                $errors['first_name'] = "Le prénom est obligatoire";
            }
        } else {
            $errors['last_name'] = "Le nom est obligatoire";
        }
    }
};


require 'pages/clients/create.page.php';
