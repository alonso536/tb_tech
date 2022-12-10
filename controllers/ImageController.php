<?php

class ImageController {

    public function __construct() {

    }

    public function generateImageName() {
        $string = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $name = '';

        for($i = 0; $i < 20; $i++) {
            $char = substr($string, rand(0, 61), 1);
            $name .= $char;
        }

        return $name;
    }

    public function insertImage($img, $id, $className) {
        $controller = new $className();

        $updateImage = array(
            'image' => $img
        );

        if($className == UsuariosController::class) {
            return $controller->updateUser($updateImage, $id);
        } else if($className == ProductosController::class) {
            return $controller->updateProduct($updateImage, $id);
        }
    }

    public function deleteImage($folder, $imagename) {
        if(unlink($folder.$imagename)) {
            return new Respuesta(Mensajes::OK);
        }
        return new Respuesta(Mensajes::ERR);
    }

    public function validateImage($folder, $img, $sesion, $className) {
        $imagename = $img['name'];

        if($img['type'] != 'image/jpg' && $img['type'] != 'image/jpeg' && $img['type'] != 'image/png') {
            return new Respuesta(Mensajes::ERR, 'Archivo no soportado');
        }
        $imageExists = false;

        do {
            $imagename = $this->generateImageName();

            switch($img['type']) {
                case 'image/jpg':
                    $imagename .= '.jpg';
                    break;
                case 'image/jpeg':
                    $imagename .= '.jpeg';
                    break;
                case 'image/png':
                    $imagename .= '.png';
                    break;
            }

            if(file_exists($_SERVER['DOCUMENT_ROOT'].'/shop/uploads/images/'.$folder.$imagename)) {
                $imageExists = true;
            }
        } while($imageExists);

        if(isset($_SESSION[$sesion])) {
            if($_SESSION[$sesion]->image !== null) {
                $delete = $this->deleteImage($_SERVER['DOCUMENT_ROOT'].'/shop/uploads/images/'.$folder, $_SESSION[$sesion]->image);
                if($delete->getCodigo() == -1) {
                    return new Respuesta(Mensajes::ERR, 'Error al subir el archivo');
                }
            }
            if(move_uploaded_file($img['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/shop/uploads/images/'.$folder.$imagename)) {
                $_SESSION[$sesion]->image = $imagename;
                return $this->insertImage($imagename, $_SESSION[$sesion]->id, $className);
            }
            return new Respuesta(Mensajes::ERR, 'Error al subir el archivo');
        }
        return new Respuesta(Mensajes::ERR, 'Error al subir el archivo');
    }
}