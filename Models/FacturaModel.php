<?php  
/*
-----------------------------------------------------------------------
Universidad Nacional Autónoma de Honduras (UNAH)
    Facultad de Ciencias Economicas
Departamento de Informatica administrativa
     Analisis, Programacion y Evaluacion de Sistemas
                Segundo Periodo 2022


Equipo:
Jose Fernando Ortiz Santos .......... (jfortizs@unah.hn)
Hugo Alejandro Paz Izaguirre..........(hugo.paz@unah.hn)
Kevin Alfredo Rodríguez Zúniga........(karodriguezz@unah.hn)
Leonela Yasmin Pineda Barahona........(lypineda@unah)
Reynaldo Jafet Giron Tercero..........(reynaldo.giron@unah.hn)
Gabriela Giselh Maradiaga Amador......(ggmaradiaga@unah.hn)
Alejandrino Victor García Bustillo....(alejandrino.garcia@unah.hn)

Catedrático:
Lic. Karla Melisa Garcia Pineda 

---------------------------------------------------------------------

Programa:          Módulo de Factura
Fecha:             07-Abril-2022
Programador:       Hugo Alejandro Paz Izaguirre
descripción:       Muestra la factura de un pedido realizado

-----------------------------------------------------------------------*/
    /* require_once("CategoriasModel.php"); */
    //Fernadno 23/10/2021
    class FacturaModel extends Mysql{

        public function __construct()
        {
           parent::__construct();
      }
      public function selectPedido(int $idpedido,$idpersona = NULL){
        $busqueda = "";
        if ($idpersona != NULL) {
            $busqueda = " AND p.COD_PERSONA = ".$idpersona;
            //TIPO CLIENTE
        }
        $request = array();
        $sql = "SELECT p.COD_PEDIDO ,
                        p.REFERENCIA_COBRO,
                        p.COD_TRANSACCION_PAYPAL,
                        p.COD_PERSONA,
                        DATE_FORMAT(p.FECHA, '%d/%m/%Y') as fecha,
                        p.COSTOENVIO,
                        p.MONTO,
                        p.COD_TIPO_PAGO,
                        tp.TIPO_PAGO,
                        p.DIRECCION_ENVIO,
                        te.DESCRIPCION as status,
                        p.COD_ESTADO
                        FROM TBL_PEDIDO as p
                        INNER JOIN TBL_TIPO_PAGO tp
                        ON p.COD_TIPO_PAGO= tp.COD_TIPO_PAGO
                        INNER JOIN TBL_TIPO_ESTADO te
                        ON p.COD_ESTADO = te.COD_ESTADO 
                        WHERE p.COD_PEDIDO =  $idpedido ".$busqueda;
                    $requestPedido = $this->select($sql);
                    if (!empty($requestPedido)) {
                        $idpersona = $requestPedido['COD_PERSONA'];
                        $sql_cliente = "SELECT tp.COD_PERSONA,
                                                    tp.NOMBRES,
                                                    tp.APELLIDOS,
                                                    tp.EMAIL,
                                                    tp.TELEFONO
                                        FROM TBL_PERSONAS tp WHERE  tp.COD_PERSONA= $idpersona ";
                        $requestcliente = $this->select($sql_cliente);
                        $sql_detalle = "SELECT p.COD_PRODUCTO,
                                               p.NOMBRE as producto,
                                               d.PRECIO,
                                               d.CANTIDAD
                                        FROM TBL_DETALLE_PEDIDO d
                                        INNER JOIN TBL_PRODUCTOS p
                                        ON d.COD_PRODUCTO = p.COD_PRODUCTO
                                        WHERE d.COD_PEDIDO = $idpedido";
                        $requestProductos = $this->select_all($sql_detalle);
                        $request = array('cliente'=> $requestcliente,
                                        'orden'=> $requestPedido,
                                        'detalle'=> $requestProductos);
                    }
                    return $request;
        }
        public function selectPedidos(string $inicio,string $final ){
            $sqlPEDIDO="SELECT date_format(FECHA,'%d-%m-%Y') as FECHA, MONTO from tbl_pedido where FECHA between '{$inicio}' and '{$final}'";
            $requestPedido = $this->select_all($sqlPEDIDO);

            $sqlCompra="SELECT  date_format(FECHA_COMPRA,'%d-%m-%Y') as FECHA_COMPRA, MONTO from tbl_orden_compra where FECHA_COMPRA between  '{$inicio}' and '{$final}'";
            dep($sqlCompra);
            dep($sqlPEDIDO);
            exit;
            $requestCompraa = $this->select_all($sqlCompra);
            $request = array('pedido'=> $requestPedido, 'compra'=> $requestCompraa);
         
            return $request;
         }
    }

?>