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
                            <label for="sigle" class="form-label">Sigle</label>
                            <input class="form-control" id="sigle" type="text" name="sigle" value="<?= $filier['sigle'] ?>">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="wording" class="form-label">Libellé</label>
                            <input class="form-control" id="wording" type="text" name="wording" value="<?= $filier['wording'] ?>">
                        </div>

                    </div>
                </div>



                <div class="row d-flex justify-content-start mt-3">
                    <div class="col">
                        <input
                            name="my-edit-filier-form"
                            type="submit"
                            value="Mettre à jour"
                            id=""
                            class="btn btn-primary w-25"
                            href="#"
                            role="button">
                    </div>
                </div>

            </form>
        </div>
    </div>
</body>

</html>