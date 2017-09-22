<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', __DIR__ . DS);

spl_autoload_register(function($className) {
    $path = ROOT . str_replace('\\', DS, $className) . '.php';
    
    if (!file_exists($path)) {
        throw new \Exception("{$path} not found");
    }
    
    require $path;
});

try {
    $request = new \Framework\Request($_GET, $_POST);
} catch (\Exception $e) {
    echo $e->getMessage();
}


require 'layout.phtml';