<?php

//vistas
Route::get("/", Controller::class."@main");
Route::get("/inicio", Controller::class."@inicio");
Route::get("/login", Controller::class."@login");
Route::get("/registro", Controller::class."@registro");

// vistas usuario
Route::get("/usuarios/gestor", UsuariosController::class."@userGestor");
Route::get("/usuarios/logout", UsuariosController::class."@userLogOut");

//resources
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