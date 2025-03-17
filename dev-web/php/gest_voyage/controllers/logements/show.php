<?php

$logement = one("logements",$_GET['code'], 'code');
page("logements/show.page.php", [
    'logement' => $logement
]);
