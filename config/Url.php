<?php

class Url {
    public static function base() {
        $baseDir = str_replace(basename($_SERVER["SCRIPT_NAME"]), "", $_SERVER["SCRIPT_NAME"]);
        $baseUrl = (isset($_SERVER["HTTPS"]) ? "https" : "http") . "://{$_SERVER["HTTP_HOST"]}{$baseDir}";
        return trim($baseUrl, "/"); 
    }

    public static function to($url) {
        $url = trim($url, "/");
        return self::base() . "/{$url}";
    }

    public static function getFull() {
        return (isset($_SERVER["HTTPS"]) ? "https" : "http") . "://{$_SERVER["HTTP_HOST"]}{$_SERVER["REQUEST_URI"]}";
    }
}