<?php partial('head.php'); ?>

<body class="bg-light">
    <?php partial("navbar.php"); ?>
    <div
        <div class="d-flex flex-column w-100 align-items-center jsutify-content-center mt-4">
        <div class="fs-3 text-center w-100">
            Modifier immeuble
        </div>

        <div class="w-50 bg-white  p-4 border shadow-sm rounded">

            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name" class="form-label">Nom</label>
                            <input class="form-control" id="name" type="text" name="name" value="<?= $immeuble['name'] ?? "" ?>">
                            <div class="text-danger" style="font-size: 12px;">
                                <?= $errors['name'] ?? "" ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="address" class="form-label">Addresse</label>
                            <input class="form-control" id="address" type="text" name="address" value="<?= $immeuble['address'] ?? "" ?>">
                            <div class="text-danger" style="font-size: 12px;">
                                <?= $errors['address'] ?? "" ?>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="row  mt-3 w-100">
                    <div class="col-3 ">
                        <input
                            name="<?= $form_name ?>"
                            type="submit"
                            value="<?= $form_value ?>"
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