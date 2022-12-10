<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?></title>

    <?= link_tag("node_modules/bootstrap/dist/js/bootstrap.min.js") ?>
    <?= script_tag("node_modules/bootstrap/dist/css/bootstrap.min.css") ?>
</head>
<body>
    <section class="container">
        <div id="div-principal-sistem" class="container-fluid">
            <?= $contents ?>
        </div>
    </section>
</body>
</html>