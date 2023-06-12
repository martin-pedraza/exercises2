<?php
require_once "./models/Pedido.php";

class PedidoController extends Pedido{
    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $codigo = $parametros['codigo'];
        $cliente = $parametros['cliente'];
        $estado = $parametros['estado'];
        $foto = null;
        if (isset($_FILES["foto"])) {
            $extension = "." . pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
            $imagen = $codigo . "_" . date("Y-m-d") . $extension;
            $destino = "img/" . $imagen;
            move_uploaded_file($_FILES["foto"]["tmp_name"], $destino);

            $foto = $imagen;
        }

        $pedido = new Pedido();
        $pedido->codigo = $codigo;
        $pedido->cliente = $cliente;
        $pedido->estado = $estado;
        $pedido->foto = $foto;
        $pedido->crearPedido();

        $payload = json_encode(array("mensaje" => "Pedido creado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function TraerUno($request, $response, $args)
    {
        $codigo = $args['codigo'];
        $pedido = Pedido::obtenerPedido($codigo);
        $payload = json_encode($pedido);

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function TraerTodos($request, $response, $args)
    {
        $lista = Pedido::obtenerTodos();
        $payload = json_encode(array("listaPedido" => $lista));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function ModificarEstado($request, $response, $args)
    {
        $codigo = $args['codigo'];

        Pedido::modificarEstadoPedido($codigo);

        $payload = json_encode(array("mensaje" => "Pedido modificado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function CancelarUno($request, $response, $args)
    {
        $codigo = $args['codigo'];
        Pedido::cancelarPedido($codigo);

        $payload = json_encode(array("mensaje" => "Pedido cancelado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
}