<?php  
    class Usuarios extends Controllers{
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
        
        public function Usuarios()
        {
            if(empty($_SESSION['permisosMod']['r'])){
                header('Location: '.base_url().'/dashboard');
            }
            $data['page_tag']="Usuarios";
            $data['page_title']="USUARIOS <small>Route 77</small>";
            $data['page_name']="usuarios";
            $data['page_functions_js']="functions_usuarios.js";
            $this->views->getView($this,"usuarios",$data);
        }

        public function setUsuario()
        {
            if ($_POST) {
                
                if(empty($_POST['txtIdentificacion']) || empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['txtTelefono']) || empty($_POST['txtEmail']) || empty($_POST['listRolid']) || empty($_POST['listStatus']) || empty($_POST['listNacionalidad']) || empty($_POST['listGenero']) )
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{ 
                    $idUsuario = intval($_POST['idUsuario']);
					$strIdentificacion = strClean($_POST['txtIdentificacion']);
					$strNombre = ucwords(strClean($_POST['txtNombre']));
					$strApellido = ucwords(strClean($_POST['txtApellido']));
					$intTelefono = intval(strClean($_POST['txtTelefono']));
					$strEmail = strtolower(strClean($_POST['txtEmail']));
					$intTipoId = intval(strClean($_POST['listRolid']));
					$intStatus = intval(strClean($_POST['listStatus']));
                    $intNacionalidad = intval(strClean($_POST['listNacionalidad']));
                    $intGenero = intval(strClean($_POST['listGenero']));
                    $intEstadoC = intval(strClean($_POST['listEstadoC']));
                    $intSucursal = intval(strClean($_POST['listSucursal']));
                    $strFechaNacimiento = strClean($_POST['fechaNacimiento']);
                    if ($idUsuario==0) {
                        $option=1;
                        $strPassword =  empty($_POST['txtPassword']) ? hash("SHA256",passGenerator()) : hash("SHA256",$_POST['txtPassword']);
                        $request_user = $this->model->insertUsuario($strIdentificacion,
                                                                                    $strNombre, 
                                                                                    $strApellido, 
                                                                                    $intTelefono, 
                                                                                    $strEmail,
                                                                                    $strPassword, 
                                                                                    $intTipoId, 
                                                                                    $intStatus,
                                                                                    $intNacionalidad,
                                                                                    $intGenero,
                                                                                    $intEstadoC,
                                                                                    $intSucursal,
                                                                                    $strFechaNacimiento );
                        
                    }else{
                        $option=2;
                        $strPassword =  empty($_POST['txtPassword']) ? "" : hash("SHA256",$_POST['txtPassword']);
                        $request_user = $this->model->updateUsuario($idUsuario,$strIdentificacion,
                                                                                    $strNombre, 
                                                                                    $strApellido, 
                                                                                    $intTelefono, 
                                                                                    $strEmail,
                                                                                    $strPassword, 
                                                                                    $intTipoId, 
                                                                                    $intStatus,
                                                                                    $intNacionalidad,
                                                                                    $intGenero,
                                                                                    $intEstadoC,
                                                                                    $intSucursal,
                                                                                    $strFechaNacimiento );
                    }
                    if($request_user > 0 ){
                        if ($option==1) {
                            $arrResponse = array("status" => true, "msg" => 'Usuario Guardado Correctamente.');
                        }else{
                            $arrResponse = array("status" => true, "msg" => 'Usuario Actualizado Correctamente.');
                        }
                    }else if($request_user == 'exist'){
						$arrResponse = array('status' => false, 'msg' => '¡Atención! el email o la identificación ya existe, ingrese otro.');		
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
					}
                 }
                 echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            
            die();
        }
        public function getUsuarios()
        {
            $arrData= $this->model->selectUsuarios();
            //dep($arrData);
            for ($i=0; $i < count($arrData) ; $i++) { 
                $btnView ='';
                $btnEdit = '';
                $btnDelete = '';

                if ($arrData[$i]['status']==1) {
                 $arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';   
                }else{
                 $arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
                }

                if($_SESSION['permisosMod']['r']){
                    $btnView = '<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntViewUsuario('.$arrData[$i]['idUsuario'].')" title="Ver usuario"><i class="far fa-eye"></i></button>';
                }

                if($_SESSION['permisosMod']['u']){
                    if(($_SESSION['idUser'] == 1 and $_SESSION['userData']['Id_Rol'] == 1) ||
                       ($_SESSION['userData']['Id_Rol'] == 1 and $arrData[$i]['Id_Rol'] != 1)){
                        $btnEdit = '<button class="btn btn-warning btn-sm btnEditUsuario" onClick="fntEditUsuario('.$arrData[$i]['idUsuario'].')" title="Editar usuario"><i class="fas fa-pencil-alt"></i></button>';
                       }else{
                        $btnEdit = '<button class="btn btn-warning btn-sm" disabled><i class="fas fa-pencil-alt"></i></button>';  
                       }
                   
                }

                if($_SESSION['permisosMod']['d']){
                    if(($_SESSION['idUser'] == 1 and $_SESSION['userData']['Id_Rol'] == 1) ||
                    ($_SESSION['userData']['Id_Rol'] == 1 and $arrData[$i]['Id_Rol'] != 1) and
                              ($_SESSION['userData']['idUsuario'] != $arrData[$i]['idUsuario'])
                              ){
                        $btnDelete = '<button class="btn btn-danger btn-sm btnDelUsuario" onClick="fntDelUsuario('.$arrData[$i]['idUsuario'].')" title="Eliminar usuario"><i class="far fa-trash-alt"></i></button>';
                    }else{
                        $btnDelete = '<button class="btn btn-danger btn-sm" disabled><i class="far fa-trash-alt"></i></button>';
                    }
                   
                }
                
 
                $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
                
             } 
            /*  dep($arrData[0]['status']);exit; */
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
        }

        public function perfil(){
            $data['page_tag']="Perfil";
            $data['page_title']="PERFIL DE USUARIO <small>Route 77</small>";
            $data['page_name']="perfil";
            $data['page_functions_js']="functions_usuarios.js";
            $this->views->getView($this,"perfil",$data);
        }
        public function putPerfil()
        {
            if ($_POST) {
                if(empty($_POST['txtIdentificacion']) || empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['txtTelefono']) )
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{
                    $idUsuario = $_SESSION['idUser'];
					$strIdentificacion = strClean($_POST['txtIdentificacion']);
					$strNombre = ucwords(strClean($_POST['txtNombre']));
					$strApellido = ucwords(strClean($_POST['txtApellido']));
					$intTelefono = intval(strClean($_POST['txtTelefono']));
                    $intNacionalidad = intval(strClean($_POST['listNacionalidad']));
                    $intGenero = intval(strClean($_POST['listGenero']));
                    $intEstadoC = intval(strClean($_POST['listEstadoC']));
                    $intSucursal = intval(strClean($_POST['listSucursal']));
                    $strFechaNacimiento = strClean($_POST['fechaNacimiento']);
                    $strPassword = "";
                    if(!empty($_POST['txtPassword'])){
						$strPassword = hash("SHA256",$_POST['txtPassword']);
					}
                    $request_user = $this->model->updatePerfil($idUsuario,
																$strIdentificacion, 
																$strNombre,
																$strApellido, 
																$intTelefono,
                                                                $intNacionalidad,
                                                                $intGenero,
                                                                $intEstadoC,
                                                                $intSucursal,
                                                                $strFechaNacimiento, 
																$strPassword);
                    if($request_user)
					{
						sessionUser($_SESSION['idUser']);
						$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible actualizar los datos.');
					}
				
                }
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }

           
            die();
        }
    
    }

?>

