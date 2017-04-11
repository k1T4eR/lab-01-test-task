<?php

require_once __DIR__.'/../application/config/autoload.php';

$request  = new Application\Routing\Request($_SERVER, $_GET, $_POST);
$response = new Application\Routing\Response();
$routes   = require_once(__DIR__ . '/../application/config/routes.php');

$application = Application::get();
$application->setRoutes($routes);
$application->setRequest($request);

try {
    $router = new Application\Routing\Router($routes);
    $router->dispatch($request, $response);

} catch (Application\Exceptions\NotFound $e) {
    $response->setStatus('404 Not Found');

} catch (Exception $e) {
    $response->setStatus('500 Internal Server Error');
}

echo $response->getBody();