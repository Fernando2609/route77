<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name = "description" content = "Route 77">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Nosotros">
    <meta name="theme-color" content="=#009688">
    <link rel="shortcut icon" href="<?= media();?>/images/uploads/favicon.ico">
    <title><?= $data['page_tag'] ?></title>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/mainLogin.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/style.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
    <div class="logo d-flex justify-content-center">
        <img src="<?= media(); ?>/images/uploads/Logo.png" class="imagenLogin" alt="" >
      </div>
      <div class="login-box">
        <form class="login-form" action="index.html">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>INICIAR SESION</h3>
          <div class="form-group">
            <label class="control-label">USUARIO</label>
            <input id="txtEmail" class="form-control" type="text" placeholder="Email" autofocus>
          </div>
          <div class="form-group">
            <label class="control-label">CONTRASEÑA</label>
            <input id="txtPasssword" class="form-control" type="password" placeholder="Contraseña">
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
        <form class="forget-form" action="index.html">
          <h3 class="login-head "><i class="fa fa-lg fa-fw fa-lock"></i>¿Olvidaste tu contraseña?</h3>
          <div class="form-group">
            <label class="control-label">EMAIL</label>
            <input id="txtEmailReset" class="form-control" type="text" placeholder="Email">
          </div>
          <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block botonLogin"><i class="fa fa-unlock fa-lg fa-fw"></i>REINICIAR</button>
          </div>
          <div class="form-group mt-3">
            <p class="semibold-text mb-0"><a href="#" class="linkLogin" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Volver al login</a></p>
          </div>
        </form>
      </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="<?= media(); ?>/js/plugins/jquery/jquery.min.js"></script>
    <script src="<?= media(); ?>/js/plugins/popper/popper.min.js"></script>
    <script src="<?= media(); ?>/js/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= media(); ?>/js/main.js"></script>
    <script src="<?= media(); ?>/js/<?= $data['page_functions_js'] ?>"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?= media(); ?>/js/pace.min.js"></script>
    
  </body>
</html>