<?php  
    class Categorias extends Controllers{
        public function __construct()
        {
            parent::__construct();
            session_start();
            //session_regenerate_id(true);
            if (empty($_SESSION['login'])) {
                header('Location: '.base_url().'/login');
                die();
            }
            getPermisos(6);
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
            $this->views->getView($this,"categorias",$data);
        }
        public function setCategorias(){
            /* dep($_FILES);
            dep($_POST);
            die; */
            if ($_POST) {
                if(empty($_POST['txtNombre']) || empty($_POST['txtDescripcion']) || empty($_POST['listStatus']) )
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else {
                    $intIdCategoria =  intval($_POST['idCategoria']);
                    $strCategoria =  strClean($_POST['txtNombre']);
                    $strDescripcion = strClean($_POST['txtDescripcion']);
                    $intStatus = intval($_POST['listStatus']);
                    //Imagen
                    //$ruta = strtolower(clear_cadena($strCategoria));
					//$ruta = str_replace(" ","-",$ruta);

					$foto   	 	= $_FILES['foto'];
					$nombre_foto 	= $foto['name'];
					$type 		 	= $foto['type'];
					$url_temp    	= $foto['tmp_name'];
					$imgPortada 	= 'portada_categoria.png';
					$request_cateria = "";
                    if($nombre_foto != ''){
						$imgPortada = 'img_'.md5(date('d-m-Y H:i:s')).'.jpg';
					}

                if ($intIdCategoria==0) {
                    //Si no hay idRol se crea uno nuevo registro
                    $request_Categoria = $this->model->insertCategoria($strCategoria, $strDescripcion,$imgPortada, $intStatus);
                    $option=1;
                }else{
                    //Si hay idRol se actualiza elregistro
                   // $request_Categoria = $this->model->updateCategoria($intIdRol,$intIdCategoria, $strDescripcion, $intStatus);
                    $option=2;
                }
                if($request_Categoria > 0 )
                {
                if($option == 1)
                {
                    $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                    if($nombre_foto != ''){ uploadImage($foto,$imgPortada); }
                }else{
                    $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
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
		if($_SESSION['permisosMod']['r']){
			$arrData = $this->model->selectCategorias();
            
			for ($i=0; $i < count($arrData); $i++) {
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';
                
                if($arrData[$i]['status'] == 1)
                {
                    $arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
                }else{
                    $arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
                }
				if($_SESSION['permisosMod']['r']){
					$btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo('.$arrData[$i]['idcategoria'].')" title="Ver Categoría"><i class="far fa-eye"></i></button>';
				}
				if($_SESSION['permisosMod']['u']){
					$btnEdit = '<button class="btn btn-warning  btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['idcategoria'].')" title="Editar Categoría"><i class="fas fa-pencil-alt"></i></button>';
				}
				if($_SESSION['permisosMod']['d']){	
					$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['idcategoria'].')" title="Eliminar Categoría"><i class="far fa-trash-alt"></i></button>';
				}
				$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
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
						$arrData['url_portada'] = media().'/images/uploads/'.$arrData['portada'];
						$arrResponse = array('status' => true, 'data' => $arrData);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}

    }

?>

