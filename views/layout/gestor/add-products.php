<h2>Agregar productos</h2>
<form id="form-product" method="POST" action="">
    <div class="form-group mx-3 my-5">
        <input type="text" id="nombre" name="nombre" class="form-control py-2" placeholder="Nombre">
    </div>
    <p class="alert alert-danger mx-3 my-5" role="alert">
    </p>
    <div class="form-group mx-3 my-5">
        <textarea id="descripcion" name="descripcion" class="form-control py-2" placeholder="Descripcion"></textarea>
    </div>
    <p class="alert alert-danger mx-3 my-5" role="alert">
    </p>
    <div class="form-group mx-3 my-5">
        <input type="number" id="precio" name="precio" class="form-control py-2" placeholder="Precio">
    </div>
    <p class="alert alert-danger mx-3 my-5" role="alert">
    </p>
    <div class="form-group mx-3 my-5">
        <input type="number" id="stock" name="stock" class="form-control py-2" placeholder="Stock">
    </div>
    <p class="alert alert-danger mx-3 my-5" role="alert">
    </p>
    <div class="form-group mx-3 my-5">
        <select id="categorias" name="categorias" class="form-select py-2">
            <option disabled selected>Categorías</option>
        </select>
    </div>
    <div class="form-group mx-3 my-5">
        <select id="subcategorias" name="subcategorias" class="form-select py-2">
            <option disabled selected>Sub-Categorías</option>
        </select>
    </div>
    <!--<div class="form-group mx-3 my-5">
        <select id="marcas" name="marcas" class="form-select py-2">
            <option disabled selected>Marcas</option>
        </select>
    </div>-->
    <div class="form-group mx-3 my-5 d-flex justify-content-center">
        <input type="submit" class="btn btn-primary bg-gradient" value="Agregar Producto">
    </div>
</form>