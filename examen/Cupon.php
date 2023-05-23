<?php
    $GLOBALS["archivoCupon"] = "cupones.json";

    class Cupon implements JsonSerializable{
        public $id;
        public $devolucionId;
        public $porcentajeDescuento;
        public $estado;

        public function __construct($id, $devolucionId, $porcentajeDescuento, $estado)
        {
            $this->id = $id;
            $this->devolucionId = $devolucionId;
            $this->porcentajeDescuento = $porcentajeDescuento;
            $this->estado = $estado;
        }

        public function jsonSerialize(){
            return [
                "id" => $this->id,
                "devolucionId" => $this->devolucionId,
                "porcentajeDescuento" => $this->porcentajeDescuento,
                "estado" => $this->estado
            ];
        }

        private static function jsonUnserialize($json){
            return new Cupon(
                $json->id,
                $json->devolucionId,
                $json->porcentajeDescuento,
                $json->estado
            );
        }

        public function GuardarCupon(){
            $cupons = array();
            $cupons = Cupon::BuscarCuponesArchivo();

            array_push($cupons, $this);

            GestorArchivo::Guardar($GLOBALS["archivoCupon"], json_encode($cupons, JSON_PRETTY_PRINT));
        }

        private static function BuscarCuponesArchivo(){
            $cupons = array();
            $cupons = GestorArchivo::VerificarArchivo($GLOBALS["archivoCupon"], $cupons);
            
            if (count($cupons) > 0) {
                $cuponsObj = array();
                foreach ($cupons as $value) {
                    $cuponObj = Cupon::jsonUnserialize($value);
                    array_push($cuponsObj, $cuponObj);
                }
                $cupons = $cuponsObj;
            }

            return $cupons;
        }
    }
?>