<?php

class OrdenCompra extends Controllers{
    public function __construct()
    {
            parent::__construct();
            session_start();
            //session_regenerate_id(true);
            if (empty($_SESSION['login'])) {
                header('Location: '.base_url().'/login');
                die();
            }
            getPermisos(17);
        }
        
        public function OrdenCompra()
        {
            if(empty($_SESSION['permisosMod']['r'])){
                header('Location: '.base_url().'/dashboard');
            }
            $data['page_tag']="ordenCompra";
            $data['page_title']="Compras <small>Route 77</small>";
            $data['page_name']="ordenCompra";
            $data['page_functions_js']="functions_ordenCompra.js";
            $this->views->getView($this,"ordenCompra",$data);
        }
        public function getProducto($idproducto){
			if($_SESSION['permisosMod']['r']){
				$idproducto = intval($idproducto);
				if($idproducto > 0){
					$arrData = $this->model->selectProducto($idproducto);
				
					if(empty($arrData)){
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{
				
						$arrResponse = array('status' => true, 'data' => $arrData);
					}
					
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}
 }
?>