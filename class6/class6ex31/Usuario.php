<?php
    include_once("AccesoDatos.php");

    class Usuario implements JsonSerializable {
        private $id;
        private $nombre;

        public function __construct($id = null, $nombre = null)
        {
            if (func_get_args() != null) {
                $this->id = $id;
                $this->nombre = $nombre;
            }
        } 

        public function jsonSerialize()
        {
            return [$this->id, $this->nombre];
        }
        
        public static function TraerUnUsuarioPorId($id){
            $pdo = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $pdo->RetornarConsulta(
                "SELECT id, nombre 
                FROM usuario 
                WHERE id = :id");
            $consulta->bindValue(":id", $id, PDO::PARAM_STR);
            $consulta->execute();
            $usuario = $consulta->fetchObject("Usuario");
            return $usuario;
        }
    }
?>