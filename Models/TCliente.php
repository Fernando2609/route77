<?php
require_once("Libraries/Core/Mysql.php");
  trait TCliente{
      private $con;
      private $intIdUsuario;
      private $intIdTransaccion;
      private $strNombre;
      private $strApellido;
      private $intTelefono;
      private $strEmail;
      private $strPassword;
      private $strToken;
      private $intTipoId;
   /*    private $intStatus; */
      private $intNacionalidad;
      private $intGenero;
      private $intEstadoC;
      private $intSucursal; 
     /*  private $strFechaNacimiento; */
     
    public function insertCliente(string $nombre, string $apellido, int $telefono, string $email, string $password, int $tipoid, int $nacionalidad, int $genero, int $estadoC, int $sucursal, string $fechaNacimeinto ){
        $this->con = new Mysql();
        $this->strNombre = $nombre;
        $this->strApellido = $apellido;
        $this->intTelefono = $telefono;
        $this->strEmail = $email;
        $this->strPassword = $password;
        $this->intTipoId = $tipoid;
        
        $this->intNacionalidad = $nacionalidad;
        $this->intGenero = $genero;
        $this->intEstadoC = $estadoC;
          $this->intSucursal = $sucursal; 
        $this->strFechaNacimiento=$fechaNacimeinto;


        $return = 0;

        $sql = "SELECT * FROM usuarios WHERE 
                email = '{$this->strEmail}' ";
        $request =$this->con->select_all($sql);

        if(empty($request))
        {
            $query_insert  = "INSERT INTO usuarios(nombres,apellidos,email,contraseña,idNacionalidad,idGenero,idEstadoCivil,idRol, idSucursal, fechaNacimiento, telefono) 
                              VALUES(?,?,?,?,?,?,?,?,?,?,?)";
            $arrData = array(
                            $this->strNombre,
                            $this->strApellido,
                            $this->strEmail,
                            $this->strPassword,
                            $this->intNacionalidad,
                            $this->intGenero,
                            $this->intEstadoC,
                            $this->intTipoId,
                            $this->intSucursal,  
                            $this->strFechaNacimiento,
                           /*  $this->intStatus, */
                             $this->intTelefono );
            $request_insert = $this->con->insert($query_insert,$arrData);
            $return = $request_insert;
            
        }else{
            $return = false;
        }
        return $return;
    }
    public function SelectNacionalidadCliente()
    {
        $this->con = new Mysql();
    // Extraer Nacionalidad
    $sql = "SELECT * FROM nacionalidad";
    $request = $this->con->select_all($sql); 
    return $request;

    }
    //Funcion para traer el genero de usuario
    public function SelectGeneroCliente()
    { 
        $this->con = new Mysql();
        // Extraer Genero
        $sql = "SELECT * FROM genero";
        $request = $this->con->select_all($sql); 
        return $request;

    }
    //Funcion para traer el Estado Civil
    public function selectEstadoCCliente()
    {
        $this->con = new Mysql();
        // Extraer estado Civil
        $sql = "SELECT * FROM estadocivil";
        $request = $this->con->select_all($sql); 
        return $request;

    }
    public function insertDetalleTemp(array $pedido)
    {
        $this->con = new Mysql();
        $this->intIdUsuario=$pedido['idcliente'];
        $this->intIdTransaccion=$pedido['idtransaccion'];
        $productos=$pedido['productos'];
        $sql = "SELECT * FROM detalle_temp WHERE 
					transaccionid = '{$this->intIdTransaccion}' AND 
					usuarioid = $this->intIdUsuario";
		$request = $this->con->select_all($sql);
        if(empty($request)){
			foreach ($productos as $producto) {
				$query_insert  = "INSERT INTO detalle_temp(usuarioid,productoid,precio,cantidad,transaccionid) 
								  VALUES(?,?,?,?,?)";
	        	$arrData = array($this->intIdUsuario,
	        					$producto['idproducto'],
	    						$producto['precio'],
	    						$producto['cantidad'],
	    						$this->intIdTransaccion
	    					);
	        	$request_insert = $this->con->insert($query_insert,$arrData);
			}
		}else{
			$sqlDel = "DELETE FROM detalle_temp WHERE 
				transaccionid = '{$this->intIdTransaccion}' AND 
				usuarioid = $this->intIdUsuario";
			$request = $this->con->delete($sqlDel);
			foreach ($productos as $producto) {
				$query_insert  = "INSERT INTO detalle_temp(usuarioid,productoid,precio,cantidad,transaccionid) 
								  VALUES(?,?,?,?,?)";
	        	$arrData = array($this->intIdUsuario,
	        					$producto['idproducto'],
	    						$producto['precio'],
	    						$producto['cantidad'],
	    						$this->intIdTransaccion
	    					);
	        	$request_insert = $this->con->insert($query_insert,$arrData);
			}
		}
    }
   }
?>