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
    <nav id="nav" data-user="<?= (isset($_SESSION['user'])) ? $_SESSION['user']->permiso_id : 0 ?>" class="navbar navbar-expand-md bg-primary bg-gradient">
        <div class="container">
            <a id="title" class="navbar-brand text-white d-flex subtitle">TB TECH</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-toggler" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-toggler">
                <ul class="navbar-nav d-flex justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link-log-out nav-link text-white">Inicio</a>
                    </li>
                    <?php if(isset($_SESSION['user'])): ?>
                    <li class="nav-item">
                        <a class="nav-link-log-in nav-link text-white"><?= $_SESSION['user']->nombre ?></a>
                    </li>
                    <li id="cart" class="nav-item">
                        <a class="nav-link-log-in nav-link text-white">Carrito</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-log-in nav-link text-white">Cerrar sesión</a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link-log-out nav-link text-white">Iniciar sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-log-out nav-link text-white">Registro</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <main data-view="0">

    </main>
    <div class="container-fluid bg-white bg-gradient py-5">
        <footer class="container">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
            </ul>
            <p class="text-center text-muted">&copy; <?= date('Y') ?> Alonso</p>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="<?= Url::base().'/assets/js/modules/routes.js' ?>"></script>
    <script src="<?= Url::base().'/assets/js/modules/util.js' ?>"></script>
    <script src="<?= Url::base().'/assets/js/modules/product.js' ?>"></script>
    <script src="<?= Url::base().'/assets/js/modules/home.js' ?>"></script>
    <script src="<?= Url::base().'/assets/js/modules/registro.js' ?>"></script>
    <script src="<?= Url::base().'/assets/js/modules/password-recovery.js' ?>"></script>
    <script src="<?= Url::base().'/assets/js/modules/login.js' ?>"></script>
    <script src="<?= Url::base().'/assets/js/modules/gestor/profile.js' ?>"></script>
    <script src="<?= Url::base().'/assets/js/modules/gestor/update-profile.js' ?>"></script>
    <script src="<?= Url::base().'/assets/js/modules/gestor/update-password.js' ?>"></script>
    <script src="<?= Url::base().'/assets/js/modules/gestor/add-products.js' ?>"></script>
    <script src="<?= Url::base().'/assets/js/modules/gestor/update-products.js' ?>"></script>
    <script src="<?= Url::base().'/assets/js/modules/gestor/products.js' ?>"></script>
    <script src="<?= Url::base().'/assets/js/modules/gestor/update-account.js' ?>"></script>
    <script src="<?= Url::base().'/assets/js/modules/gestor.js' ?>"></script>
    <script src="<?= Url::base().'/assets/js/pluggins/main.js' ?>"></script>
</body>

</html>