<?php

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
            getPermisos(17);
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
                $txtPrecio = ucwords(strClean($_POST['txtPrecio']));
                $txtPrecioTotal =$intCantidad*$txtPrecio;
                $arrDetalle=array();
                $arrTabla=array();
                $subtotal=0;
                $total=0;
                $iva=15;
                
                //$user=intval($_SESSION['idUser']);
                $arrData = $this->model->selectProducto($idproducto);
                
               $arrinfoProducto=array('idproducto' => $idproducto,
               'cantidad' => $intCantidad,
               'nombre'=>$arrData['NOMBRE'],
               'categoria'=>$arrData['CATEGORÍA'],
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

                $impuesto=round($subtotal*($iva/100),2);
                //$tl_sniva=round($subtotal-$impuesto);
                $total=round($subtotal+$impuesto);
                
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
                $htmlCompras = getFile('Template/Modals/tablaCompra',$_SESSION['compraDetalle']); 
                $htmlTotales = getFile('Template/Modals/tablaTotales',$_SESSION['compraDetalle']);
                    
                $arrResponse = array("status" => true, "msg" => 'agregado Correctamente',"htmlCompras"=>$htmlCompras,"htmlTotales"=>$htmlTotales);
               
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
			die();
		}
        public function delCompra(){
            
            //unset($_SESSION['compraDetalle']);exit;
           if($_SESSION['permisosMod']['d']){
               $detalleTabla='';
               $idproducto = intval($_POST['idProducto']);
               if (is_numeric($idproducto) ) {
                $arrCompra=$_SESSION['compraDetalle'];
                for ($pr=0; $pr < count($arrCompra); $pr++) {
                    if($arrCompra[$pr]['idproducto'] == $idproducto){
                        unset($arrCompra[$pr]);
                    }
                }
                sort($arrCompra);
                $_SESSION['compraDetalle']=$arrCompra;
               
            
                $htmlCompras = getFile('Template/Modals/tablaCompra',$_SESSION['compraDetalle']); 
                $htmlTotales = getFile('Template/Modals/tablaTotales',$_SESSION['compraDetalle']);
                    
                $arrResponse = array("status" => true, "msg" => 'agregado Correctamente',"htmlCompras"=>$htmlCompras,"htmlTotales"=>$htmlTotales);
                
            }else{
                $arrResponse=array("status"=>false,"msg"=>'Datos Incorrectoss');
            }
              
              
               echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
           }
           die();
       }


        
 }
?>