<?php
require_once './models/Encuesta.php';

class EncuestaController extends Encuesta{
    public function CargarUno($request, $response, $args){
        $parametros = $request->getParsedBody();

        $mesa = $parametros['mesa'];
        $detalle = $parametros['detalle'];
        $puntajeMesa = $parametros['puntajeMesa'];
        $puntajeRestaurante = $parametros['puntajeRestaurante'];
        $puntajeMozo = $parametros['puntajeMozo'];
        $puntajeCocinero = $parametros['puntajeCocinero'];

        $encuesta = new Encuesta();
        $encuesta->mesa = $mesa;
        $encuesta->detalle = $detalle;
        $encuesta->puntajeMesa = $puntajeMesa;
        $encuesta->puntajeRestaurante = $puntajeRestaurante;
        $encuesta->puntajeMozo = $puntajeMozo;
        $encuesta->puntajeCocinero = $puntajeCocinero;
        $encuesta->crearEncuesta();

        $payload = json_encode(array("mensaje" => "Encuesta creada con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function TraerUno($request, $response, $args)
    {
        $id = $args['id'];
        $encuesta = Encuesta::obtenerEncuesta($id);
        $payload = json_encode($encuesta);

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function TraerTodos($request, $response, $args)
    {
        $lista = Encuesta::obtenerTodos();
        $payload = json_encode(array("listaEncuesta" => $lista));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
}