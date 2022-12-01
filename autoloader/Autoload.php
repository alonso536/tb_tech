<?php

class Autoload {
    public static function register() {
        if(function_exists('__autoload')) {
            spl_autoload_register('__autoload');
            return;
        }
        if(version_compare(PHP_VERSION, '5.3.0') >= 0) {
            spl_autoload_register(array('Autoload', 'load'), true, true);
        } else {
            spl_autoload_register(array('Autoload', 'load'));
        }
    }

    public static function load($class) {
        $name = $class . '.php';
        $folders = array(
            './config/',
            './controllers/',
            './models/',
            './routes',
            './views/'
        );

        foreach($folders as $folder) {
            if(self::search($folder, $name)) {
                return true;
            }
        }

        return false;
    }

    private static function search($folder, $name) {
        $archives = scandir($folder);
        foreach($archives as $archive) {
            $root = realpath($folder . DIRECTORY_SEPARATOR . $archive);
            //$root = substr($root, 19);
            if(is_file($root)) {
                if($name == $archive) {
                    require_once $root;
                    return true;
                }
            } else if($archive != '.' && $archive != '..') {
                self::search($root, $name);
            }
        }

        return false;
    }
}