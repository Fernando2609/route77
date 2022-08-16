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

Programa:          Módulo de Factura
Fecha:             07-Abril-2022
Programador:       Hugo Alejandro Paz Izaguirre
descripción:       Muestra la factura de un pedido realizado

-----------------------------------------------------------------------*/



    require 'Libraries/html2pdf/vendor/autoload.php';
    
    require 'Libraries/Excel/vendor/autoload.php';
    use Spipu\Html2Pdf\Html2Pdf;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Cell\DataType;
    use PhpOffice\PhpSpreadsheet\RichText\RichText;
    use PhpOffice\PhpSpreadsheet\Shared\Date;
    use  PhpOffice\PhpSpreadsheet\Style\Alignment;
    use PhpOffice\PhpSpreadsheet\Style\Conditional;
    use PhpOffice\PhpSpreadsheet\Style\Border;
    use PhpOffice\PhpSpreadsheet\Style\Fill;
    use PhpOffice\PhpSpreadsheet\Style\Color;
    use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
    use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
    class Factura extends Controllers{
        public function __construct()
        {
            parent::__construct();
            session_start();
            if (empty($_SESSION['login'])) {
                header('Location: '.base_url().'/login');
                die();
            }
            getPermisos(MPEDIDOS);
        }
        
        public function generarFactura($idpedido)
        {
            if($_SESSION['permisosMod']['r']){
           if(is_numeric($idpedido)){
            $idpersona = "";
            if($_SESSION['permisosMod']['r'] and $_SESSION['userData']['COD_ROL'] == RCLIENTES){
                $idpersona = $_SESSION['userData']['COD_PERSONA'];
            }
            $data = $this->model->selectPedido($idpedido, $idpersona);

            if(empty($data)){
                echo "Datos No Encontrados";
            }else{
                $idpedido= $data['orden']['COD_PEDIDO'];
                ob_end_clean();
            $html = getfile("Template/Modals/comprobantePDF",$data);
            $html2pdf = new Html2Pdf('P','Letter','es','true','UTF-8');
            $html2pdf->writeHTML($html);
            $html2pdf->output('Factura-'.$idpedido.'.pdf');
             //BIRACORA
             Bitacora($_SESSION['idUser'],MPEDIDOS,"Consulta","Consultó la factura del pedido #".$idpedido,'');
            }

            }else{
               echo "Dato no válido"; 
            }
        }else{
            header('Location: '.base_url().'/login');
            die();
        }



     }
    
    }
?>