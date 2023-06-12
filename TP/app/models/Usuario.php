<?php

class Usuario
{
    public $id;
    public $perfil;
    public $sector;
    public $nombre;
    public $operaciones;
    public $fechaRegistro;
    public $fechaSuspension;

    public function crearUsuario()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta(
            "INSERT INTO usuario (id, perfil, sector, nombre, operaciones, fechaRegistro) 
            VALUES (:id, :perfil, :sector, :nombre, :operaciones, :fechaRegistro)"
            );
        $consulta->bindValue(':id', time(), PDO::PARAM_INT);
        $consulta->bindValue(':perfil', $this->perfil, PDO::PARAM_STR);
        $consulta->bindValue(':sector', $this->sector, PDO::PARAM_STR);
        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':operaciones', $this->operaciones, PDO::PARAM_INT);
        $consulta->bindValue(':fechaRegistro', $this->fechaRegistro, PDO::PARAM_STR);
        $consulta->execute();

        return $objAccesoDatos->obtenerUltimoId();
    }

    public static function obtenerTodos()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta(
            "SELECT id, perfil, sector, nombre, operaciones, fechaRegistro, fechaSuspension 
            FROM usuario"
            );
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Usuario');
    }

    public static function obtenerUsuario($id)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta(
            "SELECT id, perfil, sector, nombre, operaciones, fechaRegistro, fechaSuspension
            FROM usuario
            WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetchObject('Usuario');
    }

    public static function modificarSuspensionUsuario($id)
    {
        $fechaSuspension = date("Y-m-d");
        $usr = Usuario::obtenerUsuario($id);
        if ($usr->fechaSuspension != null) {
            $fechaSuspension = null;
        }
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta(
            "UPDATE usuario
            SET fechaSuspension = :fechaSuspension
            WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->bindValue(':fechaSuspension', $fechaSuspension, PDO::PARAM_STR);
        $consulta->execute();
    }

    public static function borrarUsuario($usuario)
    {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta(
            "DELETE FROM usuario 
            WHERE id = :id");
        $consulta->bindValue(':id', $usuario, PDO::PARAM_INT);
        $consulta->execute();
    }
}