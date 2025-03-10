<?php

const SUBMIT_VALUE = 'Mettre à jour';
$db = connectToDB();
$errors = [];

$post_data = $_POST;
$get_data = $_GET;
$server = $_SERVER;
$file_data = $_FILES;

$id = $get_data['id'];

$client = null;

try {
    $getCurrentClientQuery = "SELECT * FROM  clients WHERE id = :id";
    $client = getOne($db, $getCurrentClientQuery, ['id' => $id]);
} catch (\Throwable $th) {
    dd($th->getMessage());
}

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
                            'id' => $id,
                        ];
                        try {
                            $query = "UPDATE clients SET last_name = :last_name, first_name = :first_name, email = :email, phone = :phone WHERE id= :id";
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


require 'pages/clients/edit.page.php';
