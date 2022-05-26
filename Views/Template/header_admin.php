<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name = "description" content = "Route 77">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Nosotros">
  <meta name="theme-color" content="=#009688">
  <link rel="shortcut icon" href="<?= media();?>/images//favicon.ico">
  <title><?= $data['page_tag'] ?></title>
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= media(); ?>/js/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= media(); ?>/js/plugins/sweetalert2/sweetalert2.min.css">
   
    <link rel="stylesheet" type= "text/css" href="<?= media(); ?>/js/datepicker/jquery-ui.min.css">
   
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!--Boopstrap Sswitch-->
    <link rel="stylesheet" href="<?= media(); ?>/js/plugins/bootstrap-switch\css\bootstrap3\bootstrap-switch.min.css">
    <!-- Fullcalendar -->
    <link rel="stylesheet" href="<?= media(); ?>/js/plugins/fullcalendarV5/main.min.css">

    <!-- Toastr -->
    <link rel="stylesheet" href="<?= media(); ?>/js/plugins/toastr/toastr.min.css">
    <!-- Bootstrap Select -->
    <link rel="stylesheet" href="<?= media(); ?>/css/bootstrap-select.min.css">
   <!-- DataTables -->
   <link rel="stylesheet" href="<?= media(); ?>/js/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
   <link rel="stylesheet" href="<?= media(); ?>/js/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
   <link rel="stylesheet" href="<?= media(); ?>\css\datatables_datetime.min.css">
   <!-- Animate css CDN -->
   <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= media(); ?>/css/adminlte.min.css">
  <link rel="stylesheet" href="<?= media(); ?>/css/estilo.css">
  <link rel="stylesheet" href="<?= media(); ?>/css/style.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed ">
<div id="divLoading">
      <div>
        <img src="<?=media();?>/images//loadingRoute.webp" alt="Loading">
       </div>
    </div>
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= media(); ?>/images//logo3.png" alt="AdminLTELogo" height="60" width="60">
  </div>
  <!-- Navbar -->
  <nav id="navegacion" class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" id="nav-bar" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
     
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
      <li class="nav-item">
          <button class="switch" id="switch">
            <span><i class="fas fa-sun"></i></span>
            <span><i class="fas fa-moon"></i></span>
          </button>
      </li>

      <!-- <li class="nav-item">
        
        <div class="toggle-flip">
          <label class="boton-dark">
            <input id="" type="checkbox" ><span class="flip-indecator" data-toggle-on="Dark" data-toggle-off="White"></span>
          </label>
        </div> 
      </li> -->
     
      <!-- Notifications Dropdown Menu -->
      <?php
      if(!empty($_SESSION['permisos'][9]['r'])){
      ?>
      <li class="nav-item dropdown">
        <a class="nav-link" id="listProductos" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge"><?php
            
            echo count($_SESSION['notificaciones']);
            
          ?>
            
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="notificacion">
        <?php if(!empty($_SESSION['permisos'][9]['r'])){ ?>
        <?=  getModal("notificaciones",$data)  ?>
        <?php } ?>
          
         
        </div>
      </li>
      <?php } ?>
    
   
      <li class="nav-item">
        <a class="nav-link" id="expander" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
     
      <!-- User Menu-->
      <li class="nav-item dropdown show"><a class="nav-link" href="#" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
           
            <li><a class="dropdown-item" href="<?= base_url();?>/usuarios/perfil"><i class="fa fa-user fa-lg"></i> Perfil</a></li>
            <li><a class="dropdown-item" href="<?= base_url();?>/Logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
          </ul>
        </li>
       
    </ul>
  </nav>
  <?php
    if ($_SESSION['userData']['COD_STATUS']==3 ) {
      $preguntas=[];
      $preguntas=preguntasSeguridad();
     
  ?>
  <!-- Modal -->
<div class="modal fade" id="modalUserNew" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<!-- Div Centrar Modal -->
<div class="modal-dialog modal-lg bounceInDown animated" role="document">
  <div class="modal-content">
    <!-- Div Contenido Modal -->
    <div class="modal-header2">
          <!-- Encabezado Modal -->
        <h5 class="modal-title" >Cambiar Contraseña</h5>
      </div><!-- Termina Encabezado Modal -->
    
    <!-- abre Modal Body -->
    <div class="modal-body">
        <!-- Card -->
      <!-- formulario Modal -->
      <form id="formPreguntasSeguridad" name="formPreguntasSeguridad" class="form-horizontal">
        <!-- <input type="hidden" id="idUsuario" name="idUsuario" value=""> -->
        <!-- <p class="text-success">Todos los campos son obligatorios</p> -->
        <div class="form-row">
              <div class="form-group col-md-6">
                <label for="txtPassword">Contraseña</label>
                <input type="password" class="form-control valid ValidContra" id="txtPassword" name="txtPassword" required="">
              </div>
              <div class="form-group col-md-6">
                <label for="txtPasswordConfirm">Confirmar Contraseña</label>
                <input type="password" class="form-control valid ValidContra" id="txtPasswordConfirm" name="txtPasswordConfirm" required="">
              </div>
            </div>
        
            <div class="modal-header2">
              <!-- Encabezado Modal -->
              <h5 class="modal-title" >Configuración de Preguntas de Seguridad</h5>
            </div><!-- Termina Encabezado Modal --> 
        
        
            <!-- abre Modal Body -->
          <div class="modal-body">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="txtPregunta1">Selecciona una pregunta</label>
                <select class="form-control"  id="txtPregunta1" name="txtPregunta1" required>
                  <?php
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
                <input type="text" class="form-control " id="txtRespuesta1" name="txtRespuesta1" required="">
              </div>
            </div>
                
          </div>
        <!-- /.Cierra card-body -->

        <div class="card-footer">
          <button id="btnAction" class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;

          <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
        </div>
      </form>

    </div><!-- /. Cierra  Div body Modal -->
  </div><!-- /. Cierra  Div Centrar Modal -->
</div><!-- /. Cierre Div Centrar Modal -->
</div>
<!-- Cierra Modal -->




  <?php 
    }
  require_once("nav_admin.php"); 
  ?>
  <!-- /.navbar -->

  
    