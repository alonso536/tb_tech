<section class="container my-3">
    <div class="row">
        <div class="col-12">
            <div id="producto" class="card shadow-sm">
                <div class="card-header bg-primary bg-gradient bg-opacity-10">
                    <?php if (isset($_SESSION['product'])) : ?>
                        <h5 id="product-title" class="text-center text-primary mt-2"><?= $_SESSION['product']->nombre ?></h5>
                    <?php else : ?>
                        <h5 class="text-center text-primary mt-2">No se ha encontrado el producto</h5>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <?php if (isset($_SESSION['product'])) : ?>
                        <div id="contenido-producto" data-id="<?= $_SESSION['product']->id ?>" data-category="<?= $_SESSION['product']->categoria_id ?>" class="row p-3 border-bottom border-secondary mx-2">
                            <div class="col-12 col-md-6">
                                <img src="<?= ($_SESSION['product']->image !== null) ? Url::base() . '/uploads/images/products/' . $_SESSION['product']->image : Url::base() . '/uploads/images/products/product-default.png' ?>" class="img-product" alt="<?= $_SESSION['product']->nombre ?>">
                            </div>
                            <div class="col-12 col-md-6 d-flex flex-column justify-content-evenly">
                                <h2 class="card-title text-center border-bottom border-secondary py-3"><?= $_SESSION['product']->nombre ?></h2>
                                <div>
                                    <h5 class="text-start d-flex justify-content-evenly my-3"><b>Precio Oferta: </b><span class="text-primary"><?= $_SESSION['product']->precio ?></span></h5>
                                    <h5 class="text-start d-flex justify-content-evenly my-3"><b>Precio Normal: </b><span class="text-primary"><?= $_SESSION['product']->precio ?></span></h5>
                                </div>
                                <div id="prod" data-user="<?=$_SESSION['user']->permiso_id?>" class="text-center py-3">
                                    <?php if ($_SESSION['user']->permiso_id == 2) : ?>
                                        <button class="btn btn-primary btn-lg bg-gradient mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                            Gestionar imagenes
                                        </button>
                                        <div class="collapse" id="collapseExample">
                                            <div class="card card-body mb-3">
                                                <?php if ($_SESSION['product']->image !== null) : ?>
                                                    <a id="update-image" class="link d-block">Cambiar Imagen</a>
                                                    <a id="delete-image" data-image="<?= $_SESSION['product']->image ?>" class="link d-block">Quitar Imagen</a>
                                                <?php else : ?>
                                                    <a id="add-image" class="link d-block">Agregar Imagen</a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <form id="form-image-product" class="hidden" method="POST" action="<?= Url::base() . '/forms/img' ?>" enctype="multipart/form-data">
                                            <input type="file" class="form-control" id="img" name="img" accept=".png, .jpg, .jpeg">
                                            <p class="alert alert-danger mx-3 my-5" role="alert">
                                            </p>
                                            <input type="submit" class="btn btn-primary btn-sm bg-gradient my-3" value="Subir imagen">
                                        </form>
                                    <?php else : ?>
                                        <a id="buy" data-id="<?= $_SESSION['product']->id ?>" class="d-block btn btn-primary btn-lg bg-gradient mb-3">Comprar</a>
                                        <div id="inp-cantidad" data-stock="<?= $_SESSION['product']->stock ?>" class="input-group">
                                            <button class="input-group-text btn btn-primary bg-gradient">-</button>
                                            <input type="text" class="form-control text-center" id="cantidad" name="cantidad" value="1" aria-label="Username" disabled>
                                            <button class="input-group-text btn btn-primary bg-gradient">+</button>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <h6 class="text-start d-flex justify-content-evenly pb-3"><b>Stock en tienda: </b><span class="text-primary"><?= $_SESSION['product']->stock ?></span></h6>
                            </div>
                        </div>
                        <div class="btn-group d-flex justify-content-center mt-3 py-3" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="btnradio" id="descripcion" autocomplete="off" checked>
                            <label class="btn btn-outline-primary bg-gradient" for="descripcion">Descripcion</label>

                            <input type="radio" class="btn-check" name="btnradio" id="valoraciones" autocomplete="off">
                            <label class="btn btn-outline-primary bg-gradient" for="valoraciones">Valoraciones</label>
                        </div>
                        <div id="content" class="text-start p-lg-3 p-md-3 px-0 border-bottom border-secondary mx-2">
                            <div>
                                <h2 class="text-center py-3">Descripción</h2>
                                <p class="description-paragraph"><?= $_SESSION['product']->descripcion ?></p>
                            </div>
                            <div id="vals" class="hidden">
                                <h2 class="text-center py-3">Valoraciones</h2>
                                <?php if (isset($_SESSION['user']) && $_SESSION['user']->permiso_id == 1) : ?>
                                <form id="form-val" method="POST" action="">
                                    <div class="form-group mx-lg-3 mx-md-3 mx-0 my-2">
                                        <select id="estrellas" name="estrellas" class="form-select py-2">
                                            <option value="0" disabled selected>Estrellas</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                    <p class="alert alert-danger mx-lg-3 mx-md-3 mx-0 my-2" role="alert">
                                    </p>
                                    <div class="form-group mx-lg-3 mx-md-3 mx-0 my-2">
                                        <textarea id="comentario" name="comentario" class="form-control py-2" placeholder="Escribe un comentario a tu valoración"></textarea>
                                    </div>
                                    <p class="alert alert-danger mx-lg-3 mx-md-3 mx-0 my-2" role="alert">
                                    </p>
                                    <p class="alert alert-danger mx-lg-3 mx-md-3 mx-0 my-2" role="alert">
                                    </p>
                                    <div class="form-group mx-lg-3 mx-md-3 mx-0 my-2 d-flex justify-content-start">
                                        <input type="submit" class="btn btn-primary bg-gradient" value="Publicar valoración">
                                    </div>
                                </form>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div id="random-products" data-user="<?= $_SESSION['user']->permiso_id ?>" class="row mt-3">
                          <h2 class="text-center py-3">Productos relacionados</h2>
                        </div>
                    <?php else : ?>
                        <h2 class="text-center text-primary mt-2">No se ha encontrado el producto</h2>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>