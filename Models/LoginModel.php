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
            echo $sql = "SELECT idUsuario, status FROM usuarios WHERE
            email = '$this->strUsuario' and
            contraseña = '$this->strPassword' and
            status != 0 ";
            exit;
            $request = $this->select($sql);
            return $request;
        }  
    }

?>