<?php 
	$cliente = $data['cliente'];
	$orden = $data['orden'];
	$balance = $data['horizontal'];
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
		.tbl-cliente{
			/* border: 1px solid #CCC;
			border-radius: 10px; */
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
			padding: 5px;
			background-color: #009688;
			color: #FFF;
			font-size: 10px;
		}
		.tbl-detalle tbody td{
			border-bottom: 1px solid #CCC;
			padding: 5px;
			font-size: 10px;
		}
		.tbl-detalle tfoot td{
			padding: 5px;
			font-size: 10px;
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
				<td style="width: 250px;" style="font-size: 12px;">
				<strong>Presupuestado por: </strong> <?= $orden['vendedor']; ?> <br>
				<strong>Medido por:</strong> <?= $orden['medido']; ?><br>
						<?= EMAIL_EMPRESA ?>
				</td>
				<td>
					<!-- <strong>CLIENTE</strong><br>
						<strong><?= $cliente['nombre'];?></strong><br>
						Direccíon: <?= $cliente['direccion']; ?><br>
						Ciudad: <?= $cliente['ciudad'] ?><br>
						Tel: <?= $cliente['telefono'] ?><br>
						Email: <?= $cliente['email'] ?> -->
				</td>
				<td class="text-center wd33">
				    <b style="font-size: 20px;">Horizontales 2"</b>
					 <br>  <p>Notas Especiales</p>
				</td>				
			</tr>
		</tbody>
	</table>
	<br>
	<div class="container">
	<table class="tbl-cliente" style="position: relative; left: 5px; margin-top: -5px;">
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
	<table class="tbl-cliente" style="position: relative; left: 400px; margin-top: -82px;">
		<tbody>		 
			<tr>
				<td colspan="4" class="wd80"><strong>Información de registro:</strong> </td>
			</tr>
			<tr>
				<td class="wd20"><strong>Fecha:</strong> </td>
				<td class="wd40"><?= $orden['fecha'] ?></td>
				<td class="wd20"><strong>CN:</strong> </td>
				<td class="wd100"><?= $orden['cn'] ?></td>
			</tr>
			<tr>
				<td><strong>Sucursal:</strong> </td>
				<td><?= $orden['sucursal'] ?></td>
				
			</tr>
			<tr>
			    <td><strong>M.Entrega:</strong> </td>
				<td><?= $orden['entrega'] ?></td>
			</tr>
		</tbody>
	</table>
	</div>
	<div>
		<div class="container" style="padding: 10px;">
			<p style="text-align: justify; padding: 4px;">Toda información que se encuentre en este documento deberá ser confirmada y firmada por el cliente. Ordenes que no aprueben
		 el proceso de confirmación serán excluidas. Es requerido el 50% del total de la orden para ser procesada, el resto del importe será cobrado en la entrega o instalación. </p> 
		</div>
		<br>

	</div>
	<br>
	<table class="tbl-detalle" style="border: 10px;">
		<thead>
			<tr>
				<th style="background-color:#fff; color:black; border: 0.5px;">Cant</th>
				<th style="background-color:#fff; color:black; border: 0.5px;">Ident<br> de ventana</th>
				<th style="background-color:#fff; color:black; border: 0.5px;">Inst.</th>
				<th style="background-color:#fff; color:black; border: 0.5px;">Medidas (in)</th>
				<th style="background-color:#fff; color:black; border: 0.5px;">Color</th>
				<th style="background-color:#fff; color:black; border: 0.5px;">Nota especial</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$subtotal = 0;
				foreach ($balance as $persiana) {
					if(empty($persiana['hor_nota'])){						
					}else{
						$subtotal+=$persiana['hor_cantidad'];
						?>
			 ?>
			<tr>
				<td class="text-center"><?= $persiana['hor_cantidad'] ?></td>
				<td class="text-center"><?= $persiana['hor_identificacion'] ?></td>
				<td class="text-center"><?= $persiana['hor_instalacion'] ?></td>
				<td class="text-center"><?= $persiana['hor_ancho'].' x '.$persiana['hor_largo'] ?></td>
				<td class="text-center"><?= $persiana['hor_est_color'] ?></td>
				<td class="text-center"><?= $persiana['hor_nota'] ?></td>
			</tr>
			<?php }
				}			
			?>
		</tbody>
		<tfoot>
             <tr>
				<td colspan="2"><strong>Cantidad de persianas: <?=$subtotal?></strong></td>
			</tr>
        </tfoot>	
	</table>
	<div class="text-center">
		<p>Si tienes preguntas sobre la órden, <br> buscar al gerente de ventas.</p>
		<h4>¡Gracias!</h4>
	</div>
</body>
</html>