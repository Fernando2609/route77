<?php  
    //Fernadno 23/10/2021
    class SucursalesModel extends Mysql{
		private $intIdSucursal;
        private $strNombre;
		private $strDireccion;
		
        public function __construct()
        {
           parent::__construct();
        }
        public function insertSucursales(string $nombre, string $direccion){
		
			$this->strNombre = $nombre;
			$this->strDireccion = $direccion;
			
			$return = 0;
			
		
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
			//$sql="Select * from tbl_sucursal";
			$request = $this->select_all($sql);
			/* dep($request);
			exit; */
			return $request;

		}

		public function selectSucursal(int $idSucursal){
			$this->intIdSucursal = $idSucursal;
			/* $sql = "SELECT u.idUsuario,u.dni,u.nombres,u.apellidos,u.telefono,
			u.email,u.datecreated,DATE_FORMAT(u.datecreated,'%d-%m-%Y %r') as fechaRegistro,
			DATE_FORMAT(u.fechaNacimiento,'%d-%m-%Y') as fechaNacimiento, DATE_FORMAT(u.fechaNacimiento,'%Y-%m-%d') as fechaNaci,u.status,DATE_FORMAT(u.datelogin,'%d-%m-%Y %r') as datelogin,DATE_FORMAT(u.datemodificado,'%d-%m-%Y %r') as datemodificado ,
			s.idsucursal,s.nombre as 'sucursal',r.Id_Rol,r.nombreRol, 
			n.idNacionalidad,n.descripcion as 'nacionalidad',g.idGenero, g.descripcion as 'genero',
			e.idEstado,e.descripcion as 'estadocivil' 
			FROM usuarios u 
			INNER JOIN roles r ON u.idRol = r.Id_Rol 
			INNER JOIN nacionalidad n ON u.idNacionalidad = n.idNacionalidad 
			INNER JOIN genero g on u.idGenero = g.idGenero 
			INNER JOIN sucursal s on u.idSucursal = s.idsucursal 
			INNER JOIN estadocivil e on u.idEstadoCivil = e.idEstado 
			WHERE u.idUsuario = $this->intIdUsuario"; */

			$sql="CALL CRUD_SUCURSAL(null,null,'R',$this->intIdSucursal)";
			
			$request = $this->select($sql);
			
			return $request;
		}
    //}

	public function updateSucursal(int $idSucursal, string $nombre, string $direccion){
			
		$this->intIdSucursal = $idSucursal;
		$this->strNombre = $nombre;
		$this->strDireccion = $direccion;
		
		$sql="SELECT * FROM tbl_sucursal
		WHERE NOMBRE='$this->strNombre'  and COD_SUCURSAL!='$this->intIdSucursal'";

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
        $sql="CALL CRUD_SUCURSAL(null,null,'D',?)";
		$arrData = array($this->intIdSucursal);
		$request = $this->update($sql, $arrData);
		return $request;
	}

}
?>