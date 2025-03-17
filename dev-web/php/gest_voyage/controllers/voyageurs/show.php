<?php

$client = one("voyageurs", $_GET['id_voyageur'], 'id_voyageur');
page("voyageurs/show.page.php", [
    'client' => $client
]);
