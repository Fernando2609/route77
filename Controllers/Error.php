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

Programa:          Pantalla de error
Fecha:             29-Abril-2022
Programador:       Alejandrino Victor García Bustillo
descripción:       Muestra una pantalla de error cuando la url no es encontrada

-----------------------------------------------------------------------*/



     require_once("Models/Tcategoria.php");
     require_once("Models/Tproducto.php");
    class Errors extends Controllers{
        use Tcategoria, Tproducto;
        public function __construct()
        {
            parent::__construct();
            
        }
        
        public function notFound()
        {
            $pageContent=getPageRout('not-found');
            if (empty($pageContent)) {
                header("Location:".base_url());
            }else{
            $data['page_tag']=datosEmpresa()['Empresa']['NOMBRE_EMPRESA'];
            $data['page_title']=datosEmpresa()['Empresa']['NOMBRE_EMPRESA'].' - '.$pageContent['TITULO'];
            $data['page_name']=$pageContent['TITULO'];
            $data['page']=$pageContent;
            $data['categorias'] = $this->getCategorias();
            $this->views->getView($this,"error",$data);
         }
        }
        
       
    }
    $notFound= new Errors();
    $notFound->notFound();
?>