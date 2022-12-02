<?php

class SubcategoriasModel extends Model {
    protected $id;
    protected $nombre;
    protected $categoria_id;

    public function __construct($properties = null) {
        parent::__construct("subcategorias", SubcategoriasModel::class, $properties);
    }

    public function getId() {
        return $this -> id;
    }

    public function getNombre() {
        return $this -> nombre;
    }

    public function getCategoriaId() {
        return $this -> categoria_id;
    }

    public function setNombre($nombre) {
        $this -> nombre = $nombre;
    }

    public function setCategortiaId($categoria_id) {
        $this -> categoria_id = $categoria_id;
    }
}