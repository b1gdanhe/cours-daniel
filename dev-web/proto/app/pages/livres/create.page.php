<?php page('partials/head.php', ['pageTitle'=> $pageTitle]) ?>

<div class=" bg-white m-3 shadow-sm" style="height: calc(100dvh-70px);">
    <div
        class="table-responsive w-100  container p-4 bg-white">

        <div class="w-50 bg-white   borderrounded mt-2">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name" class="form-label">Nom</label>
                            <input class="form-control" id="name" type="text" name="name" value="<?= $post_datas['name'] ?? "" ?>">
                            <div class="text-danger" style="font-size: 12px;">
                                <?= $errors['name'] ?? "" ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="address" class="form-label">Addresse</label>
                            <input class="form-control" id="address" type="text" name="address" value="<?= $post_datas['address'] ?? "" ?>">
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
</div>

<?php page('partials/footer.php') ?>