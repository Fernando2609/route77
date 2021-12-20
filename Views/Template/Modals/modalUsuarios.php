<!-- Modal -->
<div class="modal fade" id="modalFormUsuario" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
  <!-- Div Centrar Modal -->
  <div class="modal-dialog modal-lg bounceInDown animated" role="document">
    <div class="modal-content" ><!-- Div Contenido Modal -->
      <div class="modal-header headerRegister "> <!-- Encabezado Modal -->
        <h5 class="modal-title" id="titleModal">Registro De Nuevo Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div><!-- Termina Encabezado Modal -->
      <!-- abre Modal Body -->
      <div class="modal-body">
          <!-- Card -->
        
          <!-- formulario Modal -->
          <form id="formUsuario" name="formUsuario" class="form-horizontal">
              <input type="hidden" id="idUsuario" name="idUsuario" value="">
              <p class="text-success">Todos los campos son obligatorios</p>
              
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="txtIdentificacion">DNI</label>
                    <input type="text" class="form-control" id="txtIdentificacion" name="txtIdentificacion" required="">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="txtNombre">Nombres</label>
                    <input type="text" class="form-control valid validText" id="txtNombre" name="txtNombre" required="">
                  </div>
                <div class="form-group col-md-6">
                  <label for="txtApellido">Apellidos</label>
                  <input type="text" class="form-control valid validText" id="txtApellido" name="txtApellido" required="">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="txtTelefono">Teléfono</label>
                  <input type="text" class="form-control valid validNumber" id="txtTelefono" name="txtTelefono" required="" onkeypress="return controlTag(event);">
                </div>
                <div class="form-group col-md-6">
                  <label for="txtEmail">Email</label>
                  <input type="email" class="form-control valid validEmail" id="txtEmail" name="txtEmail" required="">
                </div>
              </div>
             
             <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="listNacionalidad">Nacionalidad</label>
                    <select class="form-control" data-live-search="true" id="listNacionalidad" name="listNacionalidad" required >
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="listGenero">Genero</label>
                    <select class="form-control " id="listGenero" name="listGenero" required >
                    </select>
                </div>
             </div>
             <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="listEstadoC">Estado Civil</label>
                    <select class="form-control" data-live-search="true" id="listEstadoC" name="listEstadoC" required >
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="listSucursal">Sucursal</label>
                    <select class="form-control " id="listSucursal" name="listSucursal" >
                    </select>
                </div>
             </div>
              <div class="form-row">
              <div class="form-group col-md-6">
                    <label for="fechaNacimiento">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" required >
                </div>
                <div class="form-group col-md-6">
                    <label for="listRolid">Tipo usuario</label>
                    <select class="form-control" data-live-search="true" id="listRolid" name="listRolid" required >
                    </select>
                </div>
                
             </div>
             <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="txtPassword">Password</label>
                  <input type="password" class="form-control" id="txtPassword" name="txtPassword" >
                </div>
                <div class="form-group col-md-6">
                    <label for="listStatus">Status</label>
                    <select class="form-control selectpicker"  id="listStatus" name="listStatus" required >
                        <option value="1">Activo</option>
                        <option value="2">Inactivo</option>
                    </select>
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

