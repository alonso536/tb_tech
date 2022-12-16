<?php

class LineasPedidosModel extends Model {
    protected $id;
    protected $pedido_id;
    protected $producto_id;
    protected $unidades;

    public function __construct($properties = null) {
        parent::__construct("lineas_pedidos", LineasPedidosModel::class, $properties);
    }

    public function getId() {
        return $this -> id;
    }

    public function getPedidoId() {
        return $this -> pedido_id;
    }

    public function getProductoId() {
        return $this -> producto_id;
    }

    public function getUnidades() {
        return $this -> id;
    }

    public function setPedidoId($pedido_id) {
        $this -> pedido_id = $pedido_id;
    }

    public function setProductoId($producto_id) {
        $this -> producto_id = $producto_id;
    }

    public function setUnidades($unidades) {
        $this -> unidades = $unidades;
    }
}