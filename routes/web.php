<?php

//vistas
Route::get("/", Controller::class."@main");
Route::get("/inicio", Controller::class."@inicio");
Route::get("/login", Controller::class."@login");
Route::get("/registro", Controller::class."@registro");

// vistas usuario
Route::get("/usuarios/gestor", UsuariosController::class."@userGestor");
Route::get("/usuarios/logout", UsuariosController::class."@userLogOut");

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

//productos
Route::get("/productos", function() {
    $controller = new ProductosController();
    echo $controller->getProductsForDateLimit()->json();
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