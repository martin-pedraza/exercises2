<?php
    include_once("AccesoDatos.php");

    class Usuario {
        private $nombre;
        private $clave;
        private $mail;

        public function __construct(
            $nombre = null,
            $clave = null,
            $mail = null
        )
        {
            if (func_get_args() != null) {
                $this->nombre = $nombre;
                $this->clave = $clave;
                $this->mail = $mail;
            }
        } 

        public function __get($name)
        {
            return $this->$name;
        }

        public function __set($name, $value)
        {
            $this->$name = $value;
        }
        
        public function ModificarUsuario()
        {
            $pdo = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $pdo->RetornarConsulta(
                "UPDATE usuario
                SET clave = :clave
                WHERE mail = :mail"
            );
            $consulta->bindValue(":clave", $this->clave, PDO::PARAM_STR);
            $consulta->bindValue(":mail", $this->mail, PDO::PARAM_STR);
            return $consulta->execute();
        }

        public static function TraerUnUsuarioPorMail($mail){
            $pdo = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $pdo->RetornarConsulta(
                "SELECT nombre, mail, clave 
                FROM usuario 
                WHERE mail = :mail");
            $consulta->bindValue(":mail", $mail, PDO::PARAM_STR);
            $consulta->execute();
            return $consulta->fetchObject("Usuario");    
        }
    }
?>