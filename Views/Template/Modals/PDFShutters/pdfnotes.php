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
			width: 90%;
            border-radius: 5px;
            border: 1px;
            border-color: #CCC;
		}
		table td, table th{
			font-size: 10px;
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
				<td>
				  <img src="<?= media() ?>/images/1.png" style="width: 180px;" alt="Logo"> 
				</td>
				<td class="text-center wd33" style="font-size: 10px;">
				        <strong>Presupuestado por: <?= $orden['vendedor']; ?></strong><br>
						Medido por: <?= $orden['medido'] ?><br>
						<?= NOMBRE_EMPESA; ?><br>
						<?= TELEMPRESA ?><br>
						<?= EMAIL_EMPRESA ?>
				</td>
				<td style="font-size: 10px;">
					<b>FECHA: <?= $orden['fecha'] ?></b><br>  
					<b>CN: <?= $orden['cn'] ?></b><br> 
					<b>Sucursal: </b><?= $orden['sucursal'] ?><br>
					<b>M. Entrega: </b><?= $orden['entrega'] ?><br>
					<strong>Precio por ft2: <?= $orden['precioft2'] ?> </strong>              
				</td>
				<td  class="text-center wd33">
					<b style="font-size: 18px;">Shutters de madera <br>
                    <b style="font-size: 10px;"> Shutters especiales</b>
                </b>
                    
                    <br>  
				</td>
			</tr>
		</tbody>
	</table>
	<br>
	<div>
		<p style="text-align: justify;">Toda información que se encuentre en este documento es exclusivamente para shutters que requieren una fabricación personalizada y los elementos 
    no se encuentren en los formatos. Favor de confirmar datos con el <b>departamento de ventas. </b></p> <br>
	</div>
	<table class="tbl-detalle" style="border: 10px;" >
		<thead>
			<tr>
				<th style="background-color:#fff; color:black; border: 0.5px;">Cantidad</th>
				<th style="background-color:#fff; color:black; border: 0.5px;">Identificación</th>
				<th style="background-color:#fff; color:black; border: 0.5px;">Medidas <br> (in)</th>
				<th style="background-color:#fff; color:black; border: 0.5px;">Config</th>
				<th style="background-color:#fff; color:black; border: 0.5px;">Diagrama</th>
				<!-- <th style="background-color:#fff; color:black; border: 0.5px;">nota</th> -->
				<th style="background-color:#fff; color:black; border: 0.5px;">Nota</th>
                <!-- <th style="background-color:#fff; color:black; border: 0.5px;">Referencia</th> -->
			</tr>
		</thead>
		<tbody>
			<?php 
				$subtotal = 0;
				foreach ($shutter as $persiana) {
				 if(empty($persiana['shut_nota'])){						
					}else{
						$subtotal+=$persiana['shut_cantidad'];
				?>	
			<tr>
                <td><?= $persiana['shut_cantidad'] ?></td>
				<td class="text-center"><?= $persiana['shut_identificacion'] ?></td>
				<td class="text-center"> <?= $persiana['shut_ancho'].' x ' .$persiana['shut_largo'] ?></td>
				<td class="text-center"><?= $persiana['shut_configuracion'] ?></td>
				<td>
				  <img src="<?= media().'/images/uploads/'.$persiana['shut_diagrama']?>" style="width: 90px;" alt="Logo"> 
				</td>
				<td class="text-center"><?= $persiana['shut_nota'] ?></td>
            </tr>
			<?php }
				}
			 ?>
		</tbody>
		<tfoot>
             <tr>
				<td colspan="2"><strong># Persianas: <?=$subtotal?></strong></td>
			</tr>
        </tfoot>
	
	</table>

</body>
</html>