<?php  
    require_once("Models/Tcategoria.php");
    require_once("Models/Tproducto.php");
    require_once("Models/TCliente.php");
    require_once("Models/LoginModel.php");
    class Tienda extends Controllers{
        use Tcategoria, Tproducto, TCliente;
        public $login;
        public function __construct()
        {
            parent::__construct();
            session_start();
            $this->login=new LoginModel();
        }
        
        public function tienda()
        {
            $data['page_tag']=NOMBRE_EMPESA;
            $data['page_title']=NOMBRE_EMPESA;
            $data['page_name']="tienda";
            $data['productos'] = $this->getProductosT();
            $data['categorias'] = $this->getCategorias();
            $this->views->getView($this,"tienda",$data);
        }

        public function categoria($params){
            if(empty($params)){
                header("Location:".base_url());
            }else{
                $arrParams=explode(",",$params);
                $idCategoria=intval($arrParams[0]);
                $ruta=strClean($arrParams[1]);
                $infoCategoria=$this->getProductosCategoriaT($idCategoria,$ruta);
                $categoria = strClean($params);
                $data['page_tag'] = NOMBRE_EMPESA." - ".$infoCategoria['categoria'];
                $data['page_title'] = $infoCategoria['categoria'];
                $data['page_name'] = "categoria";
                $data['categorias'] = $this->getCategorias();
                $data['productos'] = $infoCategoria['productos'];
                $this->views->getView($this,"categoria",$data);
            }
        }
        
         public function producto($params){
        if (empty($params)) {
            header("Location:" . base_url());
        } else {
            $arrParams = explode(",",$params);
            $idproducto = intval($arrParams[0]);
            $ruta = strClean($arrParams[1]);
            $infoProducto = $this->getProductoT($idproducto,$ruta);
           if (empty($infoProducto)) {
               header("Location:".base_url());
           }
            $producto = strClean($params);
            //$arrProducto = $this->getProductoT($producto);
            $data['page_tag'] = NOMBRE_EMPESA . " - " . $infoProducto['nombre'];
            $data['page_title'] = $infoProducto['nombre'];
            $data['page_name'] = "producto";
            $data['categorias'] = $this->getCategorias();
            $data['producto'] = $infoProducto;
            $data['productos'] = $this->getProductosRandom($infoProducto['categoriaid'],8,"r");
            $this->views->getView($this, "producto", $data);
         }
        }
        public function addCarrito()
        {
            if ($_POST) {
               /*  */
                //dep($_POST);
                //unset($_SESSION['arrCarrito']);exit;
                $arrCarrito=array();
                $cantCarrito=0;
                $stockCarrito=0;
                $idproducto=openssl_decrypt($_POST['id'],METHODENCRIPT,KEY);
                $cantidad=$_POST['cant'];
                if (is_numeric($idproducto) and is_numeric($cantidad)) {
                    $arrInfoProducto=$this->getProductoIDT($idproducto);
                    $stockCarrito=$arrInfoProducto['stock'];
                   
                    if (!empty($arrInfoProducto)) {
                        $arrProducto = array('idproducto' => $idproducto,
											'producto' => $arrInfoProducto['nombre'],
											'cantidad' => $cantidad,
											'precio' => $arrInfoProducto['precio'],
                                            'stock' => $arrInfoProducto['stock'],
                                            'ruta'=>$arrInfoProducto['ruta'],
											'imagen' => $arrInfoProducto['images'][0]['url_image']
										);
                        
                             
                        if (isset($_SESSION['arrCarrito'])) {
                            $on = true;
							$arrCarrito = $_SESSION['arrCarrito'];
                            
							for ($pr=0; $pr < count($arrCarrito); $pr++) {
								if($arrCarrito[$pr]['idproducto'] == $idproducto){
                                    if ($stockCarrito>=$arrCarrito[$pr]['cantidad'] and $cantidad+$arrCarrito[$pr]['cantidad']<=$stockCarrito) {
                                        
                                        
                                        $arrCarrito[$pr]['cantidad'] += $cantidad;
                                        $on = false;
                                      
                                     }else{
                                        $arrResponse = array("status" => false, "msg" => 'Stock Sobrepasado');
                                        echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                                        die();
                                    }
                                    
                                    
								}     
							}
							if($on){
                                if ($stockCarrito>= $cantidad) {
                                   
                                    array_push($arrCarrito,$arrProducto);
                                 
                                 }else{
                                    $arrResponse = array("status" => false, "msg" => 'Stock Sobrepasado');
                                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                                    die();
                                }
								
							}
                            $_SESSION['arrCarrito']=$arrCarrito;
                        }else{
                            
                            if ($stockCarrito>=$cantidad ) {
                                
                                array_push($arrCarrito,$arrProducto);
                                $_SESSION['arrCarrito']=$arrCarrito;
                              
                             }else{
                                $arrResponse = array("status" => false, "msg" => 'Stock Sobrepasado');
                                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                                die();
                            }
                          
                        }
                        foreach ($_SESSION['arrCarrito'] as $pro){
                            if ($stockCarrito>=$cantidad || $stockCarrito>=$pro['cantidad'] ) {
                                
                                $cantCarrito+=$pro['cantidad'];
                            }else{
                                $arrResponse = array("status" => false, "msg" => 'Stock Sobrepasado');
                                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                                die();
                            }
                        }
                    
                        $htmlCarrito ="";
						$htmlCarrito = getFile('Template/Modals/modalCarrito',$_SESSION['arrCarrito']);
						$arrResponse = array("status" => true, 
											"msg" => '¡Se agrego al carrito!',
											"cantCarrito" => $cantCarrito,
											"htmlCarrito" => $htmlCarrito
										);
                        
                           
                        
                    }else{
                        $arrResponse = array("status" => false, "msg" => 'Producto No existente');
                    }
               
                }else{
                    $arrResponse = array("status" => false, "msg" => 'Dato incorrecto.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
               
            }
            die();
        }

        public function delCarrito()
        {
            if ($_POST) {
                $arrCarrito=array();
                $cantCarrito=0;
                $subtotal=0;
                $envio=0;
                $idproducto=openssl_decrypt($_POST['id'],METHODENCRIPT,KEY);
                $option=$_POST['option'];
                if (is_numeric($idproducto) and ($option==1 or $option==2)) {
                    $arrCarrito=$_SESSION['arrCarrito'];
                    for ($pr=0; $pr < count($arrCarrito); $pr++) {
						if($arrCarrito[$pr]['idproducto'] == $idproducto){
							unset($arrCarrito[$pr]);
						}
					}
                    sort($arrCarrito);
                    $_SESSION['arrCarrito']=$arrCarrito;
                    foreach($_SESSION['arrCarrito'] as $pro)
                    {
                         $cantCarrito+=$pro['cantidad'];
                         $subtotal+=$pro['cantidad']*$pro['precio'];
                         if ($subtotal>=500) {
                            $envio=0;
                        }else if ($subtotal<500) {
                         $envio=COSTOENVIO;   
                        } 
                    }
                    $htmlCarrito ="";
                    if ($option==1) {
                        $htmlCarrito = getFile('Template/Modals/modalCarrito',$_SESSION['arrCarrito']);
                        
                    }
                    $arrResponse = array("status" => true, 
											"msg" => '¡Producto Eliminado!',
											"cantCarrito" => $cantCarrito,
											"htmlCarrito" => $htmlCarrito,
                                            "subTotal" => SMONEY.formatMoney($subtotal),
                                             "envio" => SMONEY.formatMoney($envio),
                                             "total" => SMONEY.formatMoney($subtotal + $envio)
										);
                    
                }else{
                    $arrResponse=array("status"=>false,"msg"=>'Datos Incorrectoss');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function updCarrito(){
			if($_POST){
                //dep($_POST);
				$arrCarrito = array();
				$totalProducto = 0;
				$subtotal = 0;
				$total = 0;
                $envio=0;
				$idproducto = openssl_decrypt($_POST['id'], METHODENCRIPT, KEY);
				$cantidad = intval($_POST['cantidad']);
                $stockCarrito=0;
                
				if(is_numeric($idproducto) and $cantidad > 0){
                    
                       
					$arrCarrito = $_SESSION['arrCarrito'];
					for ($p=0; $p < count($arrCarrito); $p++) { 
						if($arrCarrito[$p]['idproducto'] == $idproducto){
							$arrCarrito[$p]['cantidad'] = $cantidad;
                            $stockCarrito=$arrCarrito[$p]['stock'];
							$totalProducto = $arrCarrito[$p]['precio'] * $cantidad;
							break;
						}
					}
                    if ($stockCarrito>=$cantidad) {
					$_SESSION['arrCarrito'] = $arrCarrito;
                  
					foreach ($_SESSION['arrCarrito'] as $pro) {
						$subtotal += $pro['cantidad'] * $pro['precio'];
                        
                        if ($subtotal>=500) {
                            $envio=0;
                        }else if ($subtotal<500) {
                         $envio=COSTOENVIO;   
                        } 
					}
                    
					$arrResponse = array("status" => true, 
                    "msg" => '¡Producto actualizado!',
                    "totalProducto" => SMONEY.formatMoney($totalProducto),
                    "subTotal" => SMONEY.formatMoney($subtotal),
                    "envio" => SMONEY.formatMoney($envio),
                    "cantidad"=>$cantidad,
                    "stock"=>$stockCarrito,
                    "total" => SMONEY.formatMoney($subtotal + $envio)
                );
                
            }else{
                $arrResponse = array("status" => false, "msg" => 'Stock Sobrepasado');
            }
				}else{
					$arrResponse = array("status" => false, "msg" => 'Dato incorrecto.');
				}
                
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE); 
			}
			die();
		}


         public function registro()
        {
            
            if ($_POST) {
                if(empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['txtTelefono']) || empty($_POST['txtEmailCliente']) || empty($_POST['listNacionalidadCliente']))
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{ 
                    
					$strNombre = ucwords(strClean($_POST['txtNombre']));
					$strApellido = ucwords(strClean($_POST['txtApellido']));
					$intTelefono = intval(strClean($_POST['txtTelefono']));
					$strEmail = strtolower(strClean($_POST['txtEmailCliente']));
					$intTipoId = 7;
				
                    $intNacionalidad = intval(strClean($_POST['listNacionalidadCliente']));
                    $intGenero = intval(strClean($_POST['listGenero']));
                    $intEstadoC = intval(strClean($_POST['listEstadoC']));
                    $intSucursal = 4;
                     $strFechaNacimiento = strClean($_POST['fechaNacimiento']); 
                    $request_user="";
                    $strPassword =  passGenerator();
                    $strPasswordEncrip = hash("SHA256",$strPassword);
                  
                    $request_user = $this->insertCliente(
                                            $strNombre, 
                                            $strApellido, 
                                            $intTelefono, 
                                            $strEmail,
                                    
                                            $strPasswordEncrip, 
                                            $intTipoId, 
                                            /*  $intStatus, */
                                            $intNacionalidad,
                                            $intGenero,
                                            $intEstadoC,
                                            $intSucursal,
                                             $strFechaNacimiento  );
                                                                               
                    

                    
                    if($request_user > 0 ){
                        $arrResponse = array("status" => true, "msg" => 'Cliente Guardado Correctamente.');
                        $nombreUsuario = $strNombre.' '.$strApellido;
                    $dataUsuario = array(
                        'nombreUsuario' => $nombreUsuario,
                        'email' => $strEmail,
                        'password' => $strPassword,
                        'asunto' => 'Bienvenido a tu Tienda en Línea');
                        $_SESSION['idUser'] = $request_user;
							$_SESSION['login'] = true;
                        $this->login->sessionLogin($request_user);
                    sendEmail($dataUsuario, 'email_bienvenida');
                    }else if($request_user == false){
						$arrResponse = array('status' => false, 'msg' => '¡Atención! el email o la identificación ya existe, ingrese otro.');		
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
					}
                 }
                 echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            
            die();
        }
        public function getSelectNacionalidadCliente()
		{
			$htmlOptions = "";
			$arrData = $this->selectNacionalidadCliente();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
				
					$htmlOptions .= '<option value="'.$arrData[$i]['idNacionalidad'].'">'.$arrData[$i]['descripcion'].'</option>';
					
				}
			}
			echo $htmlOptions;
			die();		
		}
        //Funcion para traer el Genero de usuario
        public function getSelectGeneroCliente()
        {
            $htmlOptions = "";
            $arrData = $this->selectGeneroCliente();
            if(count($arrData) > 0 ){
                for ($i=0; $i < count($arrData); $i++) { 
                
                    $htmlOptions .= '<option value="'.$arrData[$i]['idGenero'].'">'.$arrData[$i]['descripcion'].'</option>';
                    
                }
            }
            echo $htmlOptions;
            die();		
        }
        //Funcion para traer el Estado Civil
        public function getSelectEstadoCCliente()
        {
            $htmlOptions = "";
            $arrData = $this->selectEstadoCCliente();
            if(count($arrData) > 0 ){
                for ($i=0; $i < count($arrData); $i++) { 
                
                    $htmlOptions .= '<option value="'.$arrData[$i]['idEstado'].'">'.$arrData[$i]['descripcion'].'</option>';
                    
                }
            }
            echo $htmlOptions;
            die();		
        }
        public function procesarVenta(){
            dep($_POST);
            die();
        }

    }

?>