<?php  
    class Dashboard extends Controllers{
        public function __construct()
        {
            parent::__construct();
            session_start();
             //session_regenerate_id(true);
            if (empty($_SESSION['login'])) {
                header('Location: '.base_url().'/login');
                die();
            }
            getPermisos(1);
            
        }
        
        public function dashboard()
        {
            $data['page_id']=2;
            $data['page_tag']="Dashboard Route 77";
            $data['page_title']="DASHBOARD ESTACIÓN ROUTE 77";
            $data['page_name']="dashboard";
            $data['page_functions_js']="functions_dashboard.js";
            $data['usuarios'] = $this->model->cantUsuarios();
            $data['clientes'] = $this->model->cantClientes();
            $data['productos'] = $this->model->cantProductos();
            $data['pedidos'] = $this->model->cantPedidos();
            $data['pedidos'] = $this->model->cantPedidos();
            $data['lastOrders'] = $this->model->lastOrders();
            $anio = date('Y');
            $mes = date('m');
            $data['pagosMes'] = $this->model->selectPagosMes($anio, $mes);
            $data['ventasMDia'] = $this->model->selectVentasMes($anio, $mes);
        // dep($data['ventasMDia']);
        // exit;

            $this->views->getView($this,"dashboard",$data);
        }
        
    }

?>