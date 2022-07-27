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

Programa:          Pantalla sobre Nosotros(Tienda)
Fecha:             08-Abril-2022
Programador:       Reynaldo Jafet Giron Tercero
descripción:       Muestra información importante sobre la empresa
-----------------------------------------------------------------------*/



    require_once("Models/Tcategoria.php");
    require_once("Models/Tproducto.php");
    class Nosotros extends Controllers{
        use Tcategoria;
        public function __construct()
        {
            session_start();
            parent::__construct();
            /* session_start();
            if (empty($_SESSION['login'])) {
                header('Location: '.base_url().'/login');
                die();
            } */
            getPermisos(MPÁGINAS);
        }
        
        public function nosotros()
        {
            /* dep($this->getCategoriasT(CAT_SLIDER));
            exit; */
            /* dep($this->selectProductos());
            exit; */
            $pageContent=getPageRout('nosotros');
            if (empty($pageContent)) {
                header("Location:".base_url());
            }else{
                $data['page_tag']=datosEmpresa()['Empresa']['NOMBRE_EMPRESA'];
                $data['page_title']=datosEmpresa()['Empresa']['NOMBRE_EMPRESA'].' - '.$pageContent['TITULO'];
                $data['page_name']=$pageContent['TITULO'];
                $data['page']=$pageContent;
                $data['categorias'] = $this->getCategorias();
               
          
                $this->views->getView($this,"nosotros",$data);

            }
        }
        
       
    }

?>

