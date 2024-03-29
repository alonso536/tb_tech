<?php

class PedidosModel extends Model {
    protected $id;
    protected $usuario_id;
    protected $region_id;
    protected $direccion;
    protected $monto;
    protected $estado_id;
    protected $fecha;


    public function __construct($properties = null) {
        parent::__construct("pedidos", PedidosModel::class, $properties);
    }

    public function getId() {
        return $this -> id;
    }

    public function getUsuarioId() {
        return $this -> usuario_id;
    }

    public function getRegionId() {
        return $this -> region_id;
    }

    public function getDireccion() {
        return $this -> direccion;
    }

    public function getMonto() {
        return $this -> monto;
    }

    public function getEstadoId() {
        return $this -> estado_id;
    }

    public function getFecha() {
        return $this -> fecha;
    }

    public function setUsuarioId($usuario_id) {
        $this -> usuario_id = $usuario_id;
    }

    public function setRegionId($region_id) {
        $this -> region_id = $region_id;
    }

    public function setDireccion($direccion) {
        $this -> direccion = $direccion;
    }

    public function setMonto($monto) {
        $this -> monto = $monto;
    }

    public function setEstadoId($estado_id) {
        $this -> estado_id = $estado_id;
    }

    public function setFecha($fecha) {
        $this -> fecha = $fecha;
    }
}