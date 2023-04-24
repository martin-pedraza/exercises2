<?php
    class Usuario
    {
        private $_nombre;
        private $_clave;
        private $_email;
        private $_id;
        private $_fecha;

        public function __construct($_nombre, $_clave, $_email, $_id, $_fecha)
        {
            $this->_nombre = $_nombre;
            $this->_clave = $_clave;
            $this->_email = $_email;
            $this->_id = $_id;
            Usuario::GuardarId($_id);
            $this->_fecha = $_fecha;
            Usuario::GuardarUsuario($this);
        }

        public static function ObtenerId(){
            if(file_exists("id.txt")){
                $archivo = fopen("id.txt", "r");
                $id = fgets($archivo);
                if (!is_null($id) && !empty(trim($id)) && is_numeric($id)) {
                    return ++$id;
                }
                fclose($archivo);
            }
            return 1000;
        }

        private static function GuardarId($id){
            $archivo = fopen("id.txt", "w");
            fwrite($archivo, $id);
            fclose($archivo);
        }

        private static function PasarAJson($usuario){
            return json_encode([
                $usuario->_id,
                $usuario->_nombre,
                $usuario->_clave,
                $usuario->_email,
                $usuario->_fecha
            ]);
        }

        private static function GuardarUsuario($usuario){
            $usuarios = array();

            if (file_exists("usuario.json") && filesize("usuario.json")) {
                $archivo = fopen("usuario.json", "r");
                $contenido = fread($archivo, filesize("usuario.json"));
                if(json_decode($contenido)){
                    $usuarios = json_decode($contenido);
                }
                fclose($archivo);
            }
            
            $archivo = fopen("usuario.json", "w");
            array_push($usuarios,  Usuario::PasarAJson($usuario));
            fwrite($archivo, json_encode(($usuarios), JSON_PRETTY_PRINT));
            fclose($archivo);
        }
    }
    
?>