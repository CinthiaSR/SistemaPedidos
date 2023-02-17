<?php 
	$cliente = $data['cliente'];
	$orden = $data['orden'];
	$shutter = $data['shutter'];
    $precio = $data['precio'];
 ?>
<!DOCTYPE html>
<html lang="es">
<head> 
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Factura</title>
	<style>
		table{
			width: 100%;
		}
		table td, table th{
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
			border: 1px solid #CCC;
			border-radius: 10px;
			padding: 5px;
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
		}
		.tbl-detalle tbody td{
			border-bottom: 1px solid #CCC;
			padding: 5px;
		}
		.tbl-detalle tfoot td{
			padding: 5px;
		}
	</style>
</head>
<body>

<table class="tbl-hader">
		<tbody>
			<tr>
				<td class="wd33">
				  <img src="<?= media() ?>/images/1.png" style="width: 250px;" alt="Logo"> 
				</td>
				<td class="text-center wd33">
				        <strong>Presupuestado por: <?= $orden['vendedor']; ?></strong><br>
						Medido por: <?= $orden['medido'] ?><br>
						<?= NOMBRE_EMPESA; ?><br>
						<?= TELEMPRESA ?><br>
						<?= EMAIL_EMPRESA ?>
				</td>
				<td class="text-righ wd33">
					<b>FECHA: <?= $orden['fecha'] ?></b><br>  
					<b>CN: <?= $orden['cn'] ?></b><br> 
					<b>Sucursal: </b><?= $orden['sucursal'] ?><br>
					<b>M. Entrega: </b><?= $orden['entrega'] ?><br>
					<strong>Precio por ft2: $ <?= $orden['precioft2'] ?> </strong>              
				</td>
			</tr>
		</tbody>
	</table>
	<br>
	<table class="tbl-cliente">
		<tbody>
			<tr>
				<td class="wd10"><strong>Cliente:</strong> </td>
				<td class="wd40"><?= $cliente['nombre'] ?></td>
				<td class="wd10"><strong>Dirección:</strong> </td>
				<td class="wd40"><?= $cliente['direccion'].', '.$cliente['ciudad'] ?></td>
			</tr>
			<tr>
				<td><strong>Teléfono:</strong> </td>
				<td><?= $cliente['telefono']?></td>
				<td><strong>Email:</strong> </td>
				<td><?= $cliente['email'] ?></td>
			</tr>
		</tbody>
	</table>
	<div>
		<p style="text-align: justify;">Toda información que se encuentre en este documento deberá ser confirmada y firmada por el cliente. Ordenes que no aprueben
		 el proceso de confirmación serán excluidas. Es requerido el 50% del total de la orden para que sea procesada, el resto del importe será cobrado en la entrega o instalación. </p> <br>
	</div>
	<table class="tbl-detalle" style="border: 10px;">
		<thead>
			<tr>
				<th style="background-color:#fff; color:black; border: 0.5px;">#</th>
				<th style="background-color:#fff; color:black; border: 0.5px;">Identificación</th>
				<th style="background-color:#fff; color:black; border: 0.5px;">Descripción</th>
				<th style="background-color:#fff; color:black; border: 0.5px;">Nota Especial</th>
				<th style="background-color:#fff; color:black; border: 0.5px;">Precio</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$subtotal = 0;
				
				foreach ($shutter as $persiana) {
					// $importe = $producto['precio'] * $producto['cantidad'];
					// $subtotal = $subtotal + $importe;
					
			 ?>
			<tr>
				<td>1</td>
				<td class="text-center"><?= $persiana['shut_identificacion'] ?></td>
				<td>
					<table>
						<tr>
							<td>
							<b>Medidas (in): </b><?= $persiana['shut_ancho'] ?> x <?= $persiana['shut_largo'] ?> <br>  
							<b>Profundidad (in): </b><?= $persiana['shut_profundidad'] ?><br>
							<b>Tipo de medida: </b><?= $persiana['shut_t_medida'] ?><br>
							<b>Tipo de instalación: </b><?= $persiana['shut_t_instalacion'] ?><br>
							<b>Color: </b><?= $persiana['shut_color'] ?><br>
							<b>Louver: </b><?= $persiana['shut_m_louver'] ?><br>
							<b>Marco: </b><?= $persiana['shut_t_marco'] ?><br>
							</td>
							<td>
							<b>Bastón: </b><?= $persiana['shut_baston'] ?> <br>  
							<b>Configuración: </b><?= $persiana['shut_configuracion'] ?><br>
							<b>Poste T #1: </b><?= $persiana['shut_p_T1'] ?><br>
							<b>Poste T #2: </b><?= $persiana['shut_p_T2'] ?><br>
							<b>Riel: </b><?= $persiana['shut_Ub_riel'] ?><br>
							<b>Ft2: </b><?= $persiana['shut_ft2'] ?><br>
							</td>
						</tr>
					</table>
				</td>
				<td class="text-righ wd33"><?= $persiana['shut_nota'] ?></td>								
				<td><b>$ <?= $persiana['shut_precio'] ?></b></td>
			</tr>
			<?php } ?>
		</tbody>
		<tfoot>
		    <tr>
				<td colspan="2"><strong>_____________</strong></td>
			</tr>
			<tr>
			    <td colspan="2"><strong>Observaciones</strong></td>
				<td colspan="2" class="text-right"><b>Importe:</b> </td>
				<td class="text-right"><?= SMONEY. $precio['importe'] ?></td>
			</tr>
			<tr>
				<td colspan="4" class="text-right"><b>Distribuidor:</b>  <b><?= $precio['porcentaje'] ?> %</b> </td>
				<td class="text-right"><?= SMONEY . $precio['totalPor'] ?></td>
			</tr>
			<tr>
				<td colspan="4" class="text-right"><b>Subtotal:</b> </td>
				<td class="text-right"><?= SMONEY . $precio['subtotal'] ?></td>
			</tr>
			<tr>
				<td colspan="4" class="text-right"><b>Instalación:</b> </td>
				<td class="text-right"><?= SMONEY . $precio['instalacion'] ?></td>
			</tr>
			<tr>
				<td colspan="4" class="text-right"><b>Total:</b> </td>
				<td class="text-right"><?= SMONEY . $precio['total'] ?></td>
			</tr>
			<tr>
				<td colspan="4" class="text-right"><b>Anticipo:</b> </td>
				<td class="text-right"><?= SMONEY . $precio['anticipacion'] ?></td>
			</tr>
			<tr>
				<td colspan="4" class="text-right"><b>Saldo:</b> </td>
				<td class="text-right"><?= SMONEY . $precio['saldo'] ?></td>
			</tr>
		</tfoot>
	</table>
	<div class="text-center">
		<p>Si tienes preguntas sobre tu órden, <br> ponte en contacto con nosotros.</p>
		<h4>¡Gracias por tu compra!</h4>
	</div>
</body>
</html>