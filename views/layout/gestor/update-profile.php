<h2 class="text-center">Actualizar Perfil</h2>
<form id="form-update-profile" method="POST" action="">
    <div class="form-group mx-3 my-5">
        <input type="text" id="nombre" name="nombre" class="form-control py-2" placeholder="Nombre" value="<?= $_SESSION['user']->nombre ?>">
    </div>
    <p class="alert alert-danger mx-3 my-5" role="alert">
    </p>
    <div class="form-group mx-3 my-5">
        <input type="text" id="apellido" name="apellido" class="form-control py-2" placeholder="Apellido" value="<?= $_SESSION['user']->apellido ?>">
    </div>
    <p class="alert alert-danger mx-3 my-5" role="alert">
    </p>
    <div class="form-group mx-3 my-5">
        <input type="tel" id="fono" name="fono" class="form-control py-2" placeholder="Telefono" value="<?= $_SESSION['user']->fono ?>">
    </div>
    <p class="alert alert-danger mx-3 my-5" role="alert">
    </p>
    <!--<div class="form-group mx-3 my-5">
        <input type="password" id="password" name="password" class="form-control py-2" placeholder="Contraseña">
    </div>
    <p class="alert alert-danger mx-3 my-5" role="alert">
    </p>
    <div class="form-group mx-3 my-5">
        <input type="password" id="password2" name="password2" class="form-control py-2" placeholder="Repite tu contraseña">
    </div>
    <p class="alert alert-danger mx-3 my-5" role="alert">
    </p>-->
    <div class="form-group mx-3 my-5 d-flex justify-content-start">
        <input type="checkbox" id="terminos" class="form-check" name="terminos">
        <label for="terminos" class="mx-2">Acepto los Términos y Condiciones</label>
    </div>
    <p class="alert alert-danger mx-3 my-5" role="alert">
    </p>
    <div class="form-group mx-3 my-5 d-flex justify-content-center">
        <input type="submit" class="btn btn-primary bg-gradient" value="Actualizar datos">
    </div>
</form>