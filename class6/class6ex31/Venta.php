<?php
    include_once("AccesoDatos.php");
    class Venta{
        private $idUsuario;
        private $codigoProducto;

        public function __construct(
            $idUsuario = null,
            $codigoProducto = null
        )
        {
            if (func_get_args() != null) {
                $this->idUsuario = $idUsuario;
                $this->codigoProducto = $codigoProducto;
            }
        }

        public function CrearVenta()
        {
            $pdo = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $pdo->RetornarConsulta(
                "INSERT INTO venta (idUsuario, codigoProducto)
                VALUES (:idUsuario, :codigoProducto)"
            );
            $consulta->bindValue(":idUsuario", $this->idUsuario, PDO::PARAM_INT);
            $consulta->bindValue(":codigoProducto", $this->codigoProducto, PDO::PARAM_STR);
            return $consulta->execute();
        }
    }
?>