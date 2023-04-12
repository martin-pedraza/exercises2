<?php
    class Usuario
    {
        private $_nombre;
        private $_clave;
        private $_email;
        
        public function __construct($_nombre, $_clave, $_email)
        {
            $this->_nombre = $_nombre;
            $this->_clave = $_clave;
            $this->_email = $_email;
        }

        public static function DarAltaUsuario($usuario){
            $archivo = fopen("usuarios.csv", "a");
            $cadenaUsuario = $usuario->_nombre . "," . $usuario->_clave . "," . $usuario->_email . "\n";
            $sePudoEscribir = fwrite($archivo, $cadenaUsuario);
            fclose($archivo);
            return $sePudoEscribir !== false;
        }


    }
    
?>