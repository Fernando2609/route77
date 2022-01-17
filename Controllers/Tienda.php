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
                $arrParams=explode(",",$params);
                $idCategoria=intval($arrParams[0]);
                $ruta=strClean($arrParams[1]);
                $infoCategoria=$this->getProductosCategoriaT($idCategoria,$ruta);
                $categoria = strClean($params);
                $data['page_tag'] = NOMBRE_EMPESA." - ".$infoCategoria['categoria'];
                $data['page_title'] = $infoCategoria['categoria'];
                $data['page_name'] = "categoria";
                $data['productos'] = $infoCategoria['productos'];
                $this->views->getView($this,"categoria",$data);
            }
        }
        
         public function producto($params){
        if (empty($params)) {
            header("Location:" . base_url());
        } else {
            $arrParams = explode(",",$params);
            $idproducto = intval($arrParams[0]);
            $ruta = strClean($arrParams[1]);
            $infoProducto = $this->getProductoT($idproducto,$ruta);
           if (empty($infoProducto)) {
               header("Location:".base_url());
           }
            $producto = strClean($params);
            //$arrProducto = $this->getProductoT($producto);
            $data['page_tag'] = NOMBRE_EMPESA . " - " . $infoProducto['nombre'];
            $data['page_title'] = $infoProducto['nombre'];
            $data['page_name'] = "producto";
            $data['producto'] = $infoProducto;
            $data['productos'] = $this->getProductosRandom($infoProducto['categoriaid'],8,"r");
            $this->views->getView($this, "producto", $data);
        }
        }






    }

?>