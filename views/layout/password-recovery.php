<section class="container my-3">
    <section class="row">
        <article class="col-md-3">
        </article>
        <article class="col-sm-12 col-md-6">
            <div class="card">
                <h5 class="card-header bg-primary bg-gradient bg-opacity-10 text-primary text-center py-3">Recuperar contraseña</h5>
                <div class="card-body">
                    <h3 class="card-title text-center subtitle">Recuperar contraseña</h3>
                    <p id="paragraph" class="text-center mx-3 my-5">Antes de recuperar la contraseña, por favor ingresa el email de tu cuenta</p>
                    <form id="form-password-recovery" method="POST" action="">
                        <div class="form-group mx-3 my-5">
                            <input type="text" id="email" name="email" class="form-control py-2" placeholder="Email">
                        </div>
                        <p class="alert alert-danger text-center mx-3 my-5" role="alert">
                        </p>
                        <div class="form-group d-flex justify-content-center mx-3 my-5">
                            <input type="submit" class="btn btn-primary bg-gradient" value="Enviar email">
                        </div>
                    </form>
                    <form id="form-send-password" method="POST" action="">
                        <div class="form-group mx-3 my-5">
                            <input type="password" id="password" name="password" class="form-control py-2" placeholder="Nueva contraseña">
                        </div>
                        <p class="alert alert-danger text-center mx-3 my-5" role="alert">
                        </p>
                        <div class="form-group mx-3 my-5">
                            <input type="password" id="password2" name="password2" class="form-control py-2" placeholder="Repite la contraseña">
                        </div>
                        <p class="alert alert-danger text-center mx-3 my-5" role="alert">
                        </p>
                        <div class="form-group d-flex justify-content-center mx-3 my-5">
                            <input type="submit" class="btn btn-primary bg-gradient" value="Enviar contraseña">
                        </div>
                    </form>
                </div>
            </div>
        </article>
        <article class="col-md-3">
        </article>
    </section>
</section>