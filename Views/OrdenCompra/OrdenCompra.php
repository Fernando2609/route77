<?php
headerAdmin($data);
getModal('modalInventario', $data);
?>
<div class="modal fade" id="modalProveedores" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

<!-- Div Centrar Modal -->
<div class="modal-dialog bounceInDown animated modal-lg" role="document">
  <div class="modal-content">
    <!-- Div Contenido Modal -->
    <div class="modal-header  header-primary">
      <!-- Encabezado Modal -->
      <h5 class="modal-title" id="titleMvimientosEdit">Selección de Proveedor</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div><!-- Termina Encabezado Modal -->
    <!-- abre Modal Body -->
    <div class="modal-body">
      <!-- Card -->
      <table id="tableProveedores" class="display nowrap table-responsive table table-hover table-bordered  dataTable dtr-inline collapsed" style="width:100%"  role="grid">
                      <thead>
                        <tr>
                            <th>ID</th>
                            <th>Empresa</th>
                            <th>RTN</th>
                            <th>Email</th>
                            <!-- <th>Teléfono</th> -->
                            <th>Seleccionar</th>
                        </tr>
                      </thead>
                      <tbody>
                      
                      </tbody>
                  </table>

    </div><!-- /. Cierra  Div body Modal -->
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    </div>
  </div><!-- /. Cierra  Div Centrar Modal -->
</div><!-- /. Cierre Div Centrar Modal -->
</div>
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
                                        <label for="exampleInputNombre">N° Factura  (<span class="required">*</span>)</label>
                                        <input type="text" class="form-control  valid validNumber" id="txtFactura" name="txtFactura" placeholder="Número de Factura" required>
                                    </div>
                                    
                                    
                                    <div class="form-group col-md-6">
                                        <div class="d-flex justify-content-between">
                                            <label for="listProveedor">Proveedor</label>
                                        <!-- <select class="form-control" id="listProveedor" name="listProveedor"  data-live-search="true" required>
                                           
                                            </select> -->
                                            <button onclick="modalProveedores()" class="btn btn-primary mb-2 ">Seleccionar Proveedor</button>
                                        </div>
                                        <input disabled placeholder="Seleccione un Proveedor" id="txtProveedor" name="txtProveedor" type="text" class="form-control"></input>
                                        <input type="hidden" id="codProveedor" name="codProveedor" value="">
                                    </div>
                                    <!-- Div Form-Group -->
                                </div>
                            
                            
            
                                </div>
                            <div class="tile-footer d-flex justify-content-end">
                            <div class="form-group mr-4">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="checkISV">
                                    <label class="custom-control-label" for="checkISV">ISV <?=  datosEmpresa()['Empresa']['ISV']  ?>%</label>
                                </div>
                            </div>
                                <button id="btn_facturar_compra" class="btn btn-success notBlock" type="submit"><i class="fa fa-fw fa-lg fa-check-circle "></i><span id="btnText">Generar Compra</span></button>&nbsp;&nbsp;&nbsp;
                                <button class="btn btn-danger" type="button" id="btn_anular_compra"><i class="fa fa-fw fa-lg fa-times-circle"></i>Anular</button>
                            </div>
                            
                             
                        </div>
                            <div class="card-body table-responsive p-0">
                                <table  class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th style="width: 100px">Código</th>
                                            <th style="width: 400px; padding-left: 30px;">Nombre</th>
                                            <th>Categoría</th>
                                            <th style="width: 100px">Cantidad</th>
                                            <th style="width: 100px">Precio</th>
                                            <th style="width: 100px">Precio Total</th>
                                            <th>Acción</th>
                                        </tr>
                                        <tr>
                                            <td style="width: 17rem;"><input class="w-100 form-control valid validNumber" type="text" name="idProducto" id="idProducto" onkeypress="return controlTag(event);"></td>
                                            <td style="padding-left: 35px;" id="nombre">-</td>
                                            <td id="txtCategoria">-</td>
                                            <td><input type="text" class="w-100  form-control validNumber " name="txtCantidad" id="txtCantidad" value="0" min="1" disabled  onkeypress="return controlTagPrecio(event);"></td>
                                            <td ><input type="text" class="w-100  form-control valid validNumberPrecio" name="txtPrecio" id="txtPrecio" value="0" min="1" disabled  onkeypress="return controlTagPrecio(event);"></td>
                                            <td class="text-right" id="txtPrecioTotal">0.00</td>
                                            <td ><a class="notBlock" id="add_product_Compra" class="link_add"><i class="fa fa-plus"></i>Agregar</a></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 100px">Código</th>
                                            <th style="width: 400px">Nombre</th>
                                            <th>Categoría</th>
                                            <th style="width: 100px">Cantidad</th>
                                            <th style="width: 100px">Precio</th>
                                            <th style="width: 100px">Precio Total</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tablaCompra">
                                    <?=  getModal("tablaCompra",$data)  ?>
                                    </tbody>
                                <tfoot id="detalle_totales">
                                <?=  getModal("tablaTotales",$data)  ?>
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