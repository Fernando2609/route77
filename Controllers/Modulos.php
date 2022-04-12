<?php

class Modulos extends Controllers{
    public function __construct()
    {
        parent::__construct();
        session_start();
        //session_regenerate_id(true);
        if (empty($_SESSION['login'])) {
            header('Location: '.base_url().'/login');
            die();
        }
        //Aqui se pone el COD del modulo al cual se le dara los permisos en la obtencion de datos.
        getPermisos(17);
    }
    
    public function Modulos()
    {
        if(empty($_SESSION['permisosMod']['r'])){
            header('Location: '.base_url().'/dashboard');
        }
        $data['page_tag']="Modulos";
        $data['page_title']="MODULOS <small>Route 77</small>";
        $data['page_name']="modulos";
        $data['page_functions_js']="functions_modulos.js";
        $this->views->getView($this,"modulos",$data);
    }

    public function getModulos()  {
        if($_SESSION['permisosMod']['r']){
            $btnView ='';
            $btnEdit = '';
            $btnDelete = '';

        $arrData = $this->model->selectModulos();
        /* dep($arrData);
        exit; */
            for ($i=0; $i < count($arrData) ; $i++) { 
            if ($arrData[$i]['COD_STATUS']==1) {
                $arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';   
            }else{
                $arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
            }

            if($_SESSION['permisosMod']['u']){
                //$btnView = '<button class="btn btn-secondary btn-sm btnPermisosRol" onClick="fntPermisos('.$arrData[$i]['COD_MODULO'].')" title="Permisos"><i class="fas fa-key"></i></button>';
                $btnEdit = '<button class="btn btn-info btn-sm" onClick="fntEditModulo('.$arrData[$i]['COD_MODULO'].')" title="Editar Módulo"><i class="fas fa-pencil-alt"></i></button>';
            }

            if($_SESSION['permisosMod']['d']){
                $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelModulo('.$arrData[$i]['COD_MODULO'].')" title="Eliminar Módulo"><i class="far fa-trash-alt"></i></button>';
            }

            $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
            } 
        /*  dep($arrData[0]['status']);exit; */
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
       }
        die();
    }

    public function getModulo(int $idModulo)
    {
        if($_SESSION['permisosMod']['r']){
            $intIdModulo = intval(strClean($idModulo));
            if($intIdModulo > 0)
            {
                $arrData = $this->model->selectModulo($intIdModulo);
                if(empty($arrData))
                {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                }else{
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

            }
        }
        die();
    }

    public function setModulo(){
        /* dep($_POST);
        exit; */
      if($_SESSION['permisosMod']['w']){
            $intIdModulo =  intval($_POST['idModulo']);
            $strModulo =  strClean($_POST['txtNombreModulo']);
            $strDescripcion = strClean($_POST['txtDescripcionModulo']);
            $intStatus = intval($_POST['listStatus']);

            if ($intIdModulo==0) {
                //Si no hay idModulo se crea uno nuevo registro
                $request_modulo = $this->model->insertModulo($strModulo, $strDescripcion, $intStatus);
                $option=1;
            } else{
                //Si hay idModulo se actualiza elregistro
                $request_modulo = $this->model->updateModulo($intIdModulo,$strModulo, $strDescripcion, $intStatus);
                $option=2;
            }
            if($request_modulo > 0 )
            {
                if($option == 1)
                    {
                        $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                    }else{
                        $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
                    }
                $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');

            }else if($request_modulo == false){
                $arrResponse = array('status' => false, 'msg' => '¡Atención! El Módulo ya existe.');

            }else{
                $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        } 
        die();
        /* dep($_POST);
        exit; */
    }

    public function delModulo()
    {
        if($_POST){
            if($_SESSION['permisosMod']['d']){
                $intIdModulo = intval($_POST['idModulo']);
                $requestDelete = $this->model->deleteModulo($intIdModulo);
                if($requestDelete == true)
                {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Módulo');
                }else if($requestDelete == false){
                    $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar un módulo asociado a usuarios.');
                }else{
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Módulo.');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }
}    


?>