<?php

class SubcategoriasController extends Controller {

    public function __construct() {

    }

    public function insertSubcategory($subcategory) {
        $subcategoryModel = new SubcategoriasModel();

        $id = $subcategoryModel->insertModel($subcategory);
        $v = ($id > 0);

        $respuesta = new Respuesta($v ? Mensajes::OK_INSERT : Mensajes::ERR_INSERT);
        $respuesta->setDatos($id);
        
        return $respuesta;
    }

    public function getSubcategories() {
        $subcategoryModel = new SubcategoriasModel();
        $subcategories = $subcategoryModel->get();
        $v = (count($subcategories));

        $respuesta = new Respuesta($v ? Mensajes::OK : Mensajes::ERR);
        $respuesta->setDatos($subcategories);

        return $respuesta;
    }

    public function getSubcategoriesForCategory($category) {
        $subcategoryModel = new SubcategoriasModel();
        $subcategories = $subcategoryModel->where("categoria_id", "=", $category)->get();
        $v = (count($subcategories));

        $respuesta = new Respuesta($v ? Mensajes::OK : Mensajes::ERR);
        $respuesta->setDatos($subcategories);

        return $respuesta;
    }

    public function getSubcategory($field, $value) {
        $subcategoriesModel = new SubcategoriasModel();
        $subcategory = $subcategoriesModel->where($field, "=", $value)->first();
        $v = ($subcategory != null);

        $respuesta = new Respuesta($v ? Mensajes::OK : Mensajes::ERR);
        $respuesta->setDatos($subcategory);
        return $respuesta;
    }

    public function updateSubcategory($subcategory) {
        $subcategoryModel = new SubcategoriasModel();
        $update = $subcategoryModel->where("id", "=", $subcategory["idSubcategoria"])->updateModel($subcategory);
        $v = ($update > 0);

        $respuesta = new Respuesta($v ? Mensajes::OK_UPDATE : Mensajes::ERR_UPDATE);
        $respuesta->setDatos($update);

        return $respuesta;
    }

    public function deleteSubcategory($id) {
        $subcategoryModel = new SubcategoriasModel();
        $delete = $subcategoryModel->where("id", "=", $id)->delete();
        $v = ($delete > 0);

        $respuesta = new Respuesta($v ? Mensajes::OK_DELETE : Mensajes::ERR_DELETE);
        $respuesta->setDatos($delete);

        return $respuesta;
    }
}