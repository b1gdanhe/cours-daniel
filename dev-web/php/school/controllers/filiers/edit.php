<?php

const SUBMIT_VALUE = 'Mettre à jour';
$db = connectToDB();
$filiers = [];
$errors = [];

$post_data = $_POST;
$get_data = $_GET;
$server = $_SERVER;
$file_data = $_FILES;

$getCurrentFilierQuery = "SELECT * FROM  students, filiers WHERE id = :id";
$filier = getOne($db, $getCurrentFilierQuery, ['id' => $get_data['id']]);
if ($server['REQUEST_METHOD'] == "POST") {
    if (!isset($post_data['my-edit-filier-form']) || $post_data['my-edit-filier-form'] !== SUBMIT_VALUE) {
        $erros[] = 'Veuillez soumettre de forlumaire';
    } else {
        if ($sigle = validate($post_data['sigle'])) {
            if ($wording = validate($post_data['wording'])) {
                $user_data = [
                    'sigle' => $sigle,
                    'wording' => $wording,
                    'id' => $get_data['id'],
                ];
                try {
                    $query = "UPDATE filiers SET sigle  = :sigle, wording = :wording WHERE id = :id";
                    $new_city = storeNew($db, $query, $user_data);
                    header("Location: /filiers");
                } catch (\Throwable $th) {
                    dd($th->getMessage());
                }
            } else {
                $errors['wording'] = "Le libellé est obligatoire";
            }
        } else {
            $errors['sigle'] = "Le sigle est obligatoire";
        }
    }
};

$filierQuery = "SELECT * FROM filiers";
$filiers  = getList($db, $filierQuery);


require 'pages/filiers/edit.page.php';
