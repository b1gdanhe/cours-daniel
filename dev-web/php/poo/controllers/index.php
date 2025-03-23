<?php
class_path('implementation/Admin.php');
class_path('implementation/Seller.php');
class_path('interface/Exemple.php');

$admin = new Admin();
$seller = new Seller();
$seller2 = new Seller();
$seller->addProduct('Ordinateur Toshiba');
$seller2->addProduct('Mangue');
$seller2->addProduct('Bible');
$seller2->updateProduct('Bible', 'Bible Darby');
$seller2->deleteProduct2('Bible Darby');

$newB = new B();

dd($newB->gretting());

// dd($admin, $seller, $admin->product(), $seller->product() );
// dd($admin, $seller, $admin->product(), $seller->product() );

page('index.page.php', []);
