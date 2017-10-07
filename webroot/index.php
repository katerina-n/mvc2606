<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', __DIR__ . DS . '..' . DS); // path: /../
define('VIEW_DIR', ROOT . 'View' . DS); // /View
define('CONF_DIR', ROOT . 'config' . DS); // /config

spl_autoload_register(function($className) {
    $path = ROOT . str_replace('\\', DS, $className) . '.php';
    
    if (!file_exists($path)) {
        throw new \Exception("{$path} not found");
    }
    
    require $path;
});

try {
    $request = new \Framework\Request($_GET, $_POST, $_SERVER);
    \Framework\Session::start();
    
    $dbConfig = require CONF_DIR . 'db.php';
    
    $pdo = new \PDO(
        $dbConfig['dsn'], 
        $dbConfig['user'],
        $dbConfig['password']
    );
    
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    
    $container = new \Framework\Container();
    $router = new \Framework\Router();
    $repositoryFactory = new \Framework\RepositoryFactory();
    $repositoryFactory->setPdo($pdo);
    
    $container->set('router', $router);
    $container->set('repository_factory', $repositoryFactory);
    
    $controller = $request->get('controller', 'default');
    $action = $request->get('action', 'index');
    
    $controller = '\\Controller\\' . ucfirst($controller) . 'Controller';
    
    $controller = new $controller();
    $controller->setContainer($container);
    
    // bad hack - will be removed
    $controller->setLayout($request);
    
    $action = $action . 'Action';
    
    if (!method_exists($controller, $action)) {
        throw new \Exception("{$action} not found");
    }
    
    $content = $controller->$action($request);
    
} catch (\Exception $e) {
    $content = $e->getMessage();
}

echo $content;