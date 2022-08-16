<?php  
    class Preguntas extends Controllers{
        public function __construct()
        {
            parent::__construct();
            session_start();
            //session_regenerate_id(true);
            if (empty($_SESSION['login'])) {
                header('Location: '.base_url().'/login');
                die();
            }
            getPermisos(MPREGUNTAS);
        }
        public function Preguntas()
        {
            if(empty($_SESSION['permisosMod']['r'])){
                header('Location: '.base_url().'/preguntas');
            }
            $data['page_tag']="Preguntas de Seguridad";
            $data['page_title']="PREGUNTAS <small>Route 77</small>";
            $data['page_name']="preguntas";
            $data['page_functions_js']="functions_preguntas.js";
            $this->views->getView($this,"preguntas",$data);
        }

    public function setPreguntas()
    { {
            if ($_POST) {
                if (empty($_POST['txtPreguntas']) ) {
                    $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
                } else {
                    $idPreguntas = intval($_POST['idPreguntas']);
                    $strPreguntas = strClean($_POST['txtPreguntas']);
                   
                     $request_user = "";
                    if ($idPreguntas == 0) {
                        $option = 1;

                        if ($_SESSION['permisosMod']['w']) {
                               $request_user = $this->model->insertPreguntas(
                                $strPreguntas,
                            ); 
                        }
                    } else {
                         $option = 2;

                        if ($_SESSION['permisosMod']['u']) {
                            $request_user = $this->model->updatePreguntas(
                                $idPreguntas,
                                $strPreguntas,
                                );
                        } 
                    }

                    if ($request_user > 0) {
                        if ($option == 1) {
                            $arrResponse = array("status" => true, "msg" => 'Pregunta Guardada Correctamente.');
                             
                            $arrData= $this->model->selectPreguntas($request_user);
                       } else {
                            $arrResponse = array("status" => true, "msg" => 'Pregunta Actualizada Correctamente.');
                                                                                
                             $arrData= $this->model->selectPreguntas($idPreguntas);
                                
                        }
                    } else if ($request_user == 'exist') {
                        $arrResponse = array('status' => false, 'msg' => '¡Atención! la pregunta ya existe, ingrese otro.');
                    } else {
                        $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos Verifique la Pregunta.');
                    }
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }

            die();
        }
    }
    public function getPreguntas()
    {

        if ($_SESSION['permisosMod']['r']) {
            $arrData = $this->model->selectPreguntas();
            //  dep($arrData);
            // exit; 
            for ($i = 0; $i < count($arrData); $i++) {
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';



                if ($_SESSION['permisosMod']['r']) {
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['COD_PREGUNTA'] . ')" title="Ver Pregunta"><i class="far fa-eye"></i></button>';
                }

                if ($_SESSION['permisosMod']['u']) {
                    $btnEdit = '<button class="btn btn-warning btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['COD_PREGUNTA'] . ')" title="Editar Pregunta"><i class="fas fa-pencil-alt"></i></button>';
                }

                 if ($_SESSION['permisosMod']['d']) {
                    
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['COD_PREGUNTA'] . ')" title="Eliminar Pregunta"><i class="far fa-trash-alt"></i></button>';
                    
                } 


                $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit  . ' ' . $btnDelete  . '</div>';
            }
            /*  dep($arrData[0]['status']);exit; */
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
    public function getPreguntasSeguridad($idPreguntas)
    {
        //echo $idPreguntas;
        //die();
        if ($_SESSION['permisosMod']['r']) {
            $idPreguntas = intval($idPreguntas);
            if ($idPreguntas > 0) {
                $arrData = $this->model->selectPregunta($idPreguntas);

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

    public function delPreguntas()
    {
        if ($_POST) {
            if ($_SESSION['permisosMod']['d']) {
                $idPreguntas = intval($_POST['idPreguntas']);
                 //Selecciona los datos del usuario Eliminado  
                  $arrData= $this->model->selectPreguntas($idPreguntas); 
                $requestDelete = $this->model->deletePreguntas($idPreguntas);
                if ($requestDelete) {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la Pregunta');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar la pregunta Relacionada a un Usuario.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }
    }
?>

