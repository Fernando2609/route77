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

Programa:          Módulo OrdenCompra
Fecha:             14-May-2022
Programador:       Jose Fernando Ortiz Santos
descripción:       Proceso donde se registran la cantidad de productos 
                   a ingresar al sistema

-----------------------------------------------------------------------*/




class OrdenCompra extends Controllers{
    public function __construct()
    {
            parent::__construct();
            session_start();
            //session_regenerate_id(true);
            if (empty($_SESSION['login'])) {
                header('Location: '.base_url().'/login');
                die();
            }
            getPermisos(MCOMPRAS);
        }
        
        public function OrdenCompra()
        {
            if(empty($_SESSION['permisosMod']['r'])){
                header('Location: '.base_url().'/dashboard');
            }
            //unset($_SESSION['compraDetalle']);
            $data['page_tag']="ordenCompra";
            $data['page_title']="Compras <small>Route 77</small>";
            $data['page_name']="ordenCompra";
            $data['page_functions_js']="functions_ordenCompra.js";
            $data['isv']=true;
            //BIRACORA
            //Bitacora($_SESSION['idUser'],MCOMPRAS,"Ingreso","Ingresó al módulo para crear una compra");
            $this->views->getView($this,"ordenCompra",$data);
        }
        public function getProducto($idproducto){
			if($_SESSION['permisosMod']['r']){
				$idproducto = intval($idproducto);
				if($idproducto > 0){
					$arrData = $this->model->selectProducto($idproducto);
				
					if(empty($arrData)){
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{
				
						$arrResponse = array('status' => true, 'data' => $arrData);
					}
					
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}
        public function detalleCompra(){
          
             //unset($_SESSION['compraDetalle']);exit;
			if($_SESSION['permisosMod']['w']){
                $detalleTabla='';
                $idproducto = intval($_POST['idProducto']);
                $intCantidad = intval($_POST['txtCantidad']);
                $txtPrecio = $_POST['txtPrecio'];
                
                $checkISV=$_POST['checkISV'];
               
                $txtPrecioTotal =$intCantidad*$txtPrecio;
                $arrDetalle=array();
                $arrTabla=array();
                $subtotal=0;
                $total=0;
                $iva=datosEmpresa()['Empresa']['ISV'];
                
                //$user=intval($_SESSION['idUser']);
                $arrData = $this->model->selectProducto($idproducto);
               
               $arrinfoProducto=array('idproducto' => $idproducto,
               'cantidad' => $intCantidad,
               'nombre'=>$arrData['NOMBRE'],
               'categoria'=>$arrData['CATEGORÍA'],
               'stock'=>$arrData['STOCK'],
               'cantCompra'=>$arrData['CANT_COMPRA'],
               'precio' => $txtPrecio,
               'txtPrecioTotal'=>$txtPrecioTotal);
                
                
               //$_SESSION['compraDetalle']=array();
               if(isset($_SESSION['compraDetalle'])){
                $on = true;
                $arrDetalle = $_SESSION['compraDetalle'];
                for ($pr=0; $pr < count($arrDetalle); $pr++) {
                    if($arrDetalle[$pr]['idproducto'] == $idproducto){
                        $arrDetalle[$pr]['cantidad'] = $intCantidad;
                        $arrDetalle[$pr]['precio'] = $txtPrecio;
                        $arrDetalle[$pr]['txtPrecioTotal']=$txtPrecio*$intCantidad;
                        $on = false;
                    }
                }
                if($on){
                    array_push($arrDetalle,$arrinfoProducto);
                }
                    $_SESSION['compraDetalle'] = $arrDetalle;
                }else{
                    array_push($arrDetalle, $arrinfoProducto);
                    $_SESSION['compraDetalle'] = $arrDetalle;
                }
                
                $data['producto']=$_SESSION['compraDetalle'];
                $data['isv']=$checkISV;
               
                //$_SESSION['compraDetalle']['ISV']=$checkISV;
               
            
                /* for ($i=0; $i < count($_SESSION['compraDetalle']) ; $i++) { 
                    $subtotal=round($subtotal+$_SESSION['compraDetalle'][$i]['txtPrecioTotal'],2);
                    $total=round($total+$_SESSION['compraDetalle'][$i]['txtPrecioTotal'],2);
                    $detalleTabla.=' <tr>
                    <td>'.$_SESSION['compraDetalle'][$i]['idproducto'].'</td>
                    <td>'.$_SESSION['compraDetalle'][$i]['nombre'].'</td>
                    <td>'.$_SESSION['compraDetalle'][$i]['categoria'].'</td>
                    <td>'.$_SESSION['compraDetalle'][$i]['cantidad'].'</td>
                    <td>'.$_SESSION['compraDetalle'][$i]['precio'].'</td>
                    <td>'.$_SESSION['compraDetalle'][$i]['txtPrecioTotal'].'</td>
                    <td class=""><a class="link_delete" href="$" # onclick="event.preventDefault();del_product_detalle('.$_SESSION['compraDetalle'][$i]['idproducto'].');"><i class="far fa-trash-alt"></i></a></td>
                    </tr>';
                } */

                //$impuesto=round($subtotal*($iva/100),2);
                //$tl_sniva=round($subtotal-$impuesto);
                //$total=round($subtotal+$impuesto);
                
               /*  $detalletTotales=' <tr>
                                    <td colspan="6" class="text-right">Subtotal L.</td>
                                    <td class="text-right">L.'.$subtotal.'</td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="text-right">IVA ('.$iva.'%)</td>
                                    <td class="text-right">L.'.$impuesto.'</td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="text-right">Total </td>
                                    <td class="text-right">L.'.$total.'</td>
                                </tr>'; */

              /*   $arrTabla['detalle']=$detalleTabla;            
                $arrTabla['totales']=$detalletTotales;  */
                $htmlCarrito='';
                $htmlCompras = getFile('Template/Modals/tablaCompra',$data); 
                $htmlTotales = getFile('Template/Modals/tablaTotales',$data);
                    
                $arrResponse = array("status" => true, "msg" => 'Producto agregado',"htmlCompras"=>$htmlCompras,"htmlTotales"=>$htmlTotales);
               
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
			die();
		}
        public function delCompra(){
            
            //unset($_SESSION['compraDetalle']);exit;
           if($_SESSION['permisosMod']['d']){
               $detalleTabla='';
               $idproducto = intval($_POST['idProducto']);
               $checkISV=$_POST['checkISV'];
         
               if (is_numeric($idproducto) ) {
                $arrCompra=$_SESSION['compraDetalle'];
                for ($pr=0; $pr < count($arrCompra); $pr++) {
                    if($arrCompra[$pr]['idproducto'] == $idproducto){
                        unset($arrCompra[$pr]);
                    }
                }
                sort($arrCompra);
                $_SESSION['compraDetalle']=$arrCompra;
                $data['isv']=$checkISV;
               
            
                $htmlCompras = getFile('Template/Modals/tablaCompra',$data); 
                $htmlTotales = getFile('Template/Modals/tablaTotales',$data);
                    
                $arrResponse = array("status" => true, "msg" => 'Producto Eliminado',"htmlCompras"=>$htmlCompras,"htmlTotales"=>$htmlTotales);
                
            }else{
                $arrResponse=array("status"=>false,"msg"=>'Datos Incorrectoss');
            }
              
              
               echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
           }
           die();
       }

       public function anularCompra(){        
      //unset($_SESSION['compraDetalle']);exit;
       if($_SESSION['permisosMod']['d']){
         unset($_SESSION['compraDetalle']);
           if (empty($_SESSION['compraDetalle']) ) {
           
            $arrResponse = array("status" => true, "msg" => 'Productos Eliminados');
            
        }else{
            $arrResponse=array("status"=>false,"msg"=>'Datos Incorrectoss');
        }
          
           echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
       }
       die();
   }




   public function procesarCompra(){
   
    if ($_POST){
     
        $personaid=$_SESSION['idUser'];
        $monto=0;
        $factura=intval($_POST['txtFactura']);
        $idProveedor=intval($_POST['idProveedor']);
        $checkISV=$_POST['checkISV'];
        $isv=datosEmpresa()['Empresa']['ISV'];
        $total=0;
        $cantCompra=0;
        
        //$costo_envio=COSTOENVIO;

        if(!empty($_SESSION['compraDetalle']) and !empty($_POST['txtFactura'])){
            foreach ($_SESSION['compraDetalle'] as $pro) {
                $total += $pro['cantidad']*$pro['precio'];
                
            }
            if ($checkISV=='true') {
     
                $impuesto=$total*($isv/100);
            }else{
                $impuesto=0; 
            }
           
           
            $monto = $total+$impuesto;
           
            //dep($_SESSION['compraDetalle']);
            if($monto>0){
               //CREAR COMPRA
                $request_pedido=$this->model->insertCompra($idProveedor,
                                                                $monto,
                                                                $impuesto,
                                                                $factura,
                                                                $personaid);
                        
                if ($request_pedido>0){
                    foreach ($_SESSION['compraDetalle'] as $producto) {
                        
                        $productoid = $producto['idproducto'];
                        $id=$this->model->selectID($productoid); 
                        $precio = $producto['precio'];
                        $cantidad = $producto['cantidad'];
                        $stock = $producto['stock'];
                        $cantCompra=$producto['cantCompra']+$cantidad;
                        $nuevoStock=$stock+$cantidad;
                        $this->model->insertDetalle($request_pedido,$id['COD_PRODUCTO'],$precio,$cantidad);
                         //Aumentar stock
                         //$id=$this->model->selectID($productoid); 
                      
                        //Aumentar stock
                        $this->model->updateStock($id['COD_PRODUCTO'],$nuevoStock); 
                        //actualizarCant Compra
                        $this->model->updateCantCompra($id['COD_PRODUCTO'],$cantCompra); 

                    }
                
                        //BITACORA
                        Bitacora($_SESSION['idUser'],MCOMPRAS,"Nuevo","Registró la compra #".$request_pedido,''); 
                        $arrResponse= array("status"=> true,"msg"=>'Compra Realizada');
                        
                            unset($_SESSION['compraDetalle']);
                            //session_regenerate_id(true);
                        }
                        
            }

        }else{
            $arrResponse = array("status" => false, "msg" => 'No es posible procesar la Compra.');
        }

    }else{
        $arrResponse= array("status"=> false, "msg" => 'No es posible procesar el pedido.');
    }
    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
    die();
}

      public function Totales()
      {
         
          $checkISV=$_POST['checkISV'];
          $data['isv']=$checkISV;
          $htmlTotales = getFile('Template/Modals/tablaTotales',$data);
          $arrResponse = array("status" => true, "msg" => 'Producto agregado',"htmlTotales"=>$htmlTotales);
          echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
      }







   //Funcion para traer ell Proveedor
        public function getSelectProveedores()
        {
            $htmlOptions = "";
            $arrData = $this->model->selectProveedores();
           
            if(count($arrData) > 0 ){
                for ($i=0; $i < count($arrData); $i++) { 
                
                    $htmlOptions .= '<option value="'.$arrData[$i]['COD_PROVEEDOR'].'">'.$arrData[$i]['NOMBRE_EMPRESA'].'</option>';
                    
                }
           }
            echo $htmlOptions;
            die();		
        }

        
        public function getProveedores()
    {
        if($_SESSION['permisosMod']['r']){ 
        $arrData= $this->model->selectProveedores();
       /* dep($arrData);
        exit;*/
        for ($i=0; $i < count($arrData) ; $i++) { 
            $btnView ='';
            $btnEdit = '';
            $btnDelete = '';

            if ($arrData[$i]['COD_STATUS']==1) {
             $arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';   
            }else{
             $arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
            }
            $btnView = '<button class="btn btn-success btn-sm" onClick="fntProveedorSelect('.$arrData[$i]['COD_PROVEEDOR'].',`'.$arrData[$i]['NOMBRE_EMPRESA'].'`)" title="Seleccionar"><i class="fa-solid fa-check"></i></button>';

            $arrData[$i]['options'] = '<div class="text-center">'.$btnView.'</div>';
            
         } 
        /*  dep($arrData[0]['status']);exit; */
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
     }
         die();
    }  
 }

 
?>