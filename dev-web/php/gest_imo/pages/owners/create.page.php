<?php partial('head.php'); ?>

<body class="bg-light">
    <?php partial("navbar.php"); ?>
    <div
        <div class="d-flex flex-column w-100 align-items-center jsutify-content-center mt-4">
        <div class="fs-3 text-center w-100">
            Ajout appartements
        </div>
        <div class="w-50 bg-white  p-4 border shadow-sm rounded mt-2">

            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="name" class="form-label">Appartement</label>
                                <select
                                    class="form-select form-select"
                                    name="appartement_id"
                                    id="">
                                    <?php foreach ($appartements as $appartement) : ?>
                                        <option value="<?= $appartement['id']  ?>" <?= isset($post_datas['appartement_id']) && $post_datas['appartement_id'] == $appartement['id']  ? 'selected' : "" ?>><?= $appartement['name'] . '(' . $appartement['number'] . ')' ?? "" ?></option>
                                    <?php endforeach ?>

                                </select>
                            </div>

                            <!-- <input class="form-control" id="name" type="text" name="name" value="<?= $post_datas['appartement_id'] ?? "" ?>"> -->
                            <div class="text-danger" style="font-size: 12px;">
                                <?= $errors['appartement_id'] ?? "" ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="name" class="form-label">Personne</label>
                                <select
                                    class="form-select form-select"
                                    name="person_id"
                                    id="">
                                    <?php foreach ($persons as $person) : ?>
                                        <option value="<?= $person['id']  ?>" <?= isset($post_datas['person_id']) && $post_datas['person_id'] == $person['id']  ? 'selected' : "" ?>><?= $person['lastname'] . ' ' . $person['firstname'] ?? "" ?></option>
                                    <?php endforeach ?>

                                </select>
                            </div>

                            <!-- <input class="form-control" id="name" type="text" name="name" value="<?= $post_datas['appartement_id'] ?? "" ?>"> -->
                            <div class="text-danger" style="font-size: 12px;">
                                <?= $errors['person_id'] ?? "" ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="quote_part" class="form-label">Quota</label>
                            <input class="form-control" id="quote_part" type="number" name="quote_part" value="<?= $post_datas['quote_part'] ?? "" ?>">
                            <div class="text-danger" style="font-size: 12px;">
                                <?= $errors['quote_part'] ?? "" ?>
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