<?php
require_once("Libraries/Core/Mysql.php");
  trait TTIpoPago{
      private $con;

      public function getTiposPagoT(){
		$this->con = new Mysql();
		$sql = "SELECT * FROM tipo_pago WHERE status != 0";
		$request = $this->con->select_all($sql);
		return $request;
	}

   }
?>