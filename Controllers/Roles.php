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

Programa:          Módulo Roles
Fecha:             01-Marzo-2022
Programador:       Reynaldo Jafet Giron Tercero
descripción:       Administra los diferentes roles y administra los permisos de la empresa

-----------------------------------------------------------------------*/



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
            getPermisos(MUSUARIOS);
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
            //BIRACORA
            //Bitacora($_SESSION['idUser'],MUSUARIOS,"Ingreso","Ingresó al módulo roles en");
            $this->views->getView($this,"roles",$data);
        }
        public function getRoles()  {
            if($_SESSION['permisosMod']['r']){
                $btnView ='';
                $btnEdit = '';
                $btnDelete = '';

            $arrData = $this->model->selectRoles();
            

                for ($i=0; $i < count($arrData) ; $i++) { 
                if ($arrData[$i]['COD_STATUS']==1) {
        
                    $arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';   
                }else{
                    $arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
                }

                if($_SESSION['permisosMod']['u']){
                    $btnView = '<button class="btn btn-secondary btn-sm btnPermisosRol" onClick="fntPermisos('.$arrData[$i]['COD_ROL'].')" title="Permisos"><i class="fas fa-key"></i></button>';
                    $btnEdit = '<button class="btn btn-info btn-sm btnEditRol" onClick="fntEditRol('.$arrData[$i]['COD_ROL'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
                }

                if($_SESSION['permisosMod']['d']){
                    $btnDelete = '<button class="btn btn-danger btn-sm btnDelRol" onClick="fntDelRol('.$arrData[$i]['COD_ROL'].')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
                }

                $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
                $arrData[$i]['NOM_ROL'] = strtoupper($arrData[$i]['NOM_ROL']);
                $arrData[$i]['DESCRIPCION'] = strtoupper($arrData[$i]['DESCRIPCION']);

            } 
            /*  dep($arrData[0]['status']);exit; */
                echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
           }
            die();
        }
        //Funcion para traer los roles de usuario
        public function getSelectRoles()
		{
			$htmlOptions = "";
			$arrData = $this->model->selectRoles();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					if($arrData[$i]['COD_STATUS'] == 1 ){
					$htmlOptions .= '<option value="'.$arrData[$i]['COD_ROL'].'">'.$arrData[$i]['NOM_ROL'].'</option>';
					}
				}
			}
			echo $htmlOptions;
			die();		
		}

        public function getRol(int $idrol)
        {
            if($_SESSION['permisosMod']['r']){
                $intIdrol = intval(strClean($idrol));
                if($intIdrol > 0)
                {
                    $arrData = $this->model->selectRol($intIdrol);
                    if(empty($arrData))
                    {
                        $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                    }else{
                        $arrResponse = array('status' => true, 'data' => $arrData);
                        //BIRACORA
                       //Bitacora($_SESSION['idUser'],MUSUARIOS,"Consulta","Consultó al Rol ".$arrData['NOM_ROL']."");
                    }
                    echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

                }
            }
			die();
        }

        public function setRol(){
            if($_SESSION['permisosMod']['w']){
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
                             //Selecciona los datos del rol Insertado  
                             $arrData= $this->model->selectRol($request_rol);
                             //BIRACORA
                             Bitacora($_SESSION['idUser'],MUSUARIOS,"Nuevo","Registró al rol ".$arrData['NOM_ROL']."con el código ".$arrData['COD_ROL'],'');    
                        }else{
                            $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
                            //Selecciona los datos del rol Actualizado                                                       
                            $arrData= $this->model->selectRol($intIdRol);
                            //BIRACORA
                            //Bitacora($_SESSION['idUser'],MUSUARIOS,"Update","Actualizó al rol ".$arrData['NOM_ROL']."");  
                        }
                    $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');

                }else if($request_rol == false){
                    $arrResponse = array('status' => false, 'msg' => '¡Atención! El Rol ya existe.');

                }else{
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            } 
			die();
        }
        public function delRol()
		{
			if($_POST){
                if($_SESSION['permisosMod']['d']){
					$intIdrol = intval($_POST['idrol']);
                     //Selecciona los datos del rol eliminar                                                       
                     $arrData= $this->model->selectRol($intIdrol);
					$requestDelete = $this->model->deleteRol($intIdrol);
					if($requestDelete == true)
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Rol');
                      //BIRACORA
                      Bitacora($_SESSION['idUser'],MUSUARIOS,"Eliminar","Eliminó el rol ".$arrData['NOM_ROL']."con el código ".$arrData['COD_ROL'],'');   
					}else if($requestDelete == false){
						$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar un Rol asociado a usuarios.');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Rol.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }
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
                
                    $htmlOptions .= '<option value="'.$arrData[$i]['COD_GENERO'].'">'.$arrData[$i]['DESCRIPCION'].'</option>';
                    
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
                
                    $htmlOptions .= '<option value="'.$arrData[$i]['COD_SUCURSAL'].'">'.$arrData[$i]['NOMBRE'].'</option>';
                    
                }
            }
            echo $htmlOptions;
            die();		
        }
    }
    

    
   

?>