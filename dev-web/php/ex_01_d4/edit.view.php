<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
</head>

<body class="d-flex justify-content-center pt-5">
    
    <?php if ($displayInfo): ?>
        <div
            class="table-responsive w-75">
            <table
                class="table table-light table-bordered">
                <thead>
                    <tr>
                        <th scope="col"> id</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Diplôme</th>
                        <th scope="col">Age</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($users as $key => $user):
                    ?>

                        <tr class="">
                            <td scope="row"><?= $user['id'] ?></td>
                            <td scope="row"><?= $user['last_name'] ?></td>
                            <td scope="row"><?= $user['first_name'] ?></td>
                            <td scope="row"><?= $user['degree'] ?></td>
                            <td scope="row"><?= $user['age'] ?></td>
                            <td scope="row">
                                <div>
                                    <a class="btn btn-primary" href="./detail.php?id=<?= $user['id'] ?>&first_name=<?= $user['first_name'] ?>&last_name=<?= $user['last_name'] ?>&degree=<?= $user['degree'] ?>&age=<?= $user['age'] ?>&description=<?= $user['description'] ?>">
                                        Details
                                    </a>
                                    <a class="btn btn-warning" href="./edit.php?id=<?= $user['id'] ?>">
                                        Modifier
                                    </a>

                                </div>
                            </td>

                        </tr>
                    <?php endforeach ?>

                </tbody>
            </table>
        </div>

    <?php else: ?>

        <div class="d-flex flec-column  w-75 align-items-center jsutify-content-center">
            <?php if (count($errors) > 0): ?>
                <ul>
                    <?php foreach ($errors as $key => $value):
                    ?>
                        <li>
                            <?= $value ?>
                        </li>
                    <?php endforeach ?>
                </ul>
            <?php endif ?>
            <div class="w-75 bg-white p-3 border ">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name" class="form-label">Nom</label>
                                <input class="form-control" id="name" type="text" name="last_name" value="<?= $last_name ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="fname" class="form-label">Prénom</label>
                                <input class="form-control" id="fname" type="text" name="first_name" value="<?= $first_name ?>">
                            </div>

                        </div>
                    </div>
                    <div>
                        <div class="form-group">
                            <label for="textarea" class="form-label">Description</label>
                            <textarea id="textarea" class="form-control" rows="5" cols="2" name="description"><?= $description ?>
                    </textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="date" class="form-label"> Dernie diplome</label>
                                <select id="" class="form-select" name="degree">
                                    <option value="CEP" <?= selectedDegree('CEP', $degree) ? 'selected' : '' ?>>CEP</option>
                                    <option value="BEPC"  <?= selectedDegree('BEPC', $degree) ? 'selected' : '' ?>>BEPC</option>
                                    <option value="BAC" <?= selectedDegree('BAC', $degree) ? 'selected' : '' ?>>BAC</option>
                                    <option value="LICENCE" <?= selectedDegree('LICENCE', $degree) ? 'selected' : '' ?>>LICENCE</option>
                                    <option value="MASTER"  <?= selectedDegree('MASTER', $degree) ? 'selected' : '' ?>>MASTER</option>
                                </select>
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="date" class="form-label"> Age</label>
                                <input class="form-control" id="number" type="number" name="age" value="<?= $age ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center mt-3">
                        <input
                            name="my-form-button"
                            type="submit"
                            value="Valider"
                            id=""
                            class="btn btn-primary w-25"
                            href="#"
                            role="button">
                    </div>

                </form>
            </div>
        </div>
    <?php endif ?>
</body>

</html>