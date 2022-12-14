<?php

class Controller {
    protected $request;
    private $view;

    public function __construct() {
        
    }

    protected function view($file, $vars = null) {
        if(empty($this->view)) {
            $this->view = new View();
        }
        return $this->view->render($file, $vars);
    }

    public function getRegExp() {
        $expresiones = array(
            'nombre' => '^[a-zA-ZÀ-ÿ\s]{3,25}$',
            'nombreProducto' => '^[a-zA-Z0-9À-ÿ\s-]{3,40}$',
            'email' => '^[a-zA-Z0-9_.+-]{3,30}@[a-zA-Z0-9-]{3,30}\.[a-zA-Z0-9-.]{2,10}$',
            'password' => '^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,16}$',
            'fono' => '^\d{7,14}$',
            'descripcion' => '^[A-Za-z0-9\s#&.,;:]{0,10000}$'
        );
        
        return $expresiones;
    }

    public function sendRegExp() {
        $respuesta = new Respuesta(Mensajes::OK);
        $respuesta->setDatos(self::getRegExp());

        echo $respuesta->json();
    }

    public function main() {
        echo $this->view('main.php');
    }

    public function inicio() {
        echo $this->view('home.php');
    }

    public function login() {
        echo $this->view('login.php');
    }

    public function registro() {
        echo $this->view('registro.php');
    }

    public function passwordRecovery() {
        echo $this->view('password-recovery.php');
    }

    public function getRequest() {
        return $this->request;
    }

    public function setRequest($request) {
        $this->request = $request;
    }
}