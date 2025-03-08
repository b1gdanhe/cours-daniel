<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/">
</head>

<body class="bg-light">
    <?php include_once('pages/partials/navbar.php'); ?>
    <div class="d-flex flex-column w-100 align-items-center jsutify-content-center ">
        <?php if (count($errors) > 0): ?>
            <ul style="list-style: none;" class="text-danger">
                <?php foreach ($errors as $key => $value):
                ?>
                    <li>
                        <?= $value ?>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>
        <div class="w-50 bg-white mt-4 p-4 border shadow-sm rounded">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name" class="form-label">Nom</label>
                            <input class="form-control" id="name" type="text" name="last_name">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="fname" class="form-label">Prénom</label>
                            <input class="form-control" id="fname" type="text" name="first_name">
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="date" class="form-label"> Filière</label>
                            <select id="" class="form-select" name="filier">
                                <?php foreach ($filiers as $filier): ?>
                                    <option value="<?= $filier['id'] ?>"><?= $filier['sigle'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="email" class="form-label"> Email</label>
                            <input class="form-control" id="email" type="email" name="email">
                        </div>
                    </div>
                </div>

                <div
                    class="row">
                    <div class="form-group">
                        <label for="photo" class="form-label"> Photo</label>
                        <input class="form-control" id="photo" type="file" name="photo">
                    </div>
                </div>

                <div class="row d-flex justify-content-center mt-3">
                    <input
                        name="my-create-student-form"
                        type="submit"
                        value="Enregistrer"
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