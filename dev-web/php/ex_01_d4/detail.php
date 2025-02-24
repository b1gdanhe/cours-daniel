<?php

require '../utils/functions.php';
// $post_data = $_POST;
$server = $_SERVER;

$request = $_REQUEST;
$first_name =  $request['first_name'];
$last_name =  $request['last_name'];
$degree =  $request['degree'];
$age =  $request['age'];
$description =  $request['description'];
$errors = [];


require 'detail.view.php';
