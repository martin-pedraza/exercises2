<?php
    class Usuario{
        private $_id;
        private $_nombre;

        public function __construct($_id, $_nombre)
        {
            $this->_id = $_id;
            $this->_nombre = $_nombre;
        } 

        public static function GuardarUsuario($usuario){
            $usuarios = array();
            $usuarios = GestorArchivo::LeerArchivo("usuarios.json", "Usuario::PasarArrayAUsuario", $usuarios);

            array_push($usuarios, $usuario);

            GestorArchivo::Guardar("usuarios.json", Usuario::PasarArrayAJson($usuarios));
        }

        public static function VerificarUsuarioArchivo($usuario){
            $usuarios = array();
            $usuarios = GestorArchivo::LeerArchivo("usuarios.json", "Usuario::PasarArrayAUsuario", $usuarios);
            return array_search($usuario, $usuarios) !== false;
        }
        
        public static function PasarArrayAUsuario($usuarios){
            $array = array();
            foreach ($usuarios as $value) {
                array_push($array, Usuario::PasarAUsuario($value));
            }
            return $array;
        }

        private static function PasarArrayAJson($usuarios){
            $array = array();
            foreach ($usuarios as $value) {
                array_push($array, Usuario::PasarAJson($value));
            }
            return json_encode($array, JSON_PRETTY_PRINT);
        }

        private static function PasarAUsuario($usuarioJson){
            $usuario = json_decode($usuarioJson);
            return new Usuario($usuario[0], $usuario[1]);
        }

        private static function PasarAJson($usuario){
            return json_encode([$usuario->_id, $usuario->_nombre]);
        }
    }
?>