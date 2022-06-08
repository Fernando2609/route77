<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name = "description" content = "Route 77">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Nosotros">
    <meta name="theme-color" content="=#009688">
    <link rel="shortcut icon" href="<?= media();?>/images//favicon.ico">
    <title><?= $data['page_tag'] ?></title>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/mainLogin.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/style.css">
    <link rel="stylesheet" href="<?= media(); ?>/js/plugins/sweetalert2/sweetalert2.min.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
      <!-- Modal -->
  <div class="modal fade" id="modalResetPreg" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <!-- Div Centrar Modal -->
    <div class="modal-dialog modal-lg bounceInDown animated" role="document">
      <div class="modal-content">
        <!-- Div Contenido Modal -->
        <div class="modal-header2">
              <!-- Encabezado Modal -->
            <h5 class="modal-title" >Recuperación por Pregunta de Seguridad</h5>
          </div><!-- Termina Encabezado Modal -->
        
        <!-- abre Modal Body -->
        <div class="modal-body">
            <!-- Card -->
          <!-- formulario Modal -->
          <form id="formPregSeguridad" name="formPregSeguridad" class="form-horizontal">
            <!-- <input type="hidden" id="idUsuario" name="idUsuario" value=""> -->
            <p class="text-success">Todos los campos son obligatorios</p>
                <!-- abre Modal Body -->
              <div class="modal-body">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="txtPregunta1">Selecciona una pregunta</label>
                    <select class="form-control"  id="txtPregunta1" name="txtPregunta1" required>
                      <?php
                         $preguntas=[];
                         $preguntas=preguntasSeguridad();

                         for ($i=0; $i < count($preguntas); $i++) {

                          $idPregunta=$preguntas[$i]['COD_PREGUNTA'];
                          $pregunta=$preguntas[$i]['PREGUNTA'];
    
                          echo "<option value='$idPregunta'>$pregunta</option>";
                        }

                      ?>
                    
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="txtRespuesta1">Respuesta</label>
                    <input type="text" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" id="txtRespuesta1" name="txtRespuesta1" required="">
                  </div>
                </div>
                    
              </div>
            <!-- /.Cierra card-body -->

            <div class="card-footer">
              <button id="btnAction" class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Verificar</span></button>&nbsp;&nbsp;&nbsp;

              <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
            </div>
          </form>

        </div><!-- /. Cierra  Div body Modal -->
      </div><!-- /. Cierra  Div Centrar Modal -->
    </div><!-- /. Cierre Div Centrar Modal -->
  </div>
  <!-- Cierra Modal -->
    <section class="material-half-bg">
      <div class="cover"></div>
      <div class="cover2"></div>
    </section>
    <section class="login-content">
   
    <div class="logo d-flex justify-content-center">
    <a href="<?= base_url();?>" class="nav-link">
        <img src="<?= media(); ?>/images/Logo.png" class="imagenLogin" alt="" >
    </div>
    </a>

      <div class="login-box">
        <div id="divLoading">
          <div>
            <img src="<?=media();?>/images/loadingRoute.webp" alt="Loading">
          </div>
        </div>
        <form class="login-form" name="formLogin" id="formLogin" action="">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>INICIAR SESIÓN</h3>
          <div class="form-group">
            <label class="control-label">USUARIO</label>
            <input id="txtEmail" name="txtEmail" class="form-control valid validEmail" type="email" placeholder="Email" autofocus>
          </div>
          <div class="form-group">
            <label class="control-label">CONTRASEÑA</label>
            <div class="input-group">
              <input id="txtPassword" name="txtPassword" class="form-control" type="password" placeholder="Contraseña">
              <div class="input-group-prepend" onclick="mostrarContrasenas()">
              <span class="input-group-text" ><i id="icon" data-original="fa fa-eye" class="fa fa-eye" ></i></span></div>
            </div>
            
          </div>
          <div class="form-group">
            <div class="utility">
              
              <p class="semibold-text mb-2 "><a href="#" class="linkLogin" data-toggle="flip">¿Olvidaste tu contraseña ?</a></p>
            </div>
          </div>
          <div id="alertLogin" class="text-center"></div>
          <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block botonLogin"><i class="fa fa-sign-in fa-lg fa-fw"></i>INICIAR SESIÓN</button>
          </div>
        </form>
     
        <form id="formRecetPass" class="forget-form" action="">
          <h3 class="login-head "><i class="fa fa-lg fa-fw fa-lock"></i>¿Olvidaste tu contraseña?</h3>
          <div class="form-group">
            <label class="control-label">EMAIL</label>
            <input id="txtEmailReset" name="txtEmailReset" class="form-control valid validEmail" type="text" placeholder="Email">
          </div>
         
          <div class="form-group btn-container mb-3">
            <button type="submit" class="btn btn-primary btn-block botonLogin"><i class="fa fa-unlock fa-lg fa-fw"></i>ENVIAR EMAIL</button>
          </div>
          <div class="form-group btn-container">
            <a style="color:white" onclick="fntOpenModal()" class="btn btn-primary btn-block botonLogin"><i class="fa fa-unlock fa-lg fa-fw"></i>PREGUNTA DE SEGURIDAD</a>
          </div>
          <div class="form-group mt-3 mb-3">
            <p class="semibold-text mb-0"><a href="#" class="linkLogin" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Volver al login</a></p>
          </div>
        </form>
       
      </div>
      </section>
      <script>
         const base_url = "<?= base_url(); ?>";
      </script>
    <!-- Essential javascripts for application to work-->
    <script src="<?= media(); ?>/js/plugins/jquery/jquery.min.js"></script>
<!--     <script src="<?= media(); ?>/js/plugins/popper/popper.min.js"></script>-->
    <script src="<?= media(); ?>/js/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= media(); ?>/js/main.js"></script>
    <script src="<?= media(); ?>/js/funtions_admin.js"></script>
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="<?= media(); ?>/js/<?= $data['page_functions_js'] ?>"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?= media(); ?>/js/pace.min.js"></script>
   
  </body>
</html>