<?php
$currentPath =  parse_url($_SERVER['REQUEST_URI'])['path'];
?>

<nav class="navbar navbar-expand-lg bg-white  shadow-sm sticky-top">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link  <?= isCurrentUrl($currentPath, '/') ? 'active' : '' ?>" aria-current="<?= isCurrentUrl($currentPath, '/') ? 'page' : '' ?>" href="/">Voyageurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  <?= isCurrentUrl($currentPath, '/logements') ? 'active' : '' ?>" aria-current="<?= isCurrentUrl($currentPath, '/') ? 'page' : '' ?>" href="/logements">Logements</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  <?= isCurrentUrl($currentPath, '/sejours') ? 'active' : '' ?>" aria-current="<?= isCurrentUrl($currentPath, '/') ? 'page' : '' ?>" href="/sejours">Sejours</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  <?= isCurrentUrl($currentPath, '/owners') ? 'active' : '' ?>" aria-current="<?= isCurrentUrl($currentPath, '/') ? 'page' : '' ?>" href="/owners">Acitvités</a>
                </li>

            </ul>
            <!-- <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form> -->
        </div>
    </div>
</nav>