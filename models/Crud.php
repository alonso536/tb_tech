<?php

class Crud {
    private $table;
    private $conexion;
    private $where = "";
    private $orderBy = "";
    private $limit = "";
    private $sql = null;

    public function __construct($table = null) {
        $this->conexion = (new Connection())->connect(); //constructor de crud hace una instancia de conexion
        $this->table = $table;
    }

    public function get() {
        try {
            $this->sql = "SELECT * FROM {$this->table} {$this->where} {$this->orderBy} {$this->limit}";
            $st = $this->conexion->prepare($this->sql);
            $st->execute();
            return $st->fetchAll(PDO::FETCH_OBJ);
        } catch(PDOException $ex) {
            echo $ex->getTraceAsString();
        }
    }

    public function first() {
        $list = $this->get();
        if(count($list) > 0) {
            return $list[0];
        }
        return null;
    }

    public function insert($obj) {
        try {
            $fields = "`".implode("`, `", array_keys($obj))."`";// `nombre_de_usuario`, `email`, `password`, `fecha_registro`, `activo`
            $values = ":".implode(", :", array_keys($obj));// :nombre_de_usuario, :email, :password, :fecha_registro, :activo

            $this->sql = "INSERT INTO {$this->table} ({$fields}) VALUES ({$values})";
            $this->executeSt($obj);
            $id = $this->conexion->lastInsertId();
            return $id;
        } catch(PDOException $ex) {
            echo $ex->getTraceAsString();
        }
    }

    public function update($obj) {
        try {
            $fields = "";
            foreach($obj as $field => $value) {
                $fields .= "`$field`=:$field,"; // `nombre_de_usuario`=:nombre_de_usuario,`email`=:email,
            }
            $fields = rtrim($fields, ",");// `nombre_de_usuario`=:nombre_de_usuario,`email`=:email
            $this->sql = "UPDATE {$this->table} SET {$fields} {$this->where}"; // UPDATE usuarios SET nombre_de_usuario = Juanito, email = este@este.cl WHERE id
            $rowsAffected = $this->executeSt($obj);

            return $rowsAffected;
        } catch(PDOException $ex) {
            echo $ex->getTraceAsString();
        }
    }

    public function delete() {
        try {
            $this->sql = "DELETE FROM {$this->table} {$this->where}";
            $rowsAffected = $this->executeSt();
            return $rowsAffected;
        } catch(PDOException $ex) {
            echo $ex->getTraceAsString();
        }
    }

    public function where($field, $operator, $value) {
        $this->where .= (strpos($this->where, "WHERE")) ? " AND " : " WHERE "; // WHERE id = x || AND email = xxx@xxx.x
        $this->where .= "`$field` $operator " . ((is_string($value)) ? "\"$value\"" : $value) . " ";
        
        return $this;
    }

    public function orWhere($field, $operator, $value) {
        $this->where .= (strpos($this->where, "WHERE")) ? " OR " : " WHERE "; // WHERE id = x || OR email = xxx@xxx.x
        $this->where .= "`$field` $operator " . ((is_string($value)) ? "\"$value\"" : $value) . " ";
        
        return $this;
    }

    public function orderBy($field, $desc = false) {
        $this->orderBy .= " ORDER BY " . $field;
        $this->orderBy .= ($desc) ? " DESC " : " ASC ";
        return $this;
    }

    public function limit($limit, $offset = null) {
        $this->limit .= " LIMIT " . $limit;
        $this->limit .= (!is_null($offset)) ? " OFFSET " . $offset : "";
        return $this;
    }

    private function executeSt($obj = null) {
        $st = $this->conexion->prepare($this->sql);
        if($obj !== null) {
            foreach($obj as $field => $value) {
                if(empty($value) && $value !== 0) {
                    $value = null;
                }
                $st->bindValue(":$field", $value); //Ej: :nombre_de_usuario = 'Pepito'
            }
        }
        $st->execute();
        $this->restartValues();

        return $st->rowCount();
    }

    private function restartValues() {
        $this->where = "";
        $this->orderBy = "";
        $this->limit = "";
        $this->sql = null;
    }
}