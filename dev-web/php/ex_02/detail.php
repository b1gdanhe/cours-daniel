<?php

require '../utils/functions.php';
require '../utils/database.php';
// $post_data = $_POST;
$server = $_SERVER;

$id = $_GET['id'];

$db  = connectToDB();
$sever_host = $_SERVER['HTTP_HOST'];
$query = 'SELECT * FROM users WHERE id = :id';
$user = getOne($db, $query, ['id' => $id]);

require 'detail.view.php';
