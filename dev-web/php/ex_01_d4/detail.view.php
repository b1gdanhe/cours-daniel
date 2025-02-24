<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
</head>

<body class="d-flex justify-content-center pt-5">

    <div class="d-flex flex-column">
        <div>Bonjour <?= "$last_name $first_name" ?></div>
        <div>Vous avez <?= "$age" ?> ans</div>
        <div>Votre Biographie </div>
        <div><?= "$description" ?></div>
        <div>Diplome </div>
        <div><?= "$degree" ?></div>
    </div>
</body>

</html>