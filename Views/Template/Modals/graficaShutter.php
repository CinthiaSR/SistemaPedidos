<?php 
	if($grafica2 = "VShuttersAnio"){
		$ventas = $data;
		// dep($ventas); exit;
 ?>
 <script>
 	Highcharts.chart('VentasShutters', {
      chart: {
          type: 'column'
      },
      title: {
          text: 'Ventas del año <?= $ventas['anio'] ?> '
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
		pointFormat: 'Roller Shades Manuales: <b>{point.y:.2f} Dollars</b>'
      },
      series: [{
          name: 'Population',
          data: [
            <?php 
              foreach ($ventas['meses'] as $mes) {
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
  
 </script>

 <?php } ?>