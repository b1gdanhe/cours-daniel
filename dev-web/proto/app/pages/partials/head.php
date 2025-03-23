<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= asset('css/bootstrap.min.css') ?>">
    <title>Document</title>
    <style>
        .nav-link {
            color: #6c757d;
        }

        .nav-link:hover {
            color:#000000 !important;
        }

        .nav-link.active {
            color: white;
            background-color: #6c757d !important;
        }

        .nav-link.active:hover {
            color: white !important;
            background-color: #6c757d !important;
        }
    </style>
</head>

<body class="bg-light">

    <main class="d-flex">
        <?php page('partials/sidebar.php') ?>
        <section class="bg-light" style="height: 100dvh; width:calc(100dvw - 280px)">
            <?php page('partials/navbar.php', ['pageTitle' => $pageTitle]) ?>