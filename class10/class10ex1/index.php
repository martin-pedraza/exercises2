<?php
// Error Handling
error_reporting(-1);
ini_set('display_errors', 1);

use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;

require __DIR__ . '/vendor/autoload.php';

require_once './app/middlewares/LoggerMiddleware.php';
require_once './app/controllers/UsuarioController.php';

// Instantiate App
$app = AppFactory::create();

// Add error middleware
$app->addErrorMiddleware(true, true, true);

// Add parse body
$app->addBodyParsingMiddleware();

// Routes
$app->group("/credenciales", function (RouteCollectorProxy $group){
    $group->get("[/]", \UsuarioController::class . ":VerificarUsuario");
    $group->post("[/]", \UsuarioController::class . ":VerificarUsuario");
})->add(new LoggerMiddleware());

$app->run();
