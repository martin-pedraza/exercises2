<?php
    $GLOBALS["archivoPizza"] = "pizza.json";
    class Pizza implements JsonSerializable {

        public $id;
        public $sabor;
        public $precio;
        public $tipo;
        public $cantidad;

        public function __construct($id, $sabor, $precio, $tipo, $cantidad)
        {
            $this->id = $id;
            $this->sabor = $sabor;
            $this->precio = $precio;
            $this->tipo = $tipo;
            $this->cantidad = $cantidad;
        }

        public function jsonSerialize(){
            return [
                "id" => $this->id,
                "sabor" => $this->sabor,
                "precio" => $this->precio,
                "tipo" => $this->tipo,
                "cantidad" => $this->cantidad
            ];
        }

        private static function jsonUnserialize($json){
            return new Pizza(
                $json->id,
                $json->sabor,
                $json->precio,
                $json->tipo,
                $json->cantidad
            );
        }

        public function GuardarPizza(){
            $pizzas = array();
            $pizzas = Pizza::BuscarPizzasArchivo();

            array_push($pizzas, $this);

            GestorArchivo::Guardar($GLOBALS["archivoPizza"], json_encode($pizzas, JSON_PRETTY_PRINT));
        }

        private static function BuscarPizzasArchivo(){
            $pizzas = array();
            $pizzas = GestorArchivo::VerificarArchivo($GLOBALS["archivoPizza"], $pizzas);
            
            if (count($pizzas) > 0) {
                $pizzasObj = array();
                foreach ($pizzas as $value) {
                    $pizzaObj = Pizza::jsonUnserialize($value);
                    array_push($pizzasObj, $pizzaObj);
                }
                $pizzas = $pizzasObj;
            }

            return $pizzas;
        }

        public static function BuscarPizzaPorTipoSaborParaActualizarPrecioSumarStock($pizza){
            $pizzas = array();
            $pizzas = Pizza::BuscarPizzasArchivo();

            foreach ($pizzas as $value) {
                if ($value->tipo == $pizza->tipo && $value->sabor == $pizza->sabor) {
                    $value->precio = $pizza->precio;
                    $value->cantidad += $pizza->cantidad;
                    GestorArchivo::Guardar($GLOBALS["archivoPizza"], json_encode($pizzas, JSON_PRETTY_PRINT));
                    return true;
                }
            }
            return false;
        }

        public static function BuscarPizzaPorTipoSabor($tipo, $sabor){
            $pizzas = array();
            $pizzas = Pizza::BuscarPizzasArchivo();

            foreach ($pizzas as $value) {
                if ($value->tipo == $tipo && $value->sabor == $sabor) {
                    return true;
                }
            }
            return false;
        }

        public static function BuscarPizzaPorTipoSaborParaQuitarStock($tipo, $sabor, $cantidad){
            $pizzas = array();
            $pizzas = Pizza::BuscarPizzasArchivo();

            foreach ($pizzas as $value) {
                if ($value->tipo == $tipo && $value->sabor == $sabor) {
                    $value->cantidad -= $cantidad;
                    GestorArchivo::Guardar($GLOBALS["archivoPizza"], json_encode($pizzas, JSON_PRETTY_PRINT));
                    return true;
                }
            }
            return false;
        }

        public static function BuscarCantidadPizzaPorTipoSabor($tipo, $sabor){
            $pizzas = array();
            $pizzas = Pizza::BuscarPizzasArchivo();

            foreach ($pizzas as $value) {
                if ($value->tipo == $tipo && $value->sabor == $sabor) {
                    return $value->cantidad;
                }
            }
            return false;
        }
    }
?>