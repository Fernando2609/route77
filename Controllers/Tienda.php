<?php  
    require_once("Models/Tcategoria.php");
    require_once("Models/Tproducto.php");

    class Tienda extends Controllers{
        use Tcategoria, Tproducto;
        public function __construct()
        {
            parent::__construct();
        }
        
        public function tienda()
        {
            $data['page_tag']=NOMBRE_EMPESA;
            $data['page_title']=NOMBRE_EMPESA;
            $data['page_name']="tienda";
            $data['productos'] = $this->getProductosT();
            $this->views->getView($this,"tienda",$data);
        }

        public function categoria($params){
            if(empty($params)){
                header("Location:".base_url());
            }else{

                $categoria = strClean($params);
                $data['page_tag'] = NOMBRE_EMPESA." - ".$categoria;
                $data['page_title'] = $categoria;
                $data['page_name'] = "categoria";
                $data['productos'] = $this->getProductosCategoriaT($categoria);
                $this->views->getView($this,"categoria",$data);
            }
        }
        
    }

?>