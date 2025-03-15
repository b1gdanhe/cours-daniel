<?php

$client = one("voyageurs", 'id', $_GET['id']);
page("voyageurs/show.page.php", [
    'client' => $client
]);
