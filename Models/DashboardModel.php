<?php  
    class DashboardModel extends Mysql{

        
        public function __construct()
        {
           parent::__construct();
           
        }

        public function cantUsuarios(){
            $sql = "SELECT COUNT(*) as total from tbl_usuarios u
            INNER JOIN tbl_personas p on p.COD_PERSONA=u.COD_PERSONA
            WHERE p.COD_STATUS!=0";
            $request = $this->select($sql);
            $total = $request['total'];
            return $total;
        }
    public function cantClientes()
    {
        $sql = "SELECT COUNT(*) as total from tbl_cliente u
        INNER JOIN tbl_personas p on p.COD_PERSONA=u.COD_PERSONA
        WHERE p.COD_STATUS!=0";
        $request = $this->select($sql);
        $total = $request['total'];
        return $total;
    }
    public function cantProductos()
    {
        $sql = "SELECT COUNT(*) as total FROM tbl_productos WHERE COD_STATUS != 0";
        $request = $this->select($sql);
        $total = $request['total'];
        return $total;
    }
    public function cantPedidos()
    {
        $sql = "SELECT COUNT(*) as total FROM tbl_pedido";
        $request = $this->select($sql);
        $total = $request['total'];
        return $total;
    }
    public function lastOrders()
    {
        $sql = "SELECT p.COD_PEDIDO, CONCAT(pr.nombres,' ',pr.apellidos) as nombre, p.monto, s.DESCRIPCION as Estado FROM tbl_pedido p
        INNER JOIN tbl_personas pr
        ON p.COD_PERSONA = pr.COD_PERSONA
        INNER JOIN tbl_tipo_estado s 
        ON p.COD_ESTADO = s.COD_ESTADO
        ORDER BY p.COD_Pedido DESC LIMIT 10 ";
        $request = $this->select_all($sql);
        return $request;
    } 

    public function selectPagosMes(int $anio, int $mes){
    $sql = "SELECT p.COD_TIPO_PAGO, tp.TIPO_PAGO, COUNT(p.COD_TIPO_PAGO) as cantidad, SUM(p.MONTO) as total 
    FROM tbl_pedido p 
    INNER JOIN tbl_tipo_pago tp 
    ON p.COD_TIPO_PAGO = tp.COD_TIPO_PAGO 
    WHERE MONTH (p.FECHA) = $mes AND YEAR (p.FECHA) = $anio GROUP BY COD_TIPO_PAGO";
    $pagos = $this->select_all($sql);
    $meses = Meses();
    $arrData =array('anio' => $anio, 'mes' => $meses[intval($mes-1)], 'tipospago' => $pagos);
    return $arrData;
    }

    public function selectVentasMes(int $anio, int $mes){
        $totalVentasMes = 0;
        $arrVentaDias = array();
        $dias = cal_days_in_month(CAL_GREGORIAN,$mes, $anio);
        $n_dia = 1;
        for ($i=0; $i < $dias ; $i++) { 
            $date = date_create($anio."-".$mes."-".$n_dia);
            $fechaVenta = date_format($date,"Y-m-d");
            $sql = "SELECT DAY(FECHA) as Dia, COUNT(COD_PEDIDO) as Cantidad, SUM(MONTO) as Total 
            FROM tbl_pedido 
            WHERE DATE(FECHA) = '$fechaVenta' AND COD_ESTADO = '3'";
            $ventaDia = $this->select($sql);
            $ventaDia['Dia'] = $n_dia;
            $ventaDia['Total'] = $ventaDia['Total'] == "" ? 0 : $ventaDia['Total'];
            $totalVentasMes += $ventaDia['Total'];
            array_push($arrVentaDias, $ventaDia);
            $n_dia++;
        }
        $meses = Meses();
        $arrData = array('anio' => $anio, 'mes' => $meses[intval($mes-1)],  'total' => $totalVentasMes,'ventas' => $arrVentaDias);
        return $arrData;
        
    }

    }
