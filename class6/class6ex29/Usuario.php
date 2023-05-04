<?php
    include("AccesoDatos.php");

    class Usuario implements JsonSerializable {
        private $_mail;
        private $_clave;

        public function __construct($_mail = null, $_clave = null)
        {
            if (func_get_args() != null) {
                $this->_mail = $_mail;
                $this->_clave = $_clave;
            }
        } 

        public function jsonSerialize()
        {
            return [$this->_mail, $this->_clave];
        }
        
        public static function TraerUnUsuarioPorMail($mail){
            $pdo = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $pdo->RetornarConsulta(
                "SELECT mail, clave 
                FROM usuario 
                WHERE mail = :mail");
            $consulta->bindValue(":mail", $mail, PDO::PARAM_STR);
            $consulta->execute();
            $usuario = $consulta->fetchObject("Usuario");
            return $usuario;
        }
    }
?>