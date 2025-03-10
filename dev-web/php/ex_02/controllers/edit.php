<?php
require '../utils/database.php';

$post_data = $_POST;
$server = $_SERVER;
$id = $_GET['id'];

$db  = connectToDB();
$sever_host = $_SERVER['HTTP_HOST'];
$query = 'SELECT * FROM users WHERE id = :id';
$user = getOne($db, $query, ['id' => $id]);
if (!$user) {
    $errors = '';
} else {
    $request = $_REQUEST;
    $first_name =  $user['first_name'];
    $last_name =  $user['last_name'];
    $degree =  $user['degree'];
    $age =  $user['age'];
    $description =  $user['description'];
    $profile_image_url =  $user['profile_image_url'];
    $degree_file =  $user['degree_file'];
}


$errors = [];
const SUBMIT_VALUE = 'Modifier';
$displayInfo = false;

function selectedDegree($currentDegree, $degree)
{
    return $degree ===  $currentDegree;
}

if ($server['REQUEST_METHOD'] === 'POST') {

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
                            $user_data = [
                                'last_name' => $last_name,
                                'first_name' => $first_name,
                                'description' => $description,
                                'degree' => $degree,
                                'age' => $age,
                                'id' => $id
                            ];
                            try {
                                $query = "UPDATE users SET last_name = :last_name, first_name = :first_name, description = :description, degree = :degree, age = :age WHERE id = :id";
                                $new_city = storeNew($db, $query, $user_data);
                                header("Location: /list");
                            } catch (\Throwable $th) {
                                dd($th->getMessage());
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
}
require 'views/edit.view.php';
