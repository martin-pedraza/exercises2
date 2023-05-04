<?php
    include("AccesoDatos.php");

    class Usuario {
        private $_nombre;
        private $_apellido;
        private $_clave;
        private $_mail;
        private $_localidad;

        public function __construct($nombre, $apellido, $clave, $mail, $localidad)
        {
            $this->_nombre = $nombre;
            $this->_apellido = $apellido;
            $this->_clave = $clave;
            $this->_mail = $mail;
            $this->_localidad = $localidad;
        }

        public static function GuardarUsuario($usuario){
            $pdo = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $pdo->RetornarConsulta("INSERT INTO usuario (nombre, apellido, clave, mail, localidad, fecha_registro) VALUES (:nombre, :apellido, :clave, :mail, :localidad, :fecha_registro)");
            $consulta->bindValue(":nombre", $usuario->_nombre, PDO::PARAM_STR);
            $consulta->bindValue(":apellido", $usuario->_apellido, PDO::PARAM_STR);
            $consulta->bindValue(":clave", $usuario->_clave, PDO::PARAM_STR);
            $consulta->bindValue(":mail", $usuario->_mail, PDO::PARAM_STR);
            $consulta->bindValue(":localidad", $usuario->_localidad, PDO::PARAM_STR);
            $consulta->bindValue(":fecha_registro", date("Y-m-d"), PDO::PARAM_STR);
            return $consulta->execute();
        }
    }
?>