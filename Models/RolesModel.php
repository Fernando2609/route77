<?php  
    
    class rolesModel extends Mysql{
        public function __construct()
        {
           parent::__construct();
        }

        public function SelectRoles()
        {
// Extraer roles
$sql = "SELECT * FROM roles WHERE status != 0";
$request = $this->select_all($sql); 
return $request;


        }
    }   


    ?>
    
   