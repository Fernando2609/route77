<?php
$subtotal=0;
$total=0;
$iva=15;

if (isset($_SESSION['compraDetalle']) and count($_SESSION['compraDetalle'])>0) {
?>
        
    <?php
    foreach($_SESSION['compraDetalle'] as $producto )
    {   
        
        $subtotal=$subtotal+$producto['txtPrecioTotal'];
        $total=$total+$producto['txtPrecioTotal'];
    ?>
    <?php } ?>
    <?php
    if ($data['isv']=='true') {
     
        $impuesto=$subtotal*($iva/100);
    }else{
        $impuesto=0; 
    }
       
        //$tl_sniva=round($subtotal-$impuesto);
        $total=$subtotal+$impuesto;
    ?>
    <tr>
        <td colspan="6" class="text-right">Subtotal L.</td>
        <td class="text-right"><?= SMONEY.' '. formatMoney($subtotal)  ?></td>
    </tr>
    <tr>
        <td colspan="6" class="text-right">IVA (<?=  $iva  ?>%)</td>
        <td class="text-right"><?= SMONEY.' '. formatMoney($impuesto)  ?></td>
    </tr>
    <tr>
        <td colspan="6" class="text-right">Total </td>
        <td class="text-right"><?=SMONEY.' '.  formatMoney($total) ?></td>
    </tr>
   
<?php } ?>