<h2 class="text-center">Mis Pedidos</h2> 
<table class="table table-bordered my-4">
    <thead class="table-secondary">
        <tr>
            <th scope="col">Código</th>
            <th scope="col">Dirección</th>
            <th scope="col">Monto</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody id="list-orders" data-id="<?= (isset($_SESSION['user'])) ? $_SESSION['user']->id : 0 ?>">
    </tbody>
</table>