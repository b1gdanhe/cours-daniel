<?php

return [
    '/' => controller("immeubles/index.php"),
    '/immeubles' => controller("immeubles/index.php"),
    '/immeubles/create' => controller("immeubles/create.php"),
    '/immeubles/edit' => controller("immeubles/edit.php"),
    '/immeubles/show' => controller("immeubles/show.php"),

    '/appartements' => controller("appartements/index.php"),
    '/appartements' => controller("appartements/index.php"),
    '/appartements/create' => controller("appartements/create.php"),
    '/appartements/edit' => controller("appartements/edit.php"),
    '/appartements/show' => controller("appartements/show.php"),

    '/persons' => controller("persons/index.php"),
    '/persons' => controller("persons/index.php"),
    '/persons/create' => controller("persons/create.php"),
    '/persons/edit' => controller("persons/edit.php"),
    '/persons/show' => controller("persons/show.php"),

    '/owners' => controller("owners/index.php"),
    '/owners' => controller("owners/index.php"),
    '/owners/create' => controller("owners/create.php"),
    '/owners/edit' => controller("owners/edit.php"),
    '/owners/show' => controller("owners/show.php"),
];
