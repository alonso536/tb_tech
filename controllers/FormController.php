<?php

class FormController {
    
    public function __construct() {

    }

    public function registerValidate(Request $request) {
        $controller = new UsuariosController();
        $user = json_decode($request->datos);

        $insertUser = array(
            'nombre' => $user->nombre,
            'apellido' => $user->apellido,
            'email' => $user->email,
            'fono' => $user->fono,
            'password' => password_hash($user->password, PASSWORD_DEFAULT),
            'rol' => 'user'
        );
        
        return $controller->insertUser($insertUser);
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
}