<?php

require_once 'config/config.php';
require_once 'autoloader/Autoload.php';

Autoload::register();

session_start();
$routes = scandir('routes/');

foreach($routes as $archive) {
    $route = realpath('routes/' . $archive);

    if(is_file($route)) {
        require $route;
    }
}

Route::submit();
?>

