<?php
$subtotal=0;
$total=0;
$iva=15;
if (isset($_SESSION['compraDetalle']) and count($_SESSION['compraDetalle'])>0) {
?>
        
    <?php
    foreach($_SESSION['compraDetalle'] as $producto )
    {   
        
        $subtotal=round($subtotal+$producto['txtPrecioTotal'],2);
        $total=round($total+$producto['txtPrecioTotal'],2);
    ?>
    <?php } ?>
    <?php
        $impuesto=round($subtotal*($iva/100),2);
        //$tl_sniva=round($subtotal-$impuesto);
        $total=round($subtotal+$impuesto);
    ?>
    <tr>
        <td colspan="6" class="text-right">Subtotal L.</td>
        <td class="text-right">L.<?=  $subtotal  ?></td>
    </tr>
    <tr>
        <td colspan="6" class="text-right">IVA (<?=  $iva  ?>%)</td>
        <td class="text-right">L. <?=  $impuesto  ?></td>
    </tr>
    <tr>
        <td colspan="6" class="text-right">Total </td>
        <td class="text-right">L.<?=  $total  ?></td>
    </tr>
   
<?php } ?>