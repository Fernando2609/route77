
<?php 

headerAdmin($data); 

getModal('modalRoles', $data);

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="fas fa-user-tag">
            </i> <?= $data['page_title'] ?>
            
            <button type="button" class="btn btn-block btn-primary btn-sm" style="width:90px;height:35px;" onclick="openModal();"   ><i class="fas fa-plus-square" style="font-size: 10 px;"></i>  Nuevo</button>
            
</h1>

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
            <li class="breadcrumb-item"><a href="<?=base_url();?>/roles">Roles de usuario / Estación Route 77</a></li>
             
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          
          <h3 class="card-title">Roles de usuario</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          Página de inicio
        </div>
        <!-- /.card-body -->
        
        
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php footerAdmin($data); ?>