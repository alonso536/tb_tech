<h2 class="text-center">Mis Valoraciones</h2>
<table class="table table-bordered my-4">
    <thead class="table-secondary">
        <tr>
            <th scope="col">Código</th>
            <th scope="col">Producto</th>
            <th scope="col">Estrellas</th>
            <th scope="col">Comentario</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody id="list-vals" data-id="<?= (isset($_SESSION['user'])) ? $_SESSION['user']->id : 0 ?>">
    </tbody>
</table>