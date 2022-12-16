<section class="container my-3">
    <div class="row">
        <div class="col-12">
            <div id="carrito" class="card shadow-sm">
                <div class="card-header bg-primary bg-gradient bg-opacity-10">
                    <h5 class="text-center text-primary mt-2">Mi carrito</h5>
                </div>
                <div id="cart-body" class="card-body table-responsive">

                </div>
                <div class="card-footer hidden">
                    <div class="row">
                        <div class="col-12 col-md-4 text-center text-md-start">
                            <button id="create-order" class="btn btn-primary bg-gradient my-2">Realizar pedido</button>
                        </div>
                        <div class="col-12 col-md-4 text-center">
                            <button id="delete-cart" class="btn btn-danger bg-gradient my-2">Borrar carrito</button>
                        </div>
                        <div class="col-12 col-md-4">
                            <table class="table table-bordered my-2">
                                <tbody id="list-products">
                                    <tr>
                                        <td>Total: </td>
                                        <td id="totalCart"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>