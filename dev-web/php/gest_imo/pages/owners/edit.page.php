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
                                <label for="appartement_id" class="form-label">Appartement</label>
                                <select
                                    class="form-select form-select"
                                    name="appartement_id"
                                    id="appartement_id">
                                    <?php foreach ($appartements as $appartement) : ?>
                                        <option value="<?= $appartement['id']?? $person['appartement_id']  ?>" <?= isset($person['appartement_id']) && $person['appartement_id'] == $appartement['id']  ? 'selected' : "" ?>><?= $appartement['name'] . '(' . $appartement['number'] . ')' ?? "" ?></option>
                                    <?php endforeach ?>

                                </select>
                            </div>

                            <div class="text-danger" style="font-size: 12px;">
                                <?= $errors['appartement_id'] ?? "" ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="jobs" class="form-label">Profession</label>
                            <input class="form-control" id="jobs" type="text" name="jobs" value="<?= $person['jobs'] ?? "" ?>">
                            <div class="text-danger" style="font-size: 12px;">
                                <?= $errors['jobs'] ?? "" ?>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="lastname" class="form-label">Nom</label>
                            <input class="form-control" id="lastname" type="text" name="lastname" value="<?= $person['lastname'] ?? "" ?>">
                            <div class="text-danger" style="font-size: 12px;">
                                <?= $errors['lastname'] ?? "" ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="firstname" class="form-label">Prénom</label>
                            <input class="form-control" id="firstname" type="text" name="firstname" value="<?= $person['firstname'] ?? "" ?>">
                            <div class="text-danger" style="font-size: 12px;">
                                <?= $errors['firstname'] ?? "" ?>
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