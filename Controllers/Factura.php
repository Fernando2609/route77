<?php  
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
             Bitacora($_SESSION['idUser'],MPEDIDOS,"Consulta","Consultó la factura del pedido #".$idpedido);
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