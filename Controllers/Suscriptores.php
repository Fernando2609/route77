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

Programa:          Módulo de Suscriptores
Fecha:             03-Mayo-2022
Programador:       Kevin Alfredo Rodríguez Zúniga
descripción:       Almacena los suscriptores de la tienda para ofrecer 
                   futuras ofertas 
-----------------------------------------------------------------------*/




	class Suscriptores extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
				die();
			}
			getPermisos(MSUSCRIPTORES);
		}

		public function Suscriptores()
		{
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Suscriptores";
			$data['page_title'] = "SUSCRIPTORES <small>Route 77</small>";
			$data['page_name'] = "suscriptores";
			$data['page_functions_js'] = "functions_suscriptores.js";
			 //BIRACORA
			 //Bitacora($_SESSION['idUser'],MSUSCRIPTORES,"Ingreso","Ingresó al módulo");
			$this->views->getView($this,"suscriptores",$data);
		}

		public function getSuscriptores(){
			if($_SESSION['permisosMod']['r']){
				$arrData = $this->model->selectSuscriptores();
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

	}
?>