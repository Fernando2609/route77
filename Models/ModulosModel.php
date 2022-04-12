<?php
    class ModulosModel extends Mysql{

        public $intIdModulo;
        public $strModulo;
        public $strDescripcion;
        public $intStatus;

        public function __construct()
        {
           parent::__construct();
        }

        public function SelectModulos()
        {
			//$whereAdmin = "";
			/* if($_SESSION['idUser'] != 1){
				$whereAdmin = " and COD_MODULO != 1 ";
			} */
			// Extraer Modulos
			//$sql = "SELECT * FROM tbl_modulo WHERE COD_STATUS != 0";//.$whereAdmin;
            $sql = "Call CRUD_MODULOS(null, null, null, null, 'V', null)";
			$request = $this->select_all($sql); 
			return $request;

        }
        public function selectModulo(int $idModulo)
        {
            //BUSCAR ROL
			$this->intIdModulo = $idModulo;
			/* $sql ="CALL CRUD_ROLES(null, null, null,'R', ?);" */
			/* $sql = "SELECT * FROM tbl_roles WHERE COD_ROL = $this->intIdrol"; */
			//--$sql = "CALL CRUD_ROLES(null, null, null,'R',$this->intIdModulo)";
			/* $arrData = array($this->intIdrol); */
            $sql = "Call CRUD_MODULOS(null, null, null, null, 'R', '{$this->intIdModulo}')";
			$request = $this->select($sql);
			/* dep($request);
			exit; */
			return $request;
			
        }

        public function insertModulo(string $modulo, string $descripcion, int $status){

            $return="";
            $this->strModulo = $modulo;
            $this->strDescripcion = $descripcion;
            $this->intStatus = $status;
            
            /* CRUD DE INSERT MÓDULO PRIMERA CONDICION DE VERIFICACION */
            //$sql = "SELECT * FROM tbl_modulo WHERE NOMBRE =  '{$this->strModulo}'";
            $sql ="CALL CRUD_MODULOS('{$this->strModulo}', null,null,null, 'A',null)";
		    /* $sql = "CALL CRUD_ROLES('{$this->strRol}', null, null,'A',null)"; */
            $request = $this->select_all($sql);
            
            if(empty($request))
			{
				/* $query_insert = "INSERT INTO tbl_roles(NOM_ROL, DESCRIPCION, status) VALUES(?,?,?)"; */
				$query_insert="CALL CRUD_MODULOS(?, ?, ?,null, 'I',null)";
				$arrData = array($this->strModulo, $this->strDescripcion, $this->intStatus);
                $request_insert= $this->insert($query_insert, $arrData);
				$sql = "SELECT last_insert_id()";
				$request_ID = $this->select($sql);
	        	$return = $request_ID['last_insert_id()'];
               /*  dep($request_insert);
                dep($sql);
                exit; */
				
			}else{
				$return = false;
			}
		    return $return;
        }

        public function updateModulo(int $idModulo, string $modulo, string $descripcion, int $status){
			$this->intIdModulo = $idModulo;
			$this->strModulo = $modulo;
			$this->strDescripcion = $descripcion;
			$this->intStatus = $status;
            
			/* CRUD DE UPDATE MÓDULO PRIMERA CONDICION DE VERIFICACION */
            $sql = "Call CRUD_MODULOS('{$this->strModulo}', null, null, null, 'B', '{$this->intIdModulo}');";
			//$sql = "SELECT * FROM tbl_modulo WHERE NOMBRE = '$this->strModulo' AND COD_MODULO != $this->intIdModulo"; 
			//$sql = "CALL CRUD_ROLES('{$this->strRol}', null, null,'B','{$this->intIdrol}')";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				/* $sql = "UPDATE tbl_roles SET NOM_ROL = ?, DESCRIPCION = ?, COD_STATUS = ? WHERE COD_ROL = $this->intIdrol "; */
				$sql = "Call CRUD_MODULOS(?, ?, ?, null, 'U', $this->intIdModulo);";
				$arrData = array($this->strModulo, $this->strDescripcion, $this->intStatus);
				$request = $this->update($sql,$arrData);
				/* dep($request);
				exit; */
			}else{
				$request = false;
			}
		    return $request;			
		}

        public function deleteModulo(int $idModulo)
		{
			$this->intIdModulo = $idModulo;
			/* CRUD DE DELETE MÓDULO PRIMERA CONDICION DE VERIFICACION */
            $sql = "Call CRUD_MODULOS(null, null, null, null, 'C', $this->intIdModulo);";
			//$sql = "SELECT * FROM tbl_modulo WHERE COD_STATUS = $this->intIdModulo";
			//$sql = "CALL CRUD_ROLES(null, null, null,'C',$this->intIdrol)";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				/* $sql = "UPDATE tbl_roles SET COD_STATUS = ? WHERE COD_ROL = $this->intIdrol "; */
				$sql = "Call CRUD_MODULOS(?, ?, ?, null, 'D', $this->intIdModulo);";
				/* $arrData = array(0); */
				$arrData = array($this->strModulo, $this->strDescripcion, $this->intStatus);
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
        
    }
?>