<?php
require_once './models/Producto.php';

class ProductoController extends Producto{
    public function CargarUno($request, $response, $args){
        $parametros = $request->getParsedBody();

        $tipo = $parametros['tipo'];
        $detalle = $parametros['detalle'];
        $precio = $parametros['precio'];
        $tiempo = $parametros['tiempo'];
        $pedido = $parametros['pedido'];

        $producto = new Producto();
        $producto->tipo = $tipo;
        $producto->detalle = $detalle;
        $producto->precio = $precio;
        $producto->tiempo = $tiempo;
        $producto->pedido = $pedido;
        $producto->crearProducto();

        $payload = json_encode(array("mensaje" => "Producto creado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function TraerUno($request, $response, $args)
    {
        $id = $args['id'];
        $producto = Producto::obtenerProducto($id);
        $payload = json_encode($producto);

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function TraerTodos($request, $response, $args)
    {
        $lista = Producto::obtenerTodos();
        $payload = json_encode(array("listaProducto" => $lista));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function BorrarUno($request, $response, $args)
    {
        $id = $args['id'];
        Producto::borrarProducto($id);

        $payload = json_encode(array("mensaje" => "Producto borrado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

}
