<?php


use App\Controllers\DeleteController;
use App\Controllers\EditController;
use App\Controllers\HomeController;
use App\Controllers\PersonListController;
use App\Controllers\SearchController;
use App\Controllers\SubmitController;
use App\Repositories\MySQLPersonsRepository;
use App\Repositories\PersonRepository;
use App\Services\DeletePersonService;
use App\Services\EditPersonService;
use App\Services\PersonListService;
use App\Services\SearchPersonService;
use App\Services\SubmitPersonService;
use League\Container\Container;

require_once '../vendor/autoload.php';


////////////////// CONTAINER /////////////////
$container = new Container;
$container->add(PersonRepository::class, MySQLPersonsRepository::class);

$container->add(HomeController::class, HomeController::class);

$container->add(PersonListService::class,PersonListService::class)
    ->addArgument(PersonRepository::class);

$container->add(PersonListController::class, PersonListController::class)
    ->addArgument(PersonListService::class);

$container->add(SubmitPersonService::class, SubmitPersonService::class)
    ->addArgument(PersonRepository::class);
$container->add(SubmitController::class, SubmitController::class)
    ->addArgument(SubmitPersonService::class);

$container->add(SearchPersonService::class, SearchPersonService::class)
    ->addArgument(PersonRepository::class);
$container->add(SearchController::class, SearchController::class)
    ->addArgument(SearchPersonService::class);

$container->add(DeletePersonService::class, DeletePersonService::class)
    ->addArgument(PersonRepository::class);
$container->add(DeleteController::class, DeleteController::class)
    ->addArgument(DeletePersonService::class);

$container->add(EditPersonService::class, EditPersonService::class)
    ->addArgument(PersonRepository::class);
$container->add(EditController::class, EditController::class)
    ->addArguments([EditPersonService::class, SearchPersonService::class]);


////////////////// ROUTS //////////////////////
$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', [HomeController::class, 'showHomePage']);

    $r->addRoute('GET', '/list', [PersonListController::class, 'showPage']);

    $r->addRoute('GET', '/submit', [SubmitController::class, 'showPage']);
    $r->addRoute('POST', '/submit', [SubmitController::class, 'savePerson']);

    $r->addRoute('GET', '/search', [SearchController::class, 'showPage']);
    $r->addRoute('POST', '/search', [SearchController::class, 'searchPerson']);

    $r->addRoute('POST', '/delete', [DeleteController::class, 'deletePerson']);

    $r->addRoute('GET', '/edit', [EditController::class, 'showPage']);
    $r->addRoute('POST', '/edit', [EditController::class, 'editPerson']);
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
        [$controller, $method] = $handler;
        $container->get($controller)->$method($vars);
        break;
}


