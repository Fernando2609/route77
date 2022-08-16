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

Programa:          Módulo Empresa
Fecha:             11-Abril-2022
Programador:       Reynaldo Jafet Giron Tercero
descripción:       Módulo que gestiona los parametros del sistema 

-----------------------------------------------------------------------*/



class Empresa extends Controllers{
        public function __construct()
        {
            parent::__construct();
            session_start();
            //session_regenerate_id(true);
            if (empty($_SESSION['login'])) {
                header('Location: '.base_url().'/login');
                die();
            }
            
            getPermisos(MEMPRESA);
        }
        
        public function Empresa()
        {
            if(empty($_SESSION['permisosMod']['r'])){
                header('Location: '.base_url().'/dashboard');
            }
            $data['page_tag']="Empresa";
            $data['page_title']="EMPRESA <small>Route 77</small>";
            $data['page_name']="empresa";
            $data['page_functions_js']="functions_empresa.js";
            //BIRACORA
            //Bitacora($_SESSION['idUser'],MEMPRESA,"Ingreso","Ingresó al módulo");
            $this->views->getView($this,"empresa",$data);
        }

    public function setEmpresa(){ {
           
            if ($_POST) {
                if (empty($_POST['txtNombreEmpresa']) || empty($_POST['txtDireccion']) || empty($_POST['txtRazonSocial']) || empty($_POST['txtEmail']) || empty($_POST['txtGerenteGeneral'])|| empty($_POST['txtCostoEnvio'])|| empty($_POST['txtRTN']) || empty($_POST['txtEmailPedidos'])|| empty($_POST['txtTelEmpresa'])|| empty($_POST['txtCelEmpresa'])|| empty($_POST['txtCatSlider'])|| empty($_POST['txtCatBanner']) || empty($_POST['txtPedidoMinimo'])|| empty($_POST['txtISV'])) {
                    $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
                } else {
                    $idUsuario = intval($_POST['idUsuario']);
                    $strNombreEmpresa = strClean($_POST['txtNombreEmpresa']);
                    $strDireccion = ucwords(strClean($_POST['txtDireccion']));
                    $strRazonSocial = ucwords(strClean($_POST['txtRazonSocial']));
                    $strEmail = strtolower(strClean($_POST['txtEmail']));
                    $strGerenteGeneral = ucwords(strClean($_POST['txtGerenteGeneral']));
                    $dblISV = strClean($_POST['txtISV']);
                    $intCostoEnvio = ucwords(strClean($_POST['txtCostoEnvio']));
                    $intPedidoMinimo = ucwords(strClean($_POST['txtPedidoMinimo']));
                    $strRTN = ucwords(strClean($_POST['txtRTN']));
                    $strEmailPedidos = strtolower(strClean($_POST['txtEmailPedidos']));
                    $strTelEmpresa = ucwords(strClean($_POST['txtTelEmpresa']));
                    $strCelEmpresa = ucwords(strClean($_POST['txtCelEmpresa']));
                    $strCatSlider = ucwords(strClean($_POST['txtCatSlider']));
                    $strCatBanner = strtolower(strClean($_POST['txtCatBanner']));
                    
                    if ($idUsuario == 0) {
                        $option = 1;
                        
                        if ($_SESSION['permisosMod']['w']) {
                          /*   $request_user = $this->model->insertEmpresa(
                                $strNombreEmpresa,
                                $strDireccion,
                                $strRazonSocial,
                                $strEmail,
                                $strGerenteGeneral,

                            ); */
                        }
                    } else {
                         $option = 2;
                        
                        if ($_SESSION['permisosMod']['u']) {
                             // ! Seleccionar Datos antes de la actualización
                            $arrDataOld= $this->model->selectEmpresa($idUsuario);
                            $request_user = $this->model->updateEmpresa(
                                $idUsuario,
                                $strNombreEmpresa,
                                $strDireccion,
                                $strRazonSocial,
                                $strEmail,
                                $strGerenteGeneral,
                                $intCostoEnvio,
                                $intPedidoMinimo,
                                $strRTN,
                                $strEmailPedidos,
                                $strTelEmpresa,
                                $strCelEmpresa,
                                $strCatSlider,
                                $strCatBanner,
                                $dblISV
                            );
                             // ! datos despues de la actualización
                        $arrDataNew= $this->model->selectEmpresa($idUsuario);

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

                        

                            $changeTable="<tr>
                            <td>Nombre Empresa:</td>
                            <td id='celNombreEmpresa'>{$arrChangeOld['NOMBRE_EMPRESA']}</td>
                            <td >{$arrChangeNew['NOMBRE_EMPRESA']}</td>
                        </tr>
                        <tr>
                            <td>Direccion Factura (Factura)</td>
                            <td id='celDireccion'>{$arrChangeOld['DIRECCION_FACTURA']}</td>
                            <td>{$arrChangeNew['DIRECCION_FACTURA']}</td>
                        </tr>
                        <tr>
                            <td>Razón Social:</td>
                            <td id='celRazonSocial'>{$arrChangeOld['RAZON_SOCIAL']}</td>
                            <td >{$arrChangeNew['RAZON_SOCIAL']}</td>
                        </tr>
                        <tr>
                            <td>Email (Empresa):</td>
                            <td id='celEmail'>{$arrChangeOld['EMAIL_EMPRESA']}</td>
                            <td>{$arrChangeNew['EMAIL_EMPRESA']}</td>

                        </tr>
                        <tr>
                            <td>Gerente General</td>
                            <td id='celGerenteGeneral'>{$arrChangeOld['GERENTE_GENERAL']}</td>
                            <td >{$arrChangeNew['GERENTE_GENERAL']}</td>
                        </tr>
                        <tr>
                            <td>Costo de Envío Lps</td>
                            <td id='celCostoEnvio'>{$arrChangeOld['COSTO_ENVIO']}</td>
                            <td>{$arrChangeNew['COSTO_ENVIO']}</td>
                        </tr>
                        <tr>
                            <td>Pedido Mínimo Lps</td>
                            <td id='celPedidoMinimo'>{$arrChangeOld['PEDIDO_MINIMO']}</td>
                            <td >{$arrChangeNew['PEDIDO_MINIMO']}</td>
                        </tr>
                        <tr>
                            <td>RTN</td>
                            <td id='celRTN'>{$arrChangeOld['RTN']}</td>
                            <td >{$arrChangeNew['RTN']}</td>
                        </tr>
                        <tr>
                            <td>Email Pedidos</td>
                            <td id='celEmailPedidos'>{$arrChangeOld['EMAIL_PEDIDOS']}</td>
                            <td>{$arrChangeNew['EMAIL_PEDIDOS']}</td>
                        </tr>
                        <tr>
                            <td>Teléfono Empresa (Factura)</td>
                            <td id='celTelefonoEmpresa'>{$arrChangeOld['TEL_EMPRESA']}</td>
                            <td >{$arrChangeNew['TEL_EMPRESA']}</td>
                        </tr>
                        <tr>
                            <td>Celular Empresa(Factura)</td>
                            <td id='celCelularEmpresa'>{$arrChangeOld['CEL_EMPRESA']}</td>
                            <td >{$arrChangeNew['CEL_EMPRESA']}</td>
                        </tr>
                       
                        <tr>
                            <td>Categorías Slider</td>
                            <td id='celCatSlider'>{$arrChangeOld['CATEGORIAS_SLIDER']}</td>
                            <td>{$arrChangeNew['CATEGORIAS_SLIDER']}</td>
                        </tr>
                        <tr>
                            <td>Categorías Banner</td>
                            <td id='celCatBanner'>{$arrChangeOld['CATEGORIAS_BANNER']}</td>
                            <td >{$arrChangeNew['CATEGORIAS_BANNER']}</td>
                        </tr>";


                        } 
                    }

                    if ($request_user > 0) {
                        if ($option == 1) {
                            $arrResponse = array("status" => true, "msg" => 'Empresa Guardada Correctamente.');
                        } else {
                            $arrResponse = array("status" => true, "msg" => 'Empresa Actualizada Correctamente.');
                            //BIRACORA
                            Bitacora($_SESSION['idUser'],MEMPRESA,"Actualizar","Actualizó los datos de la empresa ",$changeTable);
                        }
                    } else if ($request_user == 'exist') {
                        $arrResponse = array('status' => false, 'msg' => '¡Atención! el email ya existe, ingrese otro.');
                    } else {
                        $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos Verifique el email.');
                    }
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }

            die();
        }
    }
    public function getEmpresas()
    {

        if ($_SESSION['permisosMod']['r']) {
            $arrData = $this->model->selectEmpresas();
             /* dep($arrData);
            exit; */ 
            for ($i = 0; $i < count($arrData); $i++) {
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';

                

                if ($_SESSION['permisosMod']['r']) {
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['COD_EMPRESA'] . ')" title="Ver empresa"><i class="far fa-eye"></i></button>';
                }

                if ($_SESSION['permisosMod']['u']) {
                        $btnEdit = '<button class="btn btn-warning btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['COD_EMPRESA'] . ')" title="Editar empresa"><i class="fas fa-pencil-alt"></i></button>';
                }

               /*  if ($_SESSION['permisosMod']['d']) {
                    
                        $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['COD_EMPRESA'] . ')" title="Eliminar empresa"><i class="far fa-trash-alt"></i></button>';
                    
                } */


                $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit /* . ' ' . $btnDelete */ . '</div>';
            }
            /*  dep($arrData[0]['status']);exit; */
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
    public function getEmpresa($idUsuario)
    {
        //echo $idUsuario;
        //die();
        if ($_SESSION['permisosMod']['r']) {
            $idusuario = intval($idUsuario);
            if ($idusuario > 0) {
                $arrData = $this->model->selectEmpresa($idusuario);
                /* dep($arrData);
                exit; */
                if (empty($arrData)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                } else {
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

   /*  public function delEmpresa()
    {
        if ($_POST) {
            if ($_SESSION['permisosMod']['d']) {
                $intIdpersona = intval($_POST['idUsuario']);

                $requestDelete = $this->model->deleteEmpresa($intIdpersona);
                if ($requestDelete) {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la Empresa');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar la Empresa.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    } */



    }


?>