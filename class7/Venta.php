<?php
    $GLOBALS["archivoVenta"] = "ventas.json";
    class Venta implements JsonSerializable{

        public $id;
        public $pedido;
        public $email;
        public $sabor;
        public $tipo;
        public $cantidad;
        public $fecha;
        public $imagen;

        public function __construct($id, $pedido, $email, $sabor, $tipo, $cantidad, $fecha, $imagen = null)
        {
            $this->id = $id;
            $this->pedido = $pedido;
            $this->email = $email;
            $this->sabor = $sabor;
            $this->tipo = $tipo;
            $this->cantidad = $cantidad;
            $this->fecha = $fecha;
            $this->imagen = $imagen;
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
                "cantidad" => $this->cantidad,
                "fecha" => $this->fecha,
                "imagen" => $this->imagen
            ];
        }

        private static function jsonUnserialize($json){
            return new Venta(
                $json->id,
                $json->pedido,
                $json->email,
                $json->sabor,
                $json->tipo,
                $json->cantidad,
                $json->fecha,
                $json->imagen
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

        public static function ConsultarCantidadPizzasVendidas(){
            $ventas = array();
            $ventas = Venta::BuscarVentasArchivo();

            $sumador = 0;
            foreach ($ventas as $value) {
                $sumador += $value->cantidad;
            }

            return $sumador;
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

        public static function BuscarVentaPorPedidoParaModificar($pedido, $email, $sabor, $tipo, $cantidad)
        {
            $ventas = array();
            $ventas = Venta::BuscarVentasArchivo();

            if (count($ventas) > 0) {
                foreach ($ventas as $value) {
                    if ($value->pedido == $pedido) {
                        $value->email = $email;
                        $value->sabor = $sabor;
                        $value->tipo = $tipo;
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
                $ventasFinal = array();
                foreach ($ventas as $value) {
                    if ($value->pedido == $pedido) {
                        continue;
                    }
                    array_push($ventasFinal, $value);
                }
                $ventas = $ventasFinal;
                GestorArchivo::Guardar($GLOBALS["archivoVenta"], json_encode($ventas, JSON_PRETTY_PRINT));
                return true;
            }

            return false;
        }
    }
?>