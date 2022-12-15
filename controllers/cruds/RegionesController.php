<?php

class RegionesController extends Controller {

    public function __construct() {

    }

    public function insertReg($reg) {
        $regModel = new RegionesModel();

        $id = $regModel->insertModel($reg);
        $v = ($id > 0);

        $respuesta = new Respuesta($v ? Mensajes::OK_INSERT : Mensajes::ERR_INSERT);
        $respuesta->setDatos($id);
        
        return $respuesta;
    }

    public function getRegs() {
        $regModel = new RegionesModel();
        $reg = $regModel->get();
        $v = (count($reg));

        $respuesta = new Respuesta($v ? Mensajes::OK : Mensajes::ERR);
        $respuesta->setDatos($reg);

        return $respuesta;
    }

    public function getReg($field, $value) {
        $regModel = new RegionesModel();
        $reg = $regModel->where($field, "=", $value)->first();
        $v = ($reg != null);

        $respuesta = new Respuesta($v ? Mensajes::OK : Mensajes::ERR);
        $respuesta->setDatos($reg);
        return $respuesta;
    }

    public function updateReg($reg, $id) {
        $regModel = new RegionesModel();
        $update = $regModel->where("id", "=", $id)->updateModel($reg);
        $v = ($update > 0);

        $respuesta = new Respuesta($v ? Mensajes::OK_UPDATE : Mensajes::ERR_UPDATE);
        $respuesta->setDatos($update);

        return $respuesta;
    }

    public function deleteReg($id) {
        $regModel = new RegionesModel();
        $delete = $regModel->where("id", "=", $id)->delete();
        $v = ($delete > 0);

        $respuesta = new Respuesta($v ? Mensajes::OK_DELETE : Mensajes::ERR_DELETE);
        $respuesta->setDatos($delete);

        return $respuesta;
    }
}