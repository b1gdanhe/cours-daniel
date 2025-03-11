<?php

$getCurrentGarageQuery = "SELECT * FROM  garages WHERE id = :id";
$garage = one( $getCurrentGarageQuery, ['id' => $_GET['id']]);
require 'pages/garages/show.page.php';
