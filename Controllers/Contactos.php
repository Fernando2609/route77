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

Programa:          Módulo Contactos
Fecha:             23-Abril-2022
Programador:       Gabriela Giselh Maradiaga Amador
descripción:       Módulo que recibe los mensajes enviados por los clientes

-----------------------------------------------------------------------*/




	class Contactos extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
				die();
			}
			getPermisos(MCONTACTO);
		}

		public function contactos()
		{
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Contactos";
			$data['page_title'] = "Contactos <small>Route 77</small>";
			$data['page_name'] = "Contactos";
			$data['page_functions_js'] = "functions_Contactos.js";
			//BIRACORA
            //Bitacora($_SESSION['idUser'],MCONTACTO,"Ingreso","Ingresó al módulo");
			$this->views->getView($this,"contactos",$data);
		}

		public function getContactos(){
			if($_SESSION['permisosMod']['r']){
				$arrData = $this->model->selectContactos();
                for ($i=0; $i < count($arrData); $i++) { 
                    $btnView='';
                    if ($_SESSION['permisosMod']['r']) {
                        $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['COD_CONTACTO'] . ')" title="Ver Mensaje"><i class="far fa-eye"></i></button>';
                    }
                    $arrData[$i]['options'] = '<div class="text-center">' . $btnView. '</div>';
                }
                
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
        public function getMensaje($idMensaje){
			if($_SESSION['permisosMod']['r']){
				$idMensaje = intval($idMensaje);
				if($idMensaje > 0){
					$arrData = $this->model->selectMensaje($idMensaje);
					
					if(empty($arrData)){
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{
           			 //BIRACORA
            		//Bitacora($_SESSION['idUser'],MCONTACTO,"Consulta","Consultó el mensaje #".$idMensaje." Enviado por el usuario ".$arrData['NOMBRE']." con el Correo ".$arrData['EMAIL']);
						$arrResponse = array('status' => true, 'data' => $arrData);
					}
				
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}

	}
?>