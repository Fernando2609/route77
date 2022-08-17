<?php  
    class Logout extends Controllers{
        public function __construct()
        {
            
            session_start();
              //BIRACORA
          //  Bitacora($_SESSION['idUser'],1,"Logout","Cerró Sesión",'');
			session_unset();
			session_destroy();
			header('location: '.base_url().'/login');
            
			die();
            
        }
        
        
        
    }

?>
