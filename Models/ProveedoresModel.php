<?php 

class ProveedoresModel extends Mysql{
		
		private $strNombre;
		private $strApellido;
		private $strEmail;
		private $intStatus;
		private $intTipoId;
		private $intTelefono;
		private $strEmpresa;
		private $strRTN;
		private $strUbicacion;
		

        public function __construct()
        {
           parent::__construct();
        }
        public function insertProveedores(string $nombre, string $apellido, string $email, int $status, int $tipoid, int $telefono, string $Empresa, string $RTN, string $Ubicacion, int $user ){
		
			$this->strNombre = $nombre;
			$this->strApellido = $apellido;
			$this->strEmail = $email;
			$this->intStatus = $status;
			$this->intTipoId = $tipoid;
			$this->intTelefono = $telefono;
			$this->strEmpresa = $Empresa;
			$this->strRTN = $RTN;
			$this->strUbicacion = $Ubicacion;
            $this->intUser=$user;
         

			$return = 0;
			
			$sql="SELECT * FROM tbl_personas p
			left join tbl_proveedores pr on p.COD_PERSONA=pr.COD_PERSONA
			WHERE p.email =  '{$this->strEmail}' or pr.RTN = '{$this->strRTN}'";


			//$sql = "SELECT * FROM tbl_personas WHERE email = '{$this->strEmail}'";
			
			//Leo lo arregla
			//or dni = '{$this->strIdentificacion}' 
			$request = $this->select_all($sql);

			if(empty($request))
			{
/* $query_insert  = "INSERT INTO usuarios(nombres,apellidos,email,status,rol,telefono,empresa,rtn,ubicacion,creado_por,modificado_por,modo,cod) 
								  VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)"; */
				$query_insert="CALL CRUD_PROVEEDOR(?,?,?,?,?,?,?,?,?,?,null,'I',null)";
	        	$arrData = array($this->strNombre,
									$this->strApellido,
									$this->strEmail,
									$this->intStatus,
									$this->intTipoId,
									$this->intTelefono,
									$this->strEmpresa,
									$this->strRTN,
									$this->strUbicacion,
									$this->intUser);
									
	        	$request_insert = $this->insert($query_insert,$arrData);
				$sql = "SELECT last_insert_id()";
				$request_ID = $this->select($sql);
	        	$return = $request_ID['last_insert_id()'];

			}else{
				$return = false;
			}
	        return $return;
		}

		public function selectProveedores()
		{
			
			/*$sql = "SELECT idUsuario, dni, nombres, apellidos, telefono, email, status
					FROM usuarios */
            $sql = "CALL CRUD_PROVEEDOR(null,null,null,null,null,null,null,null,null,null,null,'V',null)";
			//WHERE idRol = 7 and status != 0";
			    $request = $this->select_all($sql);
				return $request;
		}

		public function selectProveedor(int $idProveedores){
			$this->intIdProveedores = $idProveedores;
		    $sql= "CALL CRUD_PROVEEDOR(null,null,null,null,null,null,null,null,null,null,null,'R',$this->intIdProveedores)";
			$request = $this->select($sql);
			/*dep(($request));
			exit;*/
			return $request;
		}

		public function updateProveedores(string $nombre, string $apellido, string $email, int $status, int $tipoid, int $telefono, string $Empresa, string $RTN, string $Ubicacion, int $user, int $idProveedores)
		{
	
			$this->strNombre = $nombre;
			$this->strApellido = $apellido;
			$this->strEmail = $email;
			$this->intStatus = $status;
			$this->intTipoId = $tipoid;
			$this->intTelefono = $telefono;
			$this->strEmpresa = $Empresa;
			$this->strRTN = $RTN;
			$this->strUbicacion = $Ubicacion;
            $this->intUser=$user;
			$this->intIdProveedores = $idProveedores;
			
			$sql="SELECT * FROM tbl_personas p
			left join tbl_proveedores pr on p.COD_PERSONA=pr.COD_PERSONA
			WHERE  p.email =  '{$this->strEmail}' and p.COD_PERSONA !=$this->intIdProveedores or pr.RTN = '{$this->strRTN}' AND p.COD_PERSONA !=$this->intIdProveedores";
			$request = $this->select_all($sql);
	        	
			if (empty($request)) 
			{	
				             //(nombres,apellidos,email,status,rol,telefono,empresa,rtn,ubicacion,creado_por,modificado_por,modo,cod) 
				$sql="CALL CRUD_PROVEEDOR(?,?,?,?,?,?,?,?,?,null,?,'U',?)";
	        	$arrData = array($this->strNombre,
				$this->strApellido,
				$this->strEmail,
				$this->intStatus,
				$this->intTipoId,
				$this->intTelefono,
				$this->strEmpresa,
				$this->strRTN,
				$this->strUbicacion,
				$this->intUser,
				$this->intIdProveedores);
	
				
				$request = $this->update($sql, $arrData);
				
				
			} else {
				$request = false;
				
			}
			
			return $request;
			
		}
	
		public function deleteProveedor(int $intIdProveedores)
		{
			$this->intIdProveedores = $intIdProveedores;
			//$sql = "UPDATE usuarios SET status = ? WHERE idUsuario = $intIdUser";
			$sql="CALL CRUD_PROVEEDOR(null,null,null,null,null,null,null,null,null,null,null,'D',?)";
			$arrData = array($this->intIdProveedores);
			$request = $this->update($sql, $arrData);
			return $request;
		}

    }







?>