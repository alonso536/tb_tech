<?php

class Route {
    public function __construct() {

    }

    private static $uris = array();

    public static function add($uri, $method, $function = null) {
        self::$uris[] = new Uri(self::parseUri($uri), $method, $function);
        return;
    }

    public static function get($uri, $function = null) {
        return self::add($uri, "GET", $function);
    }

    public static function post($uri, $function = null) {
        return self::add($uri, "POST", $function);
    }

    public static function put($uri, $function = null) {
        return self::add($uri, "PUT", $function);
    }

    public static function delete($uri, $function = null) {
        return self::add($uri, "DELETE", $function);
    }

    public static function any($uri, $function = null) {
        return self::add($uri, "ANY", $function);
    }

    private static function parseUri($uri) {
        $uri = trim($uri, '/');
        $uri = (strlen($uri) > 0) ? $uri : '/';

        return $uri;
    }

    public static function submit() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = isset($_GET['uri']) ? $_GET['uri'] : '';
        $uri = self::parseUri($uri);

        foreach(self::$uris as $valueUri) {
            if($valueUri->match($uri)) {
                return $valueUri->call();
            }
        }

        header("Content-Type: text/html");
        echo 'La URI (<a href="'. $uri .'">' . $uri . '</a>) no se encuentra registrada en el metodo ' . $method . '.';
    }
}