<?php

$db = connectToDb();
$getCurrentclientQuery = "SELECT * FROM  clients WHERE id = :id";
$client = getOne($db, $getCurrentclientQuery, ['id' => $_GET['id']]);
require 'pages/clients/show.page.php';
