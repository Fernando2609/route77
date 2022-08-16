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

Programa:          Módulo Roles
Fecha:             01-Marzo-2022
Programador:       Reynaldo Jafet Giron Tercero
descripción:       Administra los diferentes roles y administra los permisos de la empresa

-----------------------------------------------------------------------*/
    
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
			$whereAdmin = "";
			$idUser=$_SESSION['idUser'];
			if($_SESSION['idUser'] != 1){
				$whereAdmin = " and COD_ROL != 1 ";
			}
			// Extraer roles
			//$sql = "SELECT * FROM TBL_ROLES WHERE COD_STATUS != 0".$whereAdmin;
			$sql="CALL CRUD_ROLES(null, null, null,'V',$idUser)";
			$request = $this->select_all($sql); 
			return $request;

        }
        public function selectRol(int $idrol)
        {
            //BUSCAR ROL
			$this->intIdrol = $idrol;
			/* $sql ="CALL CRUD_ROLES(null, null, null,'R', ?);" */
			/* $sql = "SELECT * FROM TBL_ROLES WHERE COD_ROL = $this->intIdrol"; */
			$sql = "CALL CRUD_ROLES(null, null, null,'R',$this->intIdrol)";
			/* $arrData = array($this->intIdrol); */
			$request = $this->select($sql);
			/* dep($request);
			exit; */
			return $request;
			
        }

        public function insertRol(string $rol, string $descripcion, int $status){

            $return="";
            $this->strRol = $rol;
            $this->strDescripcion = $descripcion;
            $this->intStatus = $status;
            
            /* CRUD DE INSERT ROL PRIMERA CONDICION DE VERIFICACION */
           /*  $sql = "SELECT * FROM TBL_ROLES WHERE NOM_ROL =  '{$this->strRol}'"; */
		    $sql = "CALL CRUD_ROLES('{$this->strRol}', null, null,'A',null)";
            $request = $this->select_all($sql);
            
            if(empty($request))
			{
				/* $query_insert = "INSERT INTO TBL_ROLES(NOM_ROL, DESCRIPCION, status) VALUES(?,?,?)"; */
				$query_insert="CALL CRUD_ROLES(?, ?, ?,'I',null)";
				$arrData = array($this->strRol, $this->strDescripcion, $this->intStatus);
                $request_insert= $this->insert($query_insert, $arrData);
				$sql = "SELECT last_insert_id()";
				$request_ID = $this->select($sql);
	        	$return = $request_ID['last_insert_id()'];
				
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
            
			/* CRUD DE UPDATE ROL PRIMERA CONDICION DE VERIFICACION */
			/* $sql = "SELECT * FROM TBL_ROLES WHERE NOM_ROL = '$this->strRol' AND COD_ROL != $this->intIdrol"; */
			$sql = "CALL CRUD_ROLES('{$this->strRol}', null, null,'B','{$this->intIdrol}')";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				/* $sql = "UPDATE TBL_ROLES SET NOM_ROL = ?, DESCRIPCION = ?, COD_STATUS = ? WHERE COD_ROL = $this->intIdrol "; */
				$sql = "CALL CRUD_ROLES(?, ?, ?,'U',$this->intIdrol)";
				$arrData = array($this->strRol, $this->strDescripcion, $this->intStatus);
				$request = $this->update($sql,$arrData);
				/* dep($request);
				exit; */
			}else{
				$request = false;
			}
		    return $request;			
		}

        public function deleteRol(int $idrol)
		{
			$this->intIdrol = $idrol;
			/* CRUD DE DELETE ROL PRIMERA CONDICION DE VERIFICACION */
			/* $sql = "SELECT * FROM TBL_PERSONAS WHERE COD_ROL = $this->intIdrol"; */
			$sql = "CALL CRUD_ROLES(null, null, null,'C',$this->intIdrol)";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				/* $sql = "UPDATE TBL_ROLES SET COD_STATUS = ? WHERE COD_ROL = $this->intIdrol "; */
				$sql = "CALL CRUD_ROLES(?, ?, ?,'D',$this->intIdrol)";
				/* $arrData = array(0); */
				$arrData = array($this->strRol, $this->strDescripcion, $this->intStatus);
				$request = $this->update($sql,$arrData);
				/* dep($request);
				exit; */
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
			$sql = "SELECT * FROM TBL_GENERO";
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
			  $sql = "SELECT * FROM TBL_SUCURSAL";
			  $request = $this->select_all($sql); 
			  return $request;
  
		  }
    }   

	
?>
    
   