<?php 
	   $cliente = $data['cliente']; 
       $orden = $data['orden'];
       $arcos = $data['arcos'];
       $precio = $data['precio'];
 ?>
<!DOCTYPE html>
<html lang="es">
<head> 
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Factura</title>
	<style>
		.container{
			max-width: 200px;
		}
		table{
			width: 100%;
		}
		table td, table th,p{
			font-size: 12px;
			
		}
		h4{
			margin-bottom: 0px;
		}
		.text-center{
			text-align: center;
		}
		.text-right{
			text-align: right;
		}
		.wd33{
			width: 33.33%;
		}
		.wd30{
			width: 20%;
		}
		.tbl-cliente{
			/* border: 1px solid #CCC; */
			border-radius: 10px;
			padding: 5px;
			font-size: 10px;
			width: 300px;
			height: 50px;
		}
		.wd10{
			width: 10%;
		}
		.wd15{
			width: 15%;
		}
		.wd40{
			width: 40%;
		}
		.wd55{
			width: 55%;
		}
		.tbl-detalle{
			border-collapse: collapse;
		}
		.tbl-detalle thead th{
			padding: 6px;
			background-color: #009688;
			color: #FFF;
			font-size: 12px;
		}
		.tbl-detalle tbody td{
			border-bottom: 1px solid #CCC;
			padding: 6px;
			font-size: 12px;
		}
		.tbl-detalle tfoot td{
			padding: 6px;
			font-size: 12px;
		}
	</style>
</head>
<body>
<table class="tbl-hader">
		<tbody>
			<tr>
				<td class="wd33">
					<img src="<?= media() ?>/images/1.png" style="width: 300px;" alt="Logo">
				</td>
				<!-- <td class="text-center wd30" style="width: 250px; font-size: 16px;">
						<?= NOMBRE_EMPESA; ?><br>
						<?= TELEMPRESA ?><br>
						<?= EMAIL_EMPRESA ?>
				</td> -->
				<td class="wd30"  style="font-size: 14px;">
				    <b style="font-size: 14px;">Fecha: </b> <?= $orden['fecha'] ?> <br>
					<b style="font-size: 14px;">Sucursal: </b> <?= $orden['sucursal'] ?> <br>
				</td>	
				<td class="wd30"  style="font-size: 14px;">
					<b style="font-size: 14px;">CN: </b> <?= $orden['cn'] ?> <br>
					<b style="font-size: 14px;">M. Entrega: </b> <?= $orden['entrega'] ?> <br>
				</td>		
				<td class="text-center wd30">
					<b style="font-size: 25px; ">Arcos</b> <br>
				</td>
			</tr>
		</tbody>
	</table>
	<br>
	<div class="container">
     <table class="tbl-cliente" style="position: relative; left: 5px; margin-top: -5px;">	
		<tbody>	
		<tr>
				<td colspan="3" class="wd60"><strong style="font-size: 12px;">Información General:</strong> </td>
			</tr>   	   
			<tr>
				<td class="wd20"><strong>Presupuestado por: </strong> </td>
				<td class="wd40"> <?= $orden['vendedor']; ?></td>				
			</tr>
			<tr>
				<td><strong>Medido por:</strong> </td>
				<td><?= $orden['medido'] ?></td>
			</tr>
			<tr>
				<td><strong>Email:</strong> </td>
				<td><?= EMAIL_EMPRESA ?></td>
			</tr>
		</tbody>
	</table>
	<table class="tbl-cliente" style="position: relative; left: 370px; margin-top: -84px;">
		<tbody>		
	    	<tr>
				<td colspan="4" class="wd60"><strong>Informacion del cliente:</strong> </td>
			</tr>   
			<tr>
				<td class="wd10"><strong>Cliente:</strong> </td>
				<td class="wd50"><?= $cliente['nombre'] ?></td>
				<td class="wd20"><strong>Ciudad:</strong> </td>
				<td class="wd60"><?= $cliente['ciudad'] ?></td>
			</tr>
			<tr>
				<td class="wd10"><strong>Teléfono:</strong> </td>
				<td><?= $cliente['telefono']?></td>
				<td class="wd10"><strong>Email:</strong> </td>
				<td><?= $cliente['email'] ?></td>
			</tr>
			<tr>
				<td><strong>Dirección:</strong> </td>
				<td class="wd40"><?= $cliente['direccion'] ?></td>
			</tr>
		</tbody>
	</table>
	</div>
	<div>
		<!-- <div class="container" style="padding: 30px;"> -->
			<p style="text-align: justify; padding: 5px;">Toda información que se encuentre en este documento deberá ser confirmada y firmada por el cliente. Ordenes que no aprueben
		 el proceso de confirmación serán excluidas. Es requerido el 50% del total de la orden para ser procesada, el resto del importe será cobrado en la entrega o instalación. </p> 
		<!-- </div> -->
		<!-- <br> -->

	</div>
	<br>
	<br>
	<table class="tbl-detalle" style="border: 10px;">
		<thead>
			<tr>
				<th style="background-color:#fff; color:black; border: 0.5px;">Cant</th>
				<th style="background-color:#fff; color:black; border: 0.5px;">Identificación <br> de ventana</th>
				<th style="background-color:#fff; color:black; border: 0.5px;">Instalación</th>
				<th style="background-color:#fff; color:black; border: 0.5px;">Medidas (in)</th>
				<th style="background-color:#fff; color:black; border: 0.5px;">Color</th>
				<th style="background-color:#fff; color:black; border: 0.5px;">Configuración</th>
				<th style="background-color:#fff; color:black; border: 0.5px;">Marco</th>
				<th style="background-color:#fff; color:black; border: 0.5px;">Ft2</th>
				<th style="background-color:#fff; color:black; border: 0.5px;">Nota</th>
		
			</tr>
		</thead>
		<tbody>
			<?php 
				$subtotal = 0;
				foreach ($arcos as $persiana) {
					// $importe = $producto['precio'] * $producto['cantidad'];
					$subtotal +=$persiana['cantidad_arcos'];
			 ?>
			<tr>
				<td class="text-center"><?= $persiana['cantidad_arcos'] ?></td>
				<td class="text-center"><?= $persiana['arcos_identificacion'] ?></td>
				<td class="text-center"><?= $persiana['arcos_instalacion'] ?></td>
				<td class="text-center"><?= $persiana['arcos_base'].' x '.$persiana['arcos_altura'] ?></td>
				<td class="text-center"><?= $persiana['arcos_color'] ?></td>
				<td class="text-center"><?= $persiana['arcos_tipoconfiguracion'] ?></td>
				<td class="text-center"><?= $persiana['arcos_tipomarco'] ?></td>
				<td class="text-center"><?= $persiana['arcos_totalf2'] ?></td>
				<td class="text-center"><?= $persiana['arcos_nota'] ?></td>
				
			</tr>
			<?php } ?>
		</tbody>
		<tfoot>
		    <tr>
				<td colspan="2"><strong>Cantidad de persianas: <?=$subtotal?></strong></td>
			</tr>
		</tfoot>
	</table>
	<div class="text-center">
		<p>Si tienes preguntas sobre la órden, <br> ponte en contacto con el supervisor a cargo.</p>
		<h4>¡Gracias!</h4>
	</div>
</body>
</html>