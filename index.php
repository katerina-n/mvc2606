<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', __DIR__ . DS); // /
define('VIEW_DIR', ROOT . 'View' . DS); // /View

spl_autoload_register(function($className) {
    $path = ROOT . str_replace('\\', DS, $className) . '.php';
    
    if (!file_exists($path)) {
        throw new \Exception("{$path} not found");
    }
    
    require $path;
});

try {
    $request = new \Framework\Request($_GET, $_POST);
    
    $controller = $request->get('controller', 'default');
    $action = $request->get('action', 'index');
    
    $controller = '\\Controller\\' . ucfirst($controller) . 'Controller';
    
    $controller = new $controller();
    $action = $action . 'Action';
    
    if (!method_exists($controller, $action)) {
        throw new \Exception("{$action} not found");
    }
    
    $content = $controller->$action();
    
} catch (\Exception $e) {
    $content = $e->getMessage();
}


require 'layout.phtml';

var_dump($controller, $action);

