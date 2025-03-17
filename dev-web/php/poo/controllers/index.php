<?php
class_path('Account.php');
class_path('Human.php');

$account = new Account('DANHIN', 'Bignon Elie', 'bigdanhe@gmail.com');
$account->setSolde(200);
$account->retrait(50);
$account->depot(50);

$humain = new Humain();

$humain->setNom('DANHIN');
// retour de la vue
page('index.page.php', [
    'account' => $account,
    'humain' => $humain
]);
