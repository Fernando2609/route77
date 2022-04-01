<?php  
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
					$r = empty($modulo['R']) ? 0 : 1;
					$w = empty($modulo['W']) ? 0 : 1;
					$u = empty($modulo['U']) ? 0 : 1;
					$d = empty($modulo['D']) ? 0 : 1;
					$requestPermiso = $this->model->insertPermisos($intIdrol, $idModulo, $r, $w, $u, $d);
				}
				if($requestPermiso > 0)
				{
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