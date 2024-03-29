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

Programa:          Módulo de Bitacora
Fecha:             11-Mayo-2022
Programador:       Gabriela Giselh Maradiaga Amador
descripción:       Registra y Muestra los cambios y acciones realizados 
                   por los usuarios al sistema

-----------------------------------------------------------------------*/



    class Bitacora extends Controllers{
        
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
            
            getPermisos(MBITACORA);
        }
        
        public function Bitacora()
        {
  
            if(empty($_SESSION['permisosMod']['r'])){
                header('Location: '.base_url().'/dashboard');
            }
            $data['page_tag']="Bitácora";
            $data['page_title']="Bitácora <small>Route 77</small>";
            $data['page_name']="bitacora";
            $data['page_functions_js']="functions_bitacora.js";
            $this->views->getView($this,"bitacora",$data);
         
        }
        public function getBitacoras(){

            if ($_SESSION['permisosMod']['r']) {
                $arrData = $this->model->selectBitacoras();
                
                for ($i = 0; $i < count($arrData); $i++) {
                    $btnView = '';
                    $btnEdit = '';
                    $btnDelete = '';

                    

                    if ($_SESSION['permisosMod']['r']) {
                        $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['ID_BITACORA'] . ')" title="Ver empresa"><i class="far fa-eye"></i></button>';
                    }

                    $arrData[$i]['options'] = '<div class="text-center">' . $btnView  /* . ' ' . $btnDelete */ . '</div>';
                }
                echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            }
            die();
        }
        public function getBitacora($idBitacora)
        {
            //echo $idBitacora;
            //die();
            if ($_SESSION['permisosMod']['r']) {
                $idBitacora = intval($idBitacora);
                if ($idBitacora > 0) {
                    $arrData = $this->model->selectBitacora($idBitacora);
                    $descripcion=$arrData['USUARIO'].' '.$arrData['DESCRIPCION'];
                    $arrData['DESCRIP']=$descripcion;
                   
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
        
      
     }
 

?>
