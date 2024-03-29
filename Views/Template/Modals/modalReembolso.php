<?php
$trs=$data->purchase_units[0];
$cl=$data->payer;
$idTransaccion = $trs->payments->captures[0]->id;
//Datos del cliente
$nombreCliente = $cl->name->given_name.' '.$cl->name->surname;
$emailCliente = $cl->email_address;
$telCliente = isset($cl->phone) ? $cl->phone->phone_number->national_number : "";
$codCiudad =  $cl->address->country_code;
 //Detalle montos 
 $totalCompra =  $trs->payments->captures[0]->seller_receivable_breakdown->gross_amount->value;
 $comision =  $trs->payments->captures[0]->seller_receivable_breakdown->paypal_fee->value; 
 $importeNeto =  $trs->payments->captures[0]->seller_receivable_breakdown->net_amount->value;
 $moneda = $trs->payments->captures[0]->amount->currency_code;
?>
<!-- Modal view -->
<div class="modal fade" id="modalReembolso" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Hacer Reembolso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <input type="hidden" id="idtransaccion" value="<?= $idTransaccion ?>">
          <tbody>
            <tr>
              <td>Transacción:</td>
              <td> <?= $idTransaccion ?></td>
            </tr>
            <tr>
              <td>Datos Contacto:</td>
              <td><?= $nombreCliente ?> <br> <?= $emailCliente ?> <br> <?= $telCliente ?></td>
            </tr>
            <tr>
              <td>Importe Total Reembolso:</td>
              <td><?= $totalCompra.' '.$moneda ?></td>
            </tr>
            <tr>
              <td>Importe Neto Reembolso:</td>
              <td><?= $importeNeto.' '.$moneda ?></td>
            </tr>
            <tr>
              <td>Comisión Reembolso por Paypal:</td>
              <td><?= $comision.' '.$moneda ?></td>
            </tr>
            <tr>
              <td>Observación:</td>
              <td > <textarea id="txtObservacion" class="form-control"></textarea> </td>
            </tr>
            <tr >
              
              <td colspan="2">
              <div class="d-flex">
              Reembolsar Producto:
              <div class="toggle-flip ml-3">
                <label>
                  <input type="checkbox" name="checkReembolso" id="checkReembolso" class="selectAll"><span class="flip-indecator" data-toggle-on="Si"  data-toggle-off="No"></span>
                </label>
              </div>
              </div>
              </td>
              
            </tr>
          </tbody>
        </table>
      </div>
<div class="modal-footer">                                      
        <button type="button" class="btn btn-primary" onclick="fntReembolsar()"><i class="fa fa-reply-all" aria-hidden="true"></i> Reembolsar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

