<?php  
    class Productos extends Controllers{
        public function __construct()
        {
            parent::__construct();
            session_start();
            if (empty($_SESSION['login'])) {
                header('Location: '.base_url().'/login');
                die();
            }
        }
        
        public function productos()
        {
            $data['page_id']=2;
            $data['page_tag']="Productos";
            $data['page_title']="BIENVENIDOS A LOS PRODUCTOS ESTACIÓN ROUTE 77";
            $data['page_name']="Productos";
            
            $this->views->getView($this,"productos",$data);
        }
    }
?>