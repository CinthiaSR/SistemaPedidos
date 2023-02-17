<!-- <php headerAdmin($data); ?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i><= $data['page_title'] ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<= base_url(); ?>/dashboard">Dashboard</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">Dashboard</div>
          </div>
        </div>
      </div>
    </main>
<php footerAdmin($data); ?>
     -->

     <?php headerAdmin($data); ?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i><?= $data['page_title'] ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Dashboard</a></li>
        </ul>
      </div>
      <div class="row">
        <?php if(!empty($_SESSION['permisos'][2]['r'])){ ?>
        <div class="col-md-6 col-lg-3">
          <a href="<?= base_url() ?>/usuarios" class="linkw">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
              <div class="info">
                <h4>Usuarios</h4>
                <p><b><?= $data['usuarios'] ?></b></p>
              </div>
            </div>
          </a>
        </div>
        <?php } ?>
        <?php if(!empty($_SESSION['permisos'][3]['r'])){ ?>
        <div class="col-md-6 col-lg-3">
          <a href="<?= base_url() ?>/clientes" class="linkw">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-user fa-3x"></i>
              <div class="info">
                <h4>Clientes</h4>
                <p><b><?= $data['clientes'] ?></b></p>
              </div>
            </div>
          </a>
        </div>
        <?php } ?>


<!-- ================================================================================================== -->
<div class="row col-md-12">
        <?php if(!empty($_SESSION['permisos'][4]['r'])){ ?>
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Pedidos por persiana</h3>
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th># Pedidos</th>
                  <th>Tipo de persiana</th>
                  <th class="text-right">Monto</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                 <tr>
                  <td><?= $data['arco'] ?></td>
                  <td>Arcos</td>
                  <td class="text-right"><?= SMONEY." ".formatMoney($data['arcoMonto'])?></td>
                  <td><a href="<?= base_url() ?>/arcos""><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                </tr>
                <tr>
                  <td><?= $data['balance'] ?></td>
                  <td>Balances de madera</td>
                  <td class="text-right"><?= SMONEY." ".formatMoney($data['balanceMonto'])?></td>
                  <td><a href="<?= base_url() ?>/balance"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                </tr>
                <tr>
                  <td><?= $data['horizontal'] ?></td>
                  <td>Horizontales </td>
                  <td class="text-right"><?= SMONEY." ".formatMoney($data['horizontalMonto'])?></td>
                  <td><a href="<?= base_url() ?>/horizontales"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                </tr>
                <tr>
                  <td><?= $data['neolux'] ?></td>
                  <td>Neolux Manuales</td>
                  <td class="text-right"><?= SMONEY." ".formatMoney($data['neoluxMonto'])?></td>
                  <td><a href="<?= base_url() ?>/neolux"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                </tr>
                <tr>
                  <td><?= $data['motor'] ?></td>
                  <td>Neolux Motorizadas</td>
                  <td class="text-right"><?= SMONEY." ".formatMoney($data['motorMonto'])?></td>
                  <td><a href="<?= base_url() ?>/elegance"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                </tr>
                <tr>
                  <td><?= $data['roller'] ?></td>
                  <td>Roller Shades Manuales</td>
                  <td class="text-right"><?= SMONEY." ".formatMoney($data['rollerMonto'])?></td>
                  <td><a href="<?= base_url() ?>/rollers"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                </tr>
                <tr>
                  <td><?= $data['motorizacion'] ?></td>
                  <td>Roller Shades Motorizadas</td>
                  <td class="text-right"><?= SMONEY." ".formatMoney($data['motorizacionMonto'])?></td>
                  <td><a href="<?= base_url() ?>/motorizacion"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                </tr>
                <tr>
                  <td><?= $data['romana'] ?></td>
                  <td>Persiana Romana</td>
                  <td class="text-right"><?= SMONEY." ".formatMoney($data['romanaMonto'])?></td>
                  <td><a href="<?= base_url() ?>/romana"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                </tr>
                <tr>
                  <td><?= $data['shutter'] ?></td>
                  <td>Shutters</td>
                  <td class="text-right"><?= SMONEY." ".formatMoney($data['shutterMonto'])?></td>
                  <td><a href="<?= base_url() ?>/shutters"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
        <?php } ?>       

        <div class="col-md-6">
        <div class="tile">
            <div class="container-title">
              <h3 class="tile-title" style="font-size:22px ;">Ventas Shutters <br> por mes</h3>
              <div class="dflex">
                <input class="VShuttersAnio" name="VShuttersAnio" placeholder="Mes y Año">
                <button type="button" class="btnVentasAnio btn btn-info btn-sm" onclick="fntSearchVAnioSh()"> <i class="fas fa-search"></i> </button>              
              </div>
            </div>
            <div id="VentasShutters"></div>
          </div>
        </div>
      </div>


<!-- ================================================================================================== -->


      <div class="row col-md-12">   
        <div class="col-md-6">
          <div class="tile">
            <div class="container-title">
              <h3 class="tile-title">Ventas Roller Shades Motorizadas por mes </h3>
              <div class="dflex">
                <input class="Anio1" name="Anio1" placeholder="Año">
                <button type="button" class="btnVentasAnio btn btn-info btn-sm" onclick="fntSearchVAnio1()"> <i class="fas fa-search"></i> </button>
              </div>
            </div>
            <div id="graficaAnio"></div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="tile">
            <div class="container-title">
              <h3 class="tile-title">Ventas Roller Shades Manuales por mes </h3>
              <div class="dflex">
                <input class="ventas2" name="ventas2" placeholder="Año">
                <button type="button" class="btnVentasAnio btn btn-info btn-sm" onclick="fntSearchVAnio2()"> <i class="fas fa-search"></i> </button>
              </div>
            </div>
            <div id="grafica2"></div>
          </div>
        </div>
      </div>

    </main>
<?php footerAdmin($data); ?>

<script>
  Highcharts.chart('graficaAnio', {
    chart: {
        type: 'column'
    },
    title: {
        text:  'Año <?= $data['VentasAnio']['anio'] ?>'
    },
    subtitle: {
        text: 'Estadisticas de ventas por mes'
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
            text: ''
        }
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: 'Roller Shades Motorizada: <b>{point.y:.2f} Dollars</b>'
    },
    series: [{
        name: 'Population',
        data: [
            <?php  
              foreach ($data['VentasAnio']['meses'] as $mes) {
                // echo "['".$mes['mes']."', ".$mes['venta']."],";
                echo "['".$mes['mes']."',".$mes['venta']."],";
                }
            ?>
        ],
        dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            format: ' {point.y:.2f} dollars', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    }]
});

// --------------------------------------------------------------
Highcharts.chart('grafica2', {
    chart: {
        type: 'column'
    },
    title: {
        text:  'Año <?= $data['RolManuales']['anio'] ?>'
    },
    subtitle: {
        text: 'Estadisticas de ventas por mes'
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
            text: ''
        }
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: 'Roller Shades Manuales: <b>{point.y:.2f} Dollars</b>'
    },
    series: [{
        name: 'Population',
        data: [
            <?php  
              foreach ($data['RolManuales']['meses'] as $mes) {
                // echo "['".$mes['mes']."', ".$mes['venta']."],";
                echo "['".$mes['mes']."',".$mes['venta']."],";
                }
            ?>
        ],
        dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            format: ' {point.y:.2f} dollars', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    }]
});

// ---------------------------------------------

// ---------------------------------------------
  // Create the chart
  Highcharts.chart('VentasShutters', {
    chart: {
        type: 'column'
    },
    title: {
        text:  'Año <?= $data['Shutters']['anio'] ?>'
    },
    subtitle: {
        text: 'Estadisticas de ventas por mes'
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
            text: ''
        }
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: 'Roller Shades Manuales: <b>{point.y:.2f} Dollars</b>'
    },
    series: [{
        name: 'Population',
        data: [
            <?php  
              foreach ($data['Shutters']['meses'] as $mes) {
                // echo "['".$mes['mes']."', ".$mes['venta']."],";
                echo "['".$mes['mes']."',".$mes['venta']."],";
                }
            ?>
        ],
        dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            format: ' {point.y:.2f} dollars', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    }]
});

// ---------------------------------------
// Highcharts.chart('VentasMesAnio', {
//     chart: {
//         plotBackgroundColor: null,
//         plotBorderWidth: null,
//         plotShadow: false,
//         type: 'pie'
//     },
//     title: {
//         text: ''
//     },
//     tooltip: {
//         pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
//     },
//     accessibility: {
//         point: {
//             valueSuffix: '%'
//         }
//     },
//     plotOptions: {
//         pie: {
//             allowPointSelect: true,
//             cursor: 'pointer',
//             dataLabels: {
//                 enabled: false
//             },
//             showInLegend: true
//         }
//     },
//     series: [{
//         name: 'Brands',
//         colorByPoint: true,
//         data: [{
//             name: 'Chrome',
//             y: 61.41,
//             sliced: true,
//             selected: true
//         }, {
//             name: 'Internet Explorer',
//             y: 11.84
//         }, {
//             name: 'Firefox',
//             y: 10.85
//         }, {
//             name: 'Edge',
//             y: 4.67
//         }, {
//             name: 'Safari',
//             y: 4.18
//         }, {
//             name: 'Other',
//             y: 7.05
//         }]
//     }]
// });

// ----------------------------------------

</script>















<!-- 
<script>

  Highcharts.chart('pagosMesAnio', {
      chart: {
          plotBackgroundColor: null,
          plotBorderWidth: null,
          plotShadow: false,
          type: 'pie'
      },
      title: {
          text: 'Ventas por tipo pago, <?= $data['pagosMes']['mes'].' '.$data['pagosMes']['anio'] ?>'
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
              echo "{name:'".$pagos['tipopago']."',y:".$pagos['total']."},";
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
          text: 'Ventas de <?= $data['ventasMDia']['mes'].' del '.$data['ventasMDia']['anio'] ?>'
      },
      subtitle: {
          text: 'Total Ventas <?= SMONEY.'. '.formatMoney($data['ventasMDia']['total']) ?> '
      },
      xAxis: {
          categories: [
            <?php 
                foreach ($data['ventasMDia']['ventas'] as $dia) {
                  echo $dia['dia'].",";
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
          name: 'Dato',
          data: [
            <?php 
                foreach ($data['ventasMDia']['ventas'] as $dia) {
                  echo $dia['total'].",";
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
          text: 'Ventas del año <?= $data['ventasAnio']['anio'] ?> '
      },
      subtitle: {
          text: 'Esdística de ventas por mes'
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
              text: ''
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
            <?php 
              foreach ($data['ventasAnio']['meses'] as $mes) {
                echo "['".$mes['mes']."',".$mes['venta']."],";
              }
             ?>                 
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

</script> -->
    