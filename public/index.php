<?php


use App\Controllers\DeleteController;
use App\Controllers\EditController;
use App\Controllers\HomeController;
use App\Controllers\AuthorizeController;
use App\Controllers\PersonListController;
use App\Controllers\SearchController;
use App\Controllers\SubmitController;
use App\Controllers\LoginController;
use App\Repositories\MySQLPersonsRepository;
use App\Repositories\MySQLTokenRepository;
use App\Repositories\PersonRepository;
use App\Repositories\TokenRepository;
use App\Services\DeletePersonService;
use App\Services\EditPersonService;
use App\Services\AuthorizeUserService;
use App\Services\LoginUserService;
use App\Services\PersonListService;
use App\Services\SearchPersonService;
use App\Services\SubmitPersonService;
use App\Services\UserAdminService;
use League\Container\Container;

require_once '../vendor/autoload.php';

session_start();

////////////////// CONTAINER /////////////////
$container = new Container;
$container->add(PersonRepository::class, MySQLPersonsRepository::class);
$container->add(TokenRepository::class, MySQLTokenRepository::class);

$container->add(HomeController::class, HomeController::class)
    ->addArgument(UserAdminService::class);

$container->add(PersonListService::class, PersonListService::class)
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

$container->add(AuthorizeUserService::class, AuthorizeUserService::class)
    ->addArguments([PersonRepository::class, TokenRepository::class]);
$container->add(AuthorizeController::class, AuthorizeController::class)
    ->addArgument(AuthorizeUserService::class);

$container->add(LoginUserService::class, LoginUserService::class)
    ->addArguments([PersonRepository::class, TokenRepository::class]);
$container->add(LoginController::class, LoginController::class)
    ->addArgument(LoginUserService::class);

$container->add(UserAdminService::class, UserAdminService::class)
    ->addArgument(TokenRepository::class);


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

    $r->addRoute('GET', '/login', [AuthorizeController::class, 'showPage']);
    $r->addRoute('POST', '/login', [AuthorizeController::class, 'createUser']);

    $r->addRoute('GET', '/auth', [LoginController::class, 'userInfo']);
    $r->addRoute('POST', '/auth/{id:\d+}', [LoginController::class, 'logOut']);
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


