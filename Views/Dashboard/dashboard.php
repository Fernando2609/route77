<?php headerAdmin($data); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?= $data['page_title'] ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="<?= base_url(); ?>/dashboard">Dashboard </a></li>
          </ol>

          <?php // dep($_SESSION['userData']);        
          /* dep($_SESSION['permisos']);
                   dep($_SESSION['permisosMod']); */
          //dep(nombreEmpresa()['nombreEmpresa']);



          //uncomment to test



          ?>

        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  < <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-body">
          <div class="row">
            <?php if (!empty($_SESSION['permisos'][2]['r'])) { ?>
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <a href="<?= base_url() ?>/usuarios">
                  <div class="small-box bg-info">
                    <div class="inner">
                      <h3><?= $data['usuarios'] ?></h3>

                      <p>Usuarios</p>
                    </div>
                    <div class="icon">
                      <i class=" nav-icon fas fa-users"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </a>
              </div>
            <?php
            }
            ?>
            <!-- ./col -->
            <?php if (!empty($_SESSION['permisos'][3]['r'])) { ?>
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <a href="<?= base_url() ?>/clientes">
                  <div class="small-box bg-success">
                    <div class="inner">
                      <h3><?= $data['clientes'] ?></h3>

                      <p>Clientes</p>
                    </div>
                    <div class="icon">
                      <i class=" nav-icon fas fa-user"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </a>
              </div>
            <?php
            }
            ?>
            <!-- ./col -->
            <?php if (!empty($_SESSION['permisos'][4]['r'])) { ?>
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <a href="<?= base_url() ?>/productos">
                  <div class="small-box bg-warning">
                    <div class="inner">
                      <h3><?= $data['productos'] ?></h3>

                      <p>Productos</p>
                    </div>
                    <div class="icon">
                      <i class=" nav-icon fas fa-store"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </a>
              </div>
            <?php
            }
            ?>
            <!-- ./col -->
            <?php if (!empty($_SESSION['permisos'][5]['r'])) { ?>
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <a href="<?= base_url() ?>/pedidos">
                  <div class="small-box bg-danger">
                    <div class="inner">
                      <h3><?= $data['pedidos'] ?></h3>

                      <p>Pedidos</p>
                    </div>
                    <div class="icon">
                      <i class="nav-icon fas fa-shopping-cart"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </a>
              </div>
            <?php
            }
            ?>
            <!-- ./col -->
          </div>
        </div>
        <div class="row">
          <?php if (!empty($_SESSION['permisos'][5]['r'])) { ?>
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Últimos Pedidos</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered table-sm">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Cliente</th>
                        <th>Estado</th>
                        <th class="text-right">Monto</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if (count($data['lastOrders']) > 0) {
                        foreach ($data['lastOrders'] as $pedido) {


                      ?>
                          <tr>
                            <td><?= $pedido['COD_PEDIDO'] ?></td>
                            <td><?= $pedido['nombre'] ?></td>
                            <td><?= $pedido['COD_STATUS'] ?></td>
                            <td class="text-right"><?= SMONEY . " " . formatMoney($pedido['monto']) ?></td>
                            <td><a href="<?= base_url() ?>/pedidos/orden/<?= $pedido['COD_PEDIDO'] ?>" target="_black"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                            <!-- <td>
                              <div class="progress progress-xs">
                                <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                              </div>
                            </td>
                            <td><span class="badge bg-danger">55%</span></td>
                            <td><a href=""><i class="fa fa-eye" aria-hidden="true"></i></a></td> -->
                          </tr>
                      <?php
                        }
                      }
                      ?>
                      <!-- <tr>
                      <td>2.</td>
                      <td>Clean database</td>
                      <td>
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-warning" style="width: 70%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-warning">70%</span></td>
                    </tr>
                    <tr>
                      <td>3.</td>
                      <td>Cron job running</td>
                      <td>
                        <div class="progress progress-xs progress-striped active">
                          <div class="progress-bar bg-primary" style="width: 30%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-primary">30%</span></td>
                    </tr>
                    <tr>
                      <td>4.</td>
                      <td>Fix and squish bugs</td>
                      <td>
                        <div class="progress progress-xs progress-striped active">
                          <div class="progress-bar bg-success" style="width: 90%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-success">90%</span></td>
                    </tr> -->
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                  <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                  </ul>
                </div>
              </div>
              <!-- /.card -->


              <!-- /.card -->



            </div>
          <?php
          }
          ?>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <div class="container-tittle">
                  <h3 class="card-title">Tipos de Pagos por Mes</h3>
                </div>
              </div>
              <div id="pagosMesAnio"></div>
            </div>
          </div>
        </div>



        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <div class="container-tittle">
                  <h3 class="card-title">Ventas por Mes</h3>
                </div>
              </div>
              <div id="graficaMes"></div>
            </div>
          </div>


          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <div class="container-tittle">
                  <h3 class="card-title">Ventas por Año</h3>
                </div>
              </div>
              <div id="graficaAnio"></div>
            </div>
          </div>

        </div>
      </div>
      <!-- /.card-body -->
</div>
<!-- /.card -->
</section>
<!-- right col -->
</div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php footerAdmin($data); ?>

<script>
  Highcharts.chart('pagosMesAnio', {
    chart: {
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie'
    },
    title: {
      text: 'Ventas por Tipo Pago, <?= $data['pagosMes']['mes'] . ' ' . $data['pagosMes']['anio'] ?>'
    },
    tooltip: {
      pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
      point: {
        valueSuffix: '%'
      }
    },
    plotOptions: {
      pie: {
        allowPointSelect: true,
        cursor: 'pointer',
        dataLabels: {
          enabled: true,
          format: '<b>{point.name}</b>: {point.percentage:.1f} %'
        }
      }
    },
    series: [{
      name: 'Brands',
      colorByPoint: true,
      data: [
        <?php
        foreach ($data['pagosMes']['tipospago'] as $pagos) {
          echo "{name:'" . $pagos['TIPO_PAGO'] . "',y:" . $pagos['total'] . "},";
        }
        ?>
      ]
    }]
  });

  Highcharts.chart('graficaMes', {
    chart: {
      type: 'line'
    },
    title: {
      text: 'Ventas de <?= $data['ventasMDia']['mes'] . ' del ' . $data['ventasMDia']['anio'] ?>'
    },
    subtitle: {
      text: 'Total Ventas <?= SMONEY . '. ' . formatMoney($data['ventasMDia']['total']) ?>'
    },
    xAxis: {
      categories: [
        <?php
        foreach ($data['ventasMDia']['ventas'] as $dia) {
          echo $dia['Dia'] . ",";
        }
        ?>
      ]
    },
    yAxis: {
      title: {
        text: ''
      }
    },
    plotOptions: {
      line: {
        dataLabels: {
          enabled: true
        },
        enableMouseTracking: false
      }
    },
    series: [{
      name: '',
      data: [
        <?php
        foreach ($data['ventasMDia']['ventas'] as $dia) {
          echo $dia['Total'] . ",";
        }
        ?>
      ]
    }]
  });

  Highcharts.chart('graficaAnio', {
    chart: {
      type: 'column'
    },
    title: {
      text: 'World\'s largest cities per 2017'
    },
    subtitle: {
      text: 'Source: <a href="http://en.wikipedia.org/wiki/List_of_cities_proper_by_population">Wikipedia</a>'
    },
    xAxis: {
      type: 'category',
      labels: {
        rotation: -45,
        style: {
          fontSize: '13px',
          fontFamily: 'Verdana, sans-serif'
        }
      }
    },
    yAxis: {
      min: 0,
      title: {
        text: 'Population (millions)'
      }
    },
    legend: {
      enabled: false
    },
    tooltip: {
      pointFormat: 'Population in 2017: <b>{point.y:.1f} millions</b>'
    },
    series: [{
      name: 'Population',
      data: [
        ['Shanghai', 24.2],
        ['Beijing', 20.8],
        ['Karachi', 14.9],
        ['Shenzhen', 13.7],
        ['Guangzhou', 13.1],
        ['Istanbul', 12.7],
        ['Mumbai', 12.4],
        ['Moscow', 12.2],
        ['São Paulo', 12.0],
        ['Delhi', 11.7],
        ['Kinshasa', 11.5],
        ['Tianjin', 11.2],
        ['Lahore', 11.1],
        ['Jakarta', 10.6],
        ['Dongguan', 10.6],
        ['Lagos', 10.6],
        ['Bengaluru', 10.3],
        ['Seoul', 9.8],
        ['Foshan', 9.3],
        ['Tokyo', 9.3]
      ],
      dataLabels: {
        enabled: true,
        rotation: -90,
        color: '#FFFFFF',
        align: 'right',
        format: '{point.y:.1f}', // one decimal
        y: 10, // 10 pixels down from the top
        style: {
          fontSize: '13px',
          fontFamily: 'Verdana, sans-serif'
        }
      }
    }]
  });
</script>