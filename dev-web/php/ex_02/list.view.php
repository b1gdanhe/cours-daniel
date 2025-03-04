<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <style>
        td {
            vertical-align: middle;

        }
    </style>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg bg-white  shadow-sm" style="padding: ;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">BigDE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <div
        class="table-responsive w-100  mt-5  px-5">
        <form class="w-full  bg-white mb-2 p-2 rounded-1 shadow-sm" action="" method="post">
            <div class="row">
                <div class="col-3">
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
            class="table table-white table-striped bg-white shadow-sm rounded">
            <thead>
                <tr>
                    <th scope="col"> #</th>
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