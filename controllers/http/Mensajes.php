<?php

class Mensajes {
    const OK = "OK";
    const ERR = "ERR";
    const OK_INSERT = "OK INSERT";
    const ERR_INSERT = "ERR INSERT";
    const OK_UPDATE = "OK UPDATE";
    const ERR_UPDATE = "ERR UPDATE";
    const OK_DELETE = "OK DELETE";
    const ERR_DELETE = "ERR DELETE";
    const NULL = "NULL";
    const ERR_DATABASE = "ERR DATABASE";

    public static function getMessage($codigo) {
        switch($codigo) {
            case Mensajes::OK:
                return new Respuesta(1, "Operación realizada con exito");
            case Mensajes::OK_INSERT:
                return new Respuesta(1, "Se ha insertado el registro con exito");
            case Mensajes::OK_UPDATE:
                return new Respuesta(1, "Se ha actualizado el registro con exito");
            case Mensajes::OK_DELETE:
                return new Respuesta(1, "Se ha eliminado el registro con exito");
            case Mensajes::ERR:
                return new Respuesta(-1, "Se ha producido un error en la operación");
            case Mensajes::ERR_INSERT:
                return new Respuesta(-1, "Se ha producido un error en la inserción");
            case Mensajes::ERR_UPDATE:
                return new Respuesta(-1, "Se ha producido un error en la actualización");
            case Mensajes::ERR_DELETE:
                return new Respuesta(-1, "Se ha producido un error en la eliminación");
            case Mensajes::ERR_DATABASE:
                return new Respuesta(-1, "No se pudo conectar a la base de datos");
            case Mensajes::NULL:
                return new Respuesta(0, "No hay resultados");
        }
    }
}