<section class="container mb-3">
    <div class="row">
        <aside class="col-sm-12 col-md-4">
            <div class="row">
                <article class="col-12 g-3">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary bg-gradient bg-opacity-10">
                            <h5 class="card-title text-primary mt-2">Bienvenido <?= $_SESSION['user']->nombre ?></h5>
                        </div>
                        <div class="card-body">
                            <ul class="lista-gestor my-2">
                                <li class="mb-4"><a data-id="1" class="gestor-link link">Perfil</a></li>
                                <li class="mb-4"><a data-id="2" class="gestor-link link">Actualizar perfil</a></li>
                                <?php if(isset($_SESSION['admin'])) :?>
                                <li class="mb-4"><a data-id="3" class="gestor-link link">Gestionar productos</a></li>
                                <li class="mb-4"><a data-id="4" class="gestor-link link">Agregar productos</a></li>
                                <?php else :?>
                                <li class="mb-4"><a data-id="5" class="gestor-link link">Mis pedidos</a></li>
                                <?php endif; ?>
                                <li class="mb-4"><a data-id="6" class="gestor-link link">Eliminar cuenta</a></li>
                            </ul>
                        </div>
                    </div>
                </article>
            </div>
        </aside>
        <article class="col-sm-12 col-md-8">
            <div class="row">
                <article class="col-12 g-3">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary bg-gradient bg-opacity-10">
                            <h5 class="card-title text-primary mt-2">Gestor</h5>
                        </div>
                        <div id="gestor-main" class="card-body">
                            
                        </div>
                    </div>        
                </article>
            </div>
        </article>
    </div>
</section>