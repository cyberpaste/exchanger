<?php

define('AppDirectory', str_replace('\\', '/', __DIR__) . '/app');
require_once AppDirectory . '/autoload.php';
try {
    $config = require_once AppDirectory . '/config.php';
    $routes = require_once AppDirectory . '/routes.php';
    $app = new Core\Framework\App($config);
    $router = new Core\Framework\Router();
    $router->add($routes);
    if ($router->isFound()) {
        $router->executeHandler($router->getRequestHandler(), $router->getParams());
    }
} catch (Exception $e) {
    $error = new Core\Framework\Error;
    $error->FatalError($e);
}