<?php
error_reporting(-1);
ini_set('display_errors', 1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Slim\Routing\RouteContext;

require __DIR__ . '/../vendor/autoload.php';

require_once './middlewares/AutentificadorJWT.php';

// Instantiate App
$app = AppFactory::create();

// Add error middleware
$app->addErrorMiddleware(true, true, true);

$app->group('/login', function (RouteCollectorProxy $group) {

  $group->post('[/]', function (Request $request, Response $response) {    
    $parametros = $request->getParsedBody();

    if (isset($parametros['usuario']) && isset($parametros['password'])) {
      $usuario = $parametros['usuario'];
      $password = $parametros['password'];
      if ($usuario == "info@utnfra.com" && $password == "Utn750") {
        $datos = array('usuario' => $usuario, 'perfil' => "admin");
    
        $token = AutentificadorJWT::CrearToken($datos);
        $payload = json_encode(array('jwt' => $token)); 
    
        $response->getBody()->write($payload);
      }
    }

    return $response
      ->withHeader('Content-Type', 'application/json');
  });
});

$app->run();