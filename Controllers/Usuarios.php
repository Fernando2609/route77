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

Programa:          Módulo de Usuarios
Fecha:             03-Abril-2022
Programador:       Leonela Yasmin Pineda Barahona
descripción:       Gestiona todos los usuarios del sistema
-----------------------------------------------------------------------*/



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
            getPermisos(MUSUARIOS);
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
            //BIRACORA
            //Bitacora($_SESSION['idUser'],MUSUARIOS,"Ingreso","Ingresó al módulo");
            $this->views->getView($this,"usuarios",$data);
        }

        public function setUsuario()
        {
        
            if ($_POST) {
                if(empty($_POST['txtIdentificacion']) || empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['txtTelefono']) || empty($_POST['txtEmail']) || empty($_POST['listRolid']) || empty($_POST['listStatus']) ||  empty($_POST['listGenero']) )
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
                    $intGenero = intval(strClean($_POST['listGenero']));
                    $intSucursal = intval(strClean($_POST['listSucursal']));
                    $user=intval($_SESSION['idUser']);
                    
                    $request_user="";
                   
                    if ($idUsuario==0) {
                        $option=1;
                        if ($intStatus==ACTIVO) {
                            $intStatus=NUEVO;
                        }
                        $strPassword =  empty($_POST['txtPassword']) ? hash("SHA256",passGenerator()) : hash("SHA256",$_POST['txtPassword']);
                        if($_SESSION['permisosMod']['w']){
                        $request_user = $this->model->insertUsuario($strIdentificacion,
                                                                                    $strNombre, 
                                                                                    $strApellido, 
                                                                                    $intTelefono, 
                                                                                    $strEmail,
                                                                                    $strPassword, 
                                                                                    $intTipoId, 
                                                                                    $intStatus,
                                                                                    
                                                                                    $intGenero,
                                                                                   
                                                                                    $intSucursal,
                                                                                    $user
                                                                                   );
                                                
                        }
                    }else{
                        $option=2;
                        $strPassword =  empty($_POST['txtPassword']) ? "" : hash("SHA256",$_POST['txtPassword']);
                        if($_SESSION['permisosMod']['u']){
                        // ! Seleccionar Datos antes de la actualización
                        $arrDataOld= $this->model->selectUsuario($idUsuario);
                        
                       
                        $request_user = $this->model->updateUsuario($idUsuario,$strIdentificacion,
                                                                                    $strNombre, 
                                                                                    $strApellido, 
                                                                                    $intTelefono, 
                                                                                    $strEmail,
                                                                                    $strPassword, 
                                                                                    $intTipoId, 
                                                                                    $intStatus,
                                                                                    $intGenero,
                                                                               
                                                                                    $intSucursal,
                                                                                    $user
                                                                                    );
                        //! datos despues de la actualización
                        $arrDataNew= $this->model->selectUsuario($idUsuario);

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

                       /*  dep($arrChangeNew);
                        dep($arrChangeOld); */
                        $contraseña='';
                       
                        if ($strPassword!="") {
                          
                            $contraseña="<tr class='text-center bg-orange'>
                            <td colspan=3>Se modificó la contraseña</td></tr>";
                        };
                        
                        $changeTable="<tr id='prueba2'>
                        <td>DNI:</td>
                        <td id='celIdentificacion'>{$arrChangeOld['DNI']}</td>
                        <td id='celIdentificacion'>{$arrChangeNew['DNI']}</td>
                      </tr>
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
                        <td>Email (Usuario):</td>
                        <td id='celEmail'>{$arrChangeOld['EMAIL']}</td>
                        <td id='celNombre'>{$arrChangeNew['EMAIL']}</td>
                      </tr>
                      <tr>
                        <td>Rol Usuario:</td>
                        <td id='celTipoUsuario'>{$arrChangeOld['ROL']}</td>
                        <td id='celNombre'>{$arrChangeNew['ROL']}</td>
                      </tr>
                     
                      <tr>
                        <td>Genero:</td>
                        <td id='celGenero'>{$arrChangeOld['GENERO']}</td>
                        <td id='celNombre'>{$arrChangeNew['GENERO']}</td>
                      </tr>
                     
                      <tr>
                        <td>Sucursal:</td>
                        <td id='celSucursal'>{$arrChangeOld['SUCURSAL']}</td>
                        <td id='celNombre'>{$arrChangeNew['SUCURSAL']}</td>
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
                            $arrResponse = array("status" => true, "msg" => 'Usuario Guardado Correctamente.');
                             //Selecciona los datos del usuario Insertado  
                             $arrData= $this->model->selectUsuario2($request_user);
                             //BIRACORA
                             Bitacora($_SESSION['idUser'],MUSUARIOS,"Nuevo","Registró al Usuario con el ID ".$arrData['COD_USUARIO'],'');   
                        }else{
                            $arrResponse = array("status" => true, "msg" => 'Usuario Actualizado Correctamente.');
                             //Selecciona los datos del usuario Actualizado                                                       
                             $arrData= $this->model->selectUsuario($idUsuario);
                             //BIRACORA
                             Bitacora($_SESSION['idUser'],MUSUARIOS,"Actualizar","Actualizó al Usuario con el ID ".$arrData['COD_USUARIO'],$changeTable);
                        }
                    }else if($request_user == 'exist'){
						$arrResponse = array('status' => false, 'msg' => '¡Atención! el email o la identificación ya existe, ingrese otro.');		
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos. Verifique el email y el DNI.');
					}
                 }
                 echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            
            die();
        }
        public function getUsuarios()
        {
         
            if($_SESSION['permisosMod']['r']){ 
            $arrData= $this->model->selectUsuarios();
            /* dep($arrData);
            exit; */
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
                    $btnView = '<button class="btn  btn-info btn-sm btnViewUsuario" onClick="fntViewUsuario('.$arrData[$i]['COD_PERSONA'].')" title="Ver usuario"><i class="far fa-eye"></i></button>';
                }

                if($_SESSION['permisosMod']['u']){
                    if(($_SESSION['idUser'] == 1 and $_SESSION['userData']['COD_ROL'] == 1) ||
                       ($_SESSION['userData']['COD_ROL'] == 1 and $arrData[$i]['COD_ROL'] != 1)){
                        $btnEdit = '<button class="btn btn-warning btn-sm btnEditUsuario" onClick="fntEditUsuario(this,'.$arrData[$i]['COD_PERSONA'].')" title="Editar usuario"><i class="fas fa-pencil-alt"></i></button>';
                       }else{
                        $btnEdit = '<button class="btn btn-warning btn-sm" disabled><i class="fas fa-pencil-alt"></i></button>';  
                       }
                   
                }

                if($_SESSION['permisosMod']['d']){
                    if(($_SESSION['idUser'] == 1 and $_SESSION['userData']['COD_ROL'] == 1) ||
                    ($_SESSION['userData']['COD_ROL'] == 1 and $arrData[$i]['COD_ROL'] != 1) and
                              ($_SESSION['userData']['COD_PERSONA'] != $arrData[$i]['COD_PERSONA'])
                              ){
                        $btnDelete = '<button class="btn btn-danger btn-sm btnDelUsuario" onClick="fntDelUsuario('.$arrData[$i]['COD_PERSONA'].')" title="Eliminar usuario"><i class="far fa-trash-alt"></i></button>';
                    }else{
                        $btnDelete = '<button class="btn btn-danger btn-sm" disabled><i class="far fa-trash-alt"></i></button>';
                    }
                   
                }
                
 
                $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
                
             } 

            
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
         }
             die();
        }
        public function getUsuario($idUsuario){
            //echo $idUsuario;
            //die();
            if($_SESSION['permisosMod']['r']){
				$idusuario = intval($idUsuario);
				if($idusuario > 0)
				{
					$arrData = $this->model->selectUsuario($idusuario);
                    
					if(empty($arrData))
					{
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrResponse = array('status' => true, 'data' => $arrData);
                        //BIRACORA
                       //Bitacora($_SESSION['idUser'],MUSUARIOS,"Consulta","Consultó al Usuario ".$arrData['NOMBRES']." ".$arrData['APELLIDOS']."",'');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
             } 
			die();
		}
        
        public function delUsuario()
        {
            if($_POST){
                if($_SESSION['permisosMod']['d']){
                    $intIdpersona = intval($_POST['idUsuario']);
                   
                    $requestDelete = $this-> model->deleteUsuario($intIdpersona);
                    if ($requestDelete) 
                    {
                        //Selecciona los datos del usuario Eliminado  
                        $arrData= $this->model->selectUsuario($intIdpersona);
                        //BIRACORA  
                        Bitacora($_SESSION['idUser'],MUSUARIOS,"Eliminar","Eliminó al Usuario con el ID ".$arrData['COD_USUARIO'],'');  
                        $arrResponse = array ('status' => true, 'msg' => 'Se ha eliminado el usuario');
                    }else{
                        $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el usuario.');
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                    } 
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
                $idUsuario = $_SESSION['idUser'];
                $codRol=$_SESSION['userData']['COD_ROL'];
                
                
                if(($codRol==RCLIENTES and empty($_POST['txtNombre'])) || ($codRol==RCLIENTES and empty($_POST['txtApellido'])) || ( $codRol==RCLIENTES and empty($_POST['txtTelefono'])) )
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{
                    $idUsuario = $_SESSION['idUser'];
                    $strIdentificacion =  empty($_POST['txtIdentificacion']) ? "":  strClean($_POST['txtIdentificacion']);
                    if ($codRol==RCLIENTES) {
                        	/* $strIdentificacion = strClean($_POST['txtIdentificacion']); */
                        $strNombre = ucwords(strClean($_POST['txtNombre']));
                        $strApellido = ucwords(strClean($_POST['txtApellido']));
                        $intTelefono = intval(strClean($_POST['txtTelefono']));
                    }
				
             
                    $intGenero =  empty($_POST['listGenero']) ? "":   intval(strClean($_POST['listGenero']));
                   /*  $intGenero = intval(strClean($_POST['listGenero'])); */
                   $intSucursal =  empty($_POST['listSucursal']) ? "": intval(strClean($_POST['listSucursal']));
                    /* $intSucursal = intval(strClean($_POST['listSucursal'])); */
                    $user=intval($_SESSION['idUser']);
                    $strPassword = "";
                  
                    if(!empty($_POST['txtPassword'])){
						$strPassword = hash("SHA256",$_POST['txtPassword']);
					}
                  
                   if ($_SESSION['userData']['COD_ROL']==RCLIENTES){
                     
                    $request_user = $this->model->updatePerfilCliente($idUsuario, 
                    $strNombre,
                    $strApellido, 
                    $intTelefono,
                    $strPassword,$user);
                   }else{
                        $request_user = $this->model->updatePerfil($idUsuario,
                        //$strIdentificacion, 
                        //$strNombre,
                        //$strApellido, 
                        //$intTelefono,
                        //$intGenero,
                        //$intSucursal,
                        $strPassword,$user);
                   }
                   
                   
                   
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

