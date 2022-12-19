<section class="container mb-3">
    <div class="row">
    <aside class="col-12 col-lg-4">
            <div class="card mt-3">
                <h5 class="card-header bg-primary bg-gradient bg-opacity-10 text-primary text-center py-3">Carrito</h5>
                <div class="card-body">
                    <?php if (isset($_SESSION['cart'])) : ?>
                        <h3 class="card-title text-center subtitle mb-3">Carrito</h3>
                            <table class="table table-bordered my-2">
                                <thead">
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody">
                                    <?php foreach($_SESSION['cart'] as $field => $value) : ?>
                                    <tr>
                                        <td><?= $_SESSION['cart'][$field]['nombre'] ?></td>
                                        <td><?= $_SESSION['cart'][$field]['cantidad'] ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td><b>Total a pagar</b></td>
                                        <td id="totalCart"></td>
                                    </tr>
                                </tbody>
                            </table>
                    <?php else : ?>
                        <h3 class="card-title text-center subtitle">No hay carrito</h3>
                    <?php endif; ?>
                </div>
            </div>
        </aside>
        <article class="col-12 col-lg-8">
            <div id="f-order" class="card mt-3">
                <h5 class="card-header bg-primary bg-gradient bg-opacity-10 text-primary text-center py-3">Crear pedido</h5>
                <div class="card-body">
                    <?php if (isset($_SESSION['cart'])) : ?>
                        <h3 class="card-title text-center subtitle">Crear pedido</h3>
                        <form id="form-order" data-user="<?= (isset($_SESSION['user'])) ? $_SESSION['user']->permiso_id : 0 ?>" method="POST" action="">
                            <div class="form-group mx-3 my-5">
                                <select id="regiones" name="regiones" class="form-select py-2">
                                    <option value="0" disabled selected>Regiones</option>
                                </select>
                            </div>
                            <p class="alert alert-danger mx-3 my-5" role="alert">
                            </p>
                            <div class="form-group mx-3 my-5">
                                <input type="text" id="direccion" name="direccion" class="form-control py-2" placeholder="Direccion">
                            </div>
                            <p class="alert alert-danger mx-3 my-5" role="alert">
                            </p>
                            <p class="alert alert-danger mx-3 my-5" role="alert">
                            </p>
                            <div class="form-group mx-3 my-5 d-flex justify-content-center">
                                <input type="submit" class="btn btn-primary bg-gradient" value="Crear pedido">
                            </div>
                        </form>
                    <?php else : ?>
                        <h3 class="card-title text-center subtitle">Crear pedido</h3>
                    <?php endif; ?>
                </div>
            </div>
        </article>
    </div>
</section>