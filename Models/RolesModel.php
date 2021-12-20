<?php  
    
    class RolesModel extends Mysql{

        public $intIdrol;
        public $strRol;
        public $strDescripcion;
        public $intStatus;

        public function __construct()
        {
           parent::__construct();
        }

        public function SelectRoles()
        {
        // Extraer roles
        $sql = "SELECT * FROM roles WHERE status != 0";
        $request = $this->select_all($sql); 
        return $request;

        }
        public function selectRol(int $idrol)
        {
            //BUSCAR ROL
			$this->intIdrol = $idrol;
			$sql = "SELECT * FROM roles WHERE id_Rol = $this->intIdrol";
			$request = $this->select($sql);
			return $request;
        }

        public function insertRol(string $rol, string $descripcion, int $status){

            $return="";
            $this->strRol = $rol;
            $this->strDescripcion = $descripcion;
            $this->intStatus = $status;
            

            $sql = "SELECT * FROM roles WHERE nombreRol =  '{$this->strRol}'";
            $request = $this->select_all($sql);
         
            if(empty($request))
			{
				$query_insert = "INSERT INTO roles(nombreRol, descripcion, status) VALUES(?,?,?)";
				$arrData = array($this->strRol, $this->strDescripcion, $this->intStatus);
                $request_insert= $this->insert($query_insert, $arrData);
				$return = $request_insert;
			}else{
				$return = false;
			}
		    return $return;
        }
        public function updateRol(int $idrol, string $rol, string $descripcion, int $status){
			$this->intIdrol = $idrol;
			$this->strRol = $rol;
			$this->strDescripcion = $descripcion;
			$this->intStatus = $status;

			$sql = "SELECT * FROM roles WHERE nombreRol = '$this->strRol' AND id_Rol != $this->intIdrol";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE roles SET nombreRol = ?, descripcion = ?, status = ? WHERE id_Rol = $this->intIdrol ";
				$arrData = array($this->strRol, $this->strDescripcion, $this->intStatus);
				$request = $this->update($sql,$arrData);
			}else{
				$request = false;
			}
		    return $request;			
		}

        public function deleteRol(int $idrol)
		{
			$this->intIdrol = $idrol;
			$sql = "SELECT * FROM usuarios WHERE idRol = $this->intIdrol";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "UPDATE roles SET status = ? WHERE id_Rol = $this->intIdrol ";
				$arrData = array(0);
				$request = $this->update($sql,$arrData);
				if($request)
				{
					$request = true;	
				}else{
					$request = false;
				}
			}else{
				$request = false;
			}
			return $request;
		}




		/* 
        ESTO DE ACABA ABAJO DEBERA DE CAMBIARSE DE LUGAR EN UN FUTURO
        
        */

        //Funcion para traer las nacionalidades de usuario
		
        public function SelectNacionalidad()
        {
        // Extraer Nacionalidad
        $sql = "SELECT * FROM nacionalidad";
        $request = $this->select_all($sql); 
        return $request;

        }
		 //Funcion para traer el genero de usuario
		public function SelectGenero()
		{
			// Extraer Genero
			$sql = "SELECT * FROM genero";
			$request = $this->select_all($sql); 
			return $request;

		}
		 //Funcion para traer el Estado Civil
		 public function selectEstadoC()
		 {
			 // Extraer estado Civil
			 $sql = "SELECT * FROM estadocivil";
			 $request = $this->select_all($sql); 
			 return $request;
 
		 }
		  //Funcion para traer la sucursal
		  public function selectSucursal()
		  {
			  // Extraer estado Civil
			  $sql = "SELECT * FROM sucursal";
			  $request = $this->select_all($sql); 
			  return $request;
  
		  }
    }   

	
   


?>
    
   