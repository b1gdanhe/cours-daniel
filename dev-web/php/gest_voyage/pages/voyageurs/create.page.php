<?php partial('head.php'); ?>

<body class="bg-light">
    <?php partial("navbar.php"); ?>
    <div
        <div class="d-flex flex-column w-100 align-items-center jsutify-content-center mt-4">
        <div class="fs-3 text-center w-100">
            Ajout voyageurs
        </div>
        <div class="w-50 bg-white  p-4 border shadow-sm rounded mt-2">

            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="nom" class="form-label">Nom</label>
                            <input class="form-control" id="nom" type="text" name="nom" value="<?= $post_datas['nom'] ?? "" ?>">
                            <div class="text-danger" style="font-size: 12px;">
                                <?= $errors['nom'] ?? "" ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="prenom" class="form-label">Addresse</label>
                            <input class="form-control" id="prenom" type="text" name="prenom" value="<?= $post_datas['prenom'] ?? "" ?>">
                            <div class="text-danger" style="font-size: 12px;">
                                <?= $errors['prenom'] ?? "" ?>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="ville" class="form-label">Ville</label>
                            <input class="form-control" id="ville" type="text" name="ville" value="<?= $post_datas['ville'] ?? "" ?>">
                            <div class="text-danger" style="font-size: 12px;">
                                <?= $errors['ville'] ?? "" ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="region" class="form-label">Region</label>
                            <input class="form-control" id="region" type="text" name="region" value="<?= $post_datas['region'] ?? "" ?>">
                            <div class="text-danger" style="font-size: 12px;">
                                <?= $errors['region'] ?? "" ?>
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