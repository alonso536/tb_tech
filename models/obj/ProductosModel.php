<?php

class ProductosModel extends Model {
    protected $id;
    protected $categoria_id;
    protected $nombre;
    protected $descripcion;
    protected $precio;
    protected $stock;
    protected $oferta;
    protected $fecha;
    protected $image;
    protected $subcategoria_id;
    protected $marca_id;

    public function __construct($properties = null) {
        parent::__construct("productos", CategoriasModel::class, $properties);
    }

    public function getId() {
        return $this -> id;
    }

    public function getCategoriaId() {
        return $this -> categoria_id;
    }

    public function getNombre() {
        return $this -> nombre;
    }

    public function getDescripcion() {
        return $this -> descripcion;
    }

    public function getPrecio() {
        return $this -> precio;
    }

    public function getStock() {
        return $this -> stock;
    }

    public function getOferta() {
        return $this -> oferta;
    }

    public function getFecha() {
        return $this -> fecha;
    }

    public function getImage() {
        return $this -> image;
    }

    public function getSubcategoriaId() {
        return $this -> subcategoria_id;
    }

    public function getMarcaId() {
        return $this -> marca;
    }

    public function setCategoriaId($categoria_id) {
        $this -> categoria_id = $categoria_id;
    }

    public function setNombre($nombre) {
        $this -> nombre = $nombre;
    }

    public function setDescripcion($descripcion) {
        $this -> descripcion = $descripcion;
    }

    public function setPrecio($precio) {
        $this -> precio = $precio;
    }
    
    public function setStock($stock) {
        $this -> stock = $stock;
    }

    public function setOferta($oferta) {
        $this -> oferta = $oferta;
    }

    public function setFecha($fecha) {
        $this -> fecha = $fecha;
    }

    public function setImage($image) {
        $this -> image = $image;
    }

    public function setSubcategoriaId($subcategoria_id) {
        $this -> subcategoria_id = $subcategoria_id;
    }

    public function setMarcaId($marca_id) {
        $this -> marca_id = $marca_id;
    }
}
