<?php

$getCurrentclientQuery = "SELECT * FROM  clients WHERE id = :id";
$client = one( $getCurrentclientQuery, ['id' => $_GET['id']]);
require 'pages/clients/show.page.php';
