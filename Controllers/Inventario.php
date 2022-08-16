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


           /*  if ($_SESSION['permisosMod']['d']) {
                
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['COD_EMPRESA'] . ')" title="Eliminar empresa"><i class="far fa-trash-alt"></i></button>';
                
            } */


            $arrData[$i]['options'] = '<div class="text-center">' . $btnView   . ' ' . $btnEdit . '</div>';
            
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

public function setInventario()
{   
    if ($_POST) {
        if(empty($_POST['idInventario']) || empty($_POST['stockupdate']))
        {
            $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
        }else{ 
            $idInventario = intval($_POST['idInventario']);
            $stockupdate = intval($_POST['stockupdate']);
                            
            $request_user="";
            $arrData = $this->model->selectInventario($idInventario);
            if(empty($arrData)){
                $arrResponse = array("status" => false, "msg" => 'Producto No Existente');
            }else{
                $stock=$arrData["STOCK"];
                if($stockupdate>=$stock){
                    $arrResponse = array("status" => false, "msg" => 'Stock a eliminar es mayor que el actual.');
                }else{
                    $newstock=$stock-$stockupdate;
                    $request_user=$this->model->updateInventario($idInventario, $newstock);
                
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