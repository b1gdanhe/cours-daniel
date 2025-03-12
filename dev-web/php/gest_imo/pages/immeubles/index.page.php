<?php partial('head.php'); ?>

<body class="bg-light">
    <?php partial("navbar.php"); ?>
    <div
        class="table-responsive w-75 mt-4 container p-4 bg-white shadow-sm">
        <div class="w-100 d-flex justify-content-between align-items-center mb-4">
            <form class="w-100 d-flex justify-content-start" action="" method="post">
                <div class="d-flex gap-2">
                    <div class="">
                    </div>
                    <div class="">
                        <div class="form-group">
                            <input class="form-control" id="name" type="text" value="<?= $search_key ?? '' ?>" name="search_key" placeholder="Search">
                        </div>
                    </div>

                    <div class="d-flex align-items-center ">
                        <label for="my-search-button" class="" style="">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-danger" style=" width: 20px;" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                            </svg>
                        </label>
                        <input
                            style="display:none"
                            name="my-search-button"
                            type="submit"
                            value="Filter"
                            id="my-search-button"
                            class="btn btn-primary w-100"
                            href="#"
                            role="button">
                    </div>
                    <div class="d-flex align-items-center">
                        <label for="my-clearSearch-button">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-danger" style=" width: 20px; color:red" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path d="M64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32zm79 143c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z" />
                            </svg>

                        </label>

                        <input
                            style="display:none"
                            name="my-clearSearch-button"
                            type="submit"
                            value="Clear"
                            id="my-clearSearch-button"
                            class="btn btn-danger w-100"
                            href="#"
                            role="button">
                    </div>
                </div>
            </form>
            <a
                name=""
                id=""
                class="btn btn-dark"
                href="/immeubles/create"
                role="button">Add</a>

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
                <?php if (count($immeubles) === 0): ?>
                    <tr>
                        <td colspan="6" class="text-center">
                            Pas de données trouvées
                        </td>

                    </tr>

                <?php else: ?>
                    <?php foreach ($immeubles as $key => $client):
                    ?>

                        <tr class="">
                            <td scope="row"><?= $client['id'] ?></td>
                            <td scope="row"><?= $client['name'] ?></td>
                            <td scope="row"><?= $client['address'] ?></td>


                            <td scope="row">
                                <div>
                                    <a class="btn btn-primary" href="immeubles/show?id=<?= $client['id'] ?>">
                                        Details
                                    </a>
                                    <a class="btn btn-warning" href="immeubles/edit?id=<?= $client['id'] ?>">
                                        Modifier
                                    </a>
                                    <form action="" method="post" style="display: inline;">
                                        <input type="hidden" name="id" value="<?= $client['id'] ?>">
                                        <input class="btn btn-danger"
                                            type="submit"
                                            name="my-delete-client-form"
                                            value="Delete client" />
                                    </form>


                                </div>
                            </td>

                        </tr>
                    <?php endforeach ?>
                <?php endif ?>

            </tbody>
        </table>


    </div>

</body>

</html>