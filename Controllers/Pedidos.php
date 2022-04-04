<?php
 class Pedidos extends Controllers{
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

                $arrData[$i]['MONTO'] = SMONEY.formatMoney($arrData[$i]['MONTO']);

                if ($_SESSION['permisosMod']['r']) {

                    $btnView .= ' <a title= "Ver Detalle" href="'.base_url().'/pedidos/orden/'.$arrData[$i]['COD_PEDIDO'].'" target="_balnck" class="btn btn-info btn-sm"> <i class="far fa-eye"></i> </a>
                    <button class="btn btn-danger btn-sm" onClick="fntViewDPF('.$arrData[$i]['COD_PEDIDO'].')" title="Generar PDF"><i class="fas fa-file-pdf"></i></button> ';
                    
                    if ($arrData[$i]['COD_TIPO_PAGO'] == 1) {
                        $btnView .= '<button class="btn btn-info btn-sm" onClick="fntViewInfo('.$arrData[$i]['COD_PEDIDO'].')" title="Ver Transacción"><i class="fa fa-paypal" aria-hidden="true"></i></button> ';
                    }else{
                        $btnView .= '<button class="btn btn-secondary btn-sm" disabled=""><i class="fa fa-paypal" aria-hidden="true"></i></button> ';
                    }
                }
                if ($_SESSION['permisosMod']['u']) {
                    $btnEdit = '<button class="btn btn-warning  btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['COD_PEDIDO'] . ')" title="Editar Pedido"><i class="fas fa-pencil-alt"></i></button>';
                }
                if ($_SESSION['permisosMod']['d']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['COD_PEDIDO'] . ')" title="Eliminar Pedido"><i class="far fa-trash-alt"></i></button>';
                }
                $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
            }
            
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
        }

        public function orden(int $idpedido){
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
        $this->views->getView($this, "orden", $data);

        }

    }
?>