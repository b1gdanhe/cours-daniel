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
const SUBMIT_VALUE = 'Valider';
$displayInfo = false;

function selectedDegree($currentDegree, $degree)
{
    return $degree ===  $currentDegree;
}

if ($server['REQUEST_METHOD'] === 'POST') {
    dd($post_data);
}
require 'views/edit.view.php';
