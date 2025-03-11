<?php

const SUBMIT_VALUE = 'Mettre à jour';
$errors = [];

$post_data = $_POST;
$get_data = $_GET;
$server = $_SERVER;
$file_data = $_FILES;

$id = $get_data['id'];

$car = null;

try {
    $getCurrentCarQuery = "SELECT * FROM  cars WHERE id = :id";
    $car = one( $getCurrentCarQuery, ['id' => $id]);
} catch (\Throwable $th) {
    dd($th->getMessage());
}

if ($server['REQUEST_METHOD'] == "POST") {
    if (!isset($post_data['my-edit-car-form']) || $post_data['my-edit-car-form'] !== SUBMIT_VALUE) {
        $erros[] = 'Veuillez soumettre de forlumaire';
    } else {
        if ($name = validate($post_data['name'])) {
            if ($address = validate($post_data['address'])) {
                if ($phone = validate($post_data['phone'])) {

                    $user_data = [
                        'name' => $name,
                        'address' => $address,
                        'phone' => $phone,
                        'id' => $id,
                    ];
                    try {
                        $query = "UPDATE cars SET name = :name, address = :address, phone = :phone WHERE id= :id";
                        $new_city = storeNew($db, $query, $user_data);
                        header("Location: /cars");
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


require 'pages/garages/edit.page.php';
