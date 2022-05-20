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
            /* $sql = "SELECT idUsuario, status FROM usuarios WHERE
            email = '$this->strUsuario' and
            contraseña = '$this->strPassword' and
            status !=0"; */
            /* $sql="SELECT COD_PERSONA, COD_STATUS FROM TBL_PERSONAS WHERE email =  '$this->strUsuario' and contraseña = '$this->strPassword' and COD_STATUS !=0"; */
            $sql="CALL LOGIN('$this->strUsuario','$this->strPassword',null,'V',null)";
           
            $request = $this->select($sql);
            return $request;
        } 
        public function sessionLogin(int $iduser)
        {
            $this->intIdUsuario=$iduser;
           /*  $sql="SELECT u.idUsuario,u.dni,u.nombres,u.apellidos,u.telefono, u.datemodificado,u.datelogin,
			u.email,u.datecreated, DATE_FORMAT(u.datecreated,'%d-%m-%Y') as fechaRegistro,
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
			WHERE u.idUsuario =  $this->intIdUsuario"; */
            $sql="CALL LOGIN(null,null,null,'S', $this->intIdUsuario)";
            $request=$this->select($sql);
            $_SESSION['userData']=$request;
            return $request;
        }
        public function sessionUpdate(int $iduser)
        {
            $this->intIdUsuario = $iduser;
			
			//$sql = "UPDATE usuarios SET datelogin = ? WHERE idUsuario = $this->intIdUsuario ";
			/* $sql = "UPDATE TBL_PERSONAS SET DATE_LOGIN = ? WHERE COD_PERSONA = $this->intIdUsuario "; */
            $sql="CALL LOGIN(null,null,null,'L',?)";
			$arrData = array($this->intIdUsuario);
			$request = $this->update($sql,$arrData);
			return $request;
        }
        public function getUserEmail(string $email)
        {
            $this->strUsuario = $email;
			/* $sql = "SELECT idUsuario,nombres,apellidos,status FROM usuarios WHERE 
					email = '$this->strUsuario' and  
					status = 1"; */
            $sql="CALL LOGIN('$this->strUsuario',null,null,'R',null)";
			$request = $this->select($sql);
			return $request;
        }
        public function setTokenUser(int $idUsuario, string $token){
			$this->intIdUsuario = $idUsuario;
			$this->strToken = $token;
			/* $sql = "UPDATE usuarios SET token = ? WHERE idUsuario = $this->intIdUsuario "; */
            $sql="CALL LOGIN(null,null,?,'T',$this->intIdUsuario)";
			$arrData = array($this->strToken);
			$request = $this->update($sql,$arrData);
           
           
			return $request;
		}
        public function getUsuario(string $email, string $token)
        {
            $this->strUsuario = $email;
			$this->strToken = $token;
			/* $sql = "SELECT idUsuario FROM usuarios WHERE 
					email = '$this->strUsuario' and 
					token = '$this->strToken' and 					
					status = 1 "; */
            $sql="CALL LOGIN('$this->strUsuario',null,'$this->strToken','C',null)";
			$request = $this->select($sql);
           
			return $request;
        }
        public function insertPassword(int $idUsuario, string $password){
			$this->intIdUsuario = $idUsuario;
			$this->strPassword = $password;
			//$sql = "UPDATE usuarios SET contraseña = ?, token = ? WHERE idUsuario = $this->intIdUsuario ";
            $sql="CALL LOGIN(null,?,?,'P',$this->intIdUsuario)";
			$arrData = array($this->strPassword,"");
			$request = $this->update($sql,$arrData);
			return $request;
		}
       
            public function datosEmpresa(){
                
             
                $sqlEmpresa = "call CRUD_EMPRESA(null,null,null,null,null,null,null,null,null,null,null,null,null,'V',null)";
                $requestEmpresa = $this->select($sqlEmpresa);

                $sqlRedSocial = "CALL CRUD_REDES_SOCIALES(1,null,null,'V',null)";
                $requestRedSocial = $this->select_all($sqlRedSocial);

                $sqlSucursales="CALL CRUD_SUCURSAL(null,null,'V',null)";
                $requestSucursales = $this->select_all($sqlSucursales);

                $sqlTelEmpresa = "CALL CRUD_TELEFONO_EMPRESA(1,null,'V',null)";
		        $requestTelEmpresa = $this->select_all($sqlTelEmpresa);

                $request = array('Empresa'=> $requestEmpresa, 'RedSocial'=> $requestRedSocial,'Sucursales'=>$requestSucursales,'TelEmpresa'=>$requestTelEmpresa);
               
                return $request;
              
            }  
            public function selectProductos(){
			
                $sql= 'call CRUD_PRODUCTOS(null,null,null,null,null,null,null,null,null,null,null,"H",null)';
                $request = $this->select_all($sql);


                 
        return $request;
    }	
        }
?>