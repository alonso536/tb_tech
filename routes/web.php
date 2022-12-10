<?php

//vistas
Route::get("/", Controller::class."@main");
Route::get("/inicio", Controller::class."@inicio");
Route::get("/login", Controller::class."@login");
Route::get("/registro", Controller::class."@registro");

// vistas usuario
Route::get("/usuarios/gestor", UsuariosController::class."@userGestor");
Route::get("/usuarios/logout", UsuariosController::class."@userLogOut");
Route::get("/gestor/perfil", UsuariosController::class."@profile");
Route::get("/gestor/actualizar-perfil", UsuariosController::class."@updateProfile");
Route::get("/gestor/productos", UsuariosController::class."@products");
Route::get("/gestor/agregar-productos", UsuariosController::class."@addProducts");
Route::get("/gestor/pedidos", UsuariosController::class."@orders");
Route::get("/gestor/eliminar-cuenta", UsuariosController::class."@deleteAccount");
Route::get("/gestor/activar-cuenta", UsuariosController::class."@activeAccount");

Route::post("/gestor/actualizar-productos", function(Request $request) {
    $controller = new UsuariosController();
    $datos = json_decode($request->datos);
    $controller->updateProducts((int) $datos->id);
});

//categorias
Route::get("/categorias", function() {
    $controller = new CategoriasController();
    echo $controller->getCategories()->json();
});

//subcategorias
Route::get("/subcategorias", function() {
    $controller = new SubcategoriasController();
    echo $controller->getSubcategories()->json();
});

Route::post("/subcategorias/categorias", function(Request $request) {
    $controller = new SubcategoriasController();
    $datos = json_decode($request->datos);

    echo $controller->getSubcategoriesForCategory((int) $datos->categoria)->json();
});

//productos
Route::get("/productos", function() {
    $controller = new ProductosController();
    echo $controller->getProducts()->json();
});

//marcas
Route::get("/marcas", function() {
    $controller = new MarcasController();
    echo $controller->getBrands()->json();
});

Route::post("/productos/categorias", function(Request $request) {
    $controller = new ProductosController();
    $datos = json_decode($request->datos);

    if(is_null($datos->subcategoria)) {
        echo $controller->getProductsForCategory((int) $datos->categoria)->json();
    } else {
        echo $controller->getProductsForCategory((int) $datos->categoria, (int) $datos->subcategoria)->json();
    }
});

//recursos
Route::get("/resources/expresiones", Controller::class."@sendRegExp");

//formularios
Route::post("/forms/register", function(Request $request) {
    $controller = new FormController();
    echo $controller->registerValidate($request)->json();
});

Route::post("/forms/login", function(Request $request) {
    $controller = new FormController();
    echo $controller->loginValidate($request)->json();
});

Route::post("/forms/update-profile", function(Request $request) {
    $controller = new FormController();
    echo $controller->updateProfileValidate($request)->json();
    session_destroy();
});

Route::post("/forms/products", function(Request $request) {
    $controller = new FormController();
    echo $controller->productValidate($request)->json();
});

Route::post("/forms/update-product", function(Request $request) {
    $controller = new FormController();
    echo $controller->updateProductValidate($request)->json();
});

Route::post("/forms/img-user", function() {
    $controller = new ImageController();
    if(isset($_FILES['img'])) {
        echo $controller->validateImage('users/', $_FILES['img'], 'user', UsuariosController::class)->json();
    } else {
        $res = new Respuesta(Mensajes::ERR);
        echo $res->json();
    }
});

Route::post("/forms/delete-img-user", function(Request $request) {
    $controller = new ImageController();
    $image = json_decode($request->datos);

    $res = $controller->deleteImage($_SERVER['DOCUMENT_ROOT'].'/shop/uploads/images/users/', $image->image);

    if($res->getCodigo() == -1) {
        $response = new Respuesta(Mensajes::ERR, 'No se pudo quitar la imagen');
        echo $response->json();
    } else {
        $userController = new UsuariosController();
        $updateUser = array(
            'image' => ''
        );

        $_SESSION['user']->image = null;
        echo $userController->updateUser($updateUser, $_SESSION['user']->id)->json();
    }
});