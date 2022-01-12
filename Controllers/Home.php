<?php  
    class Home extends Controllers{
        public function __construct()
        {
            parent::__construct();
            /* session_start();
            if (empty($_SESSION['login'])) {
                header('Location: '.base_url().'/login');
                die();
            } */
        }
        
        public function home()
        {
            
            $data['page_tag']=NOMBRE_EMPESA;
            $data['page_title']=NOMBRE_EMPESA;
            $data['page_name']=NOMBRE_EMPESA;
            $this->views->getView($this,"home",$data);
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

