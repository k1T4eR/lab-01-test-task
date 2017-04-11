<?php

namespace Application\Routing;

use Application\Exceptions\NotFound;

class Router {

    protected $_routes;

    /**
     * Router constructor.
     * @param Route[] $routes
     */
    public function __construct(array $routes) {
        $this->_routes = $routes;
    }

    /**
     * Maps a request to controller:action.
     * @param Request  $request
     * @param Response $response
     * @return bool
     * @throws NotFound
     */
    public function dispatch(Request $request, Response $response) {
        foreach ($this->_routes as $route) {
            if ($route->match($request->getPath()) && $request->getMethod() === $route->getMethod()) {
                $controllerClassName  = $route->getControllerClassName();
                $controllerActionName = $route->getControllerActionName();
                $controller = new $controllerClassName($request, $response);
                $controller->$controllerActionName();
                return true;
            }
        }
        throw new NotFound();
    }
}