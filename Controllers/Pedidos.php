<?php
require_once("Models/TTipoPago.php");
require 'Libraries/Excel/vendor/autoload.php';
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
    class Pedidos extends Controllers{
    use TTipoPago;
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
        
        public function Pedidos()
        {
            if(empty($_SESSION['permisosMod']['r'])){
                header('Location: '.base_url().'/dashboard');
            }
           
            $data['page_tag']="Pedidos";
            $data['page_title']="PEDIDOS <small> Route 77</small> ";
            $data['page_name']="pedidos";
            $data['page_functions_js']="functions_pedidos.js";
            //BIRACORA
            Bitacora($_SESSION['idUser'],MPEDIDOS,"Ingreso","Ingresó al módulo");
            $this->views->getView($this,"pedidos",$data);
        }

        public function getPedidos(){
        if ($_SESSION['permisosMod']['r']) {
            $idpersona = "";
            if( $_SESSION['userData']['COD_ROL'] == RCLIENTES ) {
                $idpersona = $_SESSION['userData']['COD_PERSONA'];
            }
            $arrData = $this->model->selectPedidos($idpersona);
            for ($i = 0; $i < count($arrData); $i++) {
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';

                $arrData[$i]['transaccion'] = $arrData[$i]['REFERENCIA_COBRO'];
                if ($arrData[$i]['COD_TRANSACCION_PAYPAL'] != "") {
                    $arrData[$i]['transaccion'] = $arrData[$i]['COD_TRANSACCION_PAYPAL'];
                }

                $arrData[$i]['MONTO'] = SMONEY.' '.formatMoney($arrData[$i]['MONTO']);

                if ($_SESSION['permisosMod']['r']) {

                    $btnView .= ' <a title= "Ver Detalle" href="'.base_url().'/pedidos/orden/'.$arrData[$i]['COD_PEDIDO'].'
                    " target="_balnck" class="btn btn-info btn-sm"> <i class="far fa-eye"></i> </a>

                    <a title= "Generar PDF" href="'.base_url().'/factura/generarFactura/'.$arrData[$i]['COD_PEDIDO'].'
                    " target="_balnck" class="btn btn-danger btn-sm"> <i class="fas fa-file-pdf"></i> </a> ';
                    
                    if ($arrData[$i]['COD_TIPO_PAGO'] == 1) {        
                        $btnView .= '<a title= "Ver Transaccion" href="'.base_url().'/pedidos/transaccion/'.$arrData[$i]['COD_TRANSACCION_PAYPAL'].'
                        " target="_balnck" class="btn btn-info btn-sm"> <i class="fa fa-paypal" 
                        aria-hidden="true"></i></a>';
                   
                    }else{
                        $btnView .= '<button class="btn btn-secondary btn-sm" disabled=""><i class="fa fa-paypal" 
                        aria-hidden="true"></i></button> ';
                    }
                }
                if ($_SESSION['permisosMod']['u']) {
                    $btnEdit = '<button class="btn btn-warning  btn-sm" onClick="fntEditInfo(this,'. $arrData[$i]['COD_PEDIDO'] . ')
                    " title="Editar Pedido"><i class="fas fa-pencil-alt"></i></button>';
                }
                /* if ($_SESSION['permisosMod']['d']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['COD_PEDIDO'] . ')
                    " title="Eliminar Pedido"><i class="far fa-trash-alt"></i></button>';
                } */
                $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . /* ' ' . $btnDelete .  */'</div>';
            }
            
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
        }

        public function orden($idpedido){
        if(!is_numeric($idpedido)){
            header("Location:".base_url().'/pedidos');
        }
        if (empty($_SESSION['permisosMod']['r'])) {
            header('Location: ' . base_url() . '/dashboard');
        }
        $idpersona = "";
        if ($_SESSION['userData']['COD_ROL'] == RCLIENTES) {
            $idpersona = $_SESSION['userData']['COD_PERSONA'];
        }


        $data['page_tag'] = "Pedido - Route 77";
        $data['page_name'] = "pedido";
        $data['arrPedido'] = $this->model->selectPedido($idpedido, $idpersona);
        $data['page_title'] = "PEDIDO #".$data['arrPedido']['orden']['COD_PEDIDO'];
        //BIRACORA
        Bitacora($_SESSION['idUser'],MPEDIDOS,"Consulta","Consultó el Pedido #".$idpedido);
        $this->views->getView($this, "orden", $data);

        }
        public function transaccion($transaccion){
            if (empty($_SESSION['permisosMod']['r'])) {
                header('Location: ' . base_url() . '/dashboard');
            }
            $idpersona = "";
            if ($_SESSION['userData']['COD_ROL'] == RCLIENTES) {
                $idpersona = $_SESSION['userData']['COD_PERSONA'];
            }
            $requestTransaccion=$this->model->selectTransPaypal($transaccion,$idpersona);
           
            $data['page_tag'] = "Detalle de la Transaccion - Route 77";
            $data['page_title'] = "Detalles de la Transaccion";
            $data['page_name'] = "Detalles de la Transaccion";
            $data['page_functions_js']="functions_pedidos.js";
            $data['objTransaccion']=$requestTransaccion;
             //BIRACORA
             Bitacora($_SESSION['idUser'],MPEDIDOS,"Consulta","Consultó el Pedido con la transacción paypal #".$transaccion);
            $this->views->getView($this, "transaccion", $data);   
            }
            public function getTransaccion(string $transaccion){
                if($_SESSION['permisosMod']['r'] and $_SESSION['userData']['COD_ROL'] != RCLIENTES){
                    if($transaccion == ""){
                        $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
                    }else{
                        $transaccion = strClean($transaccion);
                        $requestTransaccion = $this->model->selectTransPaypal($transaccion);
                        if(empty($requestTransaccion)){
                            $arrResponse = array("status" => false, "msg" => "Datos no disponibles.");
                        }else{
                            $htmlModal = getFile("Template/Modals/modalReembolso",$requestTransaccion);
                            $arrResponse = array("status" => true, "html" => $htmlModal);
                        }
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }
                die();
            }
            public function setReembolso(){
                if($_POST){
                    if($_SESSION['permisosMod']['u'] and $_SESSION['userData']['COD_ROL'] != RCLIENTES){
                        //dep($_POST);
                        $transaccion = strClean($_POST['idtransaccion']);
                        $observacion = strClean($_POST['observacion']); 
                        $requestTransaccion = $this->model->reembolsoPaypal($transaccion,$observacion);
                        if($requestTransaccion){
                             //BIRACORA
                             Bitacora($_SESSION['idUser'],MPEDIDOS,"Update","Realizó el reembolso a la transacción ".$transaccion." con la observación ".$observacion."");
                            $arrResponse = array("status" => true, "msg" => "El reembolso se ha procesado.");
                        }else{
                            $arrResponse = array("status" => false, "msg" => "No es posible procesar el reembolso.");
                        } 
                    }else{
                        $arrResponse = array("status" => false, "msg" => "No es posible realizar el proceso, Preguntele al BOSS.");
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }
                die();
            }
            public function getPedido(string $pedido){
                if($_SESSION['permisosMod']['u'] and $_SESSION['userData']['COD_ROL'] != RCLIENTES){
                    if($pedido == ""){
                        $arrResponse = array("status" => false, "msg" => "Datos Incorrectos");
                    }else{
                        $requestPedido= $this->model->selectPedido($pedido,"");
                        if(empty($requestPedido)){
                            $arrResponse=array("status"=>false,"msg" => "Datos No Disponibles");
                        }else{
                            $requestPedido['tipospago']=$this->getTiposPagoT();
                            $requestPedido['tiposestado']=$this->getTiposEstadoT();
                            $htmlModal = getFile("Template/Modals/modalPedido",$requestPedido);
                            $arrResponse=array("status"=>true, "html"=>$htmlModal);
                        }
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }
                die();
            }

            public function setPedido(){
                if($_POST){
                    if($_SESSION['permisosMod']['u'] and $_SESSION['userData']['COD_ROL'] != RCLIENTES){ 
                        $idpedido = !empty($_POST['idpedido']) ? intval($_POST['idpedido']) : "";
                        $estado = !empty($_POST['listEstado']) ? intval($_POST['listEstado']) : "";
                        $idtipopago =  !empty($_POST['listTipopago']) ? intval($_POST['listTipopago']) : "";
                        $user=$_SESSION['idUser'];
                        
                        $transaccion = !empty($_POST['txtTransaccion']) ? strClean($_POST['txtTransaccion']) : "";
        
                        if($idpedido == ""){
                            $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
                        }else{
                            if($idtipopago == ""){
                                if($estado == ""){
                                    $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
                                }else{
                                    $requestPedido = $this->model->updatePedido($idpedido,"","",$estado,$user);
                                    if($requestPedido){
                                        $arrResponse = array("status" => true, "msg" => "Datos actualizados correctamente");
                                         //BIRACORA
                                        Bitacora($_SESSION['idUser'],MPEDIDOS,"Update","Actualizó el pedido #".$idpedido);
                                    }else{
                                        $arrResponse = array("status" => false, "msg" => "No es posible actualizar la información.");
                                    }
                                }
                            }else{
                                if($idtipopago =="" or $estado == ""){
                                    $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
                                }else{
                                    $requestPedido = $this->model->updatePedido($idpedido,$transaccion,$idtipopago,$estado,$user);
                                    
                                    if($requestPedido){
                                        //BIRACORA
                                        Bitacora($_SESSION['idUser'],MPEDIDOS,"Update","Actualizó el pedido #".$idpedido);
                                        $arrResponse = array("status" => true, "msg" => "Datos actualizados correctamente");
                                    }else{
                                        $arrResponse = array("status" => false, "msg" => "No es posible actualizar la información.");
                                    }
                                }
                            }
                        }
                        echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                    }
                }
                die();
            }
            public function Utilidad($params)
            {
          
                
                if (($_SESSION['permisos']['5']['r'] || $_SESSION['permisos']['17']['r']) AND $_SESSION['userData']['COD_ROL']!=2 ) {
                      
                    $arrFecha = explode(',',$params);
                   
                    $fechaInicio= date("Y-m-d",strtotime($arrFecha[0]));
                    
                    $fechaFin=date("Y-m-d",strtotime($arrFecha[1]));
                   //$fechaInicio = str_replace(" ","",$_POST['fechaInicio']);
                   //$fechaFin = str_replace(" ","",$_POST['fechaFinal']);
                    //traer pedidos y compras
                   $data = $this->model->selectUtilidad($fechaInicio,$fechaFin);
                  
                   //nueva hoja de excel
                   $excel = new Spreadsheet();
                   //estilos por default
                   $excel->getDefaultStyle()
                   ->getFont()
                   ->setName('Times New Roman')
                   ->setSize(11);
                   $styleArrayFecha=[
                               'borders' => [
                                   'bottom' => ['borderStyle' => Border::BORDER_THIN],
                                   'top' => ['borderStyle' => Border::BORDER_THIN],
                                   'left' => ['borderStyle' => Border::BORDER_THIN],
                                   'right' => ['borderStyle' => Border::BORDER_THIN],
                               ],
                               'alignment' => [
                                   'horizontal' => Alignment::HORIZONTAL_CENTER,
                               ],
                       
                           ];
                   $styleArrayMonto=[
                       'borders' => [
                           'bottom' => ['borderStyle' => Border::BORDER_THIN],
                           'top' => ['borderStyle' => Border::BORDER_THIN],
                           'left' => ['borderStyle' => Border::BORDER_THIN],
                           'right' => ['borderStyle' => Border::BORDER_THIN],
                       ],
                       
               
                   ];
                   $styleSumatoria=[
                       'fill' => [
                       'fillType' => Fill::FILL_SOLID,
                       'color' => ['argb' => '81B031'],
                       
                       ],
                       'font' => [
                           'color' => ['argb' => 'FFFFFF'],
                       ],
                           'borders' => [
                               'bottom' => ['borderStyle' => Border::BORDER_THIN],
                               'top' => ['borderStyle' => Border::BORDER_THIN],
                               'left' => ['borderStyle' => Border::BORDER_THIN],
                               'right' => ['borderStyle' => Border::BORDER_THIN],
                           ],
                           'alignment' => [
                               'horizontal' => Alignment::HORIZONTAL_CENTER,
                           ],
                       
                   ];
                   $styleEncabezado=[
                       'fill' => [
                           'fillType' => Fill::FILL_SOLID,
                           'color' => ['argb' => '055488'],
                           
                       ],
                       'font' => [
                           'bold' => true,
                           'color' => ['argb' => 'FFFFFF'],
                           'size'=>12
                       ],
                           'borders' => [
                               'bottom' => ['borderStyle' => Border::BORDER_THIN],
                               'right' => ['borderStyle' => Border::BORDER_MEDIUM],
                           ],
                           'alignment' => [
                               'horizontal' => Alignment::HORIZONTAL_CENTER,
                           ],    
                   ];
                   $styleUtilidad=[
                       'fill' => [
                           'fillType' => Fill::FILL_SOLID,
                           'color' => ['argb' => 'D9D9D9'],
                           
                       ],
                           'alignment' => [
                               'horizontal' => Alignment::HORIZONTAL_CENTER,
                           ],
           
                   ];
                   //$hoja activa
                   $hojaActiva=$excel->getActiveSheet();
                   //titulo
                   $hojaActiva->setTitle("Utilidad");
                   //Dimension y valor de la Columna A
                   $hojaActiva->getColumnDimension('A')->setWidth(30);
                   $hojaActiva->setCellValue('A1',"FECHA PEDIDO");
                   //Dimension y valor de la Columna B
                   $hojaActiva->getColumnDimension('B')->setWidth(20);
                   $hojaActiva->setCellValue('B1',"MONTO PEDIDO");
                   //Dimension y valor de la Columna C
                   $hojaActiva->getColumnDimension('C')->setWidth(30);
                   $hojaActiva->setCellValue('C1',"FECHA COMPRA");
                   //Dimension y valor de la Columna D
                   $hojaActiva->getColumnDimension('D')->setWidth(20);
                   $hojaActiva->setCellValue('D1',"MONTO COMPRA");
                   //Se inicia en la segunda fila
                   $filaPedido=2;
               //recorrer los pedidos
                   for ($i=0; $i < count($data['pedido']); $i++) { 
                       //FECHA
                   $hojaActiva->setCellValue('A'.$filaPedido,$data['pedido'][$i]["FECHA"])->getStyle('A'.$filaPedido)->applyFromArray($styleArrayFecha);
                       //MONTO
                   $hojaActiva->setCellValue('B'.$filaPedido,$data['pedido'][$i]["MONTO"])->getStyle('B'.$filaPedido)->applyFromArray($styleArrayMonto);
                   $filaPedido++;
                   }
       
               //Se inicia en la segunda fila
                   $filaCompra=2;
                   //recorrer compras
                   for ($i=0; $i < count($data['compra']); $i++) { 
                       //FECHA 
                       $hojaActiva->setCellValue('C'.$filaCompra,$data['compra'][$i]["FECHA_COMPRA"])->getStyle('C'.$filaCompra)->applyFromArray($styleArrayFecha);
                       //MONTO
                       $hojaActiva->setCellValue('D'.$filaCompra,$data['compra'][$i]["MONTO"])->getStyle('D'.$filaCompra)->applyFromArray($styleArrayMonto);
                       $filaCompra++;  
                   }
                   //Fila mayor de pedido o compra
                   $filaMayor=0;
                   if ($filaPedido>=$filaCompra) {
                       $filaMayor=$filaPedido;
                   }else{
                       $filaMayor=$filaCompra; 
                   }
                   //Columna A fila mayor para la sumatoria
                   $hojaActiva->setCellValue('A'.($filaMayor+1),'SUMA PEDIDOS')->getStyle('A'.($filaMayor+1))->applyFromArray($styleSumatoria);
                   //Columna C fila mayor para la sumatoria
                   $hojaActiva->setCellValue('C'.($filaMayor+1),'SUMA COMPRAS')->getStyle('C'.($filaMayor+1))->applyFromArray($styleSumatoria);
       
                   //Sumatora de pedido
                   $hojaActiva->setCellValue('B'.($filaMayor+1),'=SUM(B2:B'.($filaPedido-1).')')->getStyle('B'.($filaMayor+1))->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_ACCOUNTING_LPS);
                   //Sumatoria de compra
                   $hojaActiva->setCellValue('D'.($filaMayor+1),'=SUM(D2:D'.($filaCompra-1).')')->getStyle('D'.($filaMayor+1))->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_ACCOUNTING_LPS);
                   //estilo numerico para la columnas de monto
                   $hojaActiva->getStyle('D2:D'.$filaMayor)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_ACCOUNTING_LPS);
                   $hojaActiva->getStyle('B2:B'.$filaMayor)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_ACCOUNTING_LPS);
                   //Estilos de encabezado
                   $hojaActiva->getStyle('A1:D1')->applyFromArray($styleEncabezado);
                   //Combinar columnas
                   $hojaActiva->mergeCells('F3:k3');
                   $hojaActiva->setCellValue('F3',"UTILIDAD BRUTA ".$fechaInicio.' / '.$fechaFin)->getStyle('F3')->applyFromArray(
                       [
                           'fill' => [
                               'fillType' => Fill::FILL_SOLID,
                               'color' => ['argb' => '81B031'],
                               
                               ],
                               'font' => [
                                   'bold'=>true,
                                   //'color' => ['argb' => 'FFFFFF'],
                                   'size'=>12
                               ],
                                   'borders' => [
                                       'bottom' => ['borderStyle' => Border::BORDER_THIN],
                                       'top' => ['borderStyle' => Border::BORDER_THIN],
                                       'left' => ['borderStyle' => Border::BORDER_THIN],
                                       'right' => ['borderStyle' => Border::BORDER_THIN],
                                   ],
                                   'alignment' => [
                                       'horizontal' => Alignment::HORIZONTAL_CENTER,
                                   ],
                       ]
                   ); 
                   //Columna de abajo
                   $hojaActiva->mergeCells('F4:H4');
                   $hojaActiva->setCellValue('F4',"Totala Ingresos (Pedidos)")->getStyle('F4:H4')->applyFromArray(
                       [
                                   'borders' => [
                                       'bottom' => ['borderStyle' => Border::BORDER_THIN],
                                   
                                       'right' => ['borderStyle' => Border::BORDER_THICK],
                                       
                                   ],
                                   'alignment' => [
                                       'horizontal' => Alignment::HORIZONTAL_CENTER,
                                   ],
                       ]
                   ); 
                   //Columna de abajo
                   $hojaActiva->mergeCells('I4:K4');
                   $hojaActiva->setCellValue('I4',"Total Costos (Compras)")->getStyle('I4:K4')->applyFromArray(
                       [
                                   'borders' => [
                                       'bottom' => ['borderStyle' => Border::BORDER_THIN],
                                       
                                   ],
                                   'alignment' => [
                                       'horizontal' => Alignment::HORIZONTAL_CENTER,
                                   ],
                       ]
                   ); 
       
                   //Totales 
                   $hojaActiva->mergeCells('F6:H6');
                   $hojaActiva->setCellValue('F6','=SUM(B2:B'.($filaPedido-1).')')->getStyle('F6:H6')->applyFromArray(
                       [
                                   'borders' => [
                                       'bottom' => ['borderStyle' => Border::BORDER_THICK],
                                       
                                       //'right' => ['borderStyle' => Border::BORDER_THICK],
                                       
                                   ],
                                   'alignment' => [
                                       'horizontal' => Alignment::HORIZONTAL_CENTER,
                                   ],
                       ]
                   ); 
                   $hojaActiva->getStyle("F6")->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_ACCOUNTING_LPS); 
                   //Columna de abajo
                   $hojaActiva->mergeCells('I6:K6');
                   $hojaActiva->setCellValue('I6','=SUM(D2:D'.($filaCompra-1).')')->getStyle('I6:K6')->applyFromArray(
                       [
                                   'borders' => [
                                       'bottom' => ['borderStyle' => Border::BORDER_THICK],
                                       
                                   ],
                                   'alignment' => [
                                       'horizontal' => Alignment::HORIZONTAL_CENTER,
                                   ],
                       ]
                   );
                   $hojaActiva->getStyle("I6")->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_ACCOUNTING_LPS); 
                   //Utilidad Bruta
                   $hojaActiva->mergeCells('F8:G8');
                   $hojaActiva->setCellValue('F8','Utilidad Bruta');
                   $hojaActiva->mergeCells('I8:K8');
                   $hojaActiva->setCellValue('I8','=(F6-I6)');
                   $hojaActiva->getStyle("I8")->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_CURRENCY_LPS_SIMPLE); 
                   $hojaActiva->getStyle("F8:H8")->applyFromArray($styleUtilidad);
                       //Utilidad Bruta porcentual
                   $hojaActiva->mergeCells('F10:G10');
                   $hojaActiva->setCellValue('F10','Margen Bruto %');
                   $hojaActiva->mergeCells('I10:K10');
                   $hojaActiva->setCellValue('I10','=I8/F6');
                   $hojaActiva->getStyle("I10")->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE_00); 
                   $hojaActiva->getStyle("F10:H10")->applyFromArray($styleUtilidad);
       
       
       
                   /*Crear nueva Hoja
                   $excel->createSheet();
                   $excel->setActiveSheetIndex(1);
                   $excel->getActiveSheet()->setCellValue('A1', 'Firstname:'); */
       
       
                   $conditional2 = new Conditional();
                   $conditional2->setConditionType(Conditional::CONDITION_CELLIS);
                   $conditional2->setOperatorType(Conditional::OPERATOR_LESSTHAN);
                   $conditional2->addCondition(0);
                   $conditional2->getStyle()->getFont()->getColor()->setRGB(COLOR::COLOR_DARKRED);
                   $conditional2->getStyle()->getFont()->setBold(true);
                   //$conditional2->getStyle()->getFill()->setFillType(Fill::FILL_SOLID);
                   //$conditional2->getStyle()->getFill()->getStartColor()->setRGB(COLOR::COLOR_ROJO);
       
       
                   $conditional3 = new Conditional();
                   $conditional3->setConditionType(Conditional::CONDITION_CELLIS);
                   $conditional3->setOperatorType(Conditional::OPERATOR_GREATERTHANOREQUAL);
                   $conditional3->addCondition(0);
                   $conditional3->getStyle()->getFont()->getColor()->setRGB(COLOR::COLOR_RED);
                   $conditional3->getStyle()->getFont()->setBold(true);
       
       
                   $conditionalStyles = $hojaActiva->getStyle('I8')->getConditionalStyles();
                   $conditionalStyles[] = $conditional2;
                   $conditionalStyles[] = $conditional3;
       
                   $hojaActiva->getStyle('I8')->setConditionalStyles($conditionalStyles);
                    //BIRACORA
                    Bitacora($_SESSION['idUser'],MPEDIDOS,"Consulta","Consultó y descargó las utilidades de la fecha del ".$fechaInicio." al ".$fechaFin);
                   //dep($excel);
                   //exit;
                   ob_end_clean();
                   /* Here there will be some code where you create $spreadsheet */
                   $nombre="Utilidades_".$fechaInicio.'_'.$fechaFin;
                   
                   // redirect output to client browser
                   header('Content-Type: application/vnd.ms-excel');
                   header('Content-Disposition: attachment;filename="'.$nombre.'.xls"');
                   header('Cache-Control: max-age=0');
       
                   $writer = IOFactory::createWriter($excel, 'Xls');
                   $writer->save('php://output');

                   

                }
            }
           
    }
?>