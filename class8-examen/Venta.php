<?php
    $GLOBALS["archivoVenta"] = "ventas.json";
    class Venta implements JsonSerializable{

        public $id;
        public $pedido;
        public $email;
        public $sabor;
        public $tipo;
        public $vaso;
        public $stock;
        public $fecha;
        public $imagen;
        public $delete;

        public function __construct($id, $pedido, $email, $sabor, $tipo, $vaso, $stock, $fecha, $imagen = null)
        {
            $this->id = $id;
            $this->pedido = $pedido;
            $this->email = $email;
            $this->sabor = $sabor;
            $this->tipo = $tipo;
            $this->vaso = $vaso;
            $this->stock = $stock;
            $this->fecha = $fecha;
            $this->imagen = $imagen;
            $this->delete = false;

        }

        public function __set($name, $value)
        {
            $this->$name = $value;
        }

        public function jsonSerialize(){
            return [
                "id" => $this->id,
                "pedido" => $this->pedido,
                "email" => $this->email,
                "sabor" => $this->sabor,
                "tipo" => $this->tipo,
                "vaso" => $this->vaso,
                "stock" => $this->stock,
                "fecha" => $this->fecha,
                "imagen" => $this->imagen,
                "delete" => $this->delete
            ];
        }

        private static function jsonUnserialize($json){
            return new Venta(
                $json->id,
                $json->pedido,
                $json->email,
                $json->sabor,
                $json->tipo,
                $json->vaso,
                $json->stock,
                $json->fecha,
                $json->imagen,
                $json->delete
            );
        }

        public function GuardarVenta(){
            $ventas = array();
            $ventas = Venta::BuscarVentasArchivo();

            array_push($ventas, $this);

            GestorArchivo::Guardar($GLOBALS["archivoVenta"], json_encode($ventas, JSON_PRETTY_PRINT));
        }

        private static function BuscarVentasArchivo(){
            $ventas = array();
            $ventas = GestorArchivo::VerificarArchivo($GLOBALS["archivoVenta"], $ventas);
            
            if (count($ventas) > 0) {
                $ventasObj = array();
                foreach ($ventas as $value) {
                    $ventaObj = Venta::jsonUnserialize($value);
                    array_push($ventasObj, $ventaObj);
                }
                $ventas = $ventasObj;
            }

            return $ventas;
        }

        public static function ConsultarVentasEntreFechas($desde, $hasta){
            $ventas = array();
            $ventas = Venta::BuscarVentasArchivo();

            if (count($ventas) > 0) {
                $ventasConsultadas = array();
                foreach ($ventas as $value) {
                    if ($value->fecha >= $desde && $value->fecha <= $hasta) {
                        array_push($ventasConsultadas, $value);
                    }
                }
                $ventas = $ventasConsultadas;
            }

            return json_encode($ventas, JSON_PRETTY_PRINT);
        }

        public static function ConsultarVentasPorDia($dia){
            $ventas = array();
            $ventas = Venta::BuscarVentasArchivo();

            if (count($ventas) > 0) {
                $ventasConsultadas = array();
                if(!isset($dia)){
                    $dia = "2023-05-15";
                }
                foreach ($ventas as $value) {
                    if ($value->fecha == $dia) {
                        array_push($ventasConsultadas, $value);
                    }
                }
                $ventas = $ventasConsultadas;
            }

            return json_encode($ventas, JSON_PRETTY_PRINT);
        }

        public static function ConsultarVentasPorUsuario($usuario){
            $ventas = array();
            $ventas = Venta::BuscarVentasArchivo();

            if (count($ventas) > 0) {
                $ventasConsultadas = array();
                foreach ($ventas as $value) {
                    if ($value->email == $usuario) {
                        array_push($ventasConsultadas, $value);
                    }
                }
                $ventas = $ventasConsultadas;
                usort($ventas, function($a, $b) {return strcmp($a->sabor, $b->sabor);});
            }

            return json_encode($ventas, JSON_PRETTY_PRINT);
        }

        public static function ConsultarVentasPorSabor($sabor){
            $ventas = array();
            $ventas = Venta::BuscarVentasArchivo();

            if (count($ventas) > 0) {
                $ventasConsultadas = array();
                foreach ($ventas as $value) {
                    if ($value->sabor == $sabor) {
                        array_push($ventasConsultadas, $value);
                    }
                }
                $ventas = $ventasConsultadas;
            }

            return json_encode($ventas, JSON_PRETTY_PRINT);
        }

        public static function ConsultarVentasPorVasoCucurucho(){
            $ventas = array();
            $ventas = Venta::BuscarVentasArchivo();

            if (count($ventas) > 0) {
                $ventasConsultadas = array();
                foreach ($ventas as $value) {
                    if ($value->vaso == "Cucurucho") {
                        array_push($ventasConsultadas, $value);
                    }
                }
                $ventas = $ventasConsultadas;
            }

            return json_encode($ventas, JSON_PRETTY_PRINT);
        }

        public static function BuscarVentaPorPedidoParaModificar($pedido, $email, $sabor, $tipo, $vaso, $cantidad)
        {
            $ventas = array();
            $ventas = Venta::BuscarVentasArchivo();

            if (count($ventas) > 0) {
                foreach ($ventas as $value) {
                    if ($value->pedido == $pedido) {
                        $value->email = $email;
                        $value->sabor = $sabor;
                        $value->tipo = $tipo;
                        $value->vaso = $vaso;
                        $value->cantidad = $cantidad;
                        GestorArchivo::Guardar($GLOBALS["archivoVenta"], json_encode($ventas, JSON_PRETTY_PRINT));
                        return true;
                    }
                }
            }
            
            return false;
        }

        public static function BuscarVentaPorPedido($pedido){
            $ventas = array();
            $ventas = Venta::BuscarVentasArchivo();

            if (count($ventas) > 0) {
                foreach ($ventas as $value) {
                    if ($value->pedido == $pedido) {
                        return $value;
                    }
                }
            }

            return false;
        }

        public static function BorrarVentaPorPedido($pedido){
            $ventas = array();
            $ventas = Venta::BuscarVentasArchivo();

            if (count($ventas) > 0) {
                foreach ($ventas as $value) {
                    if ($value->pedido == $pedido) {
                        $value->delete = true;
                    }
                }
                GestorArchivo::Guardar($GLOBALS["archivoVenta"], json_encode($ventas, JSON_PRETTY_PRINT));
                return true;
            }

            return false;
        }

        public static function ValidarPedido($pedido){
            $ventas = array();
            $ventas = Venta::BuscarVentasArchivo();

            if (count($ventas) > 0) {
                foreach ($ventas as $value) {
                    if ($value->pedido == $pedido) {
                        return true;
                    }
                }
            }

            return false;
        }
    }
?>