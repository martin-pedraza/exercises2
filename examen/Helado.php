<?php
    $GLOBALS["archivoHelado"] = "heladeria.json";
    class Helado implements JsonSerializable {

        public $id;
        public $sabor;
        public $precio;
        public $tipo;
        public $vaso;
        public $stock;

        public function __construct($id, $sabor, $precio, $tipo, $vaso, $stock)
        {
            $this->id = $id;
            $this->sabor = $sabor;
            $this->precio = $precio;
            $this->tipo = $tipo;
            $this->vaso = $vaso;
            $this->stock = $stock;
        }

        public function jsonSerialize(){
            return [
                "id" => $this->id,
                "sabor" => $this->sabor,
                "precio" => $this->precio,
                "tipo" => $this->tipo,
                "vaso" => $this->vaso,
                "stock" => $this->stock
            ];
        }

        private static function jsonUnserialize($json){
            return new Helado(
                $json->id,
                $json->sabor,
                $json->precio,
                $json->tipo,
                $json->vaso,
                $json->stock
            );
        }

        public function GuardarHelado(){
            $helados = array();
            $helados = Helado::BuscarHeladosArchivo();

            array_push($helados, $this);

            GestorArchivo::Guardar($GLOBALS["archivoHelado"], json_encode($helados, JSON_PRETTY_PRINT));
        }

        private static function BuscarHeladosArchivo(){
            $helados = array();
            $helados = GestorArchivo::VerificarArchivo($GLOBALS["archivoHelado"], $helados);
            
            if (count($helados) > 0) {
                $heladosObj = array();
                foreach ($helados as $value) {
                    $heladoObj = Helado::jsonUnserialize($value);
                    array_push($heladosObj, $heladoObj);
                }
                $helados = $heladosObj;
            }

            return $helados;
        }

        public static function BuscarHeladoPorTipoSaborParaActualizarPrecioSumarStock($helado){
            $helados = array();
            $helados = Helado::BuscarHeladosArchivo();

            foreach ($helados as $value) {
                if ($value->tipo == $helado->tipo && $value->sabor == $helado->sabor) {
                    $value->precio = $helado->precio;
                    $value->stock += $helado->stock;
                    GestorArchivo::Guardar($GLOBALS["archivoHelado"], json_encode($helados, JSON_PRETTY_PRINT));
                    return true;
                }
            }
            return false;
        }

        public static function BuscarHeladoPorTipoSabor($tipo, $sabor){
            $helados = array();
            $helados = Helado::BuscarHeladosArchivo();

            foreach ($helados as $value) {
                if ($value->tipo == $tipo && $value->sabor == $sabor) {
                    return true;
                }
            }
            return false;
        }

        public static function BuscarHeladoPorTipoSaborParaQuitarStock($tipo, $sabor, $stock){
            $helados = array();
            $helados = Helado::BuscarHeladosArchivo();

            foreach ($helados as $value) {
                if ($value->tipo == $tipo && $value->sabor == $sabor) {
                    $value->stock -=$stock;
                    GestorArchivo::Guardar($GLOBALS["archivoHelado"], json_encode($helados, JSON_PRETTY_PRINT));
                    return true;
                }
            }
            return false;
        }

        public static function BuscarCantidadHeladoPorTipoSaborVaso($tipo, $sabor, $vaso){
            $helados = array();
            $helados = Helado::BuscarHeladosArchivo();

            foreach ($helados as $value) {
                if ($value->tipo == $tipo && $value->sabor == $sabor && $value->vaso == $vaso) {
                    return $value->stock;
                }
            }
            return false;
        }
    }
?>