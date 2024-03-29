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

Programa:          Módulo de Redes sociales
Fecha:             02-Abril-2022
Programador:       Gabriela Giselh Maradiaga Amador
descripción:       Se administran las redes sociales de la empresa

-----------------------------------------------------------------------*/



class RedesSociales extends Controllers{
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
        
        public function redesSociales()
        {
            if(empty($_SESSION['permisosMod']['r'])){
                header('Location: '.base_url().'/dashboard');
            }
            $data['page_tag']= "redesSociales";
            $data['page_title']= "Redes Sociales <small>Route 77</small>";
            $data['page_name']= "redesSociales";
            $data['page_functions_js']= "functions_redesSociales.js";
            //BIRACORA
            ////Bitacora($_SESSION['idUser'],MEMPRESA,"Ingreso","Ingresó al módulo");
            $this->views->getView($this, "redesSociales",$data);
        }

    public function setredesSocial()
    { {
            if ($_POST) {
                if (empty($_POST['txtDescripcion']) || empty($_POST['txtEnlace'])) {
                    $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
                } else {
                    $idUsuario = intval($_POST['idUsuario']);
                    $strDescripcion = strClean($_POST['txtDescripcion']);
                    $strEnlace = strtolower(strClean($_POST['txtEnlace']));
                   
                     $request_user = "";
                    if ($idUsuario == 0) {
                        $option = 1;

                        if ($_SESSION['permisosMod']['w']) {
                               $request_user = $this->model->insertredesSociales(
                                $strDescripcion,
                                $strEnlace,
                            ); 
                        }
                    } else {
                         $option = 2;

                        if ($_SESSION['permisosMod']['u']) {
                            $request_user = $this->model->updateredesSociales(
                                $idUsuario,
                                $strDescripcion,
                                $strEnlace,

                            );
                        } 
                    }

                    if ($request_user > 0) {
                        if ($option == 1) {
                            $arrResponse = array("status" => true, "msg" => 'Red Social Guardada Correctamente.');
                            //Selecciona los datos de la red social Insertado  
                            $arrData= $this->model->selectredSocial($request_user);
                            //BIRACORA
                            //Bitacora($_SESSION['idUser'],MEMPRESA,"Nuevo","Registró la red social ".$arrData['DESCRIPCION']);  
                        } else {
                            $arrResponse = array("status" => true, "msg" => 'Red Social Actualizada Correctamente.');
                             //Selecciona los datos del usuario Actualizado                                                       
                             $arrData= $this->model->selectredSocial($idUsuario);
                             //BIRACORA
                             //Bitacora($_SESSION['idUser'],MEMPRESA,"Update","Actualizó la red social ".$arrData['DESCRIPCION']);  
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
    public function getredesSociales()
    {

        if ($_SESSION['permisosMod']['r']) {
            $arrData = $this->model->selectredesSociales();
            //  dep($arrData);
            // exit; 
            for ($i = 0; $i < count($arrData); $i++) {
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';



                if ($_SESSION['permisosMod']['r']) {
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['COD_RED_SOCIAL'] . ')" title="Ver Red Social"><i class="far fa-eye"></i></button>';
                }

                if ($_SESSION['permisosMod']['u']) {
                    $btnEdit = '<button class="btn btn-warning btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['COD_RED_SOCIAL'] . ')" title="Editar Red Social"><i class="fas fa-pencil-alt"></i></button>';
                }

                 if ($_SESSION['permisosMod']['d']) {
                    
                        $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['COD_RED_SOCIAL'] . ')" title="Eliminar Red Social"><i class="far fa-trash-alt"></i></button>';
                    
                } 


                $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit  . ' ' . $btnDelete  . '</div>';
            }
            /*  dep($arrData[0]['status']);exit; */
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
    public function getredSocial($idUsuario)
    {
        //echo $idUsuario;
        //die();
        if ($_SESSION['permisosMod']['r']) {
            $idusuario = intval($idUsuario);
            if ($idusuario > 0) {
                $arrData = $this->model->selectredSocial($idusuario);

                if (empty($arrData)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                } else {
                    $arrResponse = array('status' => true, 'data' => $arrData);
                    //BIRACORA
                    //Bitacora($_SESSION['idUser'],MEMPRESA,"Consulta","Consultó la red social ".$arrData['DESCRIPCION']);  
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    public function delredSocial()
    {
        if ($_POST) {
            if ($_SESSION['permisosMod']['d']) {
                $intIdpersona = intval($_POST['idUsuario']);
                 //Selecciona los datos del usuario Eliminado  
                 $arrData= $this->model->selectredSocial($intIdpersona);

                $requestDelete = $this->model->deleteredSocial($intIdpersona);
                if ($requestDelete) {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la Red Social');
                   
                    //BIRACORA
                    //Bitacora($_SESSION['idUser'],MEMPRESA,"Delete","Eliminó la red social ".$arrData['DESCRIPCION']);
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar la Red Social.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }


    }
?>