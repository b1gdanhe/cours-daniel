<?php

$db = connectToDb();
$getCurrentGarageQuery = "SELECT * FROM  garages WHERE id = :id";
$garage = getOne($db, $getCurrentGarageQuery, ['id' => $_GET['id']]);
require 'pages/garages/show.page.php';
