<?php
require '../utils/functions.php';
$post_data = $_POST;
$get_data = $_GET;

$errors = [];
const SUBMIT_VALUE = 'Valider';
$displayInfo = false;


$users = [
    [
        'id' => 1,
        'last_name' => 'Toto',
        'first_name' => 'Momo',
        'description' => '',
        'degree' => 'BEPC',
        'age' => 23,
    ]
];
if (!isset($post_data['my-form-button']) ||  $post_data['my-form-button'] != SUBMIT_VALUE) {
    $displayInfo =  false;
    // echo 'Veuillez soumettre le formulaire';
} else {
    if ($last_name = validate($post_data['last_name'])) {
        if ($first_name = validate($post_data['first_name'])) {
            if ($description = validate($post_data['description'])) {
                if ($degree = validate($post_data['degree'])) {
                    if ($age = validate($post_data['age'])) {
                        $displayInfo = true;
                        $new_user = [
                            'id' => count($users) + 1,
                            'last_name' => $last_name,
                            'first_name' => $first_name,
                            'description' => $description,
                            'degree' => $degree,
                            'age' => $age,
                        ];
                        array_push($users,$new_user);
                    } else {
                        $errors['age'] = "L'âge est obligatoire";
                    }
                } else {
                    $errors['degree'] = "Le diplome est obligatoire";
                }
            } else {
                $errors['description'] = "La description est obligatoire";
            }
        } else {
            $errors['first_name'] = "Le prénom est obligatoire";
        }
    } else {
        $errors['last_name'] = "Le nom est obligatoire";
    }
}



require 'index.view.php';
