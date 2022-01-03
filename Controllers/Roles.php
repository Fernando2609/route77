<?php  
    class Roles extends Controllers{
        public function __construct()
        {
            parent::__construct();
            session_start();

            //session_regenerate_id(true);

            if (empty($_SESSION['login'])) {
                header('Location: '.base_url().'/login');
                die();
            }
            getPermisos(2);
        }
        
        public function Roles()
        {   
            if(empty($_SESSION['permisosMod']['r'])){
                header('Location: '.base_url().'/dashboard');
            }
            $data['page_id']=3;
            $data['page_tag']="Roles Usuario";
            $data['page_title']="Roles <small> Route 77</small> ";
            $data['page_functions_js']="functions_roles.js";
            $data['page_name']="rol_usuario";
            $this->views->getView($this,"roles",$data);
        }
        public function getRoles()  {
            $btnView ='';
            $btnEdit = '';
            $btnDelete = '';

           $arrData = $this->model->selectRoles();

            for ($i=0; $i < count($arrData) ; $i++) { 
               if ($arrData[$i]['status']==1) {
                $arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';   
               }else{
                $arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
               }

               if($_SESSION['permisosMod']['u']){
                $btnView = '<button class="btn btn-secondary btn-sm btnPermisosRol" onClick="fntPermisos('.$arrData[$i]['Id_Rol'].')" title="Permisos"><i class="fas fa-key"></i></button>';
                $btnEdit = '<button class="btn btn-info btn-sm btnEditRol" onClick="fntEditRol('.$arrData[$i]['Id_Rol'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
               }

               if($_SESSION['permisosMod']['d']){
                $btnDelete = '<button class="btn btn-danger btn-sm btnDelRol" onClick="fntDelRol('.$arrData[$i]['Id_Rol'].')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
               }
            
              $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
            } 
           /*  dep($arrData[0]['status']);exit; */
           echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }
        //Funcion para traer los roles de usuario
        public function getSelectRoles()
		{
			$htmlOptions = "";
			$arrData = $this->model->selectRoles();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					if($arrData[$i]['status'] == 1 ){
					$htmlOptions .= '<option value="'.$arrData[$i]['Id_Rol'].'">'.$arrData[$i]['nombreRol'].'</option>';
					}
				}
			}
			echo $htmlOptions;
			die();		
		}

        public function getRol(int $idrol)
        {
				$intIdrol = intval(strClean($idrol));
				if($intIdrol > 0)
				{
					$arrData = $this->model->selectRol($intIdrol);
					if(empty($arrData))
					{
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrResponse = array('status' => true, 'data' => $arrData);
					}
					echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
                    
				}
			
			die();
        }

        public function setRol(){
            $intIdRol =  intval($_POST['idRol']);
			$strRol =  strClean($_POST['txtNombre']);
			$strDescripcion = strClean($_POST['txtDescripcion']);
			$intStatus = intval($_POST['listStatus']);

            if ($intIdRol==0) {
                //Si no hay idRol se crea uno nuevo registro
                $request_rol = $this->model->insertRol($strRol, $strDescripcion, $intStatus);
                $option=1;
            } else{
                 //Si hay idRol se actualiza elregistro
                $request_rol = $this->model->updateRol($intIdRol,$strRol, $strDescripcion, $intStatus);
                $option=2;
            }
			if($request_rol > 0 )
			{
                if($option == 1)
					{
						$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
					}else{
						$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
					}
                $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
					
			}else if($request_rol == false){
                $arrResponse = array('status' => false, 'msg' => '¡Atención! El Rol ya existe.');
				
			}else{
				$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
        }
        public function delRol()
		{
			if($_POST){
					$intIdrol = intval($_POST['idrol']);
					$requestDelete = $this->model->deleteRol($intIdrol);
					if($requestDelete == true)
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Rol');
					}else if($requestDelete == false){
						$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar un Rol asociado a usuarios.');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Rol.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}





        /* 
        ESTO DE ACABA ABAJO DEBERA DE CAMBIARSE DE LUGAR EN UN FUTURO
        
        */

        //Funcion para traer la nacionalidades de usuario
        public function getSelectNacionalidad()
		{
			$htmlOptions = "";
			$arrData = $this->model->selectNacionalidad();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
				
					$htmlOptions .= '<option value="'.$arrData[$i]['idNacionalidad'].'">'.$arrData[$i]['descripcion'].'</option>';
					
				}
			}
			echo $htmlOptions;
			die();		
		}
        //Funcion para traer el Genero de usuario
        public function getSelectGenero()
        {
            $htmlOptions = "";
            $arrData = $this->model->selectGenero();
            if(count($arrData) > 0 ){
                for ($i=0; $i < count($arrData); $i++) { 
                
                    $htmlOptions .= '<option value="'.$arrData[$i]['idGenero'].'">'.$arrData[$i]['descripcion'].'</option>';
                    
                }
            }
            echo $htmlOptions;
            die();		
        }
        //Funcion para traer el Estado Civil
        public function getSelectEstadoC()
        {
            $htmlOptions = "";
            $arrData = $this->model->selectEstadoC();
            if(count($arrData) > 0 ){
                for ($i=0; $i < count($arrData); $i++) { 
                
                    $htmlOptions .= '<option value="'.$arrData[$i]['idEstado'].'">'.$arrData[$i]['descripcion'].'</option>';
                    
                }
            }
            echo $htmlOptions;
            die();		
        }
        //Funcion para traer La Sucursal
        public function getSelectSucursal()
        {
            $htmlOptions = "";
            $arrData = $this->model->selectSucursal();
            if(count($arrData) > 0 ){
                for ($i=0; $i < count($arrData); $i++) { 
                
                    $htmlOptions .= '<option value="'.$arrData[$i]['idsucursal'].'">'.$arrData[$i]['nombre'].'</option>';
                    
                }
            }
            echo $htmlOptions;
            die();		
        }
    }
    

    
   

?>