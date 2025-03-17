<?php partial('head.php'); ?>

<body class="bg-light">
    <?php partial("navbar.php"); ?>
    <div
        <div class="d-flex flex-column w-100 align-items-center jsutify-content-center mt-4">
        <div class="fs-3 text-center w-100">
            Modification Sejour
        </div>
        <div class="w-50 bg-white  p-4 border shadow-sm rounded mt-2">

            <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="code_logement" class="form-label">Logement</label>
                                <select
                                    class="form-select form-select"
                                    name="code_logement"
                                    id="">
                                    <?php foreach ($logements as $logement) : ?>
                                        <option value="<?= $logement['code']  ?>" <?= isset($sejour['code_logement']) && $sejour['code_logement'] == $logement['code']  ? 'selected' : "" ?>><?= $logement['nom'] ?? "" ?></option>
                                    <?php endforeach ?>

                                </select>
                            </div>

                            <!-- <input class="form-control" id="name" type="text" name="name" value="<?= $sejour['code_logement'] ?? "" ?>"> -->
                            <div class="text-danger" style="font-size: 12px;">
                                <?= $errors['code_logement'] ?? "" ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="id_voyageur" class="form-label">Voyageur</label>
                                <select
                                    class="form-select form-select"
                                    name="id_voyageur"
                                    id="">
                                    <?php foreach ($voyageurs as $voyageur) : ?>
                                        <option value="<?= $voyageur['id_voyageur']  ?>" <?= isset($sejour['id_voyageur']) && $sejour['id_voyageur'] == $voyageur['id_voyageur']  ? 'selected' : "" ?>><?= $voyageur['nom'] . " " . $voyageur['prenom'] ?></option>
                                    <?php endforeach ?>

                                </select>
                            </div>

                            <!-- <input class="form-control" id="name" type="text" name="name" value="<?= $sejour['id_voyageur'] ?? "" ?>"> -->
                            <div class="text-danger" style="font-size: 12px;">
                                <?= $errors['id_voyageur'] ?? "" ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="debut" class="form-label">Date de debut</label>
                            <input class="form-control" id="debut" type="date" name="debut" value="<?= $sejour['debut'] ?? "" ?>">
                            <div class="text-danger" style="font-size: 12px;">
                                <?= $errors['debut'] ?? "" ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="fin" class="form-label">Date de fin</label>
                            <input class="form-control" id="fin" type="date" name="fin" value="<?= $sejour['fin'] ?? "" ?>">
                            <div class="text-danger" style="font-size: 12px;">
                                <?= $errors['fin'] ?? "" ?>
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