<?php

require_once 'vendor/autoload.php';


use App\Controllers\EditController;
use App\Controllers\HomeController;
use App\Controllers\SearchController;
use App\Controllers\SubmitController;


$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', [HomeController::class, 'showHomePage']);

    $r->addRoute('GET', '/submit', [SubmitController::class, 'showPage']);
    $r->addRoute('POST', '/submit', [SubmitController::class, 'savePerson']);

    $r->addRoute('GET', '/search', [SearchController::class, 'showPage']);
    $r->addRoute('POST', '/search', [SearchController::class, 'searchPerson']);

    $r->addRoute('GET', '/edit', [EditController::class, 'showPage']);
    $r->addRoute('POST', '/edit', [EditController::class, 'editPerson']);


    $r->addRoute('POST', '/delete', [SubmitController::class, 'deletePerson']);
});




$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];


if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:

        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        [$class, $method] = $handler;
        call_user_func_array([new $class, $method], $vars);

        break;
}




