<?php partial('head.php'); ?>

<body class="bg-light">
    <?php partial("navbar.php"); ?>
    <div
        <div class="d-flex flex-column w-100 align-items-center jsutify-content-center mt-4">
        <div class="fs-3 text-center w-100">
            Modification appartements
        </div>
        <div class="w-50 bg-white  p-4 border shadow-sm rounded mt-2">

            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="name" class="form-label">Immeuble</label>
                                <select
                                    class="form-select form-select"
                                    name="immeuble_id"
                                    id="">
                                    <?php foreach ($immeubles as $immeuble) : ?>
                                        <option value="<?= $immeuble['id']  ?>" <?= isset($appartement['immeuble_id']) && $appartement['immeuble_id'] == $immeuble['id']  ? 'selected' : "" ?>><?= $immeuble['name'] ?? "" ?></option>
                                    <?php endforeach ?>

                                </select>
                            </div>

                            <!-- <input class="form-control" id="name" type="text" name="name" value="<?= $appartement['name'] ?? "" ?>"> -->
                            <div class="text-danger" style="font-size: 12px;">
                                <?= $errors['immeuble_id'] ?? "" ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="number" class="form-label">Numéro</label>
                            <input class="form-control" id="number" type="number" name="number" value="<?= $appartement['number'] ?? "" ?>">
                            <div class="text-danger" style="font-size: 12px;">
                                <?= $errors['number'] ?? "" ?>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="level" class="form-label">Niveau</label>
                            <input class="form-control" id="level" type="number" name="level" value="<?= $appartement['level'] ?? "" ?>">
                            <div class="text-danger" style="font-size: 12px;">
                                <?= $errors['level'] ?? "" ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="area" class="form-label">Superficie</label>
                            <input class="form-control" id="area" type="number" name="area" value="<?= $appartement['area'] ?? "" ?>">
                            <div class="text-danger" style="font-size: 12px;">
                                <?= $errors['area'] ?? "" ?>
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