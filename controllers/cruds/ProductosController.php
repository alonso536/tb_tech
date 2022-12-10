<?php

class ProductosController extends Controller {

    public function __construct() {

    }

    public function insertProduct($product) {
        $productModel = new ProductosModel();

        $id = $productModel->insertModel($product);
        $v = ($id > 0);

        $respuesta = new Respuesta($v ? Mensajes::OK_INSERT : Mensajes::ERR_INSERT);
        $respuesta->setDatos($id);
        
        return $respuesta;
    }

    public function getProducts() {
        $productsModel = new ProductosModel();
        $products = $productsModel->orderBy('fecha', true)->get();
        $v = (count($products));

        $respuesta = new Respuesta($v ? Mensajes::OK : Mensajes::ERR);
        $respuesta->setDatos($products);

        return $respuesta;
    }

    public function getProductsForDateLimit() {
        $productsModel = new ProductosModel();
        $products = $productsModel->limit(60)->orderBy('fecha', true)->get();
        $v = (count($products));

        $respuesta = new Respuesta($v ? Mensajes::OK : Mensajes::ERR);
        $respuesta->setDatos($products);

        return $respuesta;
    }

    public function getProductsForCategory($category, $subcategory = null) {
        $productsModel = new ProductosModel();
        if(!is_null($subcategory)) {
            $products = $productsModel->orderBy('fecha', true)->where('categoria_id', '=', $category)->where('subcategoria_id', '=', $subcategory)->get();
        } else {
            $products = $productsModel->orderBy('fecha', true)->where('categoria_id', '=', $category)->get();
        }
        $v = (count($products));

        $respuesta = new Respuesta($v ? Mensajes::OK : Mensajes::ERR);
        $respuesta->setDatos($products);

        return $respuesta;
    }

    public function getProduct($field, $value) {
        $productsModel = new ProductosModel();
        $product = $productsModel->where($field, "=", $value)->first();
        $v = ($product != null);

        $respuesta = new Respuesta($v ? Mensajes::OK : Mensajes::ERR);
        $respuesta->setDatos($product);
        return $respuesta;
    }

    public function updateProduct($product, $id) {
        $productModel = new ProductosModel();
        $update = $productModel->where("id", "=", $id)->updateModel($product);
        $v = ($update > 0);

        $respuesta = new Respuesta($v ? Mensajes::OK_UPDATE : Mensajes::ERR_UPDATE);
        $respuesta->setDatos($update);

        return $respuesta;
    }

    public function deleteProduct($id) {
        $productModel = new ProductosModel();
        $delete = $productModel->where("id", "=", $id)->delete();
        $v = ($delete > 0);

        $respuesta = new Respuesta($v ? Mensajes::OK_DELETE : Mensajes::ERR_DELETE);
        $respuesta->setDatos($delete);

        return $respuesta;
    }
}