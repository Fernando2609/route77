<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name = "description" content = "Route 77">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Nosotros">
  <meta name="theme-color" content="=#009688">
  
  <title><?= $data['page_tag'] ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
   <!-- DataTables -->
   <link rel="stylesheet" href="<?= media(); ?>/js/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
   <link rel="stylesheet" href="<?= media(); ?>/js/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?= media(); ?>/css/adminlte.min.css">
  <link rel="stylesheet" href="<?= media(); ?>/css/style.css">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
     
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">


    
   
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <!-- User Menu-->
      <li class="nav-item dropdown show"><a class="nav-link" href="#" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="<?= base_url();?>/opciones"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
            <li><a class="dropdown-item" href="<?= base_url();?>/perfil"><i class="fa fa-user fa-lg"></i> Profile</a></li>
            <li><a class="dropdown-item" href="<?= base_url();?>/logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
          </ul>
        </li>
    </ul>
  </nav>
  <?php require_once("nav_admin.php"); ?>
  <!-- /.navbar -->

  
    