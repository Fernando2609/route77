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

Programa:          Módulo de sucursales
Fecha:             15-Abril-2022
Programador:       Gabriela Giselh Maradiaga Amador
descripción:       Administra los números telefonicos de contacto de la empresa

-----------------------------------------------------------------------*/



class TelEmpresa extends Controllers{
        public function __construct()
        {
            parent::__construct();
            session_start();
            //session_regenerate_id(true);
            if (empty($_SESSION['login'])) {
                header('Location: '.base_url().'/login');
                die();
            }
            getPermisos(14);
        }
        
        public function TelEmpresa()
        {
            if(empty($_SESSION['permisosMod']['r'])){
                header('Location: '.base_url().'/dashboard');
            }
            $data['page_tag']= "telEmpresa";
            $data['page_title']="Teléfonos <small>Route 77</small>";
            $data['page_name']="telempresa";
            $data['page_functions_js']="functions_telEmpresa.js";
            //BIRACORA
            //Bitacora($_SESSION['idUser'],MEMPRESA,"Ingreso","Ingresó al módulo");
            $this->views->getView($this,"telEmpresa",$data);
        }

    public function settelEmpresa()
    {
        if ($_POST) {

            if (empty($_POST['txttelEmpresa'])) {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                $idUsuario = intval($_POST['idUsuario']);
                $intTelefono = intval(strClean($_POST['txttelEmpresa']));

            
                $request_user ="";
                if ($idUsuario == 0) {
                    $option = 1;
                    if ($_SESSION['permisosMod']['w']) {
                        $request_user = $this->model->inserttelEmpresa(
                            $intTelefono
                           
                        );
                    }
                } else {
                     $option = 2;
                    if ($_SESSION['permisosMod']['u']) {
                        $request_user = $this->model->updatetelEmpresa(
                            $idUsuario,
                            $intTelefono,
                            
                        );
                    } 
                }
              

                if ($request_user > 0) {
                    if ($option == 1) {
                        $arrResponse = array("status" => true, "msg" => 'Teléfono Empresa Guardado Correctamente.');
                      //Selecciona los datos de el télefono Insertado  
                      $arrData= $this->model->selecttelEmpresa($request_user);
                      //BIRACORA
                      //Bitacora($_SESSION['idUser'],MEMPRESA,"Nuevo","Registró el teléfono  ".$arrData['TELEFONO']); 
                    } else {
                        $arrResponse = array("status" => true, "msg" => 'Teléfono Empresa Actualizado Correctamente.');
                         //Selecciona los datos del usuario Actualizado                                                       
                         $arrData= $this->model->selecttelEmpresa($idUsuario);
                         //BIRACORA
                         //Bitacora($_SESSION['idUser'],MEMPRESA,"Update","Actualizó el teléfono  ".$arrData['TELEFONO']); 
                    }
                } else if ($request_user == 'exist') {
                    $arrResponse = array('status' => false, 'msg' => '¡Atención! el teléfono ya existe, ingrese otro.');
                } else {
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }

        die();
    }

    public function gettelEmpresas()
    {
        if ($_SESSION['permisosMod']['r']) {
            $arrData = $this->model->selecttelEmpresas();
             /* dep($arrData);
            exit; */
            for ($i = 0; $i < count($arrData); $i++) {
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';

                
                if ($_SESSION['permisosMod']['r']) {
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['COD_TELEFONO_EMPRESA'] . ')" title="Ver teleEmpresa"><i class="far fa-eye"></i></button>';
                }

                if ($_SESSION['permisosMod']['u']) {
                    $btnEdit = '<button class="btn btn-warning btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['COD_TELEFONO_EMPRESA'] . ')" title="Editar telEmpresa"><i class="fas fa-pencil-alt"></i></button>';
                }

                if ($_SESSION['permisosMod']['d']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['COD_TELEFONO_EMPRESA'] . ')" title="Eliminar telEmpresa"><i class="far fa-trash-alt"></i></button>';
                }


                $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
            }
            /*  dep($arrData[0]['status']);exit; */
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function gettelEmpresa($idUsuario)
    {
        //echo $idUsuario;
        //die();
        if ($_SESSION['permisosMod']['r']) {
            $idusuario = intval($idUsuario);
            if ($idusuario > 0) {
                $arrData = $this->model->selecttelEmpresa($idusuario);

                if (empty($arrData)) {
                    $arrResponse = array('status' => false, 'msg' => 'Dato no encontrado.');
                } else {
                    //BIRACORA
                    //Bitacora($_SESSION['idUser'],MEMPRESA,"Consulta","Consultó el teléfono  ".$arrData['TELEFONO']); 
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

     public function deltelEmpresa()
    {
        if ($_POST) {
            if ($_SESSION['permisosMod']['d']) {
                $intIdpersona = intval($_POST['idUsuario']);
                    //Selecciona los datos del usuario Eliminado  
                    $arrData= $this->model->selecttelEmpresa($intIdpersona);
                   

                $requestDelete = $this->model->deletetelEmpresa($intIdpersona);
                if ($requestDelete) {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Teléfono Empresa');
                    //BIRACORA
                    //Bitacora($_SESSION['idUser'],MEMPRESA,"Delete","Eliminó el teléfono ".$arrData['TELEFONO']);
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Teléfono Empresa.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    } 





    }
?>