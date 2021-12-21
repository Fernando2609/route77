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
                                $this->intNacionalidad,
                                $this->intGenero,
                                $this->intEstadoC,
        						$this->intTipoId,
                                $this->intSucursal,
                                $this->strFechaNacimiento,
        						$this->intStatus,
        						$this->intTelefono);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = false;
			}
	        return $return;
		}
        
		public function selectUsuarios()
		{
			$whereAdmin = "";
			$sql = "SELECT u.idUsuario,u.dni,u.nombres,u.apellidos,u.telefono,u.email,u.status,r.Id_Rol,r.nombreRol, n.descripcion, g.descripcion 
					FROM usuarios u 
					INNER JOIN roles r ON u.idRol = r.Id_Rol
					INNER JOIN nacionalidad n ON u.idNacionalidad = n.idNacionalidad
					INNER JOIN genero g on u.idGenero = g.idGenero
					WHERE u.status != 0";
					$request = $this->select_all($sql);
					return $request;
		}
		public function selectUsuario(int $idUsuario){
			$this->intIdUsuario = $idUsuario;
			$sql = "SELECT u.idUsuario,u.dni,u.nombres,u.apellidos,u.telefono,
			u.email,DATE_FORMAT(u.datecreated,'%d-%m-%Y') as fechaRegistro,
			DATE_FORMAT(u.fechaNacimiento,'%d-%m-%Y') as fechaNacimiento, DATE_FORMAT(u.fechaNacimiento,'%Y-%m-%d') as fechaNaci,u.status,
			s.idsucursal,s.nombre as 'sucursal',r.Id_Rol,r.nombreRol, 
			n.idNacionalidad,n.descripcion as 'nacionalidad',g.idGenero, g.descripcion as 'genero',
			e.idEstado,e.descripcion as 'estadocivil' 
			FROM usuarios u 
			INNER JOIN roles r ON u.idRol = r.Id_Rol 
			INNER JOIN nacionalidad n ON u.idNacionalidad = n.idNacionalidad 
			INNER JOIN genero g on u.idGenero = g.idGenero 
			INNER JOIN sucursal s on u.idSucursal = s.idsucursal 
			INNER JOIN estadocivil e on u.idEstadoCivil = e.idEstado 
			WHERE u.idUsuario = $this->intIdUsuario";
			
			$request = $this->select($sql);
			return $request;
		}
		public function updateUsuario(int $idUsuario, string $identificacion, string $nombre, string $apellido, int $telefono, string $email, string $password, int $tipoid, int $status, int $nacionalidad, int $genero, int $estadoC, int $sucursal, string $fechaNacimeinto ){

			$this->intIdUsuario = $idUsuario;
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

			$sql = "SELECT * FROM usuarios WHERE (email = '{$this->strEmail}' AND idUsuario != $this->intIdUsuario)
										  OR (dni = '{$this->strIdentificacion}' AND idUsuario != $this->intIdUsuario) ";
			$request = $this->select_all($sql);

			if(empty($request))
			{	//Si la contraseña es diferente a vaacio se actualiza la contraseña
				if($this->strPassword  != "")
				{
					$sql = "UPDATE usuarios SET dni=?,nombres=?,apellidos=?,email=?,contraseña=?,idNacionalidad=?,idGenero=?,idEstadoCivil=?,idRol=?,idSucursal=?,fechaNacimiento=?,status=?,telefono=?
							WHERE idUsuario = $this->intIdUsuario ";
					$arrData = array($this->strIdentificacion,
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
									$this->intStatus,
									$this->intTelefono);
				}else{
					$sql = "UPDATE usuarios SET dni=?,nombres=?,apellidos=?,email=?,idNacionalidad=?,idGenero=?,idEstadoCivil=?,idRol=?,idSucursal=?,fechaNacimiento=?,status=?,telefono=?
					WHERE idUsuario = $this->intIdUsuario ";
					$arrData = array($this->strIdentificacion,
									$this->strNombre,
									$this->strApellido,
									$this->strEmail,
									//$this->strPassword,
									$this->intNacionalidad,
									$this->intGenero,
									$this->intEstadoC,
									$this->intTipoId,
									$this->intSucursal,
									$this->strFechaNacimiento,
									$this->intStatus,
									$this->intTelefono);
				}
				$request = $this->update($sql,$arrData);
			}else{
				$request = false;
			}
			return $request;
		
		}
    }

?>