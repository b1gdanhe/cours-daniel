<?php
$currentPath = parse_url($_SERVER['REQUEST_URI'])['path'];
$navUrls = [

    [
        'name' => 'Auteurs',
        'url' => '/',
    ],
    [
        'name' => 'Editeurs',
        'url' => '/editeurs',
    ],
    [
        'name' => 'Etudiants',
        'url' => '/etudiants',
    ],
    [
        'name' => 'Livres',
        'url' => '/livres',
    ],

];
?>
<nav class="d-flex flex-column flex-shrink-0 p-3 bg-white shadow-sm" style="width: 280px; height:100dvh">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <span class="fs-4">Biblio</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <?php foreach ($navUrls as $navUrl): ?>
            <li class="nav-item">
                <a class="nav-link nav-pills-link-active-bg-secondary <?= isCurrentUrl($currentPath, $navUrl['url']) ? 'active' : '' ?>" aria-current="<?= isCurrentUrl($currentPath, $navUrl['url']) ? 'page' : '' ?>" href="<?= $navUrl['url'] ?>">
                    <?= $navUrl['name'] ?>
                </a>
            </li>
        <?php endforeach ?>

    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong>mdo</strong>
        </a>
        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
            <li><a class="dropdown-item" href="#">New project...</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#">Sign out</a></li>
        </ul>
    </div>
</nav>