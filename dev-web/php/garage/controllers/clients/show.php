<?php

$getCurrentclientQuery = "SELECT * FROM  clients WHERE id = :id";
$client = one($getCurrentclientQuery, ['id' => $_GET['id']]);
page("clients/show.page.php", [
    'client' => $client
]);
