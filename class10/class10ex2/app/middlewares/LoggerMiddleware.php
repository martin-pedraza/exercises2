<?php

    use Psr\Http\Message\ServerRequestInterface as Request;
    use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
    use Slim\Psr7\Response as ResponseMW;

    class LoggerMiddleware{
        public function __invoke(Request $request, RequestHandler $handler): ResponseMW
        {
            $response = new ResponseMW();

            $data = array("mensaje"=>"");
            if ($request->getMethod() == "GET") 
            {
                $data["mensaje"] = "API => GET";
            }
            else if ($request->getMethod() == "POST") 
            {
                $data["mensaje"] = "API => POST";
                if (!is_null($request->getParsedBody())) {
                    
                    $body = $request->getParsedBody();
                    $body = json_decode($body["obj_json"]);
                    
                    if ($body->perfil != "administrador") 
                    {
                        $data["mensaje"] = "ERROR, {$body->nombre} sin permisos";
                        $response = $response->withStatus(403);
                    }
                }
            }
            
            $payload = json_encode($data);
            $response->getBody()->write($payload);

            return $response->withHeader('Content-Type', 'application/json');
        }
    }
?>