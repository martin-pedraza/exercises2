<?php

class Mesa{
    public $id;
    public $codigo;
    public $estado;

    public function crearMesa(){
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta(
            "INSERT INTO mesa (codigo, estado) 
            VALUES (:codigo, :estado)"
            );
        $consulta->bindValue(':codigo', $this->codigo, PDO::PARAM_STR);
        $consulta->bindValue(':estado', $this->estado, PDO::PARAM_STR);
        $consulta->execute();

        return $objAccesoDatos->obtenerUltimoId();
    }

    public static function obtenerTodos(){
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta(
            "SELECT id, codigo, estado
            FROM mesa"
            );
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Mesa');
    }

    public static function obtenerMesa($codigo){
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta(
            "SELECT id, codigo, estado
            FROM mesa
            WHERE codigo = :codigo");
        $consulta->bindValue(':codigo', $codigo, PDO::PARAM_STR);
        $consulta->execute();

        return $consulta->fetchObject('Mesa');
    }

    public static function modificarEstadoMesa($codigo){
        $estado = "";
        $mesa = Mesa::obtenerMesa($codigo);
        
        switch ($mesa->estado) {
            case 'abierta':
                $estado = 'con cliente esperando';
                break;
            case 'con cliente esperando':
                $estado = 'con cliente comiendo';
                break;
            case 'con cliente comiendo':
                $estado = 'con cliente pagando';
                break;
            case 'con cliente pagando':
                $estado = 'abierta';
                break;
            default:
                $estado = $mesa->estado;
                break;
        }
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta(
            "UPDATE mesa
            SET estado = :estado
            WHERE codigo = :codigo");
        $consulta->bindValue(':codigo', $codigo, PDO::PARAM_STR);
        $consulta->bindValue(':estado', $estado, PDO::PARAM_STR);
        $consulta->execute();
    }

    public static function cerrarMesa($codigo){
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta(
            "UPDATE mesa
            SET estado = :estado
            WHERE codigo = :codigo");
        $consulta->bindValue(':codigo', $codigo, PDO::PARAM_INT);
        $consulta->bindValue(':estado', "cerrada", PDO::PARAM_STR);
        $consulta->execute();
    }
}