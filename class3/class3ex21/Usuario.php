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

        public static function RecuperarUsuarios(){
            $usuarios = array();
            $archivo = fopen("usuarios.csv", "r");
            while (!feof($archivo)) {
                $cadenaUsuario = fgets($archivo);
                if (trim($cadenaUsuario) != "") {
                    $arrayUsuario = explode(",", $cadenaUsuario);
                    $objectUsuario = new Usuario($arrayUsuario[0], $arrayUsuario[1], $arrayUsuario[2]);
                    array_push($usuarios, $objectUsuario);
                }
            }
            fclose($archivo);
            return $usuarios;
        }

        public static function CrearListadoUsuarios($lista){
            $cadenaHTML = "";
            $cadenaHTML .= "<ul>";
            foreach ($lista as $value) {
                $cadenaHTML .= "<li>" . $value->_nombre . "<ul><li>" . $value->_email . "</li><li>" . $value->_clave . "</li></ul></li>";
            }
            $cadenaHTML .= "</ul>";
            return $cadenaHTML;
        }
    }
    
?>