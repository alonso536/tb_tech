<?php

class PedidosController extends Controller {

    public function __construct() {

    }

    public function insertOrder($order) {
        $orderModel = new PedidosModel();

        $id = $orderModel->insertModel($order);
        $v = ($id > 0);

        $respuesta = new Respuesta($v ? Mensajes::OK_INSERT : Mensajes::ERR_INSERT);
        $respuesta->setDatos($id);
        
        return $respuesta;
    }

    public function getOrders() {
        $ordersModel = new PedidosModel();
        $orders = $ordersModel->get();
        $v = (count($orders));

        $respuesta = new Respuesta($v ? Mensajes::OK : Mensajes::ERR);
        $respuesta->setDatos($orders);

        return $respuesta;
    }

    public function getOrder($field, $value) {
        $ordersModel = new PedidosModel();
        $order = $ordersModel->where($field, "=", $value)->first();
        $v = ($order != null);

        $respuesta = new Respuesta($v ? Mensajes::OK : Mensajes::ERR);
        $respuesta->setDatos($order);
        return $respuesta;
    }

    public function updateOrder($order, $id) {
        $orderModel = new PedidosModel();
        $update = $orderModel->where("id", "=", $id)->updateModel($order);
        $v = ($update > 0);

        $respuesta = new Respuesta($v ? Mensajes::OK_UPDATE : Mensajes::ERR_UPDATE);
        $respuesta->setDatos($update);

        return $respuesta;
    }

    public function deleteOrder($id) {
        $orderModel = new PedidosModel();
        $delete = $orderModel->where("id", "=", $id)->delete();
        $v = ($delete > 0);

        $respuesta = new Respuesta($v ? Mensajes::OK_DELETE : Mensajes::ERR_DELETE);
        $respuesta->setDatos($delete);

        return $respuesta;
    }
}