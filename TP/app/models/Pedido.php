<?php

class Pedido{
    public $id;
    public $codigo;
    public $cliente;
    public $estado;
    public $foto;

    public function crearPedido(){
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta(
            "INSERT INTO pedido (codigo, cliente, estado, foto) 
            VALUES (:codigo, :cliente, :estado, :foto)"
            );
        $consulta->bindValue(':codigo', $this->codigo, PDO::PARAM_STR);
        $consulta->bindValue(':cliente', $this->cliente, PDO::PARAM_STR);
        $consulta->bindValue(':estado', $this->estado, PDO::PARAM_STR);
        $consulta->bindValue(':foto', $this->foto, PDO::PARAM_STR);
        $consulta->execute();

        return $objAccesoDatos->obtenerUltimoId();
    }

    public static function obtenerTodos()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta(
            "SELECT id, codigo, cliente, estado, foto 
            FROM pedido"
            );
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Pedido');
    }

    public static function obtenerPedido($codigo)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta(
            "SELECT id, codigo, cliente, estado, foto 
            FROM pedido
            WHERE codigo = :codigo");
        $consulta->bindValue(':codigo', $codigo, PDO::PARAM_STR);
        $consulta->execute();

        return $consulta->fetchObject('Pedido');
    }

    public static function modificarEstadoPedido($codigo){
        $estado = "";
        $pedido = Pedido::obtenerPedido($codigo);
        
        switch ($pedido->estado) {
            case 'pendiente':
                $estado = 'en preparacion';
                break;
            case 'en preparacion':
                $estado = 'listo para servir';
                break;
            case 'listo para servir':
                $estado = 'entregado';
                break;
            case 'entregado':
                $estado = 'pendiente';
                break;
            default:
                $estado = $pedido->estado;
                break;
        }
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta(
            "UPDATE pedido
            SET estado = :estado
            WHERE codigo = :codigo");
        $consulta->bindValue(':codigo', $codigo, PDO::PARAM_STR);
        $consulta->bindValue(':estado', $estado, PDO::PARAM_STR);
        $consulta->execute();
    }

    public static function cancelarPedido($codigo){
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta(
            "UPDATE pedido
            SET estado = :estado
            WHERE codigo = :codigo");
        $consulta->bindValue(':codigo', $codigo, PDO::PARAM_INT);
        $consulta->bindValue(':estado', "cancelado", PDO::PARAM_STR);
        $consulta->execute();
    }
}