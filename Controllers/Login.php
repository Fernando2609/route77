<?php  
    class Login extends Controllers{
        public function __construct()
        {
            parent::__construct();
            
        }
        
        public function login()
        {
           
            $data['page_tag']="Login - Route 77";
            $data['page_title']="LOGIN ESTACIÓN ROUTE 77";
            $data['page_name']="login";
            $data['page_functions_js']="functions_login.js";
            $this->views->getView($this,"login",$data);
        }
        public function loginUser(){
           // dep($_POST);
           if($_POST){
               if(empty($_POST['txtEmail']) || empty($_POST['txtPassword'])){
                   $arrResponse = array('status' => false, 'msg' => 'Error de datos');
                }else{
                   $strUsuario = strtolower(strClean($_POST['txtEmail']));
                   $strPassword = hash("SHA256", $_POST['txtPassword']);
                   $requestUser = $this->model->loginUser($strUsuario, $strPassword);
                   dep($requestUser); 
                }
            }
            die();
        }
    }

?>
