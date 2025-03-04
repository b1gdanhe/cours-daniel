<?php
require '../utils/functions.php';
require '../utils/database.php';

const SUBMIT_VALUE = 'Valider';

$post_data = $_POST;
$get_data = $_GET;
$file_data = $_FILES;
$errors = [];
$displayInfo = false;
$db  = connectToDB();




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
                            if ($profile_image = validateFile($file_data['profile_image'])) {
                                $displayInfo = true;
                                $destination = './public/uploads/' . $degree_file['name'];
                                $destination_image = './public/uploads/' . $profile_image['name'];
                                try {
                                    storeFile($degree_file['tmp_name'], $destination);
                                    storeFile($profile_image['tmp_name'], $destination_image);
                                } catch (\Throwable $th) {
                                    dd($th->getMessage());
                                }

                                $user_data = [
                                    'last_name' => $last_name,
                                    'first_name' => $first_name,
                                    'description' => $description,
                                    'degree' => $degree,
                                    'age' => $age,
                                    'degree_file' => $destination,
                                    'profile_image_url' => $destination_image
                                ];
                                try {
                                    $query = "INSERT INTO users (last_name, first_name, description, degree, age, degree_file, profile_image_url) VALUES (:last_name, :first_name, :description, :degree, :age, :degree_file, :profile_image_url)";
                                    $new_city = storeNew($db, $query, $user_data);
                                    header("Location: ./list.php");
                                } catch (\Throwable $th) {
                                    dd($th->getMessage());
                                }
                            } else {
                                $errors['profile_image'] = "Le fichier de l'image est obligatoire ou n'a pas le bon type";
                            }
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
