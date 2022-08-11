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

Programa:          Módulo Clientes
Fecha:             04-Marzo-2022
Programador:       Leonela Yasmin Pineda Barahona
descripción:       Módulo que Administra los datos personales de los 
                   clientes registrados en la tienda

-----------------------------------------------------------------------*/



 class Clientes extends Controllers{
        public function __construct()
        {
            parent::__construct();
            session_start();
            //session_regenerate_id(true);
            if (empty($_SESSION['login'])) {
                header('Location: '.base_url().'/login');
                die();
            }
            getPermisos(MCLIENTES);
        }
        
        public function Clientes()
        {
            if(empty($_SESSION['permisosMod']['r'])){
                header('Location: '.base_url().'/dashboard');
            }
            $data['page_tag']="Clientes";
            $data['page_title']="CLIENTES <small>Route 77</small>";
            $data['page_name']="clientes";
            $data['page_functions_js']="functions_clientes.js";
            $this->views->getView($this,"clientes",$data);
        }

        public function setCliente()
        {
            if ($_POST) {
                
                if(empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['txtTelefono']) || empty($_POST['txtEmail']) || empty($_POST['listStatus']))
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{ 
                    $idUsuario = intval($_POST['idUsuario']);
					//$strIdentificacion = strClean($_POST['txtIdentificacion']);
					$strNombre = ucwords(strClean($_POST['txtNombre']));
					$strApellido = ucwords(strClean($_POST['txtApellido']));
					
					$strEmail = strtolower(strClean($_POST['txtEmail']));
                    $intTipoId = 2;
					$intStatus = intval(strClean($_POST['listStatus']));
                    
                    
                    $intTelefono = intval(strClean($_POST['txtTelefono']));
					
                   /* $intNacionalidad = intval(strClean($_POST['listNacionalidadCliente']));
                    $intGenero = intval(strClean($_POST['listGenero']));
                    $intEstadoC = intval(strClean($_POST['listEstadoC']));
                    $intSucursal = intval(strClean($_POST['listSucursal'])); 
                    $strFechaNacimiento = strClean($_POST['fechaNacimiento']);*/
                    $user=intval($_SESSION['idUser']);
                    
                    $request_user="";

                    if ($idUsuario==0) {
                        $option=1;
                        $strPassword =  empty($_POST['txtPassword']) ? passGenerator() : $_POST['txtPassword'];
                        
                        $strPasswordEncrip = hash("SHA256",$strPassword);
                        if ($intStatus==ACTIVO) {
                            $intStatus=NUEVO;
                        }
                       
                       // $strPassword =  empty($_POST['txtPassword']) ?passGenerator() : $_POST['txtPassword'];
                      //$strPasswordEncrip = hash("SHA256",$strPassword);
                        if($_SESSION['permisosMod']['w']){
                        $request_user = $this->model->insertCliente($strNombre,     $strApellido, 
                                                                                   $strEmail,
                                                                                    $strPasswordEncrip,
                                                                                    $intTipoId, 
                                                                                    $intStatus,
                                                                                    $intTelefono, 
                                                                                    $user    
                                                                                );
                             
                                                                                   
                        } 
                    }else{
                         $option=2;
                         // ! Datos del cliente antes de actualizar                               
                        $arrDataOld= $this->model->selectCliente($idUsuario);
                         $strPassword =  empty($_POST['txtPassword']) ? "" : hash("SHA256",$_POST['txtPassword']);
                         if($_SESSION['permisosMod']['u']){
                        $request_user = $this->model->updateCliente($idUsuario,     
                                                                                    $strNombre, 
                                                                                    $strApellido, 
                                                                                    $strEmail,
                                                                                    $strPassword,
                                                                                    $intTipoId,
                                                                                    $intStatus,
                                                                                    $intTelefono,
                                                                                    $user    
                                                                                   );
                             // ! datos despues de la actualización
                        $arrDataNew= $this->model->selectCliente($idUsuario);

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
                        $contraseña='';
                       
                        if ($strPassword!="") {
                          
                            $contraseña="<tr class='text-center bg-orange'>
                            <td colspan=3>Se modificó la contraseña</td></tr>";
                        };
                        
                        $changeTable="<
                      <tr>
                        <td>Nombres:</td>
                        <td id='celNombre'>{$arrChangeOld['NOMBRES']}</td>
                        <td id='celNombre'>{$arrChangeNew['NOMBRES']}</td>
                      </tr>
                      <tr>
                        <td>Apellidos:</td>
                        <td id='celApellido'>{$arrChangeOld['APELLIDOS']}</td>
                        <td id='celNombre'>{$arrChangeNew['APELLIDOS']}</td>
                      </tr>
                      <tr>
                        <td>Teléfono:</td>
                        <td id='celTelefono'>{$arrChangeOld['TELEFONO']}</td>
                        <td id='celNombre'>{$arrChangeNew['TELEFONO']}</td>
                      </tr>
                      <tr>
                        <td>Email:</td>
                        <td id='celEmail'>{$arrChangeOld['EMAIL']}</td>
                        <td id='celNombre'>{$arrChangeNew['EMAIL']}</td>
                      </tr>  
                      <tr>
                        <td>Estado:</td>
                        <td id='celEstado'>{$arrChangeOld['STATUS']}</td>
                        <td id='celNombre'>{$arrChangeNew['STATUS']}</td>
                      </tr>".$contraseña;
                     
                      //$changeTable="{$arrChangeOld['DNI']}";
                      //dep($changeTable);
                      //exit;

                        
                        }








                   
                }
                    if($request_user > 0 ){
                        if ($option==1) {
                            $arrResponse = array("status" => true, "msg" => 'Cliente Guardado Correctamente.');
                            $nombreUsuario = $strNombre.' '.$strApellido;
                        $dataUsuario = array(
                            'nombreUsuario' => $nombreUsuario,
                            'email' => $strEmail,
                            'password' => $strPassword,
                            'asunto' => 'Bienvenido a tu Tienda en Línea');
                        sendEmail($dataUsuario, 'email_bienvenida2');
                         //Selecciona los datos del usuario Actualizado                                                       
                         $arrData= $this->model->selectCliente2($request_user);
                         //BIRACORA
                         Bitacora($_SESSION['idUser'],MCLIENTES,"Nuevo","Registró al Cliente ".$arrData['NOMBRES']." ".$arrData['APELLIDOS']."",''); 
                            
                        }else{  
                            //Selecciona los datos del usuario Actualizado                                                       
                            $arrData= $this->model->selectCliente($idUsuario);
                            //BIRACORA
                            Bitacora($_SESSION['idUser'],MCLIENTES,"Actualizar","Actualizó al Cliente ".$arrData['NOMBRES']." ".$arrData['APELLIDOS']."",$changeTable);
                            $arrResponse = array("status" => true, "msg" => 'Cliente Actualizado Correctamente.');
                        }
                    }else if($request_user == 'exist'){
						$arrResponse = array('status' => false, 'msg' => '¡Atención! el email  ya existe, ingrese otro.');		
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos. Verifique el Email');
					}
                 }
                 echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            
            die();
        }
  
        public function getClientes()
        {
            if($_SESSION['permisosMod']['r']){ 
            $arrData= $this->model->selectClientes();
           /* dep($arrData);
            exit;*/
            for ($i=0; $i < count($arrData) ; $i++) { 
                $btnView ='';
                $btnEdit = '';
                $btnDelete = '';

                if ($arrData[$i]['COD_STATUS']==1) {
                 $arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';   
                }else if($arrData[$i]['COD_STATUS']==2){
                 $arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
                }else{
                    $arrData[$i]['status'] = '<span class="badge badge-info">Nuevo</span>';
                }

                if($_SESSION['permisosMod']['r']){
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo('.$arrData[$i]['COD_PERSONA'].')" title="Ver Cliente"><i class="far fa-eye"></i></button>';
                }

                if($_SESSION['permisosMod']['u']){
                    $btnEdit = '<button class="btn btn-warning btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['COD_PERSONA'].')" title="Editar Cliente"><i class="fas fa-pencil-alt"></i></button>';                 
                }

                if($_SESSION['permisosMod']['d']){
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['COD_PERSONA'].')" title="Eliminar Cliente"><i class="far fa-trash-alt"></i></button>';  
                }
                
 
                $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
                
             } 
            //BIRACORA- Usuario entra al módulo
            //Bitacora($_SESSION['idUser'],MCLIENTES,"Ingreso","Ingresó al módulo");
            /*  dep($arrData[0]['status']);exit; */
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
         }
             die();
        }   
      
        public function getCliente($idUsuario){
            /*echo $idUsuario;
            die();*/
            if($_SESSION['permisosMod']['r']){
				$idusuario = intval($idUsuario);

				if($idusuario > 0)
				{
					$arrData = $this->model->selectCliente($idusuario);
                     /*dep($arrData);
                    exit; */
					if(empty($arrData))
					{
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrResponse = array('status' => true, 'data' => $arrData);
                        //BIRACORA
                        //Bitacora($_SESSION['idUser'],MCLIENTES,"Consulta","Consultó al Cliente ".$arrData['NOMBRES']." ".$arrData['APELLIDOS']."");
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
             } 
			die();
		}


    public function delCliente()
    {
        if ($_POST) {
            if ($_SESSION['permisosMod']['d']) {
                $intIdpersona = intval($_POST['idUsuario']);

                $requestDelete = $this->model->deleteCliente($intIdpersona);
                if ($requestDelete) {
                    //Selecciona los datos del usuario Eliminado  
                    $arrData= $this->model->selectCliente($intIdpersona);
                    //BIRACORA
                    Bitacora($_SESSION['idUser'],MCLIENTES,"Delete","Eliminó al Cliente ".$arrData['NOMBRES']." ".$arrData['APELLIDOS']."",'');  
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Cliente');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar al Cliente.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }
        //Funcion para traer La Sucursal
        /*public function getSelectSucursal()
        //{
            $htmlOptions = "";
            $arrData = $this->model->selectSucursal();
            if(count($arrData) > 0 ){
                for ($i=0; $i < count($arrData); $i++) { 
                
                    $htmlOptions .= '<option value="'.$arrData[$i]['idsucursal'].'">'.$arrData[$i]['nombre'].'</option>';
                    
               // }
           // }
            echo $htmlOptions;
            die();		
        }*/


    }

?>