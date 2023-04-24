<?php
    class GestorArchivo{
        public static function Guardar($nombreArchivo, $texto){
            $archivo = fopen($nombreArchivo, "w");
            fwrite($archivo, $texto);
            fclose($archivo);
        }

        public static function VerificarArchivo($nombreArchivo, $array){
            if (file_exists($nombreArchivo) && filesize($nombreArchivo)) {
                $archivo = fopen($nombreArchivo, "r");
                $contenido = fread($archivo, filesize($nombreArchivo));
                if (json_decode($contenido)) {
                    $array = json_decode($contenido);
                }
                fclose($archivo);
            }
            return $array;
        }

        public static function LeerArchivo($nombreArchivo, $function, $array){
            $array = GestorArchivo::VerificarArchivo($nombreArchivo, $array);
            if (count($array) > 0) {
                $array = $function($array);
            }
            return $array;
        }

        public static function ObtenerID(){
            if (file_exists("id.txt")) {
                $archivo = fopen("id.txt", "r");
                $id = fgets($archivo);
                if (is_numeric($id)) {
                    return ++$id;
                }
                fclose($archivo);
            }
            return 1000;
        }  
    }
?>