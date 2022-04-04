<?php  
    class PedidosModel extends Mysql{

        private $objCategoria;
        public function __construct()
        {
           parent::__construct();
        }

        public function selectPedidos($idpersona = null){
            $where = "";
            if ($idpersona != null) {
                $where = " WHERE p.COD_PERSONA = ".$idpersona;
            }
            $sql = "SELECT p.COD_PEDIDO,
                    p.REFERENCIA_COBRO,
                    p.COD_TRANSACCION_PAYPAL,
                    DATE_FORMAT(p.FECHA, '%d/%m/%Y') as FECHA,
                    p.MONTO,
                    tp.TIPO_PAGO,
                    tp.COD_TIPO_PAGO,
                    p.COD_ESTADO,
                    te.DESCRIPCION as status
                    FROM tbl_pedido p
                    INNER JOIN tbl_tipo_pago tp
                    ON p.COD_TIPO_PAGO = tp.COD_TIPO_PAGO
                    INNER JOIN tbl_tipo_estado te
                    ON p.COD_ESTADO = te.COD_ESTADO 
                     $where ";
                    $request = $this -> select_all($sql);
                    return $request;
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
                        FROM tbl_pedido as p
                        INNER JOIN tbl_tipo_pago tp
                        ON p.COD_TIPO_PAGO= tp.COD_TIPO_PAGO
                        INNER JOIN tbl_tipo_estado te
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
                                        FROM tbl_personas tp WHERE  tp.COD_PERSONA= $idpersona ";
                        $requestcliente = $this->select($sql_cliente);
                        $sql_detalle = "SELECT p.COD_PRODUCTO,
                                               p.NOMBRE as producto,
                                               d.PRECIO,
                                               d.CANTIDAD
                                        FROM tbl_detalle_pedido d
                                        INNER JOIN tbl_productos p
                                        ON d.COD_PRODUCTO = p.COD_PRODUCTO
                                        WHERE d.COD_PEDIDO = $idpedido";
                        $requestProductos = $this->select_all($sql_detalle);
                        $request = array('cliente'=> $requestcliente,
                                        'orden'=> $requestPedido,
                                        'detalle'=> $requestProductos);
                    }
                    return $request;
        }
  }
?>


      