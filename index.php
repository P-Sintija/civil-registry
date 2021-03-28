<?php

require_once 'vendor/autoload.php';

//
//use App\Models\SQLRepository;
//
//$register = new SQLRepository();
//$register->loadPersonData();
//var_dump($register->getPersons());

//var_dump($_POST);

/*
if(isset($_POST['name']) && isset($_POST['username']) && isset($_POST['personalCode'])){
   $register->savePersonData($_POST['name'],$_POST['username'],$_POST['personalCode']);
}
*/

/*
if(isset($_POST['name'])){
    var_dump($register->searchByName($_POST['name']));
}
*/

/*
if(isset($_POST['name'])){
    $register->deletePerson($_POST['name']);
}
*/


require_once 'vendor/autoload.php';


use App\Controllers\EditController;
use App\Controllers\HomeController;
use App\Controllers\SearchController;
use App\Controllers\SubmitController;


$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', [HomeController::class, 'showHomePage']);

    $r->addRoute('GET', '/submit', [SubmitController::class, 'showPage']);

    $r->addRoute('GET', '/search', [SearchController::class, 'showPage']);

    $r->addRoute('POST', '/submit', [SubmitController::class, 'savePerson']);

    $r->addRoute('POST', '/search', [SearchController::class, 'searchPerson']);

    $r->addRoute('POST', '/delete', [SubmitController::class, 'deletePerson']);

    $r->addRoute('GET', '/delete', [HomeController::class, 'showHomePage']);

    $r->addRoute('GET', '/edit', [EditController::class, 'showPage']);

});

//// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];


//// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri); //Returns the decoded URL, as a string.

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




