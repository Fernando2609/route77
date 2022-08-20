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

Programa:          Módulo Dashboard
Fecha:             12-Abril-2022
Programador:       Kevin Alfredo Rodríguez Zúniga
descripción:       Módulo que muestra las estadisticas de compras, pedidos 
                   tipo de pago , clientes y productos de la tienda

-----------------------------------------------------------------------*/
    class DashboardModel extends Mysql{

        
        public function __construct()
        {
           parent::__construct();
           
        }
        public function selectProductos(){
			
					$sql= 'call CRUD_PRODUCTOS(null,null,null,null,null,null,null,null,null,null,null,"H",null)';
					$request = $this->select_all($sql);


					 
			return $request;
		}	
        public function cantUsuarios(){
            $sql = "SELECT COUNT(*) as total from TBL_USUARIOS u
            INNER JOIN TBL_PERSONAS p on p.COD_PERSONA=u.COD_PERSONA
            WHERE p.COD_STATUS!=0";
            $request = $this->select($sql);
            $total = $request['total'];
            return $total;
        }
    public function cantClientes()
    {
        $sql = "SELECT COUNT(*) as total from TBL_CLIENTE u
        INNER JOIN TBL_PERSONAS p on p.COD_PERSONA=u.COD_PERSONA
        WHERE p.COD_STATUS!=0";
        $request = $this->select($sql);
        $total = $request['total'];
        return $total;
    }
    public function cantProductos()
    {
        $sql = "SELECT COUNT(*) as total FROM TBL_PRODUCTOS WHERE COD_STATUS != 0";
        $request = $this->select($sql);
        $total = $request['total'];
        return $total;
    }
    public function cantPedidos(){ 
        $rolid =$_SESSION['userData']['COD_ROL'];
        $idUser =$_SESSION['userData']['COD_PERSONA'];
        $where= "";
        if($rolid == RCLIENTES){
            $where = " WHERE COD_PERSONA = ".$idUser; 
         }
          
    
        $sql = "SELECT COUNT(*) as total FROM TBL_PEDIDO".$where;
        $request = $this->select($sql);
        $total = $request['total'];
        return $total;
    }
    public function lastOrders()
    {
        $rolid =$_SESSION['userData']['COD_ROL'];
        $idUser =$_SESSION['userData']['COD_PERSONA'];
        $where= "";
        if($rolid == RCLIENTES){
            $where = " WHERE pr.COD_PERSONA = ".$idUser; 
         }
          


        $sql = "SELECT p.COD_PEDIDO, CONCAT(pr.nombres,' ',pr.apellidos) as nombre, p.monto, s.DESCRIPCION as Estado FROM TBL_PEDIDO p
        INNER JOIN TBL_PERSONAS pr
        ON p.COD_PERSONA = pr.COD_PERSONA
        INNER JOIN TBL_TIPO_ESTADO s 
        ON p.COD_ESTADO = s.COD_ESTADO
        $where
        ORDER BY p.COD_Pedido DESC LIMIT 10 ";
        $request = $this->select_all($sql);
        return $request;
    } 

    public function selectPagosMes(int $anio, int $mes){
    $sql = "SELECT p.COD_TIPO_PAGO, tp.TIPO_PAGO, COUNT(p.COD_TIPO_PAGO) as cantidad, SUM(p.MONTO) as total 
    FROM TBL_PEDIDO p 
    INNER JOIN TBL_TIPO_PAGO tp 
    ON p.COD_TIPO_PAGO = tp.COD_TIPO_PAGO 
    WHERE MONTH (p.FECHA) = $mes AND YEAR (p.FECHA) = $anio GROUP BY COD_TIPO_PAGO";
    $pagos = $this->select_all($sql);
    $meses = Meses();
    $arrData =array('anio' => $anio, 'mes' => $meses[intval($mes-1)], 'tipospago' => $pagos);
    return $arrData;
    }

    public function selectVentasMes(int $anio, int $mes){

        $rolid =$_SESSION['userData']['COD_ROL'];
        $idUser =$_SESSION['userData']['COD_PERSONA'];
        $where= "";
        if($rolid == RCLIENTES){
            $where = " AND  COD_PERSONA = ".$idUser; 
         }
        $totalVentasMes = 0;
        $arrVentaDias = array();
        $dias = cal_days_in_month(CAL_GREGORIAN,$mes, $anio);
        $n_dia = 1;
        for ($i=0; $i < $dias ; $i++) { 
            $date = date_create($anio."-".$mes."-".$n_dia);
            $fechaVenta = date_format($date,"Y-m-d");
            $sql = "SELECT DAY(FECHA) as Dia, COUNT(COD_PEDIDO) as Cantidad, SUM(MONTO) as Total 
            FROM TBL_PEDIDO 
            WHERE DATE(FECHA) = '$fechaVenta' AND COD_ESTADO = 3".$where;
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
    public function selectVentasAnio(int $anio){
        $arrMVentas = array();
        $arrMeses = Meses();
        for ($i=1; $i <= 12; $i++) {
            $arrData = array ('anio'=>'','No_mes'=>'','venta'=>'');
            $sql="SELECT $anio as Anio, $i as mes,  SUM(MONTO) AS venta  
            FROM TBL_PEDIDO
            WHERE MONTH(FECHA) = $i and YEAR(FECHA)= $anio AND COD_ESTADO = 3
            GROUP BY MONTH(FECHA)";
            $ventaMes = $this->select($sql);
            $arrData['mes'] = $arrMeses[$i-1];
            if (empty($ventaMes)){
                $arrData['anio'] = $anio;
                $arrData['No_mes'] = $i;
                $arrData['venta'] = 0 ;

            }else{ 
                $arrData['anio'] = $ventaMes['Anio'];
                $arrData['No_mes'] =$ventaMes['mes'];
                $arrData['venta'] = $ventaMes['venta'];
                
            }
            array_push($arrMVentas, $arrData);
            

           
        }
        $arrVentas= array('anio' => $anio,'meses'=>$arrMVentas);
        return $arrVentas;
        
       
    }

    public function productosTen(){ 
    $sql= "SELECT * FROM TBL_PRODUCTOS WHERE COD_STATUS = 1 ORDER BY COD_PRODUCTO DESC LIMIT 0,10";
    $request = $this->select_all($sql);
    return $request;    
    }   
    public function insertPregunta(int $pregunta,int $user,string $respuesta,string $password)
    {
        
        $query_insert="INSERT INTO `TBL_PREGUNTAS_X_USUARIO` (`COD_PREGUNTA`, `COD_USUARIO`, `RESPUESTA`) VALUES (?, ?, ?)";
        $arrData = array($pregunta,$user,$respuesta);
        $request_insert = $this->insert($query_insert,$arrData);
        $sql = "SELECT last_insert_id()";
        $request_ID = $this->select($sql);
        $return = $request_ID['last_insert_id()'];

        $sql="UPDATE `TBL_PERSONAS` SET `COD_STATUS` = ?, `CONTRASEÑA`=?  WHERE `TBL_PERSONAS`.`COD_PERSONA` = $user;
        ";
        $arrData = array(1,$password);
        $request = $this->update($sql,$arrData);
        
        return $return;
    }
    public function deletePregunta(int $usuario)
    {
       
         $sql = "DELETE FROM TBL_PREGUNTAS_X_USUARIO WHERE COD_USUARIO = $usuario"; 
     
        $request = $this->select_all($sql);
        return $request;
    }


    public function changePassword(int $user,string $password)
    {
       
        

        $sql="UPDATE `TBL_PERSONAS` SET `CHANGE_PASSWORD` = ?, `CONTRASEÑA`=?  WHERE `TBL_PERSONAS`.`COD_PERSONA` = $user;";
        $arrData = array(0,$password);
        $request = $this->update($sql,$arrData);
        
        return $request;
    }

    public function getPassword(int $user)
    {
       
        

        $sql="SELECT `CONTRASEÑA` FROM `TBL_PERSONAS` WHERE `TBL_PERSONAS`.`COD_PERSONA` = $user;";
        
        $request = $this->select($sql);
        
        return $request;
    }






 }

 ?>