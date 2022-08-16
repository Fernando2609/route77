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

Programa:          Módulo de Inventario
Fecha:             25-Marzo-2022
Programador:       Kevin Alfredo Rodríguez Zúniga
descripción:       Módulo que gestiona la existencia de productos en el sistema

-----------------------------------------------------------------------*/
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