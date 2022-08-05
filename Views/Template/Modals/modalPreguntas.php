<!-- Modal -->
<div class="modal fade" id="ModalFormPreguntas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
  <!-- Div Centrar Modal -->
  <div class="modal-dialog modal-dialog-centered bounceInDown animated" role="document">
    <div class="modal-content" ><!-- Div Contenido Modal -->
      <div class="modal-header headerRegister "> <!-- Encabezado Modal -->
        <h5 class="modal-title" id="titleModal">Registro De Nueva Pregunta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div><!-- Termina Encabezado Modal -->
      <!-- abre Modal Body -->
      <div class="modal-body">
          <!-- Card -->
        <div class="card">
          
          <!-- formulario Modal -->
          <form id="formPreguntas" name="formPreguntas">
              <input type="hidden" id="idPreguntas" name="idPreguntas" value="">
                <div class="card-body"><!-- Card Body-->
                  <!-- Div Text -->
                  <div class="form-group">
                    <label for="exampleInputNombre">Pregunta</label>
                    <input type="text" class="form-control valid validText" id="txtPreguntas" name="txtPreguntas" placeholder="Pregunta" required="" maxlength="100">
                  </div>
                  <!-- Cierra Text -->

                  <!-- Div Text -->
                  <!-- Div Form-Group -->
                </div>
                <!-- /.Cierra card-body -->

            <div class="card-footer">
              <button id="btnActionForm" class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>
              &nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#" data-dismiss="modal" ><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
            </div>
          </form>
        </div> <!-- /.Cierra card -->
      </div><!-- /. Cierra  Div body Modal -->
    </div><!-- /. Cierra  Div Centrar Modal -->
  </div><!-- /. Cierre Div Centrar Modal -->
</div>
<!-- Cierra Modal -->

<!-- Modal -->
<div class="modal fade" id="modalViewPreguntas" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <!-- Div Centrar Modal -->
    <div class="modal-dialog bounceInDown animated" role="document">
        <div class="modal-content">
            <!-- Div Contenido Modal -->
            <div class="modal-header header-primary">
                <!-- Encabezado Modal -->
                <h5 class="modal-title" id="titleModal">Pregunta</h5>
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
                            <td>Pregunta:</td>
                            <td id="celPreguntas">InShot</td>
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