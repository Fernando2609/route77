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

Programa:          Módulo de Pedidos
Fecha:             10-Abril-2022
Programador:       Alejandrino Victor García Bustillo
descripción:       Módulo que administra los pedidos realizados por los
                   clientes desde la tienda 

-----------------------------------------------------------------------*/
    class PermisosModel extends Mysql{

        public $intIdpermiso;
		public $intRolid;
		public $intModuloid;
		public $r;
		public $w;
		public $u;
		public $d;
        public function __construct()
        {
           parent::__construct();
        }
        public function selectModulos()
		{
			/* $sql = "SELECT * FROM TBL_MODULO WHERE COD_STATUS != 0"; */
			$sql = "CALL CRUD_MODULOS(null, null, null, null, 'V', null)";
			$request = $this->select_all($sql);
			/* dep($request);
			exit; */
			return $request;
		}
        public function selectPermisosRol(int $idrol)
		{
			$this->intRolid = $idrol;
			/* $sql = "SELECT * FROM TBL_PERMISOS WHERE COD_ROL = $this->intRolid"; */
			$sql = "CALL CRUD_PERMISOS($this->intRolid,null,null,null,null,null,'R',null)";
			$request = $this->select_all($sql);
			/* dep($request);
			exit; */
			return $request;
		}
		public function deletePermisos(int $idrol)
		{
			$this->intRolid = $idrol;
			/* $sql = "DELETE FROM TBL_PERMISOS WHERE COD_ROL = $this->intRolid"; */
			$sql = "CALL CRUD_PERMISOS($this->intRolid,null,null,null,null,null,'D',null)";
			$request = $this->delete($sql);
			/* dep($request);
			exit; */
			return $request;
		}
		public function insertPermisos(int $idrol, int $idmodulo, int $r, int $w, int $u, int $d){
			$this->intRolid = $idrol;
			$this->intModuloid = $idmodulo;
			$this->r = $r;
			$this->w = $w;
			$this->u = $u;
			$this->d = $d;
			/* $query_insert  = "INSERT INTO TBL_PERMISOS(COD_ROL,COD_MODULO,R,W,U,D) VALUES(?,?,?,?,?,?)"; */
			$query_insert = "CALL CRUD_PERMISOS($this->intRolid,$this->intModuloid,?,?,?,?,'I',null)";
        	$arrData = array($this->r, $this->w, $this->u, $this->d);
        	$request_insert = $this->insert($query_insert,$arrData);
			$sql = "SELECT last_insert_id()";
			$request_ID = $this->select($sql);
			$request_insert = $request_ID['last_insert_id()'];		
	        return $request_insert;
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
		public function permisosModulo(int $idrol){
			$this->intRolid = $idrol;
			/* $sql = "SELECT p.rolid,
			               p.moduloid,
						   m.titulo as modulo,
						   p.r,
						   p.w,
						   p.u,
						   p.d
					FROM permisos p
					INNER JOIN modulo m
					ON p.moduloid = m.idmodulo
					WHERE p.rolid = $this->intRolid"; */
			/* $sql="SELECT p.COD_ROL, p.COD_MODULO, m.NOMBRE as modulo, p.r, p.w, p.u, p.d FROM TBL_PERMISOS p INNER JOIN TBL_MODULO m ON p.COD_MODULO = m.COD_MODULO WHERE p.COD_ROL = $this->intRolid";
			 */
			//VALIDACIÓN
			$sql="CALL CRUD_PERMISOS(null,null,null,null,null,null,'A',$this->intRolid)";
			
			$request = $this->select_all($sql);
			$arrPermisos = array();

			for ($i=0; $i < count($request); $i++) { 
				$arrPermisos[$request[$i]['COD_MODULO']] = $request[$i];
			}
			return $arrPermisos;

		}
    }

?>