<?php
include_once('./global.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .my-form input {
            padding: 12px 30px;
            margin-bottom: 10px;
        }

        .my-form input[type=submit] {
            padding: 12px 30px;
            outline: none;
            border: none;
            background-color: chocolate;
        }
    </style>
</head>

<body>
    <form action="http://localhost:8000/global.php" method="post"
        style="display: flex; flex-direction: column; width: 30%;" class="my-form">
        <input name="username" type="text" placeholder="Nom">
        <input name="password" type="password" placeholder="Prénom">
        <input type="submit" name="my-form-button" value="SOUMETTRE" />
    </form>
</body>

</html>