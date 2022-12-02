<?php

class Model extends Crud {
    private $className;
    private $excluir = ["className", "table", "conexion", "where", "orderBy", "limti", "sql", "excluir"];

    public function __construct($table, $className, $properties = null) {
        parent::__construct($table); // constructor de crud
        $this->className = $className;

        if(empty($properties)) {
            return;
        }

        foreach($properties as $field => $value) {
            $this->{$field} = $value;
        }
    }

    protected function getAttributes() {
        $vars = get_class_vars($this->className);
        $attributes = [];
        $max = count($vars);

        foreach($vars as $field => $value) {
            if(!in_array($field, $this->excluir)) {
                $attributes[] = $field;
            }
        }

        return $attributes;
    }

    protected function parse($obj = null) {
        try {
            $attributes = $this->getAttributes();
            $finalObj = [];

            if($obj == null) {
                foreach($attributes as $in => $field) {
                    if(isset($this->{$field})) {
                        $finalObj[$field] = $this->{$field};
                    }
                }
                return $finalObj;
            }

            foreach($attributes as $in => $field) {
                if(isset($obj[$field])) {
                    $finalObj[$field] = $obj[$field];
                }
            }
            return $finalObj;
        } catch(Exception $ex) {
            throw new Exception("Error en " . $this->className . ".parse() => " . $ex->getMessage());
        }
    }

    public function fill($obj) {
        try {
            $attributes = $this->getAttributes();

            foreach($attributes as $in => $field) {
                if(isset($obj[$field])) {
                    $this->{$field} = $obj[$field];
                }
            }
        } catch(Exception $ex) {
            throw new Exception("Error en " . $this->className . ".fill() => " . $ex->getMessage());
        }
    }

    public function insertModel($obj = null) {
        $obj = $this->parse($obj);
        return parent::insert($obj);
    }

    public function updateModel($obj) {
        $obj = $this->parse($obj);
        return parent::update($obj);
    }

    /*public function __get($attribute) {
        return $this->{$attribute};
    }

    public function __set($attribute, $value) {
        $this->$attribute = $value;
    }*/
}