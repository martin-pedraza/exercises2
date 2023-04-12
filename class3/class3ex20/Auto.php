<?php
    class Auto 
    {
        private $_marca; //(String).
        private $_color; //(String)
        private $_precio; //(Double)
        private $_fecha; //(DateTime)

        public function __construct($_marca, $_color, $_precio = null, $_fecha = null){
            $this->_marca = $_marca;
            $this->_color = $_color;
            $this->_precio = $_precio;
            $this->_fecha = $_fecha;
        }

        public function AgregarImpuestos($impuesto){
            $this->_precio += $impuesto;
        }

        public static function MostrarAuto($auto){
            echo "Marca: " . $auto->_marca . "<br>" . "Color: " . $auto->_color . "<br>";
            if ($auto->_precio) {
                echo "Precio: " . $auto->_precio . "<br>";
            }
            if ($auto->_fecha) {
                echo "Fecha: " . $auto->_fecha . "<br>";
            }
        }

        public function Equals($autoB){
            return $this->_marca == $autoB->_marca;
        }

        public static function Add($autoUno, $autoDos){
            if($autoUno->_marca == $autoDos->_marca && $autoUno->_color == $autoDos->_color){
                return $autoUno->_precio + $autoDos->_precio;
            }
            return 0;
        }

        public static function GuardarAutoEnArchivo($archivo, $auto){
            $archivo = fopen($archivo, "a");
            $cadenaAuto = $auto->_marca . "," . $auto->_color . ($auto->_precio?",".$auto->_precio:"") . ($auto->_fecha?",".$auto->_fecha:"") . "\n";
            fwrite($archivo, $cadenaAuto);
            fclose($archivo);
        }
    }
    
?>