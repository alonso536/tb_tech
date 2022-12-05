<section class="container-fluid bg-white bg-gradient shadow-sm py-5">
        <h1 class="text-center py-4">TB TECH</h1>
        <p class="text-center py-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
    </section>
    <section class="container mb-3">
        <div class="row">
            <aside class="col-sm-12 col-md-4">
                <div class="row">
                    <article class="col-12 g-3">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary bg-gradient bg-opacity-10">
                                <h5 class="card-title text-primary mt-2">Busqueda</h5>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="search" class="form-label">¿Qué buscas?</label>
                                        <input type="search" class="form-control" id="search" aria-describedby="emailHelp" />
                                    </div>
                                    <button type="submit" class="btn btn-primary bg-gradient">
                                        Buscar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="row">
                    <article class="col-12 g-3">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary bg-gradient bg-opacity-10">
                                <h5 class="card-title text-primary mt-2">Categorias</h5>
                            </div>
                            <div class="card-body">
                                <div class="accordion accordion-flush" id="accordionCategory">
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </aside>
            <article class="col-sm-12 col-md-8">
                <div id="productos" class="row d-flex align-content-start">
                </div>
                <div id="paginador" class="row">
                    <div class="col-4 col-md-2 my-3 d-flex justify-content-center">
                        <button id="anterior" class="btn btn-primary btn-sm bg-gradient"><</button>
                    </div>
                    <div class="col-4 col-md-8 d-flex justify-content-evenly align-items-center">
                    </div>
                    <div class="col-4 col-md-2 my-3 d-flex justify-content-center">
                        <button id="siguiente" class="btn btn-primary btn-sm bg-gradient">></button>
                    </div>
                </div>
            </article>
        </div>
</section>