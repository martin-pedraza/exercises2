<?php
    include("AccesoDatos.php");

    class Producto{
        private $codigoDeBarra;
        private $nombre;
        private $tipo;
        private $stock;
        private $precio;

        public function __construct($codigoDeBarra = null, $nombre = null, $tipo = null, $stock = null, $precio = null)
        {
            if (func_get_args() != null) {
                $this->codigoDeBarra = $codigoDeBarra;
                $this->nombre = $nombre;
                $this->tipo = $tipo;
                $this->stock = $stock;
                $this->precio = $precio;
            }
        }

        public static function TraerUnProductoPorCodigoDeBarra($codigoDeBarra){
            $pdo = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $pdo->RetornarConsulta(
                "SELECT codigoDeBarra, nombre, tipo, stock, precio 
                FROM producto 
                WHERE codigoDeBarra = :codigoDeBarra");
            $consulta->bindValue(":codigoDeBarra", $codigoDeBarra, PDO::PARAM_STR);
            $consulta->execute();
            $producto = $consulta->fetchObject("Producto");
            return $producto;
        }

        public function ActualizarProducto(){
            $pdo = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $pdo->RetornarConsulta(
                "UPDATE producto 
                SET nombre = :nombre, tipo = :tipo, stock = :stock, precio = :precio 
                WHERE codigoDeBarra = :codigoDeBarra"
                );
            $consulta->bindValue(":codigoDeBarra", $this->codigoDeBarra, PDO::PARAM_STR);
            $consulta->bindValue(":nombre", $this->nombre, PDO::PARAM_STR);
            $consulta->bindValue(":tipo", $this->tipo, PDO::PARAM_STR);
            $consulta->bindValue(":stock", $this->stock, PDO::PARAM_INT);
            $consulta->bindValue(":precio", $this->precio, PDO::PARAM_STR);
            return $consulta->execute();
        }
    }
?>