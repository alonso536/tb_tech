<?php

class FormController {
    
    public function __construct() {

    }

    public function registerValidate(Request $request) {
        $controller = new UsuariosController();
        $user = json_decode($request->datos);

        $expresiones = $controller->getRegExp();

        if(preg_match('/'.$expresiones['nombre'].'/', $user->nombre) && 
            preg_match('/'.$expresiones['nombre'].'/', $user->apellido) &&
            preg_match('/'.$expresiones['email'].'/', $user->email) &&
            preg_match('/'.$expresiones['fono'].'/', $user->fono) &&
            preg_match('/'.$expresiones['password'].'/', $user->password)) {

                $insertUser = array(
                    'nombre' => $user->nombre,
                    'apellido' => $user->apellido,
                    'email' => $user->email,
                    'fono' => $user->fono,
                    'password' => password_hash($user->password, PASSWORD_DEFAULT),
                    'image' => null,
                    'activo' => 1, 
                    'permiso_id' => 1
                );
                
            return $controller->insertUser($insertUser);
        }
        return new Respuesta(Mensajes::ERR, 'Error en el registro');
    }

    public function loginValidate(Request $request) {
        $controller = new UsuariosController();
        $user = json_decode($request->datos);

        $loginUser = array(
            'email' => $user->email,
            'password' => $user->password
        );

        $respuesta = $controller->getUser('email', $loginUser['email']);

        if($respuesta->getCodigo() == -1) {
            return new Respuesta(Mensajes::ERR, 'Datos incorrectos');
        }

        $usuario = $respuesta->getDatos();

        if(password_verify($loginUser['password'], $usuario->password)) {
            $controller->userLogIn($usuario);
            return new Respuesta(Mensajes::OK, 'Inicio de sesion correcto');
        } 
        return new Respuesta(Mensajes::ERR, 'Datos incorrectos');
    }

    public function updateProfileValidate(Request $request) {
        $controller = new UsuariosController();
        $user = json_decode($request->datos);

        $expresiones = $controller->getRegExp();

        if(preg_match('/'.$expresiones['nombre'].'/', $user->nombre) && 
            preg_match('/'.$expresiones['nombre'].'/', $user->apellido) &&
            preg_match('/'.$expresiones['fono'].'/', $user->fono)) {

                $updateUser = array(
                    'nombre' => $user->nombre,
                    'apellido' => $user->apellido,
                    'fono' => $user->fono
                );
                
            return $controller->updateUser($updateUser, $_SESSION['user']->id);
        }
        return new Respuesta(Mensajes::ERR_UPDATE);
    }

    public function passwordRecovery(Request $request) {
        $controller = new UsuariosController();
        $user = json_decode($request->datos);

        $respuesta = $controller->getUser('email', $user->email);

        if($respuesta->getCodigo() == -1) {
            return new Respuesta(Mensajes::ERR, 'El email ingresado no se encuentra registrado');
        }

        $_SESSION['recovery'] = $respuesta->getDatos();
        return new Respuesta(Mensajes::OK);
    }

    public function changePassword(Request $request) {
        $controller = new UsuariosController();
        $user = json_decode($request->datos);

        $expresiones = $controller->getRegExp();

        if(preg_match('/'.$expresiones['password'].'/', $user->password)) {
            $updateUser = array(
                'password' => password_hash($user->password, PASSWORD_DEFAULT)
            );

            if(isset($_SESSION['user'])) {
                return $controller->updateUser($updateUser, $_SESSION['user']->id);
            }

            if(isset($_SESSION['recovery'])) {
                return $controller->updateUser($updateUser, $_SESSION['recovery']->id);
            }
            return new Respuesta(Mensajes::ERR, 'Error al actualizar la contraseña');
        }
        return new Respuesta(Mensajes::ERR, 'Error al actualizar la contraseña');
    }

    public function updateAccount(Request $request) {
        $controller = new UsuariosController();
        $user = json_decode($request->datos);

        if(isset($_SESSION['user'])) {
            if($user->activo) {
                $updateUser = array(
                    'activo' => 0
                );
                return $controller->updateUser($updateUser, $_SESSION['user']->id);
            } else {
                $updateUser = array(
                    'activo' => 1
                );
                return $controller->updateUser($updateUser, $_SESSION['user']->id);
            }
        } else {
            return new Respuesta(Mensajes::ERR, 'Error al actualizar la cuenta');
        }
    }

    public function productValidate(Request $request) {
        $controller = new ProductosController();
        $product = json_decode($request->datos);

        $expresiones = $controller->getRegExp();

        if(preg_match('/'.$expresiones['nombreProducto'].'/', $product->nombre) && 
            preg_match('/'.$expresiones['descripcion'].'/', $product->descripcion)) {
            
                $insertProduct = array(
                    'categoria_id' => (int) $product->categoria,
                    'nombre' => $product->nombre,
                    'descripcion' => ($product->descripcion == '') ? '' : trim($product->descripcion),
                    'precio' => (int) $product->precio,
                    'stock' => (int) $product->stock,
                    'oferta' => null,
                    'fecha' => date("Y-m-d H:i:s"),
                    'image' => null,
                    'subcategoria_id' => (int) $product->subcategoria,
                    'marca_id' => (int) $product->marca
                );
        
            return $controller->insertProduct($insertProduct);
        }
        return new Respuesta(Mensajes::ERR_INSERT);
    }

    public function updateProductValidate(Request $request) {
        $controller = new ProductosController();
        $product = json_decode($request->datos);

        $expresiones = $controller->getRegExp();

        if(preg_match('/'.$expresiones['nombreProducto'].'/', $product->nombre) && 
            preg_match('/'.$expresiones['descripcion'].'/', $product->descripcion)) {
            
                $updateProduct = array(
                    'nombre' => $product->nombre,
                    'descripcion' => ($product->description == '') ? null : trim($product->descripcion),
                    'precio' => (int) $product->precio,
                    'stock' => (int) $product->stock,
                    'fecha' => date("Y-m-d H:i:s"),
                );
        
            return $controller->updateProduct($updateProduct, $_SESSION['product']->id);
        }
        return new Respuesta(Mensajes::ERR_UPDATE);
    }
}