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
    <section>
        <nav class="navbar navbar-dark navbar-expand-lg bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Teste Blue Pex</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= base_url("inventory/index") ?>">CRUD de Inventários</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url("listDirectories/index") ?>">Listagem de diretórios Linux</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </section>
    <section class="container-fluid">
        <div id="div-principal-sistem" class="container-fluid pt-4">
            <?= $contents ?>
        </div>
    </section>

    <?= script_tag("assets/js/screen/index.js") ?>
</body>

</html>