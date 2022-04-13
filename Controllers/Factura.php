<?php  
    require 'Libraries/html2pdf/vendor/autoload.php';
    use Spipu\Html2Pdf\Html2Pdf;


    class Factura extends Controllers{
        public function __construct()
        {
            session_start();
            parent::__construct();
            /* session_start();
            if (empty($_SESSION['login'])) {
                header('Location: '.base_url().'/login');
                die();
            } */
        }
        
        public function generarFactura($idpedido)
        {
           if(is_numeric($idpedido)){
            $idpersona = "";
            if($_SESSION['permisosMod']['r'] and $_SESSION['userData']['COD_ROL'] == RCLIENTES){
                $idpersona = $_SESSION['userData']['idpersona'];
            }
            $data = $this->model->selectPedido($idpedido, $idpersona);

            if(empty($data)){
                echo "datos no encontrados";
            }else{
                ob_end_clean();
            $html = getfile("Template/Modals/comprobantePDF",$data);
            $html2pdf = new Html2Pdf();
            $html2pdf->writeHTML($html);
            $html2pdf->output();
            }

            }else{
               echo "Dato no válido"; 
            }

        }
        
      
    }

?>