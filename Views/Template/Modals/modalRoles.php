<!-- Modal -->
<div class="modal fade" id="ModalFormRol" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Registro De Nuevo Rol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- abre Modal Body -->
      <div class="modal-body">
          <!-- general form elements -->
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Nuevo Rol</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="formRol" name="formRol">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputNombre">Nombre</label>
                    <input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Nombre del rol" required="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputDescrip">Descripción</label>
                    <input type="text" class="form-control" id="txtDescripcion" name="txtDescripcion" placeholder="Descripción del rol" required="">
                  </div>

                  <div class="form-group">
                        <label>Estado</label>
                        <select class="custom-select" id="listStatus" name="listStatus" required="">
                          <option value="1">Activo</option>
                          <option value="2">Inactivo</option>
                        
                         </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                  <button type="submit" class="btn btn-secondary">Cancelar</button>
                </div>
              </form>
            </div>
    
      </div>
      <!-- Cierra Modal Body -->
     <!--  <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>

    