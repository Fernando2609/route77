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

Programa:          Módulo Permisos
Fecha:             25-Febrero-2022
Programador:       Reynaldo Jafet Giron Tercero
descripción:       Otorga los diferentes permisos a cada rol de usuario

-----------------------------------------------------------------------*/



    class Permisos extends Controllers{
        public function __construct()
        {
            parent::__construct();
			session_start();
            if (empty($_SESSION['login'])) {
                header('Location: '.base_url().'/login');
                die();
            }
        }
        
        public function getPermisosRol(int $idrol)
		{
			$rolid = intval($idrol);
			if($rolid > 0)
			{
				$arrModulos = $this->model->selectModulos();
				$arrPermisosRol = $this->model->selectPermisosRol($rolid);
                $rol=$this->model->selectRol($rolid);
				
				//$arrRol = $this->model->getRol($rolid);
				$arrPermisos = array('r' => 0, 'w' => 0, 'u' => 0, 'd' => 0);
				$arrPermisoRol = array('idrol' => $rolid);

				if(empty($arrPermisosRol))
				{
					for ($i=0; $i < count($arrModulos) ; $i++) { 

						$arrModulos[$i]['permisos'] = $arrPermisos;
					}
				}else{
					for ($i=0; $i < count($arrModulos); $i++) {
						$arrPermisos = array('r' => 0, 'w' => 0, 'u' => 0, 'd' => 0);
						if(isset($arrPermisosRol[$i])){
							$arrPermisos = array('r' => $arrPermisosRol[$i]['R'], 
												 'w' => $arrPermisosRol[$i]['W'], 
												 'u' => $arrPermisosRol[$i]['U'], 
												 'd' => $arrPermisosRol[$i]['D'] 
												);            
						}
						$arrModulos[$i]['permisos']=$arrPermisos;
					 }
					}
					//BIRACORA
					//Bitacora($_SESSION['idUser'],MUSUARIOS,"Consulta","Consultó los permisos del ".$rol['NOM_ROL']."");
                    $arrPermisoRol['modulos']=$arrModulos;
                    $html=getModal('modalPermisos',$arrPermisoRol);
                    //dep($arrPermisoRol);
			}   
			die();
		}
        public function setPermisos()
		{
			
			if($_POST)
			{
				$intIdrol = intval($_POST['idrol']);
				$modulos = $_POST['modulos'];
			

				$this->model->deletePermisos($intIdrol);
				foreach ($modulos as $modulo) {
					$idModulo = $modulo['COD_MODULO'];
					$r = empty($modulo['r']) ? 0 : 1;
					$w = empty($modulo['w']) ? 0 : 1;
					$u = empty($modulo['u']) ? 0 : 1;
					$d = empty($modulo['d']) ? 0 : 1;
					
					$requestPermiso = $this->model->insertPermisos($intIdrol, $idModulo, $r, $w, $u, $d);
					$rol=$this->model->selectRol($intIdrol);
				}
				if($requestPermiso > 0)
				{
					//BIRACORA
					
					Bitacora($_SESSION['idUser'],MUSUARIOS,"Actualizar","Actualizó los permisos del rol ".$rol['NOM_ROL']." con el código ".$rol['COD_ROL']."",'');
					
					$arrResponse = array('status' => true, 'msg' => 'Permisos asignados correctamente.');
				}else{
					$arrResponse = array("status" => false, "msg" => 'No es posible asignar los permisos.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		
		}
        
    }

?>