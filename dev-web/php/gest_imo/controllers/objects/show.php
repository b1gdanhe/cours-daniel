<?php

$getCurrentclientQuery = "SELECT * FROM  clients WHERE id = :id";
$client = one("objects", 'id', $_GET['id']);
page("objects/show.page.php", [
    'client' => $client
]);
