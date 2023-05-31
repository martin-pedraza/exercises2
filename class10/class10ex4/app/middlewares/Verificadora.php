<?php

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as ResponseMW;

class Verificadora{
    public function VerificarAtributos(Request $request, RequestHandler $handler): ResponseMW
    {
        $body = $request->getParsedBody();
        $body = json_decode($body["obj_json"]);
        $correo = property_exists($body, "correo");
        $clave = property_exists($body, "clave");
        
        if (!$correo || !$clave) {
            if (!$correo && !$clave) 
            {
                $data = array("mensaje" => "Falta atributo correo!!!Falta atributo clave!!!");
            }
            elseif(!$correo)
            {
                $data = array("mensaje" => "Falta atributo correo!!!");
            }
            else
            {
                $data = array("mensaje" => "Falta atributo clave!!!");
            }

            $data = json_encode($data);
            $response = new ResponseMW();
            $response->getBody()->write($data);
            $response = $response->withStatus(403);
        }
        else
        {
            $response = $handler->handle($request);
        }
        
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function ExisteJson(Request $request, RequestHandler $handler): ResponseMW
    {
        $body = $request->getParsedBody();

        if (!is_null($body) && array_key_exists("obj_json", $body) && $body["obj_json"] != null) {      
            $response = $handler->handle($request);
        }
        else
        {
            $response = new ResponseMW();
            $data = array("mensaje" => "Falta parametro obj_json!!!");
            $response = $response->withStatus(403);
            $data = json_encode($data);
            $response->getBody()->write($data);
        }
        
        return $response->withHeader('Content-Type', 'application/json');
    }
}
?>