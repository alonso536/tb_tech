<?php

class UsuariosController extends Controller {

    public function __construct() {

    }

    public function insertUser($user) {
        $userModel = new UsuariosModel();

        if($userModel->where('email', '=', $user['email'])->first() != null) {
            return new Respuesta(Mensajes::ERR, 'El email ingresado ya se encuentra registrado, por favor ingresa otro o inicia sesión con tu cuenta');
        }

        $id = $userModel->insertModel($user);
        $v = ($id > 0);

        $respuesta = new Respuesta($v ? Mensajes::OK_INSERT : Mensajes::ERR_INSERT);
        $respuesta->setDatos($id);
        
        return $respuesta;
    }

    public function getUsers() {
        $userModel = new UsuariosModel();
        $users = $userModel->get();
        $v = (count($users));

        $respuesta = new Respuesta($v ? Mensajes::OK : Mensajes::ERR);
        $respuesta->setDatos($users);

        return $respuesta;
    }

    public function getUser($field, $value) {
        $userModel = new UsuariosModel();
        $user = $userModel->where($field, "=", $value)->first();
        $v = ($user != null);

        $respuesta = new Respuesta($v ? Mensajes::OK : Mensajes::ERR);
        $respuesta->setDatos($user);
        return $respuesta;
    }

    public function updateUser($user) {
        $userModel = new UsuariosModel();
        $update = $userModel->where("id", "=", $user["idUsuario"])->updateModel($user);
        $v = ($update > 0);

        $respuesta = new Respuesta($v ? Mensajes::OK_UPDATE : Mensajes::ERR_UPDATE);
        $respuesta->setDatos($update);

        return $respuesta;
    }

    public function deleteUser($id) {
        $userModel = new UsuariosModel();
        $delete = $userModel->where("id", "=", $id)->delete();
        $v = ($delete > 0);

        $respuesta = new Respuesta($v ? Mensajes::OK_DELETE : Mensajes::ERR_DELETE);
        $respuesta->setDatos($delete);

        return $respuesta;
    }

    public function userLogIn($user) {
        $_SESSION['user'] = $user;

        if($user->rol == 'admin') {
            $_SESSION['admin'] = true;
        }
    }

    public function userLogOut() {
        unset($_SESSION['user']);

        if(isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
        }

        $this->inicio();
    }

    public function userGestor() {
        echo $this->view('gestor.php');
    }

    public function profile() {
        echo $this->view('gestor/profile.php');
    }

    public function updateProfile() {
        echo $this->view('gestor/update-profile.php');
    }

    public function products() {
        echo $this->view('gestor/products.php');
    }

    public function addProducts() {
        echo $this->view('gestor/add-products.php');
    }

    public function orders() {
        echo $this->view('gestor/orders.php');
    }

    public function deleteAccount() {
        echo $this->view('gestor/delete-account.php');
    }
}