<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <?php include_once('partials/navbar.php'); ?>
    <div class="mt-4 w-100 d-flex justify-content-center">
        <?php if ($user):  ?>
            <div class="d-flex flex-column">
                <div>
                    <img src="<?= substr($user['profile_image_url'], 1)  ?>" alt="Image" width="300" height="300" style="object-fit:cover">
                </div>
                <div>Bonjour <?= $user['last_name'] . ' ' . $user['first_name'] ?></div>
                <div>Vous avez <?= $user['age'] ?> ans</div>
                <div>Votre Biographie </div>
                <div><?= $user['description'] ?></div>
                <div>Diplome </div>
                <div><?= $user['degree'] ?></div>
            </div>

        <?php else:  ?>
            <div> Resource non trouvé</div>
        <?php endif  ?>
    </div>



</body>

</html>