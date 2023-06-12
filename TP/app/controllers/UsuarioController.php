<?php
require_once './models/Usuario.php';

class UsuarioController extends Usuario
{
    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $perfil = $parametros['perfil'];
        $sector = $parametros['sector'];
        $nombre = $parametros['nombre'];
        $operaciones = 0;
        $fechaRegistro = date("Y-m-d");

        $usr = new Usuario();
        $usr->perfil = $perfil;
        $usr->sector = $sector;
        $usr->nombre = $nombre;
        $usr->operaciones = $operaciones;
        $usr->fechaRegistro = $fechaRegistro;
        $usr->crearUsuario();

        $payload = json_encode(array("mensaje" => "Usuario creado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function TraerUno($request, $response, $args)
    {
        $usr = $args['id'];
        $usuario = Usuario::obtenerUsuario($usr);
        $payload = json_encode($usuario);

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function TraerTodos($request, $response, $args)
    {
        $lista = Usuario::obtenerTodos();
        $payload = json_encode(array("listaUsuario" => $lista));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
    
    public function ModificarSuspension($request, $response, $args)
    {
        $id = $args['id'];

        Usuario::modificarSuspensionUsuario($id);

        $payload = json_encode(array("mensaje" => "Usuario modificado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function BorrarUno($request, $response, $args)
    {
        $id = $args['id'];
        Usuario::borrarUsuario($id);

        $payload = json_encode(array("mensaje" => "Usuario borrado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
}
