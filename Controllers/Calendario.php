<?php 


    class Calendario extends Controllers{
        
        public function __construct()
        {
            
            parent::__construct();
            session_start();
            if (empty($_SESSION['login'])) {
                header('Location: '.base_url().'/login');
                die();
            }
        }
        
        public function Calendario()
        {
           
            $data['page_tag']="Calendario";
            $data['page_title']="Calendario <small>Route 77</small>";
            $data['page_name']="calendario";
            $data['page_functions_js']="functions_calendario.js";
            $this->views->getView($this,"calendario",$data);
        }
        public function setCalendario()
        {
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
                }
            else{
            $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
        
            }
            
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
     }
     public function mostrarCalendario()
        {
            $idUsuario = $_SESSION['idUser'];
            $arrData=$this->model->selectCalendario($idUsuario);
            //dep($arrData);
            
            //dep($arrData[0]['status']);
            //exit; 
            echo json_encode($arrData);
             die();
     }
     public function updateCalendario()
     {
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
             }
         else{
         $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
     
         }
         
         echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
         die();
  }
  public function delCalendario()
     {
         $idEvento = intval($_POST['id']);
         
         $request_user = $this->model->delEvento($idEvento);
         
         if($request_user > 0 ){
           
             $arrResponse = array("status" => true, "msg" => 'Evento Borrado Correctamente.');
             }
         else{
         $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
     
         }
         
         echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
         die();
  }
    
    }

?>

