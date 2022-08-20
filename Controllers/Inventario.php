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

Programa:          Módulo de Inventario
Fecha:             25-Marzo-2022
Programador:       Kevin Alfredo Rodríguez Zúniga
descripción:       Módulo que gestiona la existencia de productos en el sistema

-----------------------------------------------------------------------*/



class Inventario extends Controllers{
    public function __construct()
    {
        parent::__construct();
        session_start();
        //session_regenerate_id(true);
        if (empty($_SESSION['login'])) {
            header('Location: '.base_url().'/login');
            die();
        }
        getPermisos(MINVENTARIO);
    }
    
    public function Inventario()
    {
        if(empty($_SESSION['permisosMod']['r'])){
            header('Location: '.base_url().'/dashboard');
        }
        $data['page_tag']="Inventario";
        $data['page_title']="INVENTARIO <small>Route 77</small>";
        $data['page_name']="inventario";
        $data['page_functions_js']="functions_inventario.js";
        //BIRACORA
        //Bitacora($_SESSION['idUser'],MINVENTARIO,"Ingreso","Ingresó al módulo");
        $this->views->getView($this,"inventario",$data);
    }

  
public function getInventarios(){

    if ($_SESSION['permisosMod']['r']) {
        $arrData = $this->model->selectInventarios();
        
        for ($i = 0; $i < count($arrData); $i++) {
            $btnView = '';
            $btnEdit = '';
            $btnDelete = '';

            

            if ($_SESSION['permisosMod']['r']) {
                $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['COD_PRODUCTO'] . ')" title="Ver empresa"><i class="far fa-eye"></i></button>';
            }
            if($_SESSION['permisosMod']['u']){
                $btnEdit = '<button class="btn btn-warning btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['COD_PRODUCTO'].')" title="Editar Producto"><i class="fas fa-pencil-alt"></i></button>';                 
            }


            if ($_SESSION['permisosMod']['r']) {
                
                    $btninfo = '<button class="btn btn-success btn-sm" onClick="fntViewMovimiento(' . $arrData[$i]['COD_PRODUCTO'] . ')" title="Ver Registro de entrada y salidas"><i class="fa-solid fa-file-lines"></i></button>';
                
            }


            $arrData[$i]['options'] = '<div class="text-center">' . $btnView   . ' ' . $btnEdit . ' '.$btninfo . '</div>';
            
    }
        /*  dep($arrData[0]['status']);exit; */
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
    }
    die();
}
public function getInventario($idUsuario){
    //echo $idUsuario;
    //die();
    if ($_SESSION['permisosMod']['r']) {
        $idusuario = intval($idUsuario);
        if ($idusuario > 0) {
            $arrData = $this->model->selectInventario($idusuario);
            if (empty($arrData)) {
                $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
            } else {
                //BIRACORA
                //Bitacora($_SESSION['idUser'],MINVENTARIO,"Consulta","Consultó el inventario del producto ".$arrData['NOMBRE']);
                $arrResponse = array('status' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
    }
    die();
}   

public function getMovimientos($idProducto){

    if ($_SESSION['permisosMod']['r']) {
        
        $arrData=[];
        $arrProductoPedido = $this->model->selectProductoPedido($idProducto);
        $arrProductoCompra = $this->model->selectProductoCompra($idProducto);
        $arrMovimietos = $this->model->selectMovimientos($idProducto);



        for ($i=0; $i < count($arrProductoPedido); $i++) {
            $arrProductoPedido[$i]['MOVIMIENTO']="Salida";


            $arrProductoPedido[$i]['PRECIONUEVO']=formatMoney($arrProductoPedido[$i]['PRECIO']);
            $arrPedido=$this->model->selectPedido($arrProductoPedido[$i]['COD_PEDIDO']);
            $arrPersona=$this->model->selectPersona($arrPedido['COD_PERSONA']);


            $arrProductoPedido[$i]['DESCRIPCION']="Salida en el pedido número #".$arrProductoPedido[$i]['COD_PEDIDO'];

            
            $arrProductoPedido[$i]=array_merge($arrProductoPedido[$i],$arrPedido);
            $arrProductoPedido[$i]=array_merge($arrProductoPedido[$i],$arrPersona);

        }

        for ($i=0; $i < count($arrProductoCompra); $i++) {
            $arrProductoCompra[$i]['MOVIMIENTO']="Entrada";
            $arrProductoCompra[$i]['CANTIDAD']=$arrProductoCompra[$i]['CANT_COMPRA'];
            unset($arrProductoCompra[$i]['CANT_COMPRA']);

            $arrProductoCompra[$i]['PRECIONUEVO']=formatMoney($arrProductoCompra[$i]['PRECIO']);
            //unset($arrProductoCompra[$i]['PRECIO']);

            
            $arrProductoCompra[$i]['DESCRIPCION']="Entrada en la Compra número #".$arrProductoCompra[$i]['COD_ORDEN'];
            $arrCompra=$this->model->selectCompra($arrProductoCompra[$i]['COD_ORDEN']);


            $arrPersona=$this->model->selectPersona($arrCompra['CREADO_POR']);



            $arrProductoCompra[$i]=array_merge($arrProductoCompra[$i],$arrCompra);
            $arrProductoCompra[$i]=array_merge($arrProductoCompra[$i],$arrPersona);

            
            $arrProductoCompra[$i]['FECHA']=$arrProductoCompra[$i]['FECHA_COMPRA'];
            unset($arrProductoCompra[$i]['FECHA_COMPRA']);
            
        }

        
        for ($i=0; $i < count($arrMovimietos); $i++) {
            
            $arrMovimietos[$i]['DESCRIPCION']="Salida por ".$arrMovimietos[$i]['DESCRIPCION_MOVIMIENTO'];
            unset($arrMovimietos[$i]['DESCRIPCION_MOVIMIENTO']);

            $arrMovimietos[$i]['PRECIONUEVO']="-";
            $arrPersona=$this->model->selectPersona($arrMovimietos[$i]['COD_USUARIO']);


            $arrMovimietos[$i]=array_merge($arrMovimietos[$i],$arrPersona);



            //$arrMovimietos[$i]['Descripcion']="Salida en el pedido número #".$arrMovimietos[$i]['COD_PEDIDO'];

            
            //$arrProductoPedido[$i]=array_merge($arrProductoPedido[$i],$arrPedido);
        }
        //dep($arrProductoCompra);
        //dep($arrProductoCompra);
        /* 
        */
        /* dep($arrMovimietos);
        
        dep($arrProductoPedido); 
        dep($arrProductoCompra); */
        
        


        $arrData=array_merge($arrProductoCompra,$arrProductoPedido);
        $arrData=array_merge($arrData,$arrMovimietos);
        
        function ordenar( $a, $b ) {
            return strtotime($a['FECHA']) - strtotime($b['FECHA']);
        }
        usort($arrData, 'ordenar');
        //dep($arrData);

        for ($i=0; $i < count($arrData); $i++) { 
            $arrData[$i]['Contador']=$i+1;
            $arrData[$i]['NOMBRE_COMPLETO']=$arrData[$i]['NOMBRES'].' '. $arrData[$i]['APELLIDOS'];

        }
     
    }
        //dep($arrData);
        /*  dep($arrData[0]['status']);exit; */
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
    
    die();
}






public function setInventario()
{   
    
    if ($_POST) {
        if(empty($_POST['idInventario']) || empty($_POST['stockupdate']))
        {
            $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
        }else{ 
            $idInventario = intval($_POST['idInventario']);
            $stockupdate = intval($_POST['stockupdate']);
            $txtDescripcion=strClean($_POST['txtDescripcion']);
            $listMovimeinto=intval($_POST['listMovimiento']);          
            $request_user="";
            $arrData = $this->model->selectInventario($idInventario);
            if(empty($arrData)){
                $arrResponse = array("status" => false, "msg" => 'Producto No Existente');
            }else{
                $stock=$arrData["STOCK"];
                $idProducto=$arrData["COD_PRODUCTO"];
                if($stockupdate>=$stock and $listMovimeinto==2){
                    $arrResponse = array("status" => false, "msg" => 'Stock a eliminar es mayor que el actual.');
                }else{

                    if ($listMovimeinto==1) {
                        //agregar
                        $movimiento="Entrada";
                        $newstock=$stock+$stockupdate;
                    }else if ($listMovimeinto==2) {
                        //eliminar
                        $movimiento="Salida";
                        $newstock=$stock-$stockupdate;
                    }
                    $user=$_SESSION['idUser'];
                    $request_user=$this->model->updateInventario($idInventario, $newstock);

                    $request_user=$this->model->InsertMovimiento($idProducto, $stockupdate,$movimiento,$txtDescripcion,$user);
                
            if($request_user > 0 ){
                    $arrResponse = array("status" => true, "msg" => 'Inventario  Actualizado Correctamente.');
                    //Selecciona los datos del usuario Actualizado                                                       
                     //$arrData= $this->model->selectSucursal();
                    //BIRACORA
                    //Bitacora($_SESSION['idUser'],MSUCURSALES,"Update","Actualizó la Sucursal ".$arrData['NOMBRE']."");
                
            }else if($request_user == 'exist'){
                $arrResponse = array('status' => false, 'msg' => '¡Atención! la sucursal ya existe, ingrese otro nombre.');		
                    }else{
                $arrResponse = array("status" => false, "msg" => 'No es posible actualizar el inventario.');
            }
        }
    }
         }
         echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
    }
    
    die();
}




}
   



    ?>