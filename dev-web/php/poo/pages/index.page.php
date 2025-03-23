<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>POO</title>
</head>

<body class="p-5">
    <div class="card p-2 shadow-sm mb-2">
        <b> Solde total de la banque : <?= $totalAmount ?> </b>
    </div>
    <ul>
        <?php foreach ($userHistories as $userHistory) : ?>
            <li>
                <?= $userHistory['nom'] . ' ' . $userHistory['prenom']  . ' (' .  $userHistory['solde'] . ')' ?>
            </li>
        <?php endforeach ?>
    </ul>
</body>

</html>