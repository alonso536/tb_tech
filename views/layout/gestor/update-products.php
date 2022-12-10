<h2 class="text-center">Actualizar Producto</h2>
<form id="form-update-product" method="POST" action="">
    <div class="form-group mx-3 my-5">
        <input type="text" id="nombre-producto" name="nombre-producto" class="form-control py-2" placeholder="Nombre" value="<?= $_SESSION['product']->nombre ?>">
    </div>
    <p class="alert alert-danger mx-3 my-5" role="alert">
    </p>
    <div class="form-group mx-3 my-5">
        <input type="number" id="precio" name="precio" class="form-control py-2" placeholder="Precio" value="<?= $_SESSION['product']->precio ?>">
    </div>
    <p class="alert alert-danger mx-3 my-5" role="alert">
    </p>
    <div class="form-group mx-3 my-5">
        <input type="number" id="stock" name="stock" class="form-control py-2" placeholder="Stock" value="<?= $_SESSION['product']->stock ?>">
    </div>
    <p class="alert alert-danger mx-3 my-5" role="alert">
    </p>
    <div class="form-group mx-3 my-5">
        <textarea id="descripcion" name="descripcion" class="form-control py-2" spellcheck="true" placeholder="Descripcion" value="<?= $_SESSION['product']->nombre ?>"></textarea>
    </div>
    <p class="alert alert-danger mx-3 my-5" role="alert">
    </p>
    <p class="alert alert-danger mx-3 my-5" role="alert">
    </p>
    <div class="form-group mx-3 my-5 d-flex justify-content-center">
        <input type="submit" class="btn btn-primary bg-gradient" value="Actualizar Producto">
    </div>
</form>