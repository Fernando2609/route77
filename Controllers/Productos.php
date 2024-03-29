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

Programa:          Módulo Productos
Fecha:             01-Marzo-2022
Programador:       Kevin Alfredo Rodríguez Zúniga
descripción:       Maneja los productos de la tienda 

-----------------------------------------------------------------------*/



    class Productos extends Controllers{
        public function __construct()
        {
            parent::__construct();
            session_start();
            if (empty($_SESSION['login'])) {
                header('Location: '.base_url().'/login');
                die();
            }
            getPermisos(MPRODUCTOS);
        }
        
        public function Productos()
        {
            if(empty($_SESSION['permisosMod']['r'])){
                header('Location: '.base_url().'/dashboard');
            }
           
            $data['page_tag']="Productos";
            $data['page_title']="PRODUCTOS <small> Route 77</small> ";
            $data['page_name']="productos";
            $data['page_functions_js']="functions_productos.js";
			 //BIRACORA
			 //Bitacora($_SESSION['idUser'],MPRODUCTOS,"Ingreso","Ingresó al módulo");
            $this->views->getView($this,"productos",$data);
        }
        public function setProducto(){
            
            if($_POST) {
                
                if(empty($_POST['txtNombre']) ||  empty($_POST['listCategoria']) || empty($_POST['txtPrecio']) || empty($_POST['listStatus']) )
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else {
                    $idProducto = intval($_POST['idProducto']);
					$strNombre = strClean($_POST['txtNombre']);
					$strDescripcion = strClean($_POST['txtDescripcion']);
					$strCodigo = strClean($_POST['txtCodigo']);
					$intCategoriaId = intval($_POST['listCategoria']);
					$strPrecio = strClean($_POST['txtPrecio']);
					$intStock = intval($_POST['txtStock']);
					$intStatus = intval($_POST['listStatus']);
					$request_producto = "";

					$ruta = strtolower(clear_cadena($strNombre));
					$ruta = str_replace(" ","-",$ruta);
					$user=$_SESSION['idUser'];


                    if($idProducto == 0)
					{
						$option = 1;
						if($_SESSION['permisosMod']['w']){
							 
					
							$request_producto = $this->model->insertProducto($strNombre, 
																		$strDescripcion, 
																		$strCodigo, 
																		$intCategoriaId,
																		$strPrecio, 
																		$intStock, 
																		$ruta,
																		$intStatus,
																	    $user);
						}
					}else{
						$option = 2;
						if($_SESSION['permisosMod']['u']){
							// ! Seleccionar Datos antes de la actualización
							$arrDataOld= $this->model->selectProducto($idProducto);
							$request_producto  = $this->model->updateProducto($idProducto,
																		$strNombre,
																		$strDescripcion, 
																		$strCodigo, 
																		$intCategoriaId,
																		$strPrecio, 
																		$intStock, 
																		$ruta,
																		$intStatus,
																	    $user
																	);

							 //! datos despues de la actualización
							 $arrDataNew= $this->model->selectProducto($idProducto);

							 //dep($arrDataNew);
							 // ? array_keys = extrae las llaves del array
							 $arrayKey=array_keys($arrDataNew);
							 // ? array_chunk= dividir array en fragmentos(Valores)
							 $arrDataNew=array_chunk($arrDataNew,1);
							 $arrDataOld=array_chunk($arrDataOld,1);
							 //Inicializar array
							 $arrChange=[];
							 //vaciar Array
							 unset($arrChange);
							 
							 // TODO: for para recorrer los valores de los array
							 for ($i=0; $i < count($arrDataNew); $i++) { 
								 // TODO: if datos nuevos diferente a datos viejos 
								 if ($arrDataNew[$i][0]!=$arrDataOld[$i][0]) {
									 //TODO: valores en el arrayCambios dentro de las llaves nuevo y antiguo
									 $arrChange['nuevo'][$i]=$arrDataNew[$i][0];
									 $arrChange['antiguo'][$i]=$arrDataOld[$i][0];
								 
								 }else{
									 // TODO: sino array en esa posición vacio
									 $arrChange['nuevo'][$i]='No se realizó Cambio';
									 $arrChange['antiguo'][$i]='No se realizó Cambio';
								 }
							 }
	 
							 // ?array_combine = combina las llavas con los valores
							 $arrChangeNew=array_combine($arrayKey,$arrChange['nuevo']);
							 $arrChangeOld=array_combine($arrayKey,$arrChange['antiguo']);
	 
							 /* dep($arrChangeNew);
							 dep($arrChangeOld);
							 exit; */
							 
							
							
							 
							 $changeTable="<tr>
							 <td>Codigo:</td>
							 <td id='celCodigo'>{$arrChangeOld['COD_BARRA']}</td>
							 <td id='celCodigo'>{$arrChangeNew['COD_BARRA']}</td>
						   </tr>
						   <tr>
							 <td>Nombres:</td>
							 <td id='celNombre'>{$arrChangeOld['NOMBRE']}</td>
							 <td >{$arrChangeNew['NOMBRE']}</td>
						   </tr>
						   <tr>
							 <td>Precio:</td>
							 <td id='celPrecio'>{$arrChangeOld['PRECIO']}</td>
							 <td >{$arrChangeNew['PRECIO']}</td>
						   </tr>
						   <tr>
							 <td>Stock:</td>
							 <td id='celStock'>{$arrChangeOld['CANT_MINIMA']}</td>
							 <td>{$arrChangeNew['CANT_MINIMA']}</td>
						   </tr>
						   <tr>
							 <td>Categoría:</td>
							 <td id='celCategoria'>{$arrChangeOld['CATEGORÍA']}</td>
							 <td >{$arrChangeNew['CATEGORÍA']}</td>
						   </tr>
						   <tr>
							 <td>Status:</td>
							 <td id='celStatus'>{$arrChangeOld['STATUS']}</td>
							 <td>{$arrChangeNew['STATUS']}</td>
						   </tr>
						   <tr>
							 <td>Descripción:</td>
							 <td id='celDescripcion'>{$arrChangeOld['DESCRIPCION']}</td>
							 <td >{$arrChangeNew['DESCRIPCION']}</td>
						   </tr>";
						  
						   //$changeTable="{$arrChangeOld['DNI']}";
						   //dep($changeTable);
						   //exit;
	 
							 

							
						}
					}
					
                    if($request_producto > 0 )
					{
						if($option == 1){
							$arrResponse = array('status' => true, 'idproducto' => $request_producto, 'msg' => 'Datos guardados correctamente.');
							//Selecciona los datos del producto Insertado  
							$arrData= $this->model->selectProducto($request_producto);
							
							//BIRACORA
							Bitacora($_SESSION['idUser'],MPRODUCTOS,"Nuevo","Registró el producto ".$arrData['NOMBRE']." con el código ".$arrData['COD_PRODUCTO']."",'');
						}else{
							$arrResponse = array('status' => true, 'idproducto' => $idProducto, 'msg' => 'Datos Actualizados correctamente.');
							 //Selecciona los datos del producto Actualizado                                                       
                             $arrData= $this->model->selectProducto($idProducto);
                             //BIRACORA
                             Bitacora($_SESSION['idUser'],MPRODUCTOS,"Actualizar","Actualizó el Producto ".$arrData['NOMBRE']."con el código ".$arrData['COD_PRODUCTO'],$changeTable);
						}
					}else if($request_producto == false){
						$arrResponse = array('status' => false, 'msg' => '¡Atención! ya existe un producto con el <b> Código </b> o el <b>Nombre</b> Ingresado.');		
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
					}
                }
             }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
        }
        public function getProductos()
	    {
            if($_SESSION['permisosMod']['r']){
                $arrData = $this->model->selectProductos();
                
                for ($i=0; $i < count($arrData); $i++) {
                    $btnView = '';
                    $btnEdit = '';
                    $btnDelete = '';
                    
                    if($arrData[$i]['COD_STATUS'] == 1)
                    {
                        $arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
                    }else{
                        $arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
                    }

                    $arrData[$i]['PRECIO']=SMONEY.' '.formatMoney($arrData[$i]['PRECIO']);
                    if($_SESSION['permisosMod']['r']){
                        $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo('.$arrData[$i]['COD_PRODUCTO'].')" title="Ver Producto"><i class="far fa-eye"></i></button>';
                    }
                    if($_SESSION['permisosMod']['u']){
                        $btnEdit = '<button class="btn btn-warning  btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['COD_PRODUCTO'].')" title="Editar Producto"><i class="fas fa-pencil-alt"></i></button>';
                    }
                    if($_SESSION['permisosMod']['d']){	
                        $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['COD_PRODUCTO'].')" title="Eliminar Producto"><i class="far fa-trash-alt"></i></button>';
                    }
                    $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
                }
                echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
        public function getProducto($idproducto){
			if($_SESSION['permisosMod']['r']){
				$idproducto = intval($idproducto);
				if($idproducto > 0){
					$arrData = $this->model->selectProducto($idproducto);
					
					if(empty($arrData)){
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrImg = $this->model->selectImages($idproducto);
                     
						if(count($arrImg) > 0){
							for ($i=0; $i < count($arrImg); $i++) { 
								$arrImg[$i]['url_image'] = media().'/images/uploads/'.$arrImg[$i]['IMG'];
							}
						}
						//BIRACORA
						//Bitacora($_SESSION['idUser'],MPRODUCTOS,"Consulta","Consultó el producto ".$arrData['NOMBRE']);
						$arrData['images'] = $arrImg;
						$arrResponse = array('status' => true, 'data' => $arrData);
					}
				
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}
        public function setImage(){
			
			if($_POST){
				if(empty($_POST['idproducto'])){
					$arrResponse = array('status' => false, 'msg' => 'Error de datos.');
				}else{
					$idProducto = intval($_POST['idproducto']);
                   
					$foto      = $_FILES['foto'];
					$type      = $_FILES['foto']['type'];
					
					
                        if ($type=='image/webp') {
                            $imgNombre = 'pro_'.md5(date('d-m-Y H:i:s')).'.webp';
                        }else{

                            $imgNombre = 'pro_'.md5(date('d-m-Y H:i:s')).'.jpg';
                        }
					
					
					$request_image = $this->model->insertImage($idProducto,$imgNombre);
					if($request_image){
						$uploadImage = uploadImage($foto,$imgNombre);
						//Selecciona los datos del producto que se inserto la imagen  
						$arrData= $this->model->selectProducto($idProducto);
						
						//BIRACORA
						Bitacora($_SESSION['idUser'],MPRODUCTOS,"Nuevo","Agregó una imagen al producto ".$arrData['NOMBRE'],"con el código ".$arrData['COD_PRODUCTO'],''); 
						$arrResponse = array('status' => true, 'imgname' => $imgNombre, 'msg' => 'Archivo cargado.');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error de carga.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die(); 
		}
		public function delFile(){
		
			if($_POST){
				
				if(empty($_POST['idproducto']) || empty($_POST['file'])){
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{
					//Eliminar de la DB
					$idProducto = intval($_POST['idproducto']);
					$imgNombre  = strClean($_POST['file']);
					$request_image = $this->model->deleteImage($idProducto,$imgNombre);

					if($request_image){
						$deleteFile =  deleteFile($imgNombre);
						//Selecciona los datos del prodcuto que se elimino la imagem  
						$arrData= $this->model->selectProducto($idProducto);
						
						//BIRACORA
						Bitacora($_SESSION['idUser'],MPRODUCTOS,"Eliminar","Eliminó una imagen al producto ".$arrData['NOMBRE']."con el código ".$arrData['COD_PRODUCTO'],''); 
						$arrResponse = array('status' => true, 'msg' => 'Archivo eliminado');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
		public function delProducto(){
			if($_POST){
				if($_SESSION['permisosMod']['d']){
					$intIdproducto = intval($_POST['idProducto']);
					$requestDelete = $this->model->deleteProducto($intIdproducto);
					if($requestDelete)
					{
						//Selecciona los datos del producto eliminado  
						$arrData= $this->model->selectProducto($intIdproducto);
						
						//BIRACORA
						Bitacora($_SESSION['idUser'],MPRODUCTOS,"Eliminar","Eliminó el producto ".$arrData['NOMBRE']."con el código ".$arrData['COD_PRODUCTO'],''); 
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el producto');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el producto.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}
    }
?>