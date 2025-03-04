<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <style>

    </style>
</head>

<body class="d-flex justify-content-center pt-5 bg-light">
    <div
        class="table-responsive w-75 ">
        <form class="w-full  bg-white mb-2 p-2 rounded-1 shadow-sm" action="" method="post">
            <div class="row">
                <div class="col-3  ">
                    <div class="form-group">
                        <input class="form-control" id="name" type="text" name="search_key" placeholder="Search">
                    </div>
                </div>

                <div class="col-3  ">
                    <div class="form-group">
                        <input class="form-control" id="name" type="text" name="name_search_key" placeholder="Search by name">
                    </div>
                </div>
                <div class="col-2">
                    <input
                        name="my-search-button"
                        type="submit"
                        value="Filtrer"
                        id=""
                        class="btn btn-primary w-100"
                        href="#"
                        role="button">
                </div>
                <div class="col-2">

                    <input
                        name="my-clearSearch-button"
                        type="submit"
                        value="Clear"
                        id=""
                        class="btn btn-danger w-100"
                        href="#"
                        role="button">
                </div>

            </div>
        </form>

        <table
            class="table table-white table-bordered bg-white shadow-sm rounded">
            <thead>
                <tr>
                    <th scope="col"> id</th>
                    <th scope="col"> Avatar</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Diplôme</th>
                    <th scope="col">Age</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($users) === 0): ?>
                    <tr>
                        <td colspan="6" class="text-center">
                            Pas de données trouvées
                        </td>

                    </tr>

                <?php else: ?>
                    <?php foreach ($users as $key => $user):
                    ?>

                        <tr class="">
                            <td scope="row"><?= $user['id'] ?></td>
                            <td scope="row"><img src="<?= substr($user['profile_image_url'], 1)  ?>" alt="Image" width="70" height="70" style="object-fit:cover"></td>
                            <td scope="row"><?= $user['last_name'] ?></td>
                            <td scope="row"><?= $user['first_name'] ?></td>
                            <td scope="row"><?= $user['degree'] ?></td>
                            <td scope="row"><?= $user['age'] ?></td>
                            <td scope="row">
                                <div>
                                    <a class="btn btn-primary" href="./detail.php?id=<?= $user['id'] ?>">
                                        Details
                                    </a>
                                    <a class="btn btn-warning" href="./edit.php?id=<?= $user['id'] ?>&first_name=<?= $user['first_name'] ?>&last_name=<?= $user['last_name'] ?>&degree=<?= $user['degree'] ?>&age=<?= $user['age'] ?>&description=<?= $user['description'] ?>&profile_image_url=<?= $user['profile_image_url'] ?>">
                                        Modifier
                                    </a>

                                </div>
                            </td>

                        </tr>
                    <?php endforeach ?>
                <?php endif ?>

            </tbody>
        </table>
    </div>

</body>

</html>