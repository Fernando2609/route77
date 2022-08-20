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

Programa:          Módulo de sucursales
Fecha:             03-Abril-2022
Programador:       Leonela Yasmin Pineda Barahona
descripción:       Mantenimiento de la información de las sucursales 
                   pertenecientes a la empresa

-----------------------------------------------------------------------*/

   
    class adminSucursalesModel extends Mysql{
		private $intIdSucursal;
        private $strNombre;
		private $strDireccion;
		
        public function __construct()
        {
           parent::__construct();
        }
        public function insertSucursales(string $nombre, string $direccion){
		    $return = 0;
			$this->strNombre = $nombre;
			$this->strDireccion = $direccion;
			

			
		     $sql="CALL CRUD_SUCURSAL('{$this->strNombre}',null,'A',null)";
			 /* dep($sql);
			 exit; */
			 $request = $this->select_all($sql);
			if(empty($request))
			{
				$query_insert="CALL CRUD_SUCURSAL(?,?,'I',null)";
	        	$arrData = array($this->strNombre,
									$this->strDireccion
									);
									
	        	$request_insert = $this->insert($query_insert,$arrData);
				$sql = "SELECT last_insert_id()";
				$request_ID = $this->select($sql);
	        	$return = $request_ID['last_insert_id()'];

			}else{
				$return = false;
			}
            
            return $return;
           
		}

		public function selectSucursales(){
			

			$sql="CALL CRUD_SUCURSAL(null,null,'V', null)";
			//$sql="Select * from TBL_SUCURSAL";
			$request = $this->select_all($sql);
			/* dep($request);
			exit; */
			return $request;

		}

		public function selectSucursal(int $idSucursal){
			$this->intIdSucursal = $idSucursal;
			

			$sql="CALL CRUD_SUCURSAL(null,null,'R',$this->intIdSucursal)";
			
			$request = $this->select($sql);
			
			return $request;
		}
    //}

	public function updateSucursal(int $idSucursal, string $nombre, string $direccion){
			
		$this->intIdSucursal = $idSucursal;
		$this->strNombre = $nombre;
		$this->strDireccion = $direccion;
		
		//validar

		/* $sql="SELECT * FROM TBL_SUCURSAL
		WHERE NOMBRE='$this->strNombre'  and COD_SUCURSAL!='$this->intIdSucursal'";
 */
        $sql="CALL CRUD_SUCURSAL('$this->strNombre',null,'B',$this->intIdSucursal)";
		/* dep($sql);
		exit; */
		$request = $this->select_all($sql);
        
        if(empty($request))
		{

		$sql="CALL CRUD_SUCURSAL(?,?,'U',$this->intIdSucursal)";
			$arrData = array(
							$this->strNombre,
							$this->strDireccion
										);
			$request = $this->update($sql,$arrData);
			
		}else{
	        $request = false;
	    }
		return $request;
	
	}
	public function deleteSucursal($intIdSucursal)
	{
		
		$this->intIdSucursal = $intIdSucursal;

		 //$sql = "UPDATE usuarios SET status = ? WHERE idUsuario = $intIdUser";
        //$sql="CALL CRUD_SUCURSAL(null,null,'D',?)";
		//$arrData = array($this->intIdSucursal);
		/* $request = $this->update($sql, $arrData);
		return $request;  */

		 $sql="SELECT * FROM `TBL_USUARIOS` WHERE COD_SUCURSAL=$intIdSucursal";
        $request = $this->select_all($sql);
        if(empty($request))
		{
            $sql = "CALL CRUD_SUCURSAL(null,null,'D',$this->intIdSucursal)";
        
            $arrData = array($this->intIdSucursal);
            $request = $this->Delete($sql, $arrData);
            
        }else{
            $request=false;
        }
        return $request; 
		
	}

}
?>