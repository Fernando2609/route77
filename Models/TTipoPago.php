<?php
require_once("Libraries/Core/Mysql.php");
  trait TTIpoPago{
      private $con;

      public function getTiposPagoT(){
		$this->con = new Mysql();
		$sql = "SELECT * FROM TBL_TIPO_PAGO WHERE COD_STATUS != 0";
		$request = $this->con->select_all($sql);
		return $request;

	}
	public function getTiposEstadoT(){
		$this->con = new Mysql();
		$sql = "SELECT * FROM TBL_TIPO_ESTADO ";
		$request = $this->con->select_all($sql);
		return $request;
		
	}

   }
?>