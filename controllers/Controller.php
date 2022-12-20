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
            'descripcion' => '^[A-Za-z0-9\s#&.,;:]{0,10000}$',
            'direccion' => '^[A-Za-z0-9\s#.,:]{10,100}$'
        );
        
        return $expresiones;
    }

    public function queryOrderDetail($idUser, $idOrder) {
        $sql = "SELECT p.id AS 'Código del pedido', u.nombre AS 'Nombre', u.apellido AS 'Apellido',
                u.email AS 'Email', r.nombre AS 'Región', p.direccion AS 'Dirección', e.nombre AS 'Estado', p.fecha AS 'Fecha', p.monto AS 'Monto a pagar' FROM pedidos p
                INNER JOIN usuarios u ON p.usuario_id = u.id
                INNER JOIN regiones r ON p.region_id = r.id
                INNER JOIN estados e ON p.estado_id = e.id WHERE u.id = {$idUser} AND p.id = {$idOrder}";
        
        return $sql;
    }

    public function queryProductsOrderDetail($idUser, $idOrder) {
        $sql = "SELECT pe.id AS 'codigo', pr.id AS 'producto_id', pr.nombre AS 'producto', pe.estado_id AS 'estado', lp.unidades AS 'cantidad' FROM productos pr
                INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id
                INNER JOIN pedidos pe ON lp.pedido_id = pe.id WHERE pe.usuario_id = {$idUser} AND pe.id = {$idOrder}";

        return $sql;
    }

    public function queryVals($idProduct) {
        $sql = "SELECT v.id, CONCAT(u.nombre, ' ', u.apellido) AS 'nombre', v.nivel, v.comentario, v.fecha FROM valoraciones v
                INNER JOIN usuarios u WHERE v.usuario_id = u.id AND v.producto_id = {$idProduct}";

        return $sql;
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