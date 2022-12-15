<?php

class CategoriasController extends Controller {

    public function __construct() {

    }

    public function insertCategory($category) {
        $categoryModel = new CategoriasModel();

        $id = $categoryModel->insertModel($category);
        $v = ($id > 0);

        $respuesta = new Respuesta($v ? Mensajes::OK_INSERT : Mensajes::ERR_INSERT);
        $respuesta->setDatos($id);
        
        return $respuesta;
    }

    public function getCategories() {
        $categoryModel = new CategoriasModel();
        $categories = $categoryModel->get();
        $v = (count($categories));

        $respuesta = new Respuesta($v ? Mensajes::OK : Mensajes::ERR);
        $respuesta->setDatos($categories);

        return $respuesta;
    }

    public function getCategory($field, $value) {
        $categoriesModel = new CategoriasModel();
        $category = $categoriesModel->where($field, "=", $value)->first();
        $v = ($category != null);

        $respuesta = new Respuesta($v ? Mensajes::OK : Mensajes::ERR);
        $respuesta->setDatos($category);
        return $respuesta;
    }

    public function updateCategory($category, $id) {
        $categoryModel = new CategoriasModel();
        $update = $categoryModel->where("id", "=", $id)->updateModel($category);
        $v = ($update > 0);

        $respuesta = new Respuesta($v ? Mensajes::OK_UPDATE : Mensajes::ERR_UPDATE);
        $respuesta->setDatos($update);

        return $respuesta;
    }

    public function deleteCategory($id) {
        $categoryModel = new CategoriasModel();
        $delete = $categoryModel->where("id", "=", $id)->delete();
        $v = ($delete > 0);

        $respuesta = new Respuesta($v ? Mensajes::OK_DELETE : Mensajes::ERR_DELETE);
        $respuesta->setDatos($delete);

        return $respuesta;
    }
}