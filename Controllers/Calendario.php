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

Programa:          Módulo Calendario
Fecha:             03-Marzo-2022
Programador:       Hugo Alejandro Paz Izaguirre
descripción:       Muestra los eventos del usuario en un solo calendario
-----------------------------------------------------------------------*/

    class Calendario extends Controllers{
        
        public function __construct()
        {
            
            parent::__construct();
            session_start();
            if (empty($_SESSION['login'])) {
                header('Location: '.base_url().'/login');
                die();
            }
            getPermisos(MCALENDARIO);
        }
        
        public function Calendario()
        {
            if(empty($_SESSION['permisosMod']['r'])){
                header('Location: '.base_url().'/dashboard');
            }
            $data['page_tag']="Calendario";
            $data['page_title']="Calendario <small>Route 77</small>";
            $data['page_name']="calendario";
            $data['page_functions_js']="functions_calendario.js";
            //BIRACORA
            //Bitacora($_SESSION['idUser'],MCALENDARIO,"Ingreso","Ingresó al módulo");
            $this->views->getView($this,"calendario",$data);
        }
        public function setCalendario()
        {
            if($_SESSION['permisosMod']['w']){
            $idUsuario = $_SESSION['idUser'];
            $strtitle = strClean($_POST['title']);
            $strDescripcion = strClean($_POST['descripcion']);
            $strStart = strClean($_POST['inicio']);
            $strEnd = strClean($_POST['end']);
            $strColor = strClean($_POST['color']);
            $strTextColor = strClean($_POST['colorText']);
            $request_user = $this->model->insertEvento($idUsuario,$strtitle,$strDescripcion,$strStart,$strEnd,$strColor,$strTextColor);
            
            if($request_user > 0 ){
              
            $arrResponse = array("status" => true, "msg" => 'Evento Guardado Correctamente.');
            
             /* //BIRACORA
             Bitacora($_SESSION['idUser'],MUSUARIOS,"Nuevo","Registró el evento ".$strtitle.""); */
                }
            else{
            $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
        
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }
            die();
     }
     public function mostrarCalendario()
        {
            
            if($_SESSION['permisosMod']['r']){
            $idUsuario = $_SESSION['idUser'];
            $arrData=$this->model->selectCalendario($idUsuario);
            
            //dep($arrData[0]['status']);
            //exit; 
            echo json_encode($arrData);
         }
             die();
     }
     public function updateCalendario()
     {
        if($_SESSION['permisosMod']['u']){
         $idEvento = intval($_POST['id']);
         $strtitle = strClean($_POST['title']);
         $strDescripcion = strClean($_POST['descripcion']);
         $strStart = strClean($_POST['inicio']);
         $strEnd = strClean($_POST['end']);
         $strColor = strClean($_POST['color']);
         $strTextColor = strClean($_POST['colorText']);
        
         $request_user = $this->model->updateEvento($idEvento,$strtitle,$strDescripcion,$strStart,$strEnd,$strColor,$strTextColor);
         
         if($request_user > 0 ){
           
             $arrResponse = array("status" => true, "msg" => 'Evento Actualizado Correctamente.');
              /* //BIRACORA
              Bitacora($_SESSION['idUser'],MUSUARIOS,"Nuevo","Actualizó el evento ".$strtitle."");*/
             } 
         else{
         $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
     
         }
         
         echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
         }
         die();
  }
  public function delCalendario()
     {
        if($_SESSION['permisosMod']['d']){
         $idEvento = intval($_POST['id']);
         
         $request_user = $this->model->delEvento($idEvento);
         
         if($request_user > 0 ){
           
             $arrResponse = array("status" => true, "msg" => 'Evento Borrado Correctamente.');
             }
         else{
         $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
     
         }
         
         echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
         }
         die();
  }
    
    }

?>

