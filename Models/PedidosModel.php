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
                $where = " WHERE p.idusuario = ".$idpersona;
            }
            $sql = "SELECT p.idpedido,
                           p.referenciacobro,
                           p.idtransaccionpaypal,
                           DATE_FORMAT(p.fecha, '%d/%m/%Y') as fecha,
                           p.monto,
                           tp.tipopago,
                           tp.idtipopago,
                           p.status
                    FROM pedido p
                    INNER JOIN tipo_pago tp
                    ON p.idTipoPago = tp.idTipoPago $where ";
                    $request = $this -> select_all($sql);
                    return $request;
        }
         public function selectPedido(int $idpedido,$idpersona = NULL){
        $busqueda = "";
        if ($idpersona != NULL) {
            $busqueda = " AND p.personaid = ".$idpersona;
        }
        $request = array();
        $sql = "SELECT p.idpedido,
							p.referenciacobro,
							p.idtransaccionpaypal,
							p.idusuario,
							DATE_FORMAT(p.fecha, '%d/%m/%Y') as fecha,
							p.costoenvio,
							p.monto,
							p.idTipoPago,
							t.tipoPago,
							p.direccion_envio,
							p.status
					FROM pedido as p
					INNER JOIN tipo_pago t
					ON p.idTipoPago= t.idTipoPago
					WHERE p.idpedido =  $idpedido ".$busqueda;
                    $requestPedido = $this->select($sql);
                    if (!empty($requestPedido)) {
                        $idpersona = $requestPedido['idusuario'];
                        $sql_cliente = "SELECT idUsuario,
											nombres,
											apellidos,
											email,
                                            telefono
									FROM usuarios WHERE idUsuario = $idpersona ";
                        $requestcliente = $this->select($sql_cliente);
                        $sql_detalle = "SELECT p.idproducto,
											p.nombre as producto,
											d.precio,
											d.cantidad
									FROM detalle_pedido d
									INNER JOIN producto p
									ON d.productoid = p.idproducto 
									WHERE d.pedidoid = $idpedido";
                        $requestProductos = $this->select_all($sql_detalle);
                        $request = array('cliente'=> $requestcliente,
                                        'orden'=> $requestPedido,
                                        'detalle'=> $requestProductos);
                    }
                    return $request;
        }
  }
?>


      