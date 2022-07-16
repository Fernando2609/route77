<?php  
    class Login extends Controllers{
        public function __construct()
        {
          
            session_start();
  
            if (isset($_SESSION['login'])) {
                header('Location: '.base_url().'/dashboard');
                die();
            }
            parent::__construct();
            
            
        }
        
        public function login()
        {
  
            $data['page_tag']="Login - Route 77";
            $data['page_title']="LOGIN ESTACIÓN ROUTE 77";
            $data['page_name']="login";
            $data['page_functions_js']="functions_login.js";
            $this->views->getView($this,"login",$data);
        }
        public function LoginUser(){
           
           if($_POST){
               if(empty($_POST['txtEmail']) || empty($_POST['txtPassword'])){
                   $arrResponse = array('status' => false, 'msg' => 'Error de datos');
                }else{
                   $intentos=0;
                   $strUsuario = strtolower(strClean($_POST['txtEmail']));
                   $strPassword = hash("SHA256", $_POST['txtPassword']);
                   
                   $requestUser = $this->model->loginUser($strUsuario, $strPassword);
                   if(empty($requestUser)){
                  
                    $arrResponse = array('status' => false, 'msg' => 'Datos incorrectos.' ); 
                }else{
                    $arrData = $requestUser;
                    
						if($arrData['COD_STATUS'] == 1 OR $arrData['COD_STATUS'] == 3){
							$_SESSION['idUser'] = $arrData['COD_PERSONA'];
							$_SESSION['login'] = true;
                            $this->model->sessionUpdate($_SESSION['idUser']);
							$arrData = $this->model->sessionLogin($_SESSION['idUser']);
                            sessionUser($_SESSION['idUser']);

                            $arrData = $this->model->selectProductos();
               
                            $arrNotificaciones=array();
                            for ($i=0; $i < count($arrData); $i++) { 
                            $arrinfoProducto=array(
                            'nombre'=>$arrData[$i]['NOMBRE'],
                            'categoria'=>$arrData[$i]['CATEGORÍA'],
                            'stock'=>$arrData[$i]['STOCK'],
                            'cant_minima'=>$arrData[$i]['CANT_MINIMA']
                            );
                                array_push($arrNotificaciones,$arrinfoProducto);
                            }
                         $_SESSION['notificaciones']=$arrNotificaciones;

                         $htmlNotifi = getFile('Template/Modals/notificaciones',$_SESSION['notificaciones']);
                              //BIRACORA
                            Bitacora($_SESSION['idUser'],1,"Login","Inició Sesión",'');
							$arrResponse = array('status' => true, 'msg' => 'ok'); 
						}else{
							$arrResponse = array('status' => false, 'msg' => 'Usuario inactivo.');
						}
                  }
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
        public function resetPass()
        {
            
            if ($_POST) {
                //si el email es vacio. error
                if(empty($_POST['txtEmailReset'])){
					$arrResponse = array('status' => false, 'msg' => 'Error de datos' );
				}else {
                    //Creacion de token (token() es una función)
                    $token=token();
                    //convertir email a minuscula
                    $strEmail  =  strtolower(strClean($_POST['txtEmailReset']));
                    //enviar email al model para verificar si el usuario exite
					$arrData = $this->model->getUserEmail($strEmail);
                   // si esta vacio la respuesta no existe el usuario
					if(empty($arrData)){
						$arrResponse = array('status' => false, 'msg' => 'Usuario no existente.' ); 
                    //sino
					}else{
                        //selecciona el codigo de la persona, el nombre, y apellido
                        $idUsuario = $arrData['COD_PERSONA'];
						$nombreUsuario = $arrData['NOMBRES'].' '.$arrData['APELLIDOS'];
                        //crear la url con concatenando el email y el token
                        $url_recovery = base_url().'/login/confirmUser/'.$strEmail.'/'.$token;
                        //Guardar el token en la base de datos con el mismo id
						$requestUpdate = $this->model->setTokenUser($idUsuario,$token);
                        
                        //$datosEmpresa=$this->model->datosEmpresa()['Empresa'];
                        //Creacion de array que se enviara a la funcion del email
                        $dataUsuario = array('nombreUsuario' => $nombreUsuario,
                        'email' => $strEmail,
                        'asunto' => 'Recuperar cuenta - '.NOMBRE_REMITENTE,
                        'url_recovery' => $url_recovery);
                        //si el token se guardo correctamente enviar la funcion send email
                        if($requestUpdate){
                            $sendEmail = sendEmail($dataUsuario,'email_cambioPassword2');
                            // si el email se envio correctamente
                            if($sendEmail){
                                $arrResponse = array('status' => true, 
                                                 'msg' => 'Se ha enviado un email a tu cuenta de correo para cambiar tu contraseña.');
                            }else{
                                $arrResponse = array('status' => false, 
                                'msg' => 'No es posible realizar el proceso, intenta más tarde. 1' );
                            }
                        }else{
                            $arrResponse = array('status' => false, 
                                             'msg' => 'No es posible realizar el proceso, intenta más tarde.' );
                        }
                    }
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
        public function confirmUser(string $params){
           
			if(empty($params)){
				header('Location: '.base_url());
			}else{
				$arrParams = explode(',',$params);
                //dep($arrParams);
				$strEmail = strClean($arrParams[0]);
				$strToken = strClean($arrParams[1]);
                $arrResponse = $this->model->getUsuario($strEmail,$strToken);
			}	if(empty($arrResponse)){
                header("Location: ".base_url());
            }else{ 
					$data['page_tag'] = "Cambiar contraseña";
					$data['page_name'] = "cambiar_contrasenia";
					$data['page_title'] = "Cambiar Contraseña";
					$data['idUsuario'] = $arrResponse['COD_PERSONA'];
                    $data['page_functions_js'] = "functions_login.js";  
					$data['email'] = $strEmail;
					$data['token'] = $strToken;
					$this->views->getView($this,"cambiarPassword",$data);
		     }
			die();
		}
        public function setPassword(){
            
			 if(empty($_POST['idUsuario']) || empty($_POST['txtEmail']) || empty($_POST['txtToken']) || empty($_POST['txtPassword']) || empty($_POST['txtPasswordConfirm'])){

					$arrResponse = array('status' => false, 
										 'msg' => 'Error de datos' );
				}else{
					$intIdUsuario= intval($_POST['idUsuario']);
					$strPassword = $_POST['txtPassword'];
					$strPasswordConfirm = $_POST['txtPasswordConfirm'];
					$strEmail = strClean($_POST['txtEmail']);
					$strToken = strClean($_POST['txtToken']);

					if($strPassword != $strPasswordConfirm){
						$arrResponse = array('status' => false, 
											 'msg' => 'Las contraseñas no son iguales.' );
					}else{
						$arrResponseUser = $this->model->getUsuario($strEmail,$strToken);
						if(empty($arrResponseUser)){
							$arrResponse = array('status' => false, 
											 'msg' => 'Error de datos.' );
						}else{
                            //Encriptación de contraseña
							$strPassword = hash("SHA256",$strPassword);
                            //Se ejecuta el query
							$requestPass = $this->model->insertPassword($intIdUsuario ,$strPassword);

							if($requestPass){
								$arrResponse = array('status' => true, 
													 'msg' => 'Contraseña actualizada con éxito.');
							}else{
								$arrResponse = array('status' => false, 
													 'msg' => 'No es posible realizar el proceso, intente más tarde.');
							}
						}
					}
				}
            
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}

        public function verificar()
        {
            
            if ($_POST) {
                if(empty($_POST['txtPregunta1']) || empty($_POST['txtRespuesta1']) || empty($_POST['email'])){
                    $arrResponse = array('status' => false, 'msg' => 'Error de datos');
                 }else{
                    $token=token();
                   $intPregunta = intval($_POST['txtPregunta1']);
                   $respuesta = ($_POST['txtRespuesta1']);
                   $strEmail  =  strtolower(strClean($_POST['email']));
                 
                   $arrData = $this->model->getUserEmail($strEmail);
                  
					if(empty($arrData)){
						$arrResponse = array('status' => false, 'msg' => 'Usuario no existente.' ); 
                    }else{
                        $requestUser = $this->model->confirmRequest($strEmail,$intPregunta, $respuesta);
                       
                        if($requestUser!=""){
                            $idUsuario=$requestUser['COD_PERSONA'];
                            $url_recovery = base_url().'/login/confirmUser/'.$strEmail.'/'.$token;
                            $requestUpdate = $this->model->setTokenUser($idUsuario,$token);
                           
                            if($requestUpdate){
                              
                                
                               
                        
                                $arrResponse = array('status' => true, 
                                                    'msg' => 'Respuesta Correcta','url'=>$url_recovery);
                              
                              
                            }else{
                                $arrResponse = array('status' => false, 
                                                 'msg' => 'No es posible realizar el proceso, intenta más tarde.');
                            }
                        }else{
                            $arrResponse = array('status' => false, 
                                                 'msg' => 'Incorrecto, Verifique los Datos');
                            
                        }
                       
                    }

                 }
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }
    }

?>
