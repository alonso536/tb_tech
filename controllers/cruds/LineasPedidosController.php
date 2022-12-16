<?php

class LineasPedidosController extends Controller {

    public function __construct() {

    }

    public function insertLineOrder($lineOrder) {
        $lineOrderModel = new LineasPedidosModel();

        $id = $lineOrderModel->insertModel($lineOrder);
        $v = ($id > 0);

        $respuesta = new Respuesta($v ? Mensajes::OK_INSERT : Mensajes::ERR_INSERT);
        $respuesta->setDatos($id);
        
        return $respuesta;
    }

    public function getLineOrders() {
        $lineOrdersModel = new LineasPedidosModel();
        $lineOrders = $lineOrdersModel->get();
        $v = (count($lineOrders));

        $respuesta = new Respuesta($v ? Mensajes::OK : Mensajes::ERR);
        $respuesta->setDatos($lineOrders);

        return $respuesta;
    }

    public function getLineOrder($field, $value) {
        $lineOrdersModel = new LineasPedidosModel();
        $lineOrder = $lineOrdersModel->where($field, "=", $value)->first();
        $v = ($lineOrder != null);

        $respuesta = new Respuesta($v ? Mensajes::OK : Mensajes::ERR);
        $respuesta->setDatos($lineOrder);
        return $respuesta;
    }

    public function updateLineOrder($lineOrder, $id) {
        $lineOrderModel = new LineasPedidosModel();
        $update = $lineOrderModel->where("id", "=", $id)->updateModel($lineOrder);
        $v = ($update > 0);

        $respuesta = new Respuesta($v ? Mensajes::OK_UPDATE : Mensajes::ERR_UPDATE);
        $respuesta->setDatos($update);

        return $respuesta;
    }

    public function deleteLineOrder($id) {
        $lineOrderModel = new LineasPedidosModel();
        $delete = $lineOrderModel->where("id", "=", $id)->delete();
        $v = ($delete > 0);

        $respuesta = new Respuesta($v ? Mensajes::OK_DELETE : Mensajes::ERR_DELETE);
        $respuesta->setDatos($delete);

        return $respuesta;
    }
}