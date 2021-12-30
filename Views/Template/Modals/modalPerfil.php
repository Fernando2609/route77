<!-- Modal -->
<div class="modal fade" id="modalFormPerfil" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <!-- Div Centrar Modal -->
  <div class="modal-dialog modal-lg bounceInDown animated" role="document">
    <div class="modal-content">
      <!-- Div Contenido Modal -->
      <div class="modal-header headerUpdate ">
        <!-- Encabezado Modal -->
        <h5 class="modal-title" id="titleModal">Actualizar Datos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div><!-- Termina Encabezado Modal -->
      <!-- abre Modal Body -->
      <div class="modal-body">
          <!-- Card -->
        


        <!-- formulario Modal -->
        <form id="formPerfil" name="formPerfil" class="form-horizontal">
         
          <!-- <p class="text-success">Todos los campos son obligatorios</p> -->
          <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="txtIdentificacion">DNI <span class="required">*</span></label>
              <input type="text" value="<?=  $_SESSION['userData']['dni'];  ?>"  class="form-control valid validNumber" id="txtIdentificacion" name="txtIdentificacion" required="" onkeypress="return controlTag(event);">
            </div>
            <div class="form-group col-md-6">
              <label for="txtEmail">Email <span class="required">*</span></label>
              <input type="email" class="form-control valid validEmail" id="txtEmail" name="txtEmail"  value="<?=  $_SESSION['userData']['email'];  ?>"  readonly disabled required="">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="txtNombre">Nombres <span class="required">*</span></label>
              <input type="text" class="form-control valid validText" id="txtNombre" name="txtNombre"  value="<?=  $_SESSION['userData']['nombres'];  ?>" required="">
            </div>
            <div class="form-group col-md-6">
              <label for="txtApellido">Apellidos <span class="required">*</span></label>
              <input type="text" class="form-control valid validText" id="txtApellido" name="txtApellido"  value="<?=  $_SESSION['userData']['apellidos'];  ?>" required="">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="txtTelefono">Teléfono <span class="required">*</span></label>
                <input type="text" class="form-control valid validNumber" id="txtTelefono" name="txtTelefono"  value="<?=  $_SESSION['userData']['telefono'];  ?>" required="" onkeypress="return controlTag(event);">
            </div>
            <div class="form-group col-md-6">
              <label for="fechaNacimiento">Fecha de Nacimiento</label>
              <input type="date" class="form-control"  value="<?=  $_SESSION['userData']['fechaNaci'];  ?>" id="fechaNacimiento" name="fechaNacimiento" >
            </div>
        </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="listNacionalidad">Nacionalidad <span class="required">*</span></label>
              <select class="form-control"  value="<?=  $_SESSION['userData']['idNacionalidad'];  ?>" data-live-search="true" id="listNacionalidad" name="listNacionalidad" required>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="listGenero">Genero</label>
              <select class="form-control " id="listGenero"  value="<?=  $_SESSION['userData']['idGenero'];  ?>" name="listGenero">
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="listEstadoC">Estado Civil</label>
              <select  value="<?=  $_SESSION['userData']['idEstado'];  ?>" class="form-control" data-live-search="true" id="listEstadoC" name="listEstadoC" >
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="listSucursal">Sucursal</label>
              <select class="form-control"  value="<?=  $_SESSION['userData']['idsucursal'];  ?>" id="listSucursal" name="listSucursal">
              </select>
            </div>
          </div>
         
        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="txtPassword">Password</label>
              <input type="password" class="form-control" id="txtPassword" name="txtPassword">
            </div>
            <div class="form-group col-md-6">
                <label for="txtPasswordConfirm">Confirmar Password</label>
                <input type="password" class="form-control" id="txtPasswordConfirm" name="txtPasswordConfirm" >
            </div>
          </div>

          <!-- /.Cierra card-body -->

          <div class="card-footer">
            <button id="btnActionForm" class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;

            <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
          </div>
        </form>

      </div><!-- /. Cierra  Div body Modal -->
    </div><!-- /. Cierra  Div Centrar Modal -->
  </div><!-- /. Cierre Div Centrar Modal -->
</div>
<!-- Cierra Modal -->

