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
    <div class="d-flex flex-column w-100 align-items-center jsutify-content-center mt-4">
        <div class="fs-3 text-center w-100">
            Ajout Voiture
        </div>
        <?php if (count($errors) > 0): ?>
            <ul style="list-style: none;" class="text-danger">
                <?php foreach ($errors as $key => $value):
                ?>
                    <li class="text-center">
                        <?= $value ?>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>

        <div class="w-50 bg-white  p-4 border shadow-sm rounded">

            <form action="" method="post" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="date" class="form-label"> Garage</label>
                            <select id="" class="form-select" name="garage_id">
                                <?php foreach ($garages as $garage): ?>
                                    <option value="<?= $garage['id'] ?>"><?= $garage['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="date" class="form-label"> Client</label>
                            <select id="" class="form-select" name="client_id">
                                <?php foreach ($clients as $client): ?>
                                    <option value="<?= $client['id'] ?>"><?= $client['last_name'] . ' ' . $client['first_name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="mark" class="form-label">Marque</label>
                            <input class="form-control" id="mark" type="text" name="mark">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="model" class="form-label">Modèle</label>
                            <input class="form-control" id="model" type="text" name="model">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="enter_date" class="form-label"> Date d'entrée</label>
                            <input class="form-control" id="enter_date" type="date" name="enter_date">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="out_date" class="form-label">Date de sortie</label>
                            <input class="form-control" id="out_date" type="date" name="out_date">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="year" class="form-label"> Année</label>
                            <input class="form-control" id="year" type="date" name="year">
                        </div>
                    </div>
                </div>


                <div class="row  mt-3 w-100">
                    <div class="col-3 ">
                        <input
                            name="my-create-car-form"
                            type="submit"

                            value="Enregistrer"
                            id=""
                            class="btn btn-primary w-100"
                            href="#"
                            role="button">
                    </div>
                    <div class="col-6 ">
                        <input
                            name="my-create-car-form"
                            type="submit"

                            value="Annuler"
                            id=""
                            class="btn btn-secondary w-50"
                            href="#"
                            role="button">
                    </div>

                </div>

            </form>
        </div>
    </div>
</body>

</html>