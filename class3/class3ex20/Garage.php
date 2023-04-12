<?php

    class Garage 
    {
        private $_razonSocial;
        private $_precioPorHora;
        private $_autos;

        public function __construct($_razonSocial, $_precioPorHora = null){
            $this->_razonSocial = $_razonSocial;
            $this->_precioPorHora = $_precioPorHora;
            $this->_autos = array();
        }

        public function MostrarGarage(){
            echo "Razon social: " . $this->_razonSocial . "<br>";
            if ($this->_precioPorHora) {
                echo "Precio por hora: " . $this->_precioPorHora . "<br>";
            }
            if ($this->_autos) {
                foreach($this->_autos as $value){
                    Auto::MostrarAuto($value);
                }
            }
        }

        public function Equals($auto){
            return array_search($auto, $this->_autos) !== false;
        }

        public function Add($auto){
            if($this->Equals($auto)){
                return "El auto ya está en el garage";
            }
            array_push($this->_autos, $auto);
            return "Auto sumado";
        }

        public function Remove($auto){
            if($this->Equals($auto)){
                if (($key = array_search($auto, $this->_autos)) !== false) {
                    unset($this->_autos[$key]);
                }
                return "Auto retirado";
            }
            return "El auto no está en el garage";
        }

        public static function GuardarGarageEnArchivo($garage){
            $archivo = fopen("garage.csv", "a");
            fwrite($archivo, $garage->_razonSocial . "," . $garage->_precioPorHora . "\n");
            foreach ($garage->_autos as $value) {
                Auto::GuardarAutoEnArchivo("garage.csv", $value);
            }
            fclose($archivo);
        }

        public static function LeerGarageEnArchivo(){
            $garages = array();
            $archivo = fopen("garage.csv", "r");
            if(!feof($archivo)){
                $cadenaGarage = fgets($archivo);
                if(trim($cadenaGarage) != ""){
                    $arrayGarage = explode(",", $cadenaGarage);
                    $objectGarage = new Garage($arrayGarage[0], count($arrayGarage)>=1?$arrayGarage[1]:"");
                }
            }
            while (!feof($archivo)) {
                $cadenaAuto = fgets($archivo);
                if(trim($cadenaAuto) != ""){
                    $arrayAuto = explode(",", $cadenaAuto);
                    $objectAuto = new Auto($arrayAuto[0], $arrayAuto[1], count($arrayAuto)>=3?$arrayAuto[2]:"", count($arrayAuto)==4?$arrayAuto[3]:"");
                    $objectGarage->Add($objectAuto);
                }
            }
            array_push($garages, $objectGarage);
            fclose($archivo);
            return $garages;
        }
    }
    
?>