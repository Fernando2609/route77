<?php  
    //Fernadno 23/10/2021
    class OrdenCompraModel extends Mysql{
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
					$sql ="call P_ORDEN_COMPRA(null,null,null,null,null,'A',{$this->intIdProducto})";
			$request = $this->select($sql);
			
			return $request;

		}

    }

?>