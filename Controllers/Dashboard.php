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



    class Dashboard extends Controllers{
        public function __construct()
        {
            parent::__construct();
            session_start();
             //session_regenerate_id(true);
            if (empty($_SESSION['login'])) {
                header('Location: '.base_url().'/login');
                die();
            }
            getPermisos(MDASHBOARD);
            
        }
        
        public function dashboard()
        {
            $data['page_id']=2;
            $data['page_tag']="Dashboard Route 77";
            $data['page_title']="DASHBOARD ESTACIÓN ROUTE 77";
            $data['page_name']="dashboard";
            $data['page_functions_js']="functions_dashboard.js";
            $data['usuarios'] = $this->model->cantUsuarios();
            $data['clientes'] = $this->model->cantClientes();
            $data['productos'] = $this->model->cantProductos();
            $data['pedidos'] = $this->model->cantPedidos();
            $data['pedidos'] = $this->model->cantPedidos();
            $data['lastOrders'] = $this->model->lastOrders();
            $data['productosTen'] = $this->model->productosTen();
            $anio = date('Y');
            $mes = date('m');
            $data['pagosMes'] = $this->model->selectPagosMes($anio, $mes);
            $data['ventasMDia'] = $this->model->selectVentasMes($anio, $mes);
        // dep($data['ventasMDia']);
        // exit;
            $data['ventasAnio'] = $this->model->selectVentasAnio($anio);
         
            //BIRACORA
            //Bitacora($_SESSION['idUser'],1,"Ingreso","Ingresó al módulo");
            
            if ($_SESSION['userData']['COD_ROL'] == RCLIENTES ) {
                $this->views->getView($this,"dashboardCliente",$data);

            }else{
                $this->views->getView($this,"dashboard",$data);
            }
               
           }
        public function getProductos()
        {
            
            if($_SESSION['permisosMod']['r'] and $_SESSION['userData']['COD_ROL']!=RCLIENTES){
            
                $arrData = $this->model->selectProductos();
               
                $arrNotificaciones=array();
                for ($i=0; $i < count($arrData); $i++) { 
                    $arrinfoProducto=array(
                        'nombre'=>$arrData[$i]['NOMBRE'],
                        'categoria'=>$arrData[$i]['CATEGORÍA'],
                        'stock'=>$arrData[$i]['STOCK'],
                        'cant_minima'=>$arrData[$i]['CANT_MINIMA']);
                        
                        array_push($arrNotificaciones,$arrinfoProducto);
                    }
                    $_SESSION['notificaciones']=$arrNotificaciones;

                 $htmlNotifi = getFile('Template/Modals/notificaciones',$_SESSION['notificaciones']);
                 $arrResponse = array("status" => true, "msg" => 'Producto Eliminado',"htmlNotifi"=>$htmlNotifi,);
                 
             }else{
                 $arrResponse=array("status"=>false,"msg"=>'Datos Incorrectoss');
             }
             echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            die();
        }
        public function tipoPagoMes(){
            if($_POST){
               
                $grafica = "tipoPagoMes";
                $nFecha = str_replace(" ","",$_POST['fecha']);
                $arrFecha = explode('-',$nFecha);
                $mes = $arrFecha[0];
                $anio = $arrFecha[1];
                $pagos = $this->model->selectPagosMes($anio,$mes);
                //BIRACORA
                Bitacora($_SESSION['idUser'],MDASHBOARD,"Consulta","Consultó las ventas por tipo de pago del mes ".$mes." y el año ".$anio."",'');
                $script = getFile("Template/Modals/graficas",$pagos);
                echo $script;
               /*  dep($pagos);
                die(); */

                

            }
        }
        public function ventasMes(){
            if($_POST){
                $grafica = "ventasMes";
              
                $nFecha = str_replace(" ","",$_POST['fecha']);
                
                $arrFecha = explode('-',$nFecha);
                
                $mes = $arrFecha[0];
                $anio = $arrFecha[1];
                $pagos = $this->model->selectVentasMes($anio, $mes);
               //BIRACORA
               Bitacora($_SESSION['idUser'],MDASHBOARD,"Consulta","Consultó las ventas del mes ".$mes." y el año ".$anio."",'');

                $script = getFile("Template/Modals/graficas",$pagos);
                echo $script;
    }
 }
 public function ventasAnio(){
    if($_POST){
        $grafica = "ventasAnio";
        $anio = intval($_POST['anio']);
         $pagos = $this->model->selectVentasAnio($anio);
         //BIRACORA
         Bitacora($_SESSION['idUser'],MDASHBOARD,"Consulta","Consultó las ventas del año ".$anio."",'');
         $script = getFile("Template/Modals/graficas",$pagos);
        echo $script;
 }

}

public function preguntasSeguridad(){
   
        if ($_POST) {
            if(empty($_POST['txtPregunta1']) || empty($_POST['txtRespuesta1'])  || empty($_POST['txtPassword'])  || empty($_POST['txtPasswordConfirm']))
            {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            }else{
                
                $user=intval($_SESSION['idUser']);
                $contraseñaUsuario=$this->model->getPassword($user);
                $passwordConfirm= strClean($_POST['txtPasswordConfirm']);
                $pregunta1= intval($_POST['txtPregunta1']);
                $respuesta1=strClean($_POST['txtRespuesta1']);

                $strPassword = hash("SHA256",$_POST['txtPassword']);

                if ($contraseñaUsuario['CONTRASEÑA']!=$strPassword) {
                    $this->model->deletePregunta($user);
                    $request_user = $this->model->insertPregunta($pregunta1,$user,$respuesta1,$strPassword);
                    
                    if($request_user > 0 ){
                        $arrResponse = array("status" => true, "msg" => 'Datos Guardados Correctamente.');
                        $_SESSION['userData']['COD_STATUS']=1;
                    }else{
                        $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos Comuniquesé con el administrador');
                    }
                }else{
                    $arrResponse = array("status" => false, "msg" => 'Ingrese una contraseña diferente a la proporcionada');
                }
                
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }
        die();
    }   

    public function changePassword(){
   
        if ($_POST) {
            if(empty($_POST['txtPassword'])  || empty($_POST['txtPasswordConfirm']))
            {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            }else{

                $user=intval($_SESSION['idUser']);
                $contraseñaUsuario=$this->model->getPassword($user);
                
                
                $passwordConfirm= strClean($_POST['txtPasswordConfirm']);

                $strPassword = hash("SHA256",strClean($_POST['txtPassword']));
                
                if ($contraseñaUsuario['CONTRASEÑA']!=$strPassword) {
                    
                    $request_user = $this->model->changePassword($user,$strPassword);
                
                
                if($request_user > 0 ){
                    $arrResponse = array("status" => true, "msg" => 'Datos Guardados Correctamente.');
                    sessionUser($_SESSION['idUser']);
                }else{
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos Comuniquesé con el administrador');
                }
                }else{
                    $arrResponse = array("status" => false, "msg" => 'Ingrese una contraseña diferente a la proporcionada');
                }
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }
        die();
    } 
  } 
?>