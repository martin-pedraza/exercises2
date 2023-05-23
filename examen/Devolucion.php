<?php
    $GLOBALS["archivoDevolucion"] = "devoluciones.json";

    class Devolucion implements JsonSerializable{
        public $id;
        public $idCupon;
        public $causa;
        public $imagen;

        public function __construct($id, $idCupon, $causa, $imagen = null)
        {
            $this->id = $id;
            $this->idCupon = $idCupon;
            $this->causa = $causa;
            $this->imagen = $imagen;
        }

        
        public function jsonSerialize(){
            return [
                "id" => $this->id,
                "idCupon" => $this->idCupon,
                "causa" => $this->causa,
                "imagen" => $this->imagen
            ];
        }

        private static function jsonUnserialize($json){
            return new Devolucion(
                $json->id,
                $json->idCupon,
                $json->causa,
                $json->imagen
            );
        }

        public function GuardarHelado(){
            $helados = array();
            $helados = Devolucion::BuscarDevolucionesArchivo();

            array_push($helados, $this);

            GestorArchivo::Guardar($GLOBALS["archivoDevolucion"], json_encode($helados, JSON_PRETTY_PRINT));
        }

        private static function BuscarDevolucionesArchivo(){
            $helados = array();
            $helados = GestorArchivo::VerificarArchivo($GLOBALS["archivoDevolucion"], $helados);
            
            if (count($helados) > 0) {
                $heladosObj = array();
                foreach ($helados as $value) {
                    $heladoObj = Devolucion::jsonUnserialize($value);
                    array_push($heladosObj, $heladoObj);
                }
                $helados = $heladosObj;
            }

            return $helados;
        }
    }
?>