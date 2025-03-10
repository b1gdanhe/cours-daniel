<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/">
</head>

<body class="bg-light ">
    <?php include_once('pages/partials/navbar.php'); ?>
    <div class="w-100 d-flex justify-content-center mt-5" style="">

        <div class="d-flex flex-column w-75  justify-content-center  p-3">
            <a href="/" class="mb-1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                </svg></a>
            <div class="w-100">
                <div class="mb-1 d-flex justify-content-center w-100 fs-3 gap-2">
                    <span class="" style="font-weight: bold"> Garage : <?= $garage['name'] ?></span>
                </div>

            </div>
            <hr style="color: lightgray;">
            <div class="bg-white w-100 p-3 rounded shadow-sm">
                <div class="">
                    Adresse : <span class="" style="font-weight: bold"><?= $garage['address'] ?></span>
                </div>
                <div class="">
                    Téléphone : <span class="" style="font-weight: bold"><?= $garage['phone'] ?></span>
                </div>

            </div>

        </div>
    </div>

</body>

</html>