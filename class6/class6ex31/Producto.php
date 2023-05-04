<?php
    include_once("AccesoDatos.php");

    class Producto{
        private $codigoDeBarra;
        private $stock;

        public function __construct(
            $codigoDeBarra = null, 
            $stock = null)
        {
            if (func_get_args() != null) {
                $this->codigoDeBarra = $codigoDeBarra;
                $this->stock = $stock;
            }
        }

        public function __get($name)
        {
            return $this->$name;
        }

        public static function TraerUnProductoPorCodigoDeBarra($codigoDeBarra){
            $pdo = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $pdo->RetornarConsulta(
                "SELECT codigoDeBarra, stock 
                FROM producto 
                WHERE codigoDeBarra = :codigoDeBarra");
            $consulta->bindValue(":codigoDeBarra", $codigoDeBarra, PDO::PARAM_STR);
            $consulta->execute();
            $producto = $consulta->fetchObject("Producto");
            return $producto;
        }

        public function QuitarStock($stock){
            $this->stock -=  $stock;
        }

        public function ActualizarProducto(){
            $pdo = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $pdo->RetornarConsulta(
                "UPDATE producto 
                SET stock = :stock 
                WHERE codigoDeBarra = :codigoDeBarra"
                );
            $consulta->bindValue(":codigoDeBarra", $this->codigoDeBarra, PDO::PARAM_STR);
            $consulta->bindValue(":stock", $this->stock, PDO::PARAM_INT);
            return $consulta->execute();
        }
    }
?>