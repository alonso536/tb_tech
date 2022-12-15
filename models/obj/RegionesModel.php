<?php

class RegionesModel extends Model {
    protected $id;
    protected $nombre;

    public function __construct($properties = null) {
        parent::__construct("regiones", RegionesModel::class, $properties);
    }

    public function getId() {
        return $this -> id;
    }

    public function getNombre() {
        return $this -> nombre;
    }

    public function setNombre($nombre) {
        $this -> nombre = $nombre;
    }
}
