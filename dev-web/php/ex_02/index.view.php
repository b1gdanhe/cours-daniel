<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/">
</head>

<body class="d-flex justify-content-center pt-5 bg-light">
    <div class="d-flex flex-column w-75 align-items-center jsutify-content-center ">
        <?php if (count($errors) > 0): ?>
            <ul style="list-style: none;" class="text-danger">
                <?php foreach ($errors as $key => $value):
                ?>
                    <li>
                        <?= $value ?>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>
        <div class="w-75 bg-white p-4 border shadow-sm rounded">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name" class="form-label">Nom</label>
                            <input class="form-control" id="name" type="text" name="last_name">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="fname" class="form-label">Prénom</label>
                            <input class="form-control" id="fname" type="text" name="first_name">
                        </div>

                    </div>
                </div>
                <div>
                    <div class="form-group">
                        <label for="textarea" class="form-label">Description</label>
                        <textarea id="textarea" class="form-control" rows="5" cols="2" name="description">
                    </textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="date" class="form-label"> Dernie diplome</label>
                            <select id="" class="form-select" name="degree">
                                <option value="CEP">CEP</option>
                                <option value="BEPC">BEPC</option>
                                <option value="BAC">BAC</option>
                                <option value="LICENCE">LICENCE</option>
                                <option value="MASTER">MASTER</option>
                            </select>
                        </div>

                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="date" class="form-label"> Age</label>
                            <input class="form-control" id="number" type="number" name="age">
                        </div>
                    </div>
                </div>
                <div
                    class="row">
                    <div class="form-group">
                        <label for="date" class="form-label"> Téléverser le diplôme</label>
                        <input class="form-control" id="number" type="file" name="degree_file">
                    </div>
                </div>
                <div
                    class="row">
                    <div class="form-group">
                        <label for="date" class="form-label"> Téléverser une image</label>
                        <input class="form-control" id="number" type="file" name="profile_image">
                    </div>
                </div>

                <div class="row d-flex justify-content-center mt-3">
                    <input
                        name="my-form-button"
                        type="submit"
                        value="Valider"
                        id=""
                        class="btn btn-primary w-25"
                        href="#"
                        role="button">
                </div>

            </form>
        </div>
    </div>
</body>

</html>