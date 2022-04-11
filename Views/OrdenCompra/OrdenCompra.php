<?php
headerAdmin($data);
getModal('modalInventario', $data);
?>
<!-- Content Header (Sección de Encabezado) -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <!-- Div Container-Fluid -->
            <div class="row mb-2">
                <!-- Div row y margen abajo de 2-->
                <div class="col-sm-6 d-flex">
                    <!-- Div 6 columnas derecha-->
                    <!--Titulo-->
                    <h1><i class="fas fa-user-tag"></i> <?= $data['page_title'] ?> </h1>
                    <!--Boton Nuevo-->
                    <!--    <?php if ($_SESSION['permisosMod']['w']) { ?>
              <button type="button" class="btn btn-success btn-nuevo" onclick="openModal();"><i class="fas fa-plus-square"></i>  Nuevo</button>
              <?php } ?>  -->
                </div><!-- / termina Div 6 columnas derecha-->
                <div class="col-sm-6">
                    <!-- Div 6 columnas Izquierda-->
                    <ol class="breadcrumb float-sm-right">
                        <!--Icono Casa-->
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/clientes"><i class="fas fa-home casa"></i></a></li>
                        <li> / <?= $data['page_title'] ?></li>
                    </ol>
                </div><!-- Termina Div 6 columnas Izquierda-->
            </div><!-- termina Div row y margen abajo de 2-->
        </div><!-- /. Termina container-fluid -->
    </section><!-- / Content Header (/. Sección de Encabezado) -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Tabla -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Nueva Compra</h3>
                        </div>
                        <div class="pr-5 pl-5 ">
                        
                            <div class="row">
                                <div class="col-md-12" style="display: flex;align-items: self-end;">

                                    <div class="form-group col-md-6">
                                        <label for="exampleInputNombre">Nombre  (<span class="required">*</span>)</label>
                                        <input type="text" class="form-control" id="txtFactura" name="txtFactura" placeholder="Nombre de la Categoría" required="">
                                    </div>
                                    
                                    
                                        <div class="form-group col-md-6">
                                        <label for="listStatus">Estado</label>
                                        <select class="form-control selectpicker" id="listStatus" name="listStatus" required>
                                            <option value="1">Activo</option>
                                            <option value="2">Inactivo</option>
                                        </select>
                                    </div>
                                    <!-- Div Form-Group -->
                                </div>
                            
                            
            
                                </div>
                            <div class="tile-footer">
                                <button id="btn_facturar_compra" class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                                <button class="btn btn-danger" type="button" id="btn_facturar_compra"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
                            </div>
                            
                             
                        </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th style="width: 100px">codigo</th>
                                            <th style="width: 400px">Nombre</th>
                                            <th>Categoría</th>
                                            <th style="width: 100px">Cantidad</th>
                                            <th style="width: 100px">Precio</th>
                                            <th style="width: 100px">Precio Total</th>
                                            <th>Acción</th>
                                        </tr>
                                        <tr>
                                            <td><input class="w-100" type="text" name="idProducto" id="idProducto"></td>
                                            <td id="nombre">-</td>
                                            <td id="txtCategoria">-</td>
                                            <td><input type="text" class="w-100" name="txtCantidad" id="txtCantidad" value="0" min="1" disabled></td>
                                            <td><input type="text" class="w-100" name="txtPrecio" id="txtPrecio" value="0" min="1" disabled></td>
                                            <td id="txtPrecioTotal">0.00</td>
                                            <td ><a class="notBlock" href="#" id="add_product_Compra" class="link_add"><i class="fa fa-plus"></i>Agregar</a></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Carne de cerdo libra</td>
                                            <td>Carne</td>
                                            <td>1</td>
                                            <td>50</td>
                                            <td>50</td>
                                            <td class=""><a class="link_delete" href="$" # onclick="event.preventDefault();del_product_detalle(1);"><i class="far fa-trash-alt"></i></a></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="6" class="text-right">Subtotal L.</td>
                                            <td class="text-right">L.88.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" class="text-right">IVA (12%)</td>
                                            <td class="text-right">L.50.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" class="text-right">Total </td>
                                            <td class="text-right">L.150.00</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <!-- termina Tabla -->
                      
                        <!-- /.termina card-body -->
                    </div>
                    <!-- /.termina card -->
                </div>
                <!-- /.termina col -->
            </div>
            <!-- /. termina ow -->
        </div>
        <!-- /. termina container-fluid -->
    </section>
    <!-- /. termina content -->
</div>
<!-- /.content-wrapper / Div Principal -->

<?php footerAdmin($data); ?>