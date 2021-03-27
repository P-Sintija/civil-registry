<?php

require_once 'vendor/autoload.php';

//
//use App\Models\Register;
//
//$register = new Register();
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
use App\Controllers\FoundController;
use App\Controllers\HomeController;
use App\Controllers\PersonController;
use App\Controllers\SearchController;
use App\Controllers\SubmitController;

//use App\Controllers\ShopController;


$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', [HomeController::class, 'showHomePage']);

    $r->addRoute('GET', '/submit', [SubmitController::class, 'showPage']);
    $r->addRoute('POST', '/submit', [SubmitController::class, 'submit']);

    $r->addRoute('GET', '/search', [SearchController::class, 'showPage']);
    $r->addRoute('POST', '/search', [SearchController::class, 'search']);

    $r->addRoute('GET', '/found', [FoundController::class, 'showPage']);
    $r->addRoute('POST', '/found', [FoundController::class, 'delete']);

    $r->addRoute('GET', '/edit', [EditController::class, 'showPage']);
    $r->addRoute('POST', '/edit', [EditController::class, 'edit']);


 //   $r->addRoute('GET', '/found', [PersonController::class, 'showPage']);
 //   $r->addRoute('POST', '/found', [PersonController::class, 'edit']);
  //  $r->addRoute('POST', '/', [HomeController::class, 'save']);



    //$r->addRoute('GET', '/shop', [ShopController::class,'index']);
});

//// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD']; //string(3) "GET"
$uri = $_SERVER['REQUEST_URI'];           //string(5) "/home"


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

        // var_dump($routeInfo);

        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        [$class, $method] = $handler;
        call_user_func_array([new $class, $method], $vars);
        //Calls the callback given by the first parameter with the parameters in args.
        //$vars = array(0){} //The parameters to be passed to the callback, as an indexed array.
        break;
}



//var_dump($_POST);


//require_once 'app/Views/home.php';

