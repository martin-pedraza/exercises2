<?php
    class Producto{
        private $_id;
        private $_codigoDeBarra;
        private $_nombre;
        private $_tipo;
        private $_stock;
        private $_precio;

        public function __construct($_id, $_codigoDeBarra, $_nombre, $_tipo, $_stock, $_precio)
        {
            $this->_id = $_id;
            Producto::GuardarId($_id);
            $this->_codigoDeBarra = $_codigoDeBarra;
            $this->_nombre = $_nombre;
            $this->_tipo = $_tipo;
            $this->_stock = $_stock;
            $this->_precio = $_precio;
        }

        public static function ObtenerId(){
            if (file_exists("id.txt")) {
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

        private static function VerificarArchivo($productos){
            if(file_exists("productos.json") && filesize("productos.json")){
                $archivo = fopen("productos.json", "r");
                $contenido = fread($archivo, filesize("productos.json"));
                if(json_decode($contenido)){
                    $productos = json_decode($contenido);
                }
                fclose($archivo);
            }
            return $productos;
        }

        private static function PasarAJson($producto){
            return json_encode([
                $producto->_id,
                $producto->_codigoDeBarra,
                $producto->_nombre,
                $producto->_tipo,
                $producto->_stock,
                $producto->_precio
            ]);
        }

        private static function PasarAProducto($producto){
            $arrayProducto = json_decode($producto);
            return new Producto(
                $arrayProducto[0],
                $arrayProducto[1],
                $arrayProducto[2],
                $arrayProducto[3],
                $arrayProducto[4],
                $arrayProducto[5]
            );
        }

        public static function GuardarProducto($producto){
            $productos = array();

            $productos = Producto::VerificarArchivo($productos);

            $existe = false;

            if(count($productos) > 0){
                $productos = Producto::PasarArrayAProducto($productos);
                foreach ($productos as $value) {
                    if ($value->_id == $producto->_id) {
                        $value->_stock += $producto->_stock;
                        $existe = true;
                        echo "Actualizado";
                        break;
                    }
                }
            }

            if (!$existe) {
                array_push($productos, $producto);
                echo "Ingresado";
            }
            
            $archivo = fopen("productos.json", "w");
            if(!fwrite($archivo, Producto::PasarArrayAJson($productos))){
                echo "No se pudo hacer";
            };
            fclose($archivo);
        }

        private static function PasarArrayAProducto($productos){
            $array = array();
            foreach ($productos as $value) {
                array_push($array, Producto::PasarAProducto($value));
            }
            return $array;
        }

        private static function PasarArrayAJson($productos){
            $array = array();
            foreach ($productos as $value) {
                array_push($array, Producto::PasarAJson($value));
            }
            return json_encode($array, JSON_PRETTY_PRINT);
        }
    }
?>