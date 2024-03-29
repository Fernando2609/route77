<?php headerAdmin($data); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1><i class="fa fa-file-text-o"></i> <?= $data['page_title'] ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard"><i class="fas fa-home casa"></i></a></li>
                        <li class="breadcrumb-item active"><a href="<?= base_url(); ?>/pedidos"> Pedidos</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section id="sPedido" class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <?php
                    if (empty($data['arrPedido'])) {
                    ?>
                        <p> Datos no encontrados</p>
                    <?php } else {
                        $cliente = $data['arrPedido']['cliente'];
                        $orden = $data['arrPedido']['orden'];
                        $detalle = $data['arrPedido']['detalle'];
                        
                        $transaccion = $orden['COD_TRANSACCION_PAYPAL'] != "" ?
                            $orden['COD_TRANSACCION_PAYPAL'] :
                            $orden['REFERENCIA_COBRO'];
                           
                    ?>

                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <!-- Acá empieza la orden -->
                                   <img width="42" src="<?= media(); ?>/images//logo3.ico" alt="" srcset=""><?= datosEmpresa()['Empresa']['NOMBRE_EMPRESA'] ?>
                                    <small class="float-right">Fecha: <?= $orden['fecha'] ?></small>
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">

                                    <address>
                                       
                                        
                                       RTN: <?= datosEmpresa()['Empresa']['RTN'] ?><br>
                                        <?= datosEmpresa()['Empresa']['EMAIL_EMPRESA'] ?>
                                        <br>
                                        <?= datosEmpresa()['Empresa']['TEL_EMPRESA'] ?>
                                        <br>
                                        <?= datosEmpresa()['Empresa']['CEL_EMPRESA'] ?>
                                        <br>
                                        <?= WEB_EMPRESA?>
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">

                                    <address>
                                        <strong><?= $cliente['NOMBRES'] . ' ' . $cliente['APELLIDOS'] ?></strong><br>
                                        Envío: <?= $orden['DIRECCION_ENVIO']; ?><br>
                                        <?php
                                            $pos=strpos($orden['DIRECCION_ENVIO'],'/Ref');
                                            if ($pos!==false) {
                                                # code...
                                            $ubicacion=explode("/",$orden['DIRECCION_ENVIO']);
                                            
                                            
                                        ?>
                                        <a href="https://maps.google.com/?q=<?=  $ubicacion[0]  ?>" target="_blank">Ver ubicacion <i class="fa-solid fa-map-location-dot"></i> </a><br>
                                        <?php } ?>
                                        Tel: <?= $cliente['TELEFONO'] ?><br>
                                        Email: <?= $cliente['EMAIL'] ?>
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <b>Orden #<?= $orden['COD_PEDIDO'] ?></b>
                                    <b>Pago: </b><?= $orden['TIPO_PAGO'] ?><br>
                                    <b>Transacción:</b> <?= $transaccion ?> <br>
                                    <b>Estado:</b> <?= $orden['status'] ?> <br>
                                    <b>Monto:</b> <?= SMONEY . ' ' . formatMoney($orden['MONTO']) ?>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Descripción</th>
                                                <th class="text-right">Precio</th>
                                                <th class="text-center">Cantidad #</th>
                                                <th class="text-right">Importe</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $subtotal = 0;
                                            if (count($detalle) > 0) {
                                                foreach ($detalle as $producto) {
                                                    $subtotal += $producto['CANTIDAD'] * $producto['PRECIO'];

                                            ?>
                                                    <tr>
                                                        <td><?= $producto['producto'] ?></td>
                                                        <td class="text-right"><?= SMONEY . ' ' . formatMoney($producto['PRECIO']) ?></td>
                                                        <td class="text-center"><?= $producto['CANTIDAD'] ?></td>
                                                        <td class="text-right"><?= SMONEY . ' ' . formatMoney($producto['CANTIDAD'] * $producto['PRECIO']) ?></td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="3" class="text-right">Sub-Total:</th>
                                                <td class="text-right"><?= SMONEY . ' ' . formatMoney($subtotal) ?></td>
                                            </tr>
                                            <tr>
                                                <th colspan="3" class="text-right">Envío:</th>
                                                <td class="text-right"><?= SMONEY . ' ' . formatMoney($orden['COSTOENVIO']) ?></td>
                                            </tr>
                                            <tr>
                                                <th colspan="3" class="text-right">Total:</th>
                                                <td class="text-right"><?= SMONEY . ' ' . formatMoney($orden['MONTO']) ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <!-- accepted payments column -->

                                <!-- /.col -->

                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- this row will not appear when printing -->
                            <div class="row no-print">
                                <div class="col-12">
                                    <a href="javascript:window.print('#sPedido');" class="btn btn-primary"><i class="fas fa-print"></i> Imprimir</a>

                                    <?php
                                        if ($pos!==false) {              
                                    ?>  
                                    <a href="https://maps.google.com/?q=<?=  $ubicacion[0]  ?>" class="btn btn-success" target="_blank"><i class="fa-solid fa-map-location-dot"></i> Ver Ubicación</a>
                                    <?php } ?>
                                    
                                    
                                </div>
                            </div>
                        </div>
                        <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
<?php } ?>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php footerAdmin($data); ?>