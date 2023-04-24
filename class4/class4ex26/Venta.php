<?php
    class Venta{
        private $_id;
        private $_producto;

        public function __construct($_id, $_producto)
        {
            $this->_id = $_id;
            $this->_producto = $_producto;
        }

        private static function PasarAJson($venta){
            return json_encode([
                $venta->_id,
                $venta->_producto
            ]);
        }

        private static function PasarAVenta($ventaJson){
            $venta = json_decode($ventaJson);
            return new Venta($venta[0], $venta[1]);
        }

        private static function PasarArrayAJson($ventas){
            $array = array();
            foreach ($ventas as $value) {
                array_push($array, Venta::PasarAJson($value));
            }
            return json_encode($array, JSON_PRETTY_PRINT);
        }

        public static function PasarArrayAVenta($ventas){
            $array = array();
            foreach ($ventas as $value) {
                array_push($array, Venta::PasarAVenta($value));
            }
            return $array;
        }

        public static function GuardarVenta($venta){
            $ventas = array();
            $ventas = GestorArchivo::LeerArchivo("ventas.json", "Venta::PasarArrayAVenta", $ventas);

            array_push($ventas, $venta);

            GestorArchivo::Guardar("ventas.json", Venta::PasarArrayAJson($ventas));
        }
    }
?>