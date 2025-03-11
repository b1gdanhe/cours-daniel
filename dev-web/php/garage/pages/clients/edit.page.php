<?php page('partials/head.php'); ?>

<body class="bg-light">
    <?php page("partials/navbar.php"); ?>
    <div
        <div class="d-flex flex-column w-100 align-items-center jsutify-content-center mt-4">
        <div class="fs-3 text-center w-100">
            Modifier client
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
                            <label for="name" class="form-label">Nom</label>
                            <input class="form-control" id="name" type="text" name="last_name" value="<?= $client['last_name'] ?>">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="fname" class="form-label">Prénom</label>
                            <input class="form-control" id="fname" type="text" name="first_name" value="<?= $client['first_name'] ?>">
                        </div>

                    </div>
                </div>
                <div class="row">

                    <div class="col-6">
                        <div class="form-group">
                            <label for="phone" class="form-label"> Téléphone</label>
                            <input class="form-control" id="phone" type="phone" name="phone" value="<?= $client['phone'] ?>">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="email" class="form-label"> Email</label>
                            <input class="form-control" id="email" type="email" name="email" value="<?= $client['email'] ?>">
                        </div>
                    </div>
                </div>

                <div class="row  mt-3 w-100">
                    <div class="col-3 ">
                        <input
                            name="my-create-client-form"
                            type="submit"

                            value="Mettre à jour"
                            id=""
                            class="btn btn-primary w-100"
                            href="#"
                            role="button">
                    </div>
                    <div class="col-6 ">
                        <a
                            id=""
                            class="btn btn-secondary w-50"
                            href="/"
                            role="button">Annuler</a>
                    </div>

                </div>

            </form>
        </div>
    </div>
</body>

</html>