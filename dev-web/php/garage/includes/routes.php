<?php

return [
    '/' => controller("clients/index.php"),
    '/clients/create' => controller("clients/create.php"),
    '/clients/edit' => controller("clients/edit.php"),
    '/clients/show' => controller("clients/show.php"),

    '/garages' => controller("garages/index.php"),
    '/garages/create' => controller("garages/create.php"),
    '/garages/edit' => controller("garages/edit.php"),
    '/garages/show' => controller("garages/show.php"),

    '/cars' => controller("cars/index.php"),
    '/cars/create' => controller("cars/create.php"),
    '/cars/edit' => controller("cars/edit.php"),
    '/cars/show' => controller("cars/show.php"),
];
