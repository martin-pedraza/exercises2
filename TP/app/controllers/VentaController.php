<?php
require_once './models/Venta.php';

class VentaController extends Venta{
    public function CargarUno($request, $response, $args){
        $parametros = $request->getParsedBody();

        $monto = $parametros['monto'];
        $fecha = date("Y-m-d");
        $pedido = $parametros['pedido'];
        $mesa = $parametros['mesa'];

        $venta = new Venta();
        $venta->monto = $monto;
        $venta->fecha = $fecha;
        $venta->pedido = $pedido;
        $venta->mesa = $mesa;
        $venta->crearVenta();

        $payload = json_encode(array("mensaje" => "Venta creada con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function TraerUno($request, $response, $args)
    {
        $id = $args['id'];
        $venta = Venta::obtenerVenta($id);
        $payload = json_encode($venta);

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function TraerTodos($request, $response, $args)
    {
        $lista = Venta::obtenerTodos();
        $payload = json_encode(array("listaVenta" => $lista));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
}