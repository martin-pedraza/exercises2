<?php
// Error Handling
error_reporting(-1);
ini_set('display_errors', 1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Slim\Routing\RouteContext;

require __DIR__ . '/../vendor/autoload.php';

require_once './db/AccesoDatos.php';
// require_once './middlewares/Logger.php';

require_once './controllers/UsuarioController.php';
require_once './controllers/MesaController.php';
require_once './controllers/PedidoController.php';
require_once './controllers/ProductoController.php';
require_once './controllers/VentaController.php';
require_once './controllers/EncuestaController.php';

// Instantiate App
$app = AppFactory::create();

// Add error middleware
$app->addErrorMiddleware(true, true, true);

// Add parse body
$app->addBodyParsingMiddleware();

// Routes
$app->group('/usuarios', function (RouteCollectorProxy $group) {
  $group->post('[/]', \UsuarioController::class . ':CargarUno');
  $group->get('/{id}', \UsuarioController::class . ':TraerUno');
  $group->put('/{id}', \UsuarioController::class . ':ModificarSuspension'); //suspender o reactivar
  $group->delete('/{id}', \UsuarioController::class . ':BorrarUno');
  $group->get('[/]', \UsuarioController::class . ':TraerTodos');
  });

$app->group('/mesas', function (RouteCollectorProxy $group) {
  $group->post('[/]', \MesaController::class . ':CargarUno');
  $group->get('/{codigo}', \MesaController::class . ':TraerUno');
  $group->put('/{codigo}', \MesaController::class . ':ModificarEstado'); //pasar siguiente estado y si estaba cerrada se reabre
  $group->delete('/{codigo}', \MesaController::class . ':CerrarUno'); //cerrar
  $group->get('[/]', \MesaController::class . ':TraerTodos');
  });

$app->group('/pedidos', function (RouteCollectorProxy $group) {
  $group->post('[/]', \PedidoController::class . ':CargarUno');
  $group->get('/{codigo}', \PedidoController::class . ':TraerUno');
  $group->put('/{codigo}', \PedidoController::class . ':ModificarEstado'); //pasar siguiente estado
  $group->delete('/{codigo}', \PedidoController::class . ':CancelarUno'); //cancelar
  $group->get('[/]', \PedidoController::class . ':TraerTodos');
  });

$app->group('/productos', function (RouteCollectorProxy $group) {
  $group->post('[/]', \ProductoController::class . ':CargarUno');
  $group->get('/{id}', \ProductoController::class . ':TraerUno');
  $group->delete('/{id}', \ProductoController::class . ':BorrarUno');
  $group->get('[/]', \ProductoController::class . ':TraerTodos');
  });

$app->group('/ventas', function (RouteCollectorProxy $group) {
  $group->post('[/]', \VentaController::class . ':CargarUno');
  $group->get('/{id}', \VentaController::class . ':TraerUno');
  $group->get('[/]', \VentaController::class . ':TraerTodos');
  });  

$app->group('/encuestas', function (RouteCollectorProxy $group) {
  $group->post('[/]', \EncuestaController::class . ':CargarUno');
  $group->get('/{id}', \EncuestaController::class . ':TraerUno');
  $group->get('[/]', \EncuestaController::class . ':TraerTodos');
  }); 

$app->run();
