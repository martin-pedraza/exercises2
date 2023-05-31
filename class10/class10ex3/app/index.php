<?php
// Error Handling
error_reporting(-1);
ini_set('display_errors', 1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;

require __DIR__ . '/../vendor/autoload.php';

require_once './middlewares/Verificadora.php';
require_once './db/AccesoDatos.php';
require_once './controllers/UsuarioController.php';

// Instantiate App
$app = AppFactory::create();

// Add error middleware
$app->addErrorMiddleware(true, true, true);

// Add parse body
$app->addBodyParsingMiddleware();

// Routes
$app->group("/json_db", function (RouteCollectorProxy $group){
    $group->get("[/]", \UsuarioController::class . ":TraerTodos");
    $group->post("[/]", \UsuarioController::class . ":TraerTodos")
    ->add(\Verificadora::class . ":VerificarUsuario")
    ->add(\Verificadora::class . "::ExisteUsuario");
});

$app->run();
