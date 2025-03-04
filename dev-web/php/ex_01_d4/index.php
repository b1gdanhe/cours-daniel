<?php
require '../utils/functions.php';
require '../utils/database.php';

$db  = connectToDB();

$query1 = 'SELECT * FROM city_listings';
$query2 = 'SELECT * FROM city_listings WHERE size_km2 > ?';
$query3 = 'SELECT * FROM city_listings WHERE size_km2 BETWEEN  ? AND ?';
$query4 = 'INSERT INTO city_listings (city, size_km2, mayor) VALUES (:city, :size_km2, :mayor)';

$params = [3000];
$params2 = [3000, 5000];
$params3 = [
    'city' => 'Kouandé',
    'size_km2' => 4000,
    'mayor' => 'Baganan',
];

$city_listings = getList($db, $query1);
$city_listing_size_more_3000 = getList($db, $query2, $params);
$city_listing_size_bw_3000_5000 = getList($db, $query3, $params2);
//$new_city = storeNew($db, $query4, $params3);
dd($city_listings);
$post_data = $_POST;
$get_data = $_GET;
$file_data = $_FILES;

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
                        if ($degree_file = validateFile($file_data['degree_file'])) {
                            $displayInfo = true;

                            storeFile($degree_file['tmp_name'], './public/uploads/' . $degree_file['name']);
                            $new_user = [
                                'id' => count($users) + 1,
                                'last_name' => $last_name,
                                'first_name' => $first_name,
                                'description' => $description,
                                'degree' => $degree,
                                'age' => $age,
                            ];
                            array_push($users, $new_user);
                        } else {
                            $errors['degree_file'] = "Le fichier du diplome est obligatoire ou n'a pas le bon type";
                        }
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
