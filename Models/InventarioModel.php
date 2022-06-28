<?php  
    
    class InventarioModel    extends Mysql{  

		//private $intIdUsuario;
		//private $strIdentificacion;
        
	    private $intCod_Producto;
	

        public function __construct()
        {
           parent::__construct();
        } 
	
		public function selectInventarios()
		{
		
            $sql = "CALL INVENTARIO(null,'V',null)";
			//WHERE idRol = 7 and status != 0";
			    $request = $this->select_all($sql);
				return $request;
		}
        
        
       
		 public function selectInventario(int $idUsuario){
			$this->intCod_Producto = $idUsuario;

			
			$sql= "CALL INVENTARIO(null,'R',$this->intCod_Producto)";
			$request = $this->select($sql);
			/*dep(($request));
			exit;*/
			return $request;
		}

		public function updateInventario(int $idInventario, int $stock)
    {
        $this->intIdInventario = $idInventario;
		$this->intStock = $stock;
		$sql = "UPDATE TBL_INVENTARIO SET STOCK = ? WHERE COD_PRODUCTO = $this->intIdInventario";
		$arrData = array($this->intStock);
		$request = $this->update($sql,$arrData);
	    return $request;
    }


	



    }
?>