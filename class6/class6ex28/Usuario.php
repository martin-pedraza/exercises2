<?php
    include("AccesoDatos.php");

    class Usuario implements JsonSerializable {
        private $id;
        private $nombre;

        public function __construct($id, $nombre)
        {
            $this->id = $id;
            $this->nombre = $nombre;
        } 

        public function jsonSerialize()
        {
            return [$this->id, $this->nombre];
        }
        
        public static function ListarUsuarios(){
            $pdo = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $pdo->RetornarConsulta("SELECT id, nombre FROM usuario");
            $consulta->execute();
            $usuarios = $consulta->fetchAll(PDO::FETCH_FUNC, function($id, $nombre){return new Usuario($id, $nombre);});
            return json_encode($usuarios, JSON_PRETTY_PRINT);
        }
        
    }
?>