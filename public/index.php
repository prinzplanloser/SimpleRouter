<?php

use App\Route\Exceptions\RouteException;
use App\Route\SimpleRouter;

require_once __DIR__ . '/../vendor/autoload.php';

$router = new SimpleRouter();

$router->add('~^$~', [App\Controller\MainController::class, 'main']);
$router->add('~^news/(\d+)$~', [\App\Controller\NewsController::class, 'test']);
try {
    $router->run();
} catch (RouteException $e) {
    echo $e->getMessage();
}