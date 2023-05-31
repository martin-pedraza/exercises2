<?php
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
    use Slim\Psr7\Response as ResponseMW;

    class LoggerMiddleware{
        public function __invoke(Request $request, RequestHandler $handler): ResponseMW
        {
            $response = new ResponseMW();

            $mensajeVuelta = "Vuelvo del verificador de credenciales";
            
            if ($request->getMethod() === "GET") 
            {
                $mensajeMetodo = "No necesita credenciales para GET </br>";
                $mensajeApi = "API => GET </br>";
                $response->getBody()->write("{$mensajeMetodo} </br> {$mensajeApi} </br> {$mensajeVuelta}");
            } 
            else if($request->getMethod() === "POST")
            {
                $mensajeMetodo = "Verifico credenciales </br>";
                $mensajeApi = "API => POST </br>";
                if (isset($_POST["perfil"]) && $_POST["perfil"] == "administrador") 
                {
                    $nombre = $_POST["nombre"];
                    $response->getBody()->write("{$mensajeMetodo} </br> Bienvenido {$nombre} </br> </br> {$mensajeApi} </br> {$mensajeVuelta}");
                }
                else
                {
                    $response->getBody()->write("{$mensajeMetodo} </br> No tienes habilitado el ingreso </br> </br> {$mensajeApi} </br> {$mensajeVuelta}");
                }
            }
            
            return $response;
        }
    }
?>