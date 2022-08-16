<?php  /*
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

Programa:          Módulo Categorias
Fecha:             09-Marzo-2022
Programador:       Hugo Alejandro Paz Izaguirre
descripción:       Administra las categorías de los productos que se 
                   se muestran en la tienda
-----------------------------------------------------------------------*/
    
    class CategoriasModel extends Mysql{
        public $intIdcategoria;
		public $strCategoria;
		public $strDescripcion;
		public $intStatus;
		public $strPortada;
		public $strRuta;
		public $user;
        public function __construct()
        {
           parent::__construct();
        }
        public function insertCategoria(string $nombre, string $descripcion, string $portada, string $ruta,int $status, int $user){

			$return = 0;
			$this->strCategoria = $nombre;
			$this->strDescripcion = $descripcion;
			$this->strPortada = $portada;
			$this->strRuta = $ruta;
			$this->intStatus = $status;
			$this->intUser = $user;


			//validación 

			/* $sql = "SELECT * FROM TBL_CATEGORIA WHERE nombre = '{$this->strCategoria}' "; */
			$sql="CALL CRUD_CATEGORIA(null,null,'{$this->strCategoria}',null,null,null,null,null,'A',null)";
			$request = $this->select_all($sql);
            /* dep($sql);
			exit; */
			if(empty($request))
			{
				/* $query_insert  = "INSERT INTO categoria(nombre,descripcion,portada,status) VALUES(?,?,?,?)";
	        	$arrData = array($this->strCategoria, 
								 $this->strDescripcion, 
								 $this->strPortada,
								 //$this->strRuta, 
								 $this->intStatus); */
				$query_insert  = 'CALL CRUD_CATEGORIA(?,?,?,?,?,?,?,?,?,?)';
	        	$arrData = array($this->intStatus, 
								 $this->strDescripcion, 
								 $this->strCategoria,
								 $this->strPortada,
								 $this->intUser,
								 0,
								 $this->strRuta, NOW(),
								 'I',
								 "null"
								 );
	        	$request_insert = $this->insert($query_insert,$arrData);
				$sql = "SELECT last_insert_id()";
				$request_ID = $this->select($sql);
				
			
	        	$return = $request_ID['last_insert_id()'];
				/* $sql = "CALL CRUD_CATEGORIA({$this->intStatus}, '{$this->strDescripcion}','{$this->strCategoria}','{$this->strPortada}','I',null)";
			$request_insert = $this->select($sql);
			
			$return = $request_insert["id"]; */
			}else{
				$return = false;
			}
			return $return;
		}
		public function selectCategorias()
		{
			/* $sql = "SELECT * FROM categoria 
					WHERE status != 0 "; */
			$sql = 'CALL CRUD_CATEGORIA(null,null,null,null,null,null,null,null,"V",null)';
			$request = $this->select_all($sql);
			
			return $request;

		}
		public function selectCategoria(int $idcategoria){
			$this->intIdcategoria = $idcategoria;
			//$sql = "SELECT * FROM categoria WHERE idcategoria = $this->intIdcategoria";
			$sql="CALL CRUD_CATEGORIA(null,null,null,null,null,null,null,null,'R',{$this->intIdcategoria})";
			$request = $this->select($sql);
			
			return $request;
		}

		public function updateCategoria(int $idcategoria, string $categoria, string $descripcion, string $portada,string $ruta, int $status,int $user){

			$this->intIdcategoria = $idcategoria;
			$this->strCategoria = $categoria;
			$this->strDescripcion = $descripcion;
			$this->strPortada = $portada;
			$this->strRuta = $ruta;
			$this->intStatus = $status;
			$this->intUser = $user;
			
			//Validación update
			/* $sql = "SELECT * FROM TBL_CATEGORIA WHERE nombre = '{$this->strCategoria}' AND COD_CATEGORIA != $this->intIdcategoria";
			 */
			$sql="CALL CRUD_CATEGORIA(null,null,'{$this->strCategoria}',null,null,null,null,null,'B',$this->intIdcategoria)";
			/* dep($sql);
			exit; */
			$request = $this->select_all($sql);

			if(empty($request))
			{
				
				$sql = "CALL CRUD_CATEGORIA(?,?,?,?,?,?,?,?,?,?)"; 	
	        	$arrData = array($this->intStatus,
								 $this->strDescripcion, 
								 $this->strCategoria, 
								 $this->strPortada,
								 null,
								 $this->intUser,
								 $this->strRuta, NOW(),
								 "U",
								 $this->intIdcategoria
								 );
	        	$request = $this->update($sql,$arrData);
				
				/* dep($arrData);
				exit; */
	        	/* $sql = "CALL CRUD_CATEGORIA({$this->intStatus}, '{$this->strDescripcion}','{$this->strCategoria}','{$this->strPortada}','U',){$this->intIdcategoria}";
			$request_insert = $this->select($sql); */
			
			//$request = $request_insert["id"];
			}else{
				$request = false;
			}
			return $request;
		}

		public function deleteCategoria(int $idcategoria)
		{
			$this->intIdcategoria = $idcategoria;
			$sql="CALL CRUD_CATEGORIA(null,null,null,null,null,null,null,null,'F','$this->intIdcategoria')";
			//$sql = "SELECT * FROM TBL_PRODUCTOS WHERE COD_CATEGORIA = $this->intIdcategoria";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				/* $sql = "UPDATE categoria SET status = ? WHERE idcategoria = $this->intIdcategoria ";
				$arrData = array(0);
				$request = $this->update($sql,$arrData);
				dep($request);
                exit; */
				$sql = "CALL CRUD_CATEGORIA(null,null,null,null,null,null,null,null,?,'$this->intIdcategoria')";
				$arrData = array("D");
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

		public function getCategoriasFooter(){
			$sql = "SELECT COD_CATEGORIA, NOMBRE, DESCRIPCION, PORTADA, RUTA
					FROM TBL_CATEGORIA WHERE  COD_STATUS = 1 AND COD_CATEGORIA IN (".CAT_FOOTER.")";
			$request = $this->select_all($sql);
			if(count($request) > 0){
				for ($c=0; $c < count($request) ; $c++) { 
					$request[$c]['PORTADA'] = BASE_URL.'/Assets/images/uploads/'.$request[$c]['PORTADA'];		

					 
				}
			}
			return $request;
		}

    }

?>