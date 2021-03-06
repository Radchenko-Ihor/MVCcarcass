<?php
/**
 * Created by PhpStorm.
 * User: Ihor
 * Date: 21.10.2017
 * Time: 15:54
 */

namespace IhorRadchenko\App\Components;

use IhorRadchenko\App\Components\Traits\Singleton;
use IhorRadchenko\App\Exceptions\Error404;

class Router
{
    use Singleton;

    /**
     * Массив с маршрутами
     * @var array
     */
    private $routes;

    /**
     * Массив с контроллером и экшеном
     * @var array
     */
    private $route;

    private function __construct()
    {
        $routesPath = $_SERVER['DOCUMENT_ROOT'] . '/App/config/routes.php';
        if (file_exists($routesPath)) {
            $this->routes = include_once $routesPath;
        }
    }

    private function getUri(): string
    {
        return ltrim($_SERVER['REQUEST_URI'], '/');
    }

    private function matchRoutes(): bool
    {
        $uri = $this->getUri();
        foreach ($this->routes as $uriPattern => $route) {
            if (preg_match("~$uriPattern~", $uri, $matches)) {
                $this->route = $route;
                if (isset($matches[1])) {
                    $this->route['arguments'][1] = $matches[1];
                }
                if (isset($matches[2])) {
                    $this->route['arguments'][2] = $matches[2];
                }
                if (isset($matches[3])) {
                    $this->route['arguments'][3] = $matches[3];
                }
                return true;
            }
        }
        return false;
    }

    /**
     * @throws Error404
     */
    public function run()
    {
        if ($this->matchRoutes()) {
            $controllerName = 'IhorRadchenko\App\Controllers\\' . $this->route['controller'];
            $controller = new $controllerName;
            $controller->action(
                $this->route['action'],
                $this->route['arguments'][1] ?? null,
                $this->route['arguments'][2] ?? null,
                $this->route['arguments'][3] ?? null
            );
        } else {
            throw new Error404('Страница не найдена');
        }
    }
}