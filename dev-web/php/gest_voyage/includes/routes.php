<?php

return [
    '/' => controller("voyageurs/index.php"),
    '/voyageurs' => controller("voyageurs/index.php"),
    '/voyageurs/create' => controller("voyageurs/create.php"),
    '/voyageurs/edit' => controller("voyageurs/edit.php"),
    '/voyageurs/show' => controller("voyageurs/show.php"),

    '/logements' => controller("logements/index.php"),
    '/logements' => controller("logements/index.php"),
    '/logements/create' => controller("logements/create.php"),
    '/logements/edit' => controller("logements/edit.php"),
    '/logements/show' => controller("logements/show.php"),

    // '/persons' => controller("persons/index.php"),
    // '/persons' => controller("persons/index.php"),
    // '/persons/create' => controller("persons/create.php"),
    // '/persons/edit' => controller("persons/edit.php"),
    // '/persons/show' => controller("persons/show.php"),

    '/sejours' => controller("sejours/index.php"),
    '/sejours' => controller("sejours/index.php"),
    '/sejours/create' => controller("sejours/create.php"),
    '/sejours/edit' => controller("sejours/edit.php"),
    '/sejours/show' => controller("sejours/show.php"),
];
