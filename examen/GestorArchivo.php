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

        public static function ObtenerID($clase){
            switch ($clase) {
                case 'helado':
                    $archivoId = "idHelado.txt";
                    $idClase = 1000;
                    break;
                case 'venta':
                    $archivoId = "idVenta.txt";
                    $idClase = 1;
                    break;
                case 'pedido':
                    $archivoId = "idPedido.txt";
                    $idClase = 100000;
                    break;
                case 'cupon':
                    $archivoId = "idCupon.txt";
                    $idClase = 10000;
                    break;
                case 'descuento':
                    $archivoId = "idDescuento.txt";
                    $idClase = 1000000;
                    break;
                default:
                    break;
            }
            if (file_exists($archivoId)) {
                $archivo = fopen($archivoId, "r");
                $id = fgets($archivo);
                if (is_numeric($id)) {
                    return ++$id;
                }
                fclose($archivo);
            }
            return $idClase;
        }  

        public static function GuardarId($id, $clase){
            switch ($clase) {
                case 'helado':
                    $archivoId = "idHelado.txt";
                    break;
                case 'venta':
                    $archivoId = "idVenta.txt";
                    break;
                case 'pedido':
                    $archivoId = "idPedido.txt";
                    break;
                case 'cupon':
                    $archivoId = "idCupon.txt";
                    break;
                case 'descuento':
                    $archivoId = "idDescuento.txt";
                    break;
                default:
                    break;
            }
            $archivo = fopen($archivoId, "w");
            fwrite($archivo, $id);
            fclose($archivo);
        }
    }
?>