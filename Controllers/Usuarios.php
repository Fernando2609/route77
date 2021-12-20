<?php  
    class Usuarios extends Controllers{
        public function __construct()
        {
            parent::__construct();
            
        }
        
        public function Usuarios()
        {
           
            $data['page_tag']="Usuarios";
            $data['page_title']="USUARIOS <small>Route 77</small>";
            $data['page_name']="usuarios";
            $this->views->getView($this,"usuarios",$data);
        }
        public function setUsuario()
        {
            if ($_POST) {
              ;
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
                    if($request_user > 0 ){
                        $arrResponse = array("status" => true, "msg" => 'Usuario Guardado Correctamente.');
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

    }

?>

