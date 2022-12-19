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

    public function getOrdersByUser($id) {
        $ordersModel = new PedidosModel();
        $orders = $ordersModel->where('usuario_id', "=", $id)->get();
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

    public function getOrderDetail() {
        $crud = new Crud();

        if(isset($_SESSION['user']) && isset($_SESSION['idOrder'])) {
            $idUser = (int) $_SESSION['user']->id;
            $idOrder = (int) $_SESSION['idOrder'];
        } else {
            $idUser = 0;
            $idOrder = 0;
        }

        if(isset($_SESSION['order'])) {
            unset($_SESSION['order']);
        }

        $data = [];

        $sql = $this->queryOrderDetail($idUser, $idOrder);
        $data[] = $crud->complexQuery($sql);

        $sql = $this->queryProductsOrderDetail($idUser, $idOrder);
        $data[] = $crud->complexQuery($sql);

        $v = (!is_null($data[0]) && !is_null($data[1])); 

        $respuesta = new Respuesta($v ? Mensajes::OK : Mensajes::ERR);
        $respuesta->setDatos($data); 

        if($respuesta->getCodigo() == 1) {
            $_SESSION['order'] = $data[1];
        }
        
        return $respuesta;
    }   
}