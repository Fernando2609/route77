
<?php 

headerAdmin($data); 
/* getModal('modalCategorias', $data); */

?>

<script>alert("hola")</script>
  <!-- Content Wrapper. Contains page content -- Div Principal -->
  <div class="content-wrapper">
      <!-- Content Header (Sección de Encabezado) -->
      <section class="content-header">
        <div class="container-fluid"><!-- Div Container-Fluid -->
          <div class="row mb-2"> <!-- Div row y margen abajo de 2-->
            <div class="col-sm-6 d-flex"><!-- Div 6 columnas derecha-->
              <!--Titulo-->
              <h1><i class="fa-solid fa-database"></i> <?= $data['page_title'] ?> </h1>
              
            </div><!-- / termina Div 6 columnas derecha-->
            <div class="col-sm-6"> <!-- Div 6 columnas Izquierda-->
              <ol class="breadcrumb float-sm-right">
                <!--Icono Casa-->
              <li class="breadcrumb-item"><a href="<?=base_url();?>/dashboard"><i class="fas fa-home casa"></i></a></li>
              <li> / <?= $data['page_title'] ?></li>
              </ol>
            </div><!-- Termina Div 6 columnas Izquierda-->
          </div><!-- termina Div row y margen abajo de 2-->
        </div><!-- /. Termina container-fluid -->
      </section><!-- / Content Header (/. Sección de Encabezado) -->
      
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12"><!-- div 12 -->
              <div class="card"><!-- div card -->
               <!-- Encabezado -->
                <div class="card-header">
                  <h2 class="card-title">Mantenimiento de la base de datos</h2>
                </div> 
                <!-- /.card-body -->
                <div class="card-body">
                 <div class="row">
                    <?php
                    if($_SESSION['permisosMod']['w']){
                    ?>
                    <div class="col-md-6 ">
                        <div class="card">
                            <div class="card-header">
                                <h3>Respaldo Manual de la BD</h3>
                            </div>
                           <div class="card-body">
                              <div>
                               <p>Los respaldos son de suma importancia en el sistema. Es por ello que se recomienda reealizar respaldo periódicamente, dependiedo de tus necesidades.</p>
                               </div>
                               <hr>
                               <div class="text-right">
                                <button class="btn btn-success" onclick="fntRespaldo();"id="idUtilidad"><span><i class="fa-solid fa-database" aria-hidden="true"></i></span> Respaldar</button>
                              </div>
                           </div>
                       </div>
                    </div>
                    <?php } ?>
                    <?php
                    if($_SESSION['permisosMod']['u']){
                    ?>
                    <div class="col-md-6">
                      <div class="card">
                            <div class="card-header">
                                <h3>Restauración Manual de la BD</h3>
                            </div>
                           <div class="card-body">

                              <label>Selecciona un punto de restauración</label><br>
                               <hr>
                                <div class="custom-file">
                                  <form id="formBD" name="formBD" class="form-horizontal">
                                    <!-- <div class="mb-2">
                                      <input type="file" id="fileBD" name="fileBD" class="custom-file-input" id="customFile">
                                      <label id="nameFile" class="custom-file-label" for="customFile">Elegir Archivo</label>
                                    </div> -->



                                  <div class="mb-2">
                                    <!-- <label>Selecciona un punto de restauración</label><br> -->
                                    <select name="fileBD"  id="fileBD" class="form-control selectpicker" data-live-search="true">
                                      <option value="" disabled="" selected="">Selecciona un punto de restauración</option>
                                      <?php
                                        for ($i=0; $i < 5; $i++) { 
                                         echo '<option value="'. $data['restore'][$i]['ruta'].'">'. $data['restore'][$i]['fecha'].'</option>';
                                        }
                                      ?>
                                    </select>
                                  </div>  

                                    <div class="text-right" >
                                      <button id="btnActionForm" class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Restaurar</span></button>&nbsp;&nbsp;&nbsp;
                                    </div>

                                  </form>
                                </div>
                           </div>
                    </div>
                 </div>
                 <?php } ?>
                <!-- termina Tabla -->
                </div>
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