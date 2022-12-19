<?php

class ValoracionesController extends Controller {

    public function __construct() {

    }

    public function insertVal($val) {
        $valModel = new ValoracionesModel();

        $id = $valModel->insertModel($val);
        $v = ($id > 0);

        $respuesta = new Respuesta($v ? Mensajes::OK_INSERT : Mensajes::ERR_INSERT);
        $respuesta->setDatos($id);
        
        return $respuesta;
    }

    public function getVals() {
        $valModel = new ValoracionesModel();
        $val = $valModel->get();
        $v = (count($val));

        $respuesta = new Respuesta($v ? Mensajes::OK : Mensajes::ERR);
        $respuesta->setDatos($val);

        return $respuesta;
    }

    public function getValsByField($field, $value) {
        $valModel = new ValoracionesModel();
        $val = $valModel->where($field, "=", $value)->get();
        $v = (count($val));

        $respuesta = new Respuesta($v ? Mensajes::OK : Mensajes::ERR);
        $respuesta->setDatos($val);

        return $respuesta;
    }

    public function getVal($field, $value) {
        $valModel = new ValoracionesModel();
        $val = $valModel->where($field, "=", $value)->first();
        $v = ($val != null);

        $respuesta = new Respuesta($v ? Mensajes::OK : Mensajes::ERR);
        $respuesta->setDatos($val);
        return $respuesta;
    }

    public function updateVal($val, $id) {
        $valModel = new ValoracionesModel();
        $update = $valModel->where("id", "=", $id)->updateModel($val);
        $v = ($update > 0);

        $respuesta = new Respuesta($v ? Mensajes::OK_UPDATE : Mensajes::ERR_UPDATE);
        $respuesta->setDatos($update);

        return $respuesta;
    }

    public function deleteVal($id) {
        $valModel = new ValoracionesModel();
        $delete = $valModel->where("id", "=", $id)->delete();
        $v = ($delete > 0);

        $respuesta = new Respuesta($v ? Mensajes::OK_DELETE : Mensajes::ERR_DELETE);
        $respuesta->setDatos($delete);

        return $respuesta;
    }

    public function getValsByProduct() {
        if(isset($_SESSION['product'])) {
            $id = (int) $_SESSION['product']->id;
        } else {
            $id = 0;
        }

        $sql = $this->queryVals($id);
        $val = (new Crud())->complexQuery($sql);

        $v = (count($val));

        $respuesta = new Respuesta($v ? Mensajes::OK : Mensajes::ERR);
        $respuesta->setDatos($val);

        return $respuesta;
    }
}