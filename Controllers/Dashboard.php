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
            $data['page_title']="Dashboard ESTACIÓN ROUTE 77";
            $data['page_name']="dashboard";
            $this->views->getView($this,"dashboard",$data);
        }
        
        /* public function insertar(){
            $data=$this->model->setUser("José",22);
            $data=$this->model->setUser("e",20);
            print_r($data);
        }
        public function verUsuario($id){
            $data=$this->model->getUser($id);
            print_r($data);
        }
        public function actualizar(){
            $data=$this->model->updateUser(1,"Fernando",21);
            print_r($data);
        }
        public function verUsuarios(){
            $data=$this->model->getUsers();
            print_r($data);
        }
        public function eliminarUsuario($id){
            $data=$this->model->delUser($id);
            print_r($data);
        } */
    }

?>