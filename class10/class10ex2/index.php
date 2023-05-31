<?php
// Error Handling
error_reporting(-1);
ini_set('display_errors', 1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;

require __DIR__ . '/vendor/autoload.php';

require_once './app/middlewares/LoggerMiddleware.php';

// Instantiate App
$app = AppFactory::create();

// Add error middleware
$app->addErrorMiddleware(true, true, true);

// Add parse body
$app->addBodyParsingMiddleware();

// Routes
$app->group("/json", function (RouteCollectorProxy $group){
    $group->get("[/]", function (Request $request, Response $response){
        return $response;
    });
    $group->post("[/]", function (Request $request, Response $response){
        return $response;
    });
})->add(new LoggerMiddleware());

$app->run();
