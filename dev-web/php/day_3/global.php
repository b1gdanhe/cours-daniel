<?php

$post_data = $_POST;
$post_errors = [];
const SUBMIT_VALUE = 'SOUMETTRE';
//print_r($post_data);
if (!isset($post_data['my-form-button']) ||  $post_data['my-form-button'] != SUBMIT_VALUE) {
    echo 'Veuillez soumettre le formulaire';
    return;
} else {
    if (!isset($post_data['username']) || empty($post_data['username'])) {
        echo "Le nom d'utilisateur esr obligatoire<br>";
    } else {
        $username = $post_data['username'];
        echo "Nom $username<br>";
    }
    if (!isset($post_data['password']) || empty($post_data['password'])) {
        echo "Le mot de passe esr obligatoire<br>";
    } else {
        $password = $post_data['password'];
        echo "Mot de passe $password<br>";
    }
}
