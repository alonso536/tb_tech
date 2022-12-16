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

        $product->cantidad = ($product->cantidad > $productAdd->getDatos()->stock) ? $productAdd->getDatos()->stock : $product->cantidad;
        
        if($productAdd->getDatos()->stock <= 0) {
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

    public function getTotal() {
        if(!isset($_SESSION['cart'])) {
            return new Respuesta(Mensajes::ERR, 'No hay productos en el carrito');
        } else {
            $total = 0;

            foreach($_SESSION['cart'] as $field => $value) {
                $total += ($_SESSION['cart'][$field]['precio'] * $_SESSION['cart'][$field]['cantidad']);
            }
        }
        $res = new Respuesta(Mensajes::OK);
        $res->setDatos($total);

        return $res;
    }

    public function remove(Request $request) {
        $product = json_decode($request->datos);
        $counter = 0;

        if(!isset($_SESSION['cart'])) {
            return new Respuesta(Mensajes::ERR, 'No hay productos en el carrito');
        }

        foreach($_SESSION['cart'] as $field => $value) {
            if(!is_null($_SESSION['cart'][$field])) {
                $counter++;
            }
        }

        foreach($_SESSION['cart'] as $field => $value) {
            if($value['id'] == $product->id) {
                if($_SESSION['cart'][$field]['cantidad'] > 1) {
                    $_SESSION['cart'][$field]['cantidad']--;
                } else {
                    $_SESSION['cart'][$field] = null;
                }

                if($_SESSION['cart'][$field]['cantidad'] < 1 && $counter == 1) {
                    return $this->delete();
                }
                return new Respuesta(Mensajes::OK, 'Producto removido del carrito');
            } 
        }

        return new Respuesta(Mensajes::ERR, 'No se pudo remover el producto');
    }

    public function delete() {
        if(isset($_SESSION['cart'])) {
            unset($_SESSION['cart']);
            return new Respuesta(Mensajes::OK, 'Carrito borrado con exito');
        }
        return new Respuesta(Mensajes::ERR, 'No se pudo borrar el carrito');
    }
}