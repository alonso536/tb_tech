<?php

class ValoracionesModel extends Model {
    protected $id;
    protected $producto_id;
    protected $usuario_id;
    protected $nivel;
    protected $comentario;
    protected $fecha;

    public function __construct($properties = null) {
        parent::__construct("valoraciones", ValoracionesModel::class, $properties);
    }

    public function getId() {
        return $this -> id;
    }

    public function getProductoId() {
        return $this -> producto_id;
    }

    public function getUsuarioId() {
        return $this -> usuario_id;
    }

    public function getNivel() {
        return $this -> nivel;
    }

    public function getComentario() {
        return $this -> comentario;
    }

    public function getFecha() {
        return $this -> fecha;
    }

    public function setProductoId($producto_id) {
        $this -> producto_id = $producto_id;
    }

    public function setUsuarioId($usuario_id) {
        $this -> usuario_id = $usuario_id;
    }

    public function setNivel($nivel) {
        $this -> nivel = $nivel;
    }

    public function setComentario($comentario) {
        $this -> comentario = $comentario;
    }

    public function setFecha($fecha) {
        $this -> fecha = $fecha;
    }
}