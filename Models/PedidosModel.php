<?php  
    class PedidosModel extends Mysql{

        private $objCategoria;
        public function __construct()
        {
           parent::__construct();
        }

        public function selectPedidos(){
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
                    ON p.idTipoPago = tp.idTipoPago";
                    $request = $this -> select_all($sql);
                    return $request;
        }
  }
?>


      