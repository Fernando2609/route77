<?php  
/*
-----------------------------------------------------------------------
Universidad Nacional Autónoma de Honduras (UNAH)
    Facultad de Ciencias Economicas
Departamento de Informatica administrativa
     Analisis, Programacion y Evaluacion de Sistemas
                Segundo Periodo 2022


Equipo:
Jose Fernando Ortiz Santos .......... (jfortizs@unah.hn)
Hugo Alejandro Paz Izaguirre..........(hugo.paz@unah.hn)
Kevin Alfredo Rodríguez Zúniga........(karodriguezz@unah.hn)
Leonela Yasmin Pineda Barahona........(lypineda@unah)
Reynaldo Jafet Giron Tercero..........(reynaldo.giron@unah.hn)
Gabriela Giselh Maradiaga Amador......(ggmaradiaga@unah.hn)
Alejandrino Victor García Bustillo....(alejandrino.garcia@unah.hn)

Catedrático:
Lic. Karla Melisa Garcia Pineda 
---------------------------------------------------------------------

Programa:          Pantalla de carrito de compras
Fecha:             21-Marzo-2022
Programador:       Alejandrino Victor García Bustillo
descripción:       Almacena los productos seleccionados por el cliente 
                   para su posterior compra
-----------------------------------------------------------------------*/
    require_once("Models/Tcategoria.php");
    require_once("Models/Tproducto.php");
    require_once("Models/TTipoPago.php");
    require_once("Models/TCliente.php");
    class Carrito extends Controllers{
        use Tcategoria, Tproducto,TTIpoPago,TCliente;
        public function __construct()
        {
            parent::__construct();
            session_start();
            
        }
        
        public function carrito()
        {
            /* dep($this->getCategoriasT(CAT_SLIDER));
            exit; */
            /* dep($this->selectProductos());
            exit; */
            $data['page_tag']=datosEmpresa()['Empresa']['NOMBRE_EMPRESA'].' - Carrito';
            $data['page_title']='Carrito de Compras';
            $data['page_name']='carrito';
            /* $data['slider'] = $this->getCategoriasT(CAT_SLIDER);
            $data['banner'] = $this->getCategoriasT(CAT_BANNER); */
            $data['categorias'] = $this->getCategorias();
            /* $data['productos'] = $this->getProductosT(); */
             /* dep($data); exit; */ 
            $this->views->getView($this,"carrito",$data);
        }
        public function procesarpago()
        {
            if (empty($_SESSION['arrCarrito'])) {
                header("Location: ". base_url());
                die();
            }

            $data['page_tag']=datosEmpresa()['Empresa']['NOMBRE_EMPRESA'].' - Procesar Pago';
            $data['page_title']='Procesar Pago';
            $data['page_name']='procesarpago';
            $data['categorias'] = $this->getCategorias();
            $data['tiposPago']= $this->getTiposPagoT();
            $this->views->getView($this,"procesarpago",$data);
        }
        
      /*   public function setDetalleTemp(){
            $sid=session_id();
           $arrPedido=array('idcliente'=>$_SESSION['idUser'],
                            'idtransaccion'=> $sid,
                            'productos'=>$_SESSION['arrCarrito']);
            $this->insertDetalleTemp($arrPedido);
        } */
    }

?>

