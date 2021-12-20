<?php  
    //Fernadno 23/10/2021
    class UsuariosModel extends Mysql{
        private $intIdUsuario;
		private $strIdentificacion;
		private $strNombre;
		private $strApellido;
		private $intTelefono;
		private $strEmail;
		private $strPassword;
		private $strToken;
		private $intTipoId;
		private $intStatus;
        private $intNacionalidad;
        private $intGenero;
        private $intEstadoC;
        private $intSucursal;
        private $strFechaNacimiento;
        public function __construct()
        {
           parent::__construct();
        }
        public function insertUsuario(string $identificacion, string $nombre, string $apellido, int $telefono, string $email, string $password, int $tipoid, int $status, int $nacionalidad, int $genero, int $estadoC, int $sucursal, string $fechaNacimeinto ){

			$this->strIdentificacion = $identificacion;
			$this->strNombre = $nombre;
			$this->strApellido = $apellido;
			$this->intTelefono = $telefono;
			$this->strEmail = $email;
			$this->strPassword = $password;
			$this->intTipoId = $tipoid;
			$this->intStatus = $status;
            $this->intNacionalidad = $nacionalidad;
            $this->intGenero = $genero;
            $this->intEstadoC = $estadoC;
            $this->intSucursal = $sucursal;
            $this->strFechaNacimiento=$fechaNacimeinto;


			$return = 0;

			$sql = "SELECT * FROM usuarios WHERE 
					email = '{$this->strEmail}' or dni = '{$this->strIdentificacion}' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO usuarios(dni,nombres,apellidos,email,contraseña,idNacionalidad,idGenero,idEstadoCivil,idRol,idSucursal,fechaNacimiento,status,telefono) 
								  VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
	        	$arrData = array($this->strIdentificacion,
        						$this->strNombre,
        						$this->strApellido,
        						$this->strEmail,
        						$this->strPassword,
                                $this->intNacionalidad = $nacionalidad,
                                $this->intGenero = $genero,
                                $this->intEstadoC = $estadoC,
        						$this->intTipoId,
                                $this->intSucursal = $sucursal,
                                $this->strFechaNacimiento=$fechaNacimeinto,
        						$this->intStatus,
        						$this->intTelefono);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = false;
			}
	        return $return;
		}
        
    }

?>