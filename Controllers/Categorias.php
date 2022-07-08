<?php  
    class Categorias extends Controllers{
        public function __construct()
        {
            parent::__construct();
            session_start();
            //session_regenerate_id(true);
            //session_regenerate_id(true);
            if (empty($_SESSION['login'])) {
                header('Location: '.base_url().'/login');
                die();
            }
            getPermisos(MCATEGORIAS);
        }
        
        public function Categorias()
        {
            if(empty($_SESSION['permisosMod']['r'])){
                header('Location: '.base_url().'/dashboard');
            }
            $data['page_tag']="Categorías";
            $data['page_title']="CATEGORÍAS <small>Route 77</small>";
            $data['page_name']="categorias";
            $data['page_functions_js']="functions_categorias.js";
            //BIRACORA
            //Bitacora($_SESSION['idUser'],MCATEGORIAS,"Ingreso","Ingresó al módulo");
            $this->views->getView($this,"categorias",$data);
        }
        public function setCategorias(){
           
            if($_POST) {
                
                if(empty($_POST['txtNombre']) || empty($_POST['txtDescripcion']) || empty($_POST['listStatus']) )
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else {
                    $intIdcategoria =  intval($_POST['idCategoria']);
                    $strCategoria =  strClean($_POST['txtNombre']);
                    $strDescripcion = strClean($_POST['txtDescripcion']);
                    $intStatus = intval($_POST['listStatus']);
                    $ruta = strtolower(clear_cadena($strCategoria));
					$ruta = str_replace(" ","-",$ruta);
                    $user=$_SESSION['idUser'];
                    //Imagen

					$foto   	 	= $_FILES['foto'];
					$nombre_foto 	= $foto['name'];
					$type 		 	= $foto['type'];
					$url_temp    	= $foto['tmp_name'];
					$imgPortada 	= 'portada_categoria.png';
                    $request_Categoria = "";

					
                    if($nombre_foto != ''){
                        if ($type=='image/webp') {
                            $imgPortada = 'img_'.md5(date('d-m-Y H:i:s')).'.webp';
                        }else{

                            $imgPortada = 'img_'.md5(date('d-m-Y H:i:s')).'.jpg';
                        }
					}
                    

                if ($intIdcategoria==0) {
                    //Si no hay idCategoria se crea uno nuevo registro
                    if($_SESSION['permisosMod']['w']){
                    
                   
                    $request_Categoria = $this->model->insertCategoria($strCategoria, $strDescripcion,$imgPortada,$ruta, $intStatus,$user);
                    $option=1;
                   
                     }
                }else{
                    //Si hay idCategoria se actualiza el registro
                    if($_SESSION['permisosMod']['u']){
                    $cambio=0;
                 
                  
                    if($nombre_foto == ''){
                        if($_POST['foto_actual'] != 'portada_categoria.png' &&  $_POST['foto_remove'] == 0){
                            $imgPortada = $_POST['foto_actual'];
                            
                        }
                         }
                    // ! Datos de la categoria antes de actualizar                               
                        $arrDataOld= $this->model->selectCategoria($intIdcategoria);
                        $request_Categoria = $this->model->updateCategoria($intIdcategoria,$strCategoria, $strDescripcion,$imgPortada,$ruta,$intStatus,$user);
                        $option=2;

                        // ! Datos despues de actualizar
                        $arrDataNew= $this->model->selectCategoria($intIdcategoria);

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
                        exit;*/
                       /*  if ($cambio==1) {
                          
                            $foto="<tr class='text-center bg-orange'>
                            <td colspan=3>Se modificó la fotografia</td></tr>";
                        }; */
                        $changeTable="
                      <tr>
                        <td>Nombre:</td>
                        <td id='celNombre'>{$arrChangeOld['NOMBRE']}</td>
                        <td >{$arrChangeNew['NOMBRE']}</td>
                      </tr>
                      <tr>
                        <td>Descripción:</td>
                        <td id='celDescripcion'>{$arrChangeOld['DESCRIPCION']}</td>
                        <td>{$arrChangeNew['DESCRIPCION']}</td>
                      </tr>
                      <tr>
                        <td>Estado:</td>
                        <td id='celEstado'>{$arrChangeOld['STATUS']}</td>
                        <td id='celEstado'>{$arrChangeNew['STATUS']}</td>
                      </tr>";

                     }
                }
                
                if($request_Categoria > 0 )
                {
                if($option == 1)
                {
                    $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                    if($nombre_foto != ''){ uploadImage($foto,$imgPortada); }
                    //Selecciona los datos del usuario Insertado  
                    $arrData= $this->model->selectCategoria($request_Categoria);
                    //BIRACORA
                    Bitacora($_SESSION['idUser'],MCATEGORIAS,"Nuevo","Registró la Categoría con el código: ".$arrData['COD_CATEGORIA']."",'');  
                }else   {
                    $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
                     //Selecciona los datos del usuario Actualizado                                                       
                     $arrData= $this->model->selectCategoria($intIdcategoria);
                     //BIRACORA
                     Bitacora($_SESSION['idUser'],MCATEGORIAS,"Actualizar","Actualizó la Categoría con el código: ".$arrData['COD_CATEGORIA']."",$changeTable);
                    if($nombre_foto != ''){ uploadImage($foto,$imgPortada);  }
                    
                       
                        if(($nombre_foto == '' && $_POST['foto_remove'] == 1 && $_POST['foto_actual'] != 'portada_categoria.png')
                              || ($nombre_foto != '' && $_POST['foto_actual'] != 'portada_categoria.png')){ 
                                  deleteFile($_POST['foto_actual']);

                           }

                     
                    }
                    
            
                $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
    
                }else if($request_Categoria == false){
                    $arrResponse = array('status' => false, 'msg' => '¡Atención! La Categoría ya existe.');
    
                }else{
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                  }
                    
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
             }
			die();
        }
        public function getCategorias()
	{
     /* dep($_SESSION['permisosMod']);
     exit; */
		if($_SESSION['permisosMod']['r']){
			$arrData = $this->model->selectCategorias();
         
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
				if($_SESSION['permisosMod']['r']){
					$btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo('.$arrData[$i]['COD_CATEGORIA'].')" title="Ver Categoría"><i class="far fa-eye"></i></button>';
				}
				if($_SESSION['permisosMod']['u']){
					$btnEdit = '<button class="btn btn-warning  btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['COD_CATEGORIA'].')" title="Editar Categoría"><i class="fas fa-pencil-alt"></i></button>';
				}
				if($_SESSION['permisosMod']['d']){	
					$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['COD_CATEGORIA'].')" title="Eliminar Categoría"><i class="far fa-trash-alt"></i></button>';
				}
				$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
                $arrData[$i]['NOMBRE'] = strtoupper($arrData[$i]['NOMBRE']);
                $arrData[$i]['DESCRIPCION'] = strtoupper($arrData[$i]['DESCRIPCION']);
            }
            
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		}
		die();
	}
    public function getCategoria($idcategoria)
		{
			if($_SESSION['permisosMod']['r']){
				$intIdcategoria = intval($idcategoria);
				if($intIdcategoria > 0)
				{
					$arrData = $this->model->selectCategoria($intIdcategoria);
                  
					if(empty($arrData))
					{
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrData['url_portada'] = media().'/images/uploads/'.$arrData['PORTADA'];
						$arrResponse = array('status' => true, 'data' => $arrData);
                         //BIRACORA
                       //Bitacora($_SESSION['idUser'],MCATEGORIAS,"Consulta","Consultó la Categoría ".$arrData['NOMBRE']."");
					}
                 
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}

    

    public function delcategoria()
    {
        if($_POST){
            
            if($_SESSION['permisosMod']['d']){
                $intIdcategoria = intval($_POST['idcategoria']);
                $requestDelete = $this->model->deleteCategoria($intIdcategoria);
                
                if($requestDelete == true)
                {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la categoría');
                     //Selecciona los datos del usuario Eliminado  
                     $arrData= $this->model->selectCategoria($intIdcategoria);
                     //BIRACORA
                     Bitacora($_SESSION['idUser'],MCATEGORIAS,"Eliminar","Eliminó la Categoría con el código: ".$arrData['COD_CATEGORIA']."",''); 
                }else if($requestDelete == false){
                    $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar una categoría asociada a los usuarios');
                }else{
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar la cateogoría.');
                }
              
               
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
         }
        die();
    }

    public function getSelectCategorias()
    {
        $htmlOptions="";
        $arrData=$this->model->selectCategorias();
        if (count($arrData)>0) {
            for ($i=0; $i < count($arrData); $i++) { 
                if($arrData[$i]['COD_STATUS'] == 1 ){
					$htmlOptions .= '<option value="'.$arrData[$i]['COD_CATEGORIA'].'">'.$arrData[$i]['NOMBRE'].'</option>';
                }
            }
        }
        echo $htmlOptions;
        die();
    }


 }
 




?>

