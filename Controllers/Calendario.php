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
            getPermisos(7);
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
            $this->views->getView($this,"calendario",$data);
        }
        public function setCalendario()
        {
            //$idUsuario = intval($_POST['idUsuario']);
            $strtitle = strClean($_POST['title']);
            $strDescripcion = strClean($_POST['descripcion']);
            $strStart = strClean($_POST['inicio']);
            $strEnd = strClean($_POST['end']);
            $strColor = strClean($_POST['color']);
            $strTextColor = strClean($_POST['colorText']);
            $request_user = $this->model->insertEvento($strtitle,$strDescripcion,$strStart,$strEnd,$strColor,$strTextColor);
            
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
            
            $arrData=$this->model->selectCalendario();
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
         /*public function getUsuarios()
        {
            $arrData= $this->model->selectUsuarios();
            //dep($arrData);
            for ($i=0; $i < count($arrData) ; $i++) { 
                if ($arrData[$i]['status']==1) {
                 $arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';   
                }else{
                 $arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
                }
 
                $arrData[$i]['options'] = '<div class="text-center">
                <button class="btn btn-info btn-sm btnViewUsuario" onClick="fntViewUsuario('.$arrData[$i]['idUsuario'].')" title="Ver usuario"><i class="far fa-eye"></i></button>
                <button class="btn btn-warning btn-sm btnEditUsuario" onClick="fntEditUsuario('.$arrData[$i]['idUsuario'].')" title="Editar usuario"><i class="fas fa-pencil-alt"></i></button>
                <button class="btn btn-danger btn-sm btnDelUsuario" onClick="fntDelUsuario('.$arrData[$i]['idUsuario'].')" title="Eliminar usuario"><i class="far fa-trash-alt"></i></button>';
             }; 
            //dep($arrData[0]['status']);
            //exit; 
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
             die();
        }
        public function getUsuario(int $idUsuario){
            //echo $idUsuario;
            //die();
			 
				$idusuario = intval($idUsuario);
				if($idusuario > 0)
				{
					$arrData = $this->model->selectUsuario($idusuario);
                    
					if(empty($arrData))
					{
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrResponse = array('status' => true, 'data' => $arrData);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				} 
			die();
		}
        
        public function delUsuario()
        {
            if($_POST){
                $intIdpersona = intval($_POST['idUsuario']);
               
                $requestDelete = $this-> model->deleteUsuario($intIdpersona);
                if ($requestDelete) 
                {
                    $arrResponse = array ('status' => true, 'msg' => 'Se ha eliminado el usuario');
                }else{
                     $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el usuario.');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }
            die();  
        } */
    
    }

?>

