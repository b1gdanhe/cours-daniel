<?php page('partials/head.php'); ?>

<body class="bg-light">
    <?php page("partials/navbar.php"); ?>
    <div
        <div class="d-flex flex-column w-100 align-items-center jsutify-content-center mt-4">
        <div class="fs-3 text-center w-100">
            Ajout client
        </div>
        <div class="w-50 bg-white  p-4 border shadow-sm rounded mt-2">

            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name" class="form-label">Nom</label>
                            <input class="form-control" id="name" type="text" name="last_name" value="<?= $post_datas['last_name'] ?? "" ?>">
                            <div class="text-danger" style="font-size: 12px;">
                                <?= $errors['last_name'] ?? "" ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="fname" class="form-label">Prénom</label>
                            <input class="form-control" id="fname" type="text" name="first_name" value="<?= $post_datas['first_name'] ?? "" ?>">
                            <div class="text-danger" style="font-size: 12px;">
                                <?= $errors['first_name'] ?? "" ?>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">

                    <div class="col-6">
                        <div class="form-group">
                            <label for="phone" class="form-label"> Téléphone</label>
                            <input class="form-control" id="phone" type="phone" name="phone" value="<?= $post_datas['phone'] ?? "" ?>">
                            <div class="text-danger" style="font-size: 12px;">
                                <?= $errors['phone'] ?? "" ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="email" class="form-label"> Email</label>
                            <input class="form-control" id="email" type="text" name="email" value="<?= $post_datas['email'] ?? "" ?>">
                            <div class="text-danger" style="font-size: 12px;">
                                <?= $errors['email'] ?? "" ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row  mt-3 w-100">
                    <div class="col-3 ">
                        <input
                            name="my-create-client-form"
                            type="submit"

                            value="Enregistrer"
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