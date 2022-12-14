<h2 class="text-center">Pagina del perfil</h2>
<div class="row d-flex flex-wrap mx-3">
    <div class="text-center d-flex flex-column align-items-center col-12 col-lg-4">
        <img src="<?= ($_SESSION['user']->image !== null) ? Url::base() . '/uploads/images/users/' . $_SESSION['user']->image : Url::base() . '/uploads/images/users/default.png' ?>" class="img-user" alt="Tu imagen de perfil">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed d-block" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        ...
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <?php if ($_SESSION['user']->image !== null) : ?>
                            <a id="update-image" class="link d-block mb-3">Cambiar Imagen</a>
                            <a id="delete-image" data-image="<?= $_SESSION['user']->image ?>" class="link d-block mb-3">Quitar Imagen</a>
                        <?php else : ?>
                            <a id="add-image" class="link d-block mb-3">Agregar Imagen</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <form id="form-image-profile" class="hidden" method="POST" action="<?= Url::base() . '/forms/img' ?>" enctype="multipart/form-data">
            <input type="file" class="form-control" id="img" name="img" accept=".png, .jpg, .jpeg">
            <p class="alert alert-danger mx-3 my-5" role="alert">
            </p>
            <input type="submit" class="btn btn-primary btn-sm bg-gradient my-3" value="Subir imagen">
        </form>
    </div>
    <div class="table-responsive mt-4 col-12 col-lg-8">
        <table class="table table-borderless mt-md-3 ml-lg-4">
            <thead>

            </thead>
            <tbody>
                <tr>
                    <th scope="row">Nombre</th>
                    <td><?= $_SESSION['user']->nombre ?></td>
                </tr>
                <tr>
                    <th scope="row">Apellido</th>
                    <td><?= $_SESSION['user']->apellido ?></td>

                </tr>
                <tr>
                    <th scope="row">Email</th>
                    <td><?= $_SESSION['user']->email ?></td>
                </tr>
                <tr>
                    <th scope="row">Teléfono</th>
                    <td><?= $_SESSION['user']->fono ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row border-top border-secondary pt-4 mt-4 mx-3">
    <div class="col-12">
        <h4 class="text-center mb-4">Información adicional</h4>
        <div class="table-responsive">
            <table class="table table-borderless mt-md-3 ml-lg-4">
                <thead>

                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Pedidos realizados</th>
                        <td class="text-end">X</td>
                    </tr>
                    <tr>
                        <th scope="row">Pedidos completados</th>
                        <td class="text-end">X</td>

                    </tr>
                    <tr>
                        <th scope="row">Descuentos</th>
                        <td class="text-end">X</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>