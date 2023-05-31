<?php

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as ResponseMW;

class Verificadora{
    public function VerificarUsuario(Request $request, RequestHandler $handler): ResponseMW
    {
        $body = $request->getParsedBody();
        $body = json_decode($body["obj_json"]);
        $usuario = Usuario::obtenerUsuario($body->correo);
        
        if ($usuario->clave == $body->clave) {
            $response = $handler->handle($request);
        }
        else
        {
            $response = new ResponseMW();
            $data = array("mensaje" => "Error. Clave o correo incorrectos");
            $response = $response->withStatus(403);
            $data = json_encode($data);
            $response->getBody()->write($data);
        }
        
        return $response->withHeader('Content-Type', 'application/json');
    }

    public static function ExisteUsuario(Request $request, RequestHandler $handler): ResponseMW
    {
        $body = $request->getParsedBody();

        if (!is_null($body)) {      
            $body = json_decode($body["obj_json"]);
            $usuario = Usuario::obtenerUsuario($body->correo);
            if ($usuario !== false) 
            {
                $response = $handler->handle($request);
                $contenidoApi = (string) $response->getBody();
                $data = $contenidoApi;
            }
        }

        if(is_null($body) || $usuario === false)
        {
            $response = new ResponseMW();
            $data = array("mensaje" => "Usuario no existe");
            $response = $response->withStatus(403);
            $data = json_encode($data);
        }
        
        $response->getBody()->write($data);
        
        return $response->withHeader('Content-Type', 'application/json');
    }
}
?>