<?php partial('head.php'); ?>

<body class="bg-light">
    <?php partial("navbar.php"); ?>
    <div
        <div class="d-flex flex-column w-100 align-items-center jsutify-content-center mt-4">
        <div class="fs-3 text-center w-100">
            Ajout logements
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
                            <label for="capacite" class="form-label">Capacité</label>
                            <input class="form-control" id="capacite" type="number" name="capacite" value="<?= $post_datas['capacite'] ?? "" ?>">
                            <div class="text-danger" style="font-size: 12px;">
                                <?= $errors['capacite'] ?? "" ?>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="type" class="form-label">Type</label>
                            <input class="form-control" id="type" type="text" name="type" value="<?= $post_datas['type'] ?? "" ?>">
                            <div class="text-danger" style="font-size: 12px;">
                                <?= $errors['type'] ?? "" ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="lieu" class="form-label">Lieu</label>
                            <input class="form-control" id="lieu" type="text" name="lieu" value="<?= $post_datas['lieu'] ?? "" ?>">
                            <div class="text-danger" style="font-size: 12px;">
                                <?= $errors['lieu'] ?? "" ?>
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