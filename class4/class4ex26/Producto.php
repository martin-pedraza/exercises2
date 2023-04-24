<?php
    class Producto{
        private $_codigoDeBarra;
        private $_stock;

        public function __construct($_codigoDeBarra, $_stock)
        {
            $this->_codigoDeBarra = $_codigoDeBarra;
            $this->_stock = $_stock;
        }

        private static function PasarAProducto($producto){
            $arrayProducto = json_decode($producto);
            return new Producto(
                $arrayProducto[0],
                $arrayProducto[1]
            );
        }

        private static function PasarAJson($producto){
            return json_encode([$producto->_codigoDeBarra, $producto->_stock]);
        }

        private static function PasarArrayAJson($productos){
            $array = array();
            foreach ($productos as $value) {
                array_push($array, Producto::PasarAJson($value));
            }
            return json_encode($array, JSON_PRETTY_PRINT);
        }

        public static function PasarArrayAProducto($productos){
            $array = array();
            foreach ($productos as $value) {
                array_push($array, Producto::PasarAProducto($value));
            }
            return $array;
        }

        public static function GuardarProducto($producto){
            $productos = array();
            $productos = GestorArchivo::LeerArchivo("productos.json", "Producto::PasarArrayAProducto", $productos);

            array_push($productos, $producto);

            GestorArchivo::Guardar("productos.json", Producto::PasarArrayAJson($productos));
        }

        public static function VerificarStockProductoArchivo($producto){
            $productos = array();
            $productos = GestorArchivo::LeerArchivo("productos.json", "Producto::PasarArrayAProducto", $productos);
            foreach ($productos as $value) {
                if ($value->_codigoDeBarra == $producto->_codigoDeBarra) {
                    return $value->_stock;
                }
            }
            return false;
        }

        public static function ModificarStockProductoArchivo($producto){
            $productos = array();
            $productos = GestorArchivo::LeerArchivo("productos.json", "Producto::PasarArrayAProducto", $productos);
            foreach ($productos as $value) {
                if ($value->_codigoDeBarra == $producto->_codigoDeBarra) {
                    $value->_stock -= $producto->_stock;
                }
            }
            GestorArchivo::Guardar("productos.json", Producto::PasarArrayAJson($productos));
        }
    }
?>