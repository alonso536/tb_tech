<?php

class UsuariosModel extends Model {
    protected $id;
    protected $nombre;
    protected $apellido;
    protected $email;
    protected $password;
    protected $fono;
    protected $rol;
    protected $image;

    public function __construct($properties = null) {
        parent::__construct("usuarios", UsuariosModel::class, $properties);
    }

    public function getId() {
        return $this -> id;
    }

    public function getNombre() {
        return $this -> nombre;
    }

    public function getApellido() {
        return $this -> apellido;
    }

    public function getEmail() {
        return $this -> email;
    }

    public function getPassword() {
        return $this -> password;
    }

    public function getFono() {
        return $this -> fono;
    }

    public function getRol() {
        return $this -> rol;
    }

    public function getImage() {
        return $this -> image;
    }

    public function getActivo() {
        return $this -> activo;
    }

    public function setNombre($nombre) {
        $this -> nombre = $nombre;
    }

    public function setApellido($apellido) {
        $this -> apellido = $apellido;
    }

    public function setEmail($email) {
        $this -> email = $email;
    }

    public function setPassword($password) {
        $this -> password = $password;
    }

    public function setFono($fono) {
        $this -> fono = $fono;
    }

    public function setRol($rol) {
        $this -> rol = $rol;
    }

    public function setImage($image) {
        $this -> image = $image;
    }
}