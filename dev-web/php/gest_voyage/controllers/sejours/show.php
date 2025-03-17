<?php

$client = one("immeubles", 'id', $_GET['id']);
page("immeubles/show.page.php", [
    'client' => $client
]);
