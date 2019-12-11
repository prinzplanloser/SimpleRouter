<?php

namespace App\Route;

use App\Route\Exceptions\RouteException;

class SimpleRouter
{
    private $routes = [];
    private $params;

    public function add($preg, $route)
    {
        $this->routes[$preg] = $route;
    }

    public function match()
    {
        $url = $_GET['route'] ?? '';
        foreach ($this->routes as $route => $controllerAndAction) {
            if (preg_match($route, $url, $matches)) {
                unset($matches[0]);
                $this->params = $matches;
                return $controllerAndAction;
            }
        }
        throw new RouteException('Роут не найден');
    }

    public function run()
    {
        $controllerAndAction = $this->match();
        $controllerName = $controllerAndAction[0];
        $actionName = $controllerAndAction[1];

        if (class_exists($controllerName) && (method_exists($controllerName, $actionName))) {
            $controller = new $controllerName;
            $controller->$actionName(...$this->params);
        } else {
            throw new RouteException('Класс или метод не найдены');
        }
    }
}
