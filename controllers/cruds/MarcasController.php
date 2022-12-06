<?php

class MarcasController extends Controller {

    public function __construct() {

    }

    public function insertBrand($brand) {
        $brandModel = new MarcasModel();

        $id = $brandModel->insertModel($brand);
        $v = ($id > 0);

        $respuesta = new Respuesta($v ? Mensajes::OK_INSERT : Mensajes::ERR_INSERT);
        $respuesta->setDatos($id);
        
        return $respuesta;
    }

    public function getBrands() {
        $brandModel = new MarcasModel();
        $brands = $brandModel->get();
        $v = (count($brands));

        $respuesta = new Respuesta($v ? Mensajes::OK : Mensajes::ERR);
        $respuesta->setDatos($brands);

        return $respuesta;
    }

    public function getBrand($field, $value) {
        $brandsModel = new MarcasModel();
        $brand = $brandsModel->where($field, "=", $value)->first();
        $v = ($brand != null);

        $respuesta = new Respuesta($v ? Mensajes::OK : Mensajes::ERR);
        $respuesta->setDatos($brand);
        return $respuesta;
    }

    public function updateBrand($brand) {
        $brandModel = new MarcasModel();
        $update = $brandModel->where("id", "=", $brand["idMarca"])->updateModel($brand);
        $v = ($update > 0);

        $respuesta = new Respuesta($v ? Mensajes::OK_UPDATE : Mensajes::ERR_UPDATE);
        $respuesta->setDatos($update);

        return $respuesta;
    }

    public function deleteBrand($id) {
        $brandModel = new CategoriasModel();
        $delete = $brandModel->where("id", "=", $id)->delete();
        $v = ($delete > 0);

        $respuesta = new Respuesta($v ? Mensajes::OK_DELETE : Mensajes::ERR_DELETE);
        $respuesta->setDatos($delete);

        return $respuesta;
    }
}