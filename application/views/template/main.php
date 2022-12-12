<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?></title>

    <link rel="stylesheet" href="<?= base_url("node_modules/bootstrap/dist/css/bootstrap.min.css") ?>">
    <script href="<?= base_url("node_modules/bootstrap/dist/js/bootstrap.min.js") ?>"></script>
    <script src="https://kit.fontawesome.com/85a0ecc078.js"></script>
</head>

<body class="m-0">
    <section class="container-fluid">
        <div id="div-principal-sistem" class="container-fluid pt-4">
            <?= $contents ?>
        </div>
    </section>

    <?= script_tag("assets/js/screen/index.js") ?>
</body>
</html>