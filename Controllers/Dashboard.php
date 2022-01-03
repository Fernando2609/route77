<?php  
    class Dashboard extends Controllers{
        public function __construct()
        {
            parent::__construct();
            
        }
        
        public function dashboard()
        {
            $data['page_id']=2;
            $data['page_tag']="Dashboard Route 77";
            $data['page_title']="DASHBOARD ESTACIÓN ROUTE 77";
            $data['page_name']="dashboard";
            $this->views->getView($this,"dashboard",$data);
        }
        
    }

?>