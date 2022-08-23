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

Programa:          Módulo OrdenCompra
Fecha:             14-May-2022
Programador:       Jose Fernando Ortiz Santos
descripción:       Proceso donde se registran la cantidad de productos 
                   a ingresar al sistema

-----------------------------------------------------------------------*/

    class OrdenCompraModel extends Mysql{
        public $idproducto;
		public $idProveedor;
		public $strDescripcion;
		public $intStatus;
		public $strPortada;
		public $strRuta;
		public $user;
        public function __construct()
        {
           parent::__construct();
        }
        public function selectProducto(int $idproducto){
			$this->intIdProducto = $idproducto;
		/* 	$sql = "SELECT p.idproducto,
							p.codigo,
							p.nombre,
							p.descripcion,
							p.precio,
							p.stock,
							p.categoriaid,
							c.nombre as categoria,
							p.status
					FROM producto p
					INNER JOIN categoria c
					ON p.categoriaid = c.idcategoria
					WHERE idproducto = $this->intIdProducto"; */
					$sql ="call CRUD_ORDEN_COMPRA(null,null,null,null,'A',null,{$this->intIdProducto})";
			$request = $this->select($sql);
		
			return $request;

		}
		public function selectProveedores()
		{
			
			/*$sql = "SELECT idUsuario, dni, nombres, apellidos, telefono, email, status
					FROM usuarios */
            $sql = "CALL CRUD_PROVEEDOR(null,null,null,null,null,null,null,null,null,null,null,null,'V',null)";
			//WHERE idRol = 7 and status != 0";
			    $request = $this->select_all($sql);
				return $request;
		}
		public function insertCompra(int $idProveedor,string $monto,int $isv,int $factura,int $personaid){
			
			/*$sql = "SELECT idUsuario, dni, nombres, apellidos, telefono, email, status
					FROM usuarios */
					$query_insert="CALL CRUD_ORDEN_COMPRA(?,?,?,?,'I',?,null)";
					$arrData = array($idProveedor,
									$monto,
									$isv,
									$factura,
									$personaid);
					
					$request_insert=$this->insert($query_insert, $arrData);
					$return=$request_insert;
					$sql = "SELECT last_insert_id()";
					$request_ID = $this->select($sql);
					$return = $request_ID['last_insert_id()'];
					return $return;
		}
		public function insertDetalle(int $idOrden,string $idproducto, $precio,int $cantidad){
			
			/*$sql = "SELECT idUsuario, dni, nombres, apellidos, telefono, email, status
					FROM usuarios */
					$query_insert="CALL CRUD_DETALLE_COMPRA(?,?,?,?,'I',null)";
					$arrData = array($idOrden,
									$idproducto,
									$precio,
									$cantidad);
						
					
					$request_insert=$this->insert($query_insert, $arrData);
					$return=$request_insert;
					$sql = "SELECT last_insert_id()";
					$request_ID = $this->select($sql);
					$return = $request_ID['last_insert_id()'];
					return $return;
		}
		public function updateStock(int $productoid, int $stock){

			$this->con = new Mysql();
			$this->productoid=$productoid;
			$this->stock=$stock;
			/* $sql = "SELECT * FROM categoria WHERE nombre = '{$this->strCategoria}' AND idcategoria != $this->intIdcategoria";
			$request = $this->select_all($sql); */
			
			if(empty($request))
			{
				//$sql = "UPDATE producto SET stock = ? WHERE idproducto = $this->productoid "; 	
				$sql="CALL INVENTARIO(?,'U',?)";
				$arrData = array($this->stock,$this->productoid);
				$request = $this->con->update($sql,$arrData);
				
			}else{
				$request = false;
			}
			return $request;
		}
		public function updateCantCompra(int $productoid, int $stock){

			$this->con = new Mysql();
			$this->productoid=$productoid;
			$this->stock=$stock;
			/* $sql = "SELECT * FROM categoria WHERE nombre = '{$this->strCategoria}' AND idcategoria != $this->intIdcategoria";
			$request = $this->select_all($sql); */
			
			if(empty($request))
			{
				//$sql = "UPDATE producto SET stock = ? WHERE idproducto = $this->productoid "; 	
				$sql="CALL INVENTARIO(?,'C',?)";
				$arrData = array($this->stock,$this->productoid);
				$request = $this->con->update($sql,$arrData);
				
			}else{
				$request = false;
			}
			return $request;
		
		}
		public function selectID(int $COD_BARRA)
		{
			/* $sql = "SELECT * FROM categoria 
					WHERE status != 0 "; */
			$sql = "SELECT COD_PRODUCTO FROM TBL_PRODUCTOS WHERE COD_BARRA = {$COD_BARRA}";
			$request = $this->select($sql);
			
			return $request;

		}

		
    }

?>