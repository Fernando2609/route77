<?php  
    
    class BitacoraModel extends Mysql{  

		//private $intIdUsuario;
		//private $strIdentificacion;
        
	    private $intCod_Producto;
	

        public function __construct()
        {
           parent::__construct();
        } 
	
		public function selectBitacoras()
		{
		
            $sql = "SELECT b.*,m.NOMBRE  as 'MODULO',CONCAT(p.NOMBRES, ' ', p.APELLIDOS) AS 'USUARIO' FROM `TBL_BITACORA` b 
            INNER JOIN TBL_MODULO m on ID_MODULO=COD_MODULO
            INNER JOIN TBL_PERSONAS p on ID_PERSONA=COD_PERSONA";
			//WHERE idRol = 7 and status != 0";
			    $request = $this->select_all($sql);
               
				return $request;
                
		}
        
        
       
		 public function selectBitacora(int $idBitacora){
			$this->intCod_Producto = $idBitacora;

			
			$sql= "SELECT b.*,m.NOMBRE as 'MODULO',CONCAT(p.NOMBRES, ' ', p.APELLIDOS) AS 'USUARIO' FROM `TBL_BITACORA` b 
			INNER JOIN TBL_MODULO m on ID_MODULO=COD_MODULO
			INNER JOIN TBL_PERSONAS p on ID_PERSONA=COD_PERSONA WHERE ID_BITACORA=$this->intCod_Producto";
			$request = $this->select($sql);
			
			/* dep(($request));
			exit; */
			return $request;
		}

	



    }
?>