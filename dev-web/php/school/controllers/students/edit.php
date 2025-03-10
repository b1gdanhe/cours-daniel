<?php

const SUBMIT_VALUE = 'Mettre à jour';
$db = connectToDB();
$filiers = [];
$errors = [];
$student = null;

$post_data = $_POST;
$get_data = $_GET;
$server = $_SERVER;
$file_data = $_FILES;

$getCurrentStudentQuery = "SELECT * FROM  students, filiers WHERE matricule = :matricule";
$student = getOne($db, $getCurrentStudentQuery, ['matricule' => $get_data['matricule']]);
if ($server['REQUEST_METHOD'] == "POST") {
    if (!isset($post_data['my-edit-student-form']) || $post_data['my-edit-student-form'] !== SUBMIT_VALUE) {
        $erros[] = 'Veuillez soumettre de forlumaire';
    } else {
        if ($last_name = validate($post_data['last_name'])) {
            if ($first_name = validate($post_data['first_name'])) {
                if ($email = validate($post_data['email'])) {
                    if (($filier = validate($post_data['filier'])) && existInTable('filiers', 'id', $post_data['filier'])) {
                        if (($photo = validateFile($file_data['photo'])) || $student['photo'] != null) {
                            $destination =  $photo  == false ? $student['photo'] : './public/uploads/' . $photo['name'] ;
                            if ($photo) {
                                try {
                                    storeFile($photo['tmp_name'], $destination);
                                } catch (\Throwable $th) {
                                    dd($th->getMessage());
                                }
                            }

                            $user_data = [
                                'last_name' => $last_name,
                                'first_name' => $first_name,
                                'email' => $email,
                                'filier_id' => $filier,
                                'photo' => $destination ?? $student['photo'],
                                'matricule' => $get_data['matricule'],
                            ];
                            //  dd($user_data);
                            try {
                                $query = "UPDATE students SET last_name = :last_name, first_name = :first_name, email = :email, filier_id = :filier_id, photo = :photo WHERE matricule = :matricule";
                                $updated_user = storeNew($db, $query, $user_data);
                                header("Location: /");
                            } catch (\Throwable $th) {
                                dd($th->getMessage());
                            }
                        } else {
                            $errors['photo'] = "Le fichier de l'image est obligatoire ou n'a pas le bon type";
                        }
                    } else {
                        $errors['filier'] = "Le filier est obligatoire";
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

$filierQuery = "SELECT * FROM filiers";
$filiers  = getList($db, $filierQuery);


require 'pages/students/edit.page.php';
