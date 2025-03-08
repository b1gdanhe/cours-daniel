<?php

const SUBMIT_VALUE = 'Enregistrer';
$db = connectToDB();
$filiers = [];
$errors = [];

$post_data = $_POST;
$server = $_SERVER;
$file_data = $_FILES;

if ($server['REQUEST_METHOD'] == "POST") {
    if (!isset($post_data['my-create-filier-form']) || $post_data['my-create-filier-form'] !== SUBMIT_VALUE) {
        $erros[] = 'Veuillez soumettre de forlumaire';
    } else {
        if ($sigle = validate($post_data['sigle'])) {
            if ($wording = validate($post_data['wording'])) {
                $user_data = [
                    'sigle' => $sigle,
                    'wording' => $wording,
                ];
                try {
                    $query = "INSERT INTO filiers (sigle, wording) VALUES (:sigle, :wording)";
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


require 'pages/filiers/create.page.php';
