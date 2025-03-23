<?php page('partials/head.php', ['pageTitle' => $pageTitle]) ?>

<div class=" bg-white m-3 shadow-sm" style="height: calc(100dvh-70px);">
    <div
        class="table-responsive w-100  container p-4 bg-white">

        <div class="w-50 bg-white   borderrounded mt-2">
            <form action="/auteurs/update" method="post" enctype="multipart/form-data">
                <input type="hidden" name="<?= $primaryKey ?>" value="<?= $auteur[$primaryKey] ?>">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="nom" class="form-label">Nom</label>
                            <input class="form-control" id="nom" type="text" name="nom" value="<?= $auteur['nom'] ?? "" ?>">
                            <div class="text-danger" style="font-size: 12px;">
                                <?= $errors['nom'][0] ?? "" ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="adresse" class="form-label">Addresse</label>
                            <input class="form-control" id="adresse" type="text" name="adresse" value="<?= $auteur['adresse'] ?? "" ?>">
                            <div class="text-danger" style="font-size: 12px;">
                                <?= $errors['adresse'][0]  ?? "" ?>
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
</div>

<?php page('partials/footer.php') ?>