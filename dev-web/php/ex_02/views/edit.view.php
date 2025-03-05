<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
</head>

<body class=" bg-light">
    <?php include_once('partials/navbar.php'); ?>


    <div class="d-flex flex-column  w-100 align-items-center jsutify-content-center mt-4">
        <?php if (count($errors) > 0): ?>
            <ul style="list-style: none;">
                <?php foreach ($errors as $key => $value):
                ?>
                    <li>
                        <?= $value ?>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>
        <div class="w-50 bg-white p-3 border   rounded shadow-sm">
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
                                <option value="BEPC" <?= selectedDegree('BEPC', $degree) ? 'selected' : '' ?>>BEPC</option>
                                <option value="BAC" <?= selectedDegree('BAC', $degree) ? 'selected' : '' ?>>BAC</option>
                                <option value="LICENCE" <?= selectedDegree('LICENCE', $degree) ? 'selected' : '' ?>>LICENCE</option>
                                <option value="MASTER" <?= selectedDegree('MASTER', $degree) ? 'selected' : '' ?>>MASTER</option>
                            </select>
                        </div>

                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="date" class="form-label"> Age</label>
                            <input class="form-control" id="number" type="number" name="age" value="<?= $age ?>">
                        </div>
                    </div>
                    <div
                        class="row">
                        <div class="form-group">
                            <label for="date" class="form-label"> Téléverser le diplôme</label>
                            <input class="form-control" id="number" type="file" name="degree_file">
                        </div>
                        <div
                            class="row">
                            <div class="form-group">
                                <label for="date" class="form-label"> Téléverser une image</label>
                                <input class="form-control" id="number" type="file" name="profile_image">
                            </div>

                        </div>
                        <div class="w-25">
                            <div class="col-2">
                                <img src="<?= substr($profile_image_url, 1)  ?>" alt="Image" width="70" height="70" style="object-fit:cover">
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center mt-3">
                        <input
                            name="my-form-button"
                            type="submit"
                            value="Modifier"
                            id=""
                            class="btn btn-primary w-25"
                            href="#"
                            role="button">
                    </div>

            </form>
        </div>
    </div>
</body>

</html>