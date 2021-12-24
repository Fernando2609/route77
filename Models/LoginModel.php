<?php  
class LoginModel extends Mysql{
    private $intIdUsuario;
    private $strUsuario;
    private $strPassword;
    private $strToken;

        public function __construct()
        {
           parent::__construct();
        }

        public function loginUser(string $usuario, string $password){
            
            $this->strUsuario = $usuario;
            $this->strPassword = $password;
            $sql = "SELECT idUsuario, status FROM usuarios WHERE
            email = '$this->strUsuario' and
            contraseña = '$this->strPassword' and
            status !=0";
            
            $request = $this->select($sql);
            return $request;
        } 
        public function sessionLogin(int $iduser)
        {
            $this->intIdUsuario=$iduser;
            $sql="SELECT u.idUsuario,u.dni,u.nombres,u.apellidos,u.telefono, u.datemodificado,u.datelogin,
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
			WHERE u.idUsuario =  $this->intIdUsuario";
            $request=$this->select($sql);
            return $request;
        }
        public function sessionUpdate(int $iduser)
        {
            $this->intIdUsuario = $iduser;
			
			$sql = "UPDATE usuarios SET datelogin = ? WHERE idUsuario = $this->intIdUsuario ";
			$arrData = array(NOW());
			$request = $this->update($sql,$arrData);
			return $request;
        }
        public function getUserEmail(string $email)
        {
            $this->strUsuario = $email;
			$sql = "SELECT idUsuario,nombres,apellidos,status FROM usuarios WHERE 
					email = '$this->strUsuario' and  
					status = 1";
			$request = $this->select($sql);
			return $request;
        }
        public function setTokenUser(int $idUsuario, string $token){
			$this->intIdUsuario = $idUsuario;
			$this->strToken = $token;
			$sql = "UPDATE usuarios SET token = ? WHERE idUsuario = $this->intIdUsuario ";
			$arrData = array($this->strToken);
			$request = $this->update($sql,$arrData);
			return $request;
		}
        public function getUsuario(string $email, string $token)
        {
            $this->strUsuario = $email;
			$this->strToken = $token;
			$sql = "SELECT idUsuario FROM usuarios WHERE 
					email = '$this->strUsuario' and 
					token = '$this->strToken' and 					
					status = 1 ";
			$request = $this->select($sql);
			return $request;
        }
        public function insertPassword(int $idUsuario, string $password){
			$this->intIdUsuario = $idUsuario;
			$this->strPassword = $password;
			$sql = "UPDATE usuarios SET contraseña = ?, token = ? WHERE idUsuario = $this->intIdUsuario ";
			$arrData = array($this->strPassword,"");
			$request = $this->update($sql,$arrData);
			return $request;
		}
       
            public function datosEmpresa(){
                
             
                $sql = "SELECT * FROM empresa";
                $request = $this->select($sql);
                return $request;
              
            }  
        }


?>