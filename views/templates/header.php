<!DOCTYPE html>
<html lang="es">

<head>
    <title>Tb Tech</title>
    <meta charset="utf-8" />
    <meta name="author" content="John Doe" />
    <meta name="description" content="Tienda de tecnologia" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="<?php echo Url::base().'/assets/css/styles.css' ?>" />
</head>

<body class="bg-secondary bg-gradient bg-opacity-25">
    <nav class="navbar navbar-expand-md bg-primary bg-gradient">
        <div class="container">
            <a id="title" class="navbar-brand text-white d-flex subtitle" href="<?php echo URL_HOME ?>">TB TECH</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-toggler" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-toggler">
                <ul class="navbar-nav d-flex justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Categoria 1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Categoria 2</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Categoria 3</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Categoria 4</a>
                    </li>
                </ul>
                <ul class="navbar-nav d-flex justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Iniciar sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?php echo URL_REGISTRO ?>">Registro</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>