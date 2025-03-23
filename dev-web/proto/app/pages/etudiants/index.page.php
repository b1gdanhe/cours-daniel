<?php page('partials/head.php', ['pageTitle' => $pageTitle]) ?>

<div class=" bg-white m-3 shadow-sm" style="height: calc(100dvh-70px);">
    <div
        class="table-responsive w-100  container p-4 bg-white">
        <div class="w-100 d-flex justify-content-between align-items-center mb-4">
            <form class=" d-flex justify-content-start" action="" method="post">
                <div class="d-flex gap-2">
                    <input class="form-control" id="name" type="text" class="w-25" value="<?= $search_key ?? '' ?>" name="search_key" placeholder="...">

                    <input
                        name="<?= $search_form_name ?>"
                        type="submit"
                        value="<?= $search_form_value ?>"
                        id="<?= $search_form_name ?>"
                        class="btn btn-primary w-auto"
                        href="#"
                        role="button">
                    <input
                        name="<?= $clear_search_name ?>"
                        type="submit"
                        value="<?= $clear_search_value ?>"
                        id="<?= $clear_search_name ?>"
                        class="btn btn-danger w-auto"
                        href="#"
                        role="button">
                </div>
            </form>
            <a
                name=""
                id=""
                class="btn btn-dark"
                href="/etudiants/create"
                role="button">Ajout</a>

        </div>
        <table
            class="table   ">
            <thead class="table-light">
                <tr>
                    <th scope="col"> #</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Adresse</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($etudiants) === 0): ?>
                    <tr>
                        <td colspan="6" class="text-center">
                            Pas de données trouvées
                        </td>

                    </tr>

                <?php else: ?>
                    <?php foreach ($etudiants as $key => $etudiant):
                    ?>

                        <tr class="">
                            <td scope="row"><?= $etudiant[$primaryKey] ?></td>
                            <td scope="row"><?= $etudiant['nom'] ?></td>

                            <td scope="row"><?= $etudiant['adresse'] ?></td>


                            <td scope="row">
                                <div>
                                    <a class="btn btn-primary" href="etudiants/show?<?= $primaryKey ?>=<?= $etudiant[$primaryKey] ?>">
                                        Details
                                    </a>
                                    <a class="btn btn-warning" href="etudiants/edit?<?= $primaryKey ?>=<?= $etudiant[$primaryKey] ?>">
                                        Modifier
                                    </a>
                                    <form action="/etudiants/delete" method="post" style="display: inline;">
                                        <input type="hidden" name="<?= $primaryKey ?>" value="<?= $etudiant[$primaryKey] ?>">
                                        <input class="btn btn-danger"
                                            type="submit"
                                            name="<?= $delete_form_name ?>"
                                            value="<?= $delete_form_value ?>" />
                                    </form>


                                </div>
                            </td>

                        </tr>
                    <?php endforeach ?>
                <?php endif ?>

            </tbody>
        </table>
    </div>
</div>

<?php page('partials/footer.php') ?>