<!-- Modal -->
<div class="modal fade" id="modalViewInventario" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <!-- Div Centrar Modal -->
  <div class="modal-dialog bounceInDown animated" role="document">
    <div class="modal-content">
      <!-- Div Contenido Modal -->
      <div class="modal-header header-primary">
        <!-- Encabezado Modal -->
        <h5 class="modal-title" id="titleModal">Bitácora Detalles</h5>
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
              <td>Fecha</td>
              <td id="celFecha"></td>
            </tr>
            <tr>
              <td>Usuario</td>
              <td id="celUsuario"></td>
            </tr>
            <tr>
              <td>Módulo</td>
              <td id="celModulo"></td>
            </tr>
            <tr>
              <td>Acción</td>
              <td id="celAccion"></td>
            </tr>
           
            <tr>
              <td>Descripción</td>
              <td rowspan="2" id="celDescripcion">Larry</td>
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