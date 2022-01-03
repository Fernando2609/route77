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
        
    }

?>
