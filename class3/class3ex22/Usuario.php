<?php
    class Usuario
    {
        private $_email;
        private $_clave;
        
        public function __construct($_email, $_clave)
        {
            $this->_email = $_email;
            $this->_clave = $_clave;
        }

        public static function DarAltaUsuario($usuario){
            $archivo = fopen("usuarios.csv", "a");
            $cadenaUsuario = $usuario->_email . "," . $usuario->_clave . "\n";
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
                    $objectUsuario = new Usuario($arrayUsuario[0], trim($arrayUsuario[1]));
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
                $cadenaHTML .= "<li>" . $value->_nombre . "<ul><li>" . $value->_email . "</li></ul></li>";
            }
            $cadenaHTML .= "</ul>";
            return $cadenaHTML;
        }

        public static function VerificarUsuario($arrayUsuario, $usuario){
            $mensaje = "Usuario no registrado";
            foreach ($arrayUsuario as $value) {
                if ($value->_email == $usuario->_email) {
                    $mensaje = "Error en los datos";
                    if ($value->_clave == $usuario->_clave) {
                        $mensaje = "Verificado";
                    }
                    break;
                }
            }
            return $mensaje;
        }
    }
    
?>