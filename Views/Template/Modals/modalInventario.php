<!-- Modal -->
<div class="modal fade" id="modalViewInventario" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

  <!-- Div Centrar Modal -->
  <div class="modal-dialog bounceInDown animated" role="document">
    <div class="modal-content">
      <!-- Div Contenido Modal -->
      <div class="modal-header header-primary">
        <!-- Encabezado Modal -->
        <h5 class="modal-title" id="titleModal">Datos del Inventario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div><!-- Termina Encabezado Modal -->
      <!-- abre Modal Body -->
      <div class="modal-body">
        <!-- Card -->
        <table class="table table-bordered">
          <tbody>
            
            <tr>
              <td>Producto</td>
              <td id="celproducto">Jacob</td>
            </tr>
            <tr>
              <td>Stock</td>
              <td id="celstock">Jacob</td>
            </tr>
            <tr>
              <td>Cantidad Vendida</td>
              <td id="celCant_Vent">Larry</td>
            </tr>
            <tr>
              <td>Cantidad Comprada</td>
              <td id="celCant_Comp">Larry</td>
            </tr>
            <!-- <tr>
              <td>Rol Usuario:</td>
              <td id="celTipoUsuario">Larry</td>
            </tr> -->
            
              <td>Cantidad Mínima</td>
              <td id="celCant_Min">Larry</td>
            </tr>
         
          </tbody>
        </table>

      </div><!-- /. Cierra  Div body Modal -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div><!-- /. Cierra  Div Centrar Modal -->
  </div><!-- /. Cierre Div Centrar Modal -->
</div>
<!-- Cierra Modal -->

<!-- Modal -->
<div class="modal fade" id="modalEditInventario" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

  <!-- Div Centrar Modal -->
  <div class="modal-dialog bounceInDown animated" role="document">
    <div class="modal-content">
      <!-- Div Contenido Modal -->
      <div class="modal-header header-primary">
        <!-- Encabezado Modal -->
        <h5 class="modal-title" id="titleModalEdit">Stock del Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div><!-- Termina Encabezado Modal -->
      <!-- abre Modal Body -->
      <div class="modal-body">
        <!-- Card -->
        <form id="formInventario" name="formInventario" class="form-Horizontal">  

        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="">Cantidad<span class="required"></span></label>
              <input type="number" min="0" class="form-control"  id="stockupdate"  maxlength="8" name="stockupdate" >
            </div>
            <div class="form-group col-md-6">
            <label for="listMovimiento">Movimiento <span class="required">*</span></label>
              <select class="form-control selectpicker" id="listMovimiento" name="listMovimiento" required="">
                <option value="1">Entrada</option>
                <option value="2">Salida</option>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-12">
              <label for="">Descripción<span class="required"></span></label>
              <input type="text" class="form-control" id="txtDescripcion" name="txtDescripcion" >
            </div>
          </div>

        <input type="hidden" id="idInventario" name="idInventario" value="">


      </div><!-- /. Cierra  Div body Modal -->

      <div class="card-footer">
            <button id="btnActionForm" class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;

            <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
          </div>
          </form>  
    </div><!-- /. Cierra  Div Centrar Modal -->
  </div><!-- /. Cierre Div Centrar Modal -->
</div>
<!-- Cierra Modal -->



<div class="modal fade" id="modalViewMovimientos" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

  <!-- Div Centrar Modal -->
  <div class="modal-dialog bounceInDown animated modal-lg" role="document">
    <div class="modal-content">
      <!-- Div Contenido Modal -->
      <div class="modal-header headerRegister">
        <!-- Encabezado Modal -->
        <h5 class="modal-title" id="titleMvimientosEdit">Movimientos del producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div><!-- Termina Encabezado Modal -->
      <!-- abre Modal Body -->
      <div class="modal-body">
        <!-- Card -->
        <table id="compromiso_ejecutivo" class="display nowrap table-responsive table table-hover table-bordered  dataTable dtr-inline collapsed"  role="grid">
                        <thead>
                          <tr>
                              <th>ID</th>
                              <th>Movimiento</th>
                              <th>Cantidad</th>
                              <th>Precio</th>
                              <th>Usuario</th>
                              <th>Descripción</th>
                              <th>Fecha</th>
                              

  
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
<!-- Cierra Modal -->


