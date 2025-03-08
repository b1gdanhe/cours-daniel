<?php

$db = connectToDb();
$getCurrentFilierQuery = "SELECT * FROM filiers WHERE id = :id";
$filier = getOne($db, $getCurrentFilierQuery, ['id' => $_GET['id']]);

require 'pages/filiers/show.page.php';
