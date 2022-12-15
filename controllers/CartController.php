<?php

class CartController {

    public function __construct() {

    }

    public function add(Request $request) {
        $controller = new ProductosController();
        $product = json_decode($request->datos);

        $productAdd = $controller->getProduct('id', $product->id);

        if($productAdd->getCodigo() == -1) {
            return new Respuesta(Mensajes::ERR, 'No se pudo agregar el producto al carrito');
        }

        if(isset($_SESSION['cart'])) {
            $counter = 0;
            foreach($_SESSION['cart'] as $field => $value) {
                if($value['id'] == $productAdd->getDatos()->id) {
                    $_SESSION['cart'][$field]['cantidad'] += $product->cantidad;
                    $counter++;

                    return new Respuesta(Mensajes::OK, 'Producto agregado al carrito');
                }
            }
        } 
        if(!isset($counter) || $counter == 0) {
            $_SESSION['cart'][] = array(
                'id' => $productAdd->getDatos()->id,
                'nombre' => $productAdd->getDatos()->nombre,
                'precio' => $productAdd->getDatos()->precio,
                'cantidad' => $product->cantidad,
                'producto' => $productAdd->getDatos()
            );

            return new Respuesta(Mensajes::OK, 'Producto agregado al carrito');
        }

        return new Respuesta(Mensajes::ERR, 'No se pudo agregar el producto al carrito');
    }

    public function get() {
        if(isset($_SESSION['cart'])) {
            $res = new Respuesta(Mensajes::OK);
            $res->setDatos($_SESSION['cart']);

            return $res;
        }
        return new Respuesta(Mensajes::ERR, 'El carrito está vacío');
    }

    public function remove() {
        
    }

    public function delete() {
        if(isset($_SESSION['cart'])) {
            unset($_SESSION['cart']);
            return new Respuesta(Mensajes::OK, 'Carrito borrado con exito');
        }
        return new Respuesta(Mensajes::ERR, 'No se pudo borrar el carrito');
    }
}