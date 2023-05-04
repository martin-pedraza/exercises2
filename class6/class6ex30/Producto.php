<?php
    include("AccesoDatos.php");

    class Producto implements JsonSerializable{
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

        public function jsonSerialize(){
            return [
                $this->_codigoDeBarra,
                $this->_nombre,
                $this->_tipo,
                $this->_stock,
                $this->_precio
            ];
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

        public function CrearProducto(){
            $pdo = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $pdo->RetornarConsulta(
                "INSERT INTO producto (codigoDeBarra, nombre, tipo, stock, precio, fechaCreacion) 
                VALUES (:codigoDeBarra, :nombre, :tipo, :stock, :precio, :fechaCreacion)");
            $consulta->bindValue(":codigoDeBarra", $this->_codigoDeBarra, PDO::PARAM_STR);
            $consulta->bindValue(":nombre", $this->_nombre, PDO::PARAM_STR);
            $consulta->bindValue(":tipo", $this->_tipo, PDO::PARAM_STR);
            $consulta->bindValue(":stock", $this->_stock, PDO::PARAM_INT);
            $consulta->bindValue(":precio", $this->_precio, PDO::PARAM_STR);
            $consulta->bindValue(":fechaCreacion", date("Y-m-d"), PDO::PARAM_STR);
            return $consulta->execute();
        }

        public function SumarStock($stock){
            $this->stock +=  $stock;
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