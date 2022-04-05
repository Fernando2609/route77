<?php
class telEmpresaModel extends Mysql{  

		private $intIdUsuario;
		private $intTelefono;
		
        

        public function __construct()
        {
           parent::__construct();
        } 
		
		public function inserttelEmpresa(int $telEmpresa){
			$this->intTelefono = $telEmpresa;
			$return = 0;

			/* $sql = "SELECT * FROM TBL_PERSONAS p 
			left join tbl_cliente c on p.COD_PERSONA=c.COD_PERSONA
			WHERE p.email =  '{$this->strEmail}' ";
			$request = $this->select_all($sql); */

			if(empty($request))
			{
				
				$query_insert= " CALL CRUD_TELEFONO_EMPRESA(1,?,'I',null)";
				$arrData = array($this->intTelefono);
		
	        	$request_insert = $this->insert($query_insert,$arrData);
				$sql = "SELECT last_insert_id()";
				$request_ID = $this->select($sql);
	        	$return = $request_ID['last_insert_id()'];
				
			}else{
				$return = false;
			}
	        return $return;
		}

	public function selecttelEmpresas()
	{

		$sql = "CALL CRUD_TELEFONO_EMPRESA(1,null,'V',null)";
		$request = $this->select_all($sql);
		return $request;
	}

	public function selecttelEmpresa(int $idUsuario)
	{
		$this->intIdUsuario = $idUsuario;

		$sql = "CALL CRUD_TELEFONO_EMPRESA(1,null,'R',$this->intIdUsuario)";

		$request = $this->select($sql);

		return $request;
	}

	public function updatetelEmpresa(int $idUsuario, int $telEmpresa)
	{

		$this->intIdUsuario = $idUsuario;
		$this->intTelefono = $telEmpresa;
		
		/* $sql = "SELECT * FROM TBL_PERSONAS p
		LEFT JOIN tbl_cliente c on p.COD_PERSONA=c.COD_PERSONA
		WHERE p.EMAIL = '{$this->strEmail}' AND p.COD_PERSONA !=$this->intIdUsuario";
		
		$request = $this->select_all($sql);
 */
		if (empty($request)) {	//Si la contraseña es diferente a vaacio se actualiza la contraseña
		
				/*$sql = "UPDATE TBL_CLIENTE SET dni=?,nombres=?,apellidos=?,email=?,contraseña=?,status=?,idNacionalidad=?,idGenero=?,idEstadoCivil=?,fechaNacimiento=?,idSucursal=?,telefono=?,datemodificado=?
							WHERE idUsuario = $this->intIdUsuario ";*/

				$sql = "CALL CRUD_TELEFONO_EMPRESA(1,?,'U',$this->intIdUsuario)";
				$arrData = array(
					
					$this->intTelefono,
					
				);

			$request = $this->update($sql, $arrData);
		} else {
			$request = false;
		}

		return $request;
	}

	public function deletetelEmpresa(int $intIdUser)
	{
		$this->intIdUsuario = $intIdUser;
		/* $sql = "UPDATE usuarios SET status = ? WHERE idUsuario = $intIdUser"; */
		$sql = "CALL CRUD_TELEFONO_EMPRESA(1,null,'D',?)";
		$arrData = array($this->intIdUsuario);
		$request = $this->update($sql, $arrData);
		return $request;
	}


    }
?>