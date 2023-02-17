<?php 
    headerAdmin($data); 
    getModal('modalShutters',$data);
    // getForm('rollers',$data);
?>
  <!-- <php headerAdmin($data); ?> -->
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-file-text-o"></i> <?= $data['page_title'] ?></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="<?= base_url(); ?>/pedidos"> Pedidos</a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <?php
          if(empty($data['arrPedido'])){
        ?>
        <p>Datos no encontrados</p>
        <?php }else{
            $cliente = $data['arrPedido']['cliente']; 
            $orden = $data['arrPedido']['orden'];
            $roller = $data['arrPedido']['roller'];
            $precio = $data['arrPedido']['precio'];
         ?>
        <section id="sPedido" class="invoice">
          <div class="row mb-4">
            <div class="col-6">
              <h2 class="page-header"><img src="<?= media(); ?>/images/1.png" style="width: 200px;"></h2>
            </div>
            <div class="col-6">
              <h5 class="text-right">Fecha: <?= $orden['fecha'] ?></h5>
            </div>
          </div>
          <div class="row invoice-info">
            <div class="col-4">
              <address><strong>INF. GENERAL</strong><br>
                <strong>  Presupuestado por: <?= $orden['vendedor']; ?></strong><br>
                Medido por: <?= $orden['medido'] ?><br>
                <?= NOMBRE_EMPESA; ?><br>
                <?= TELEMPRESA ?><br>
                <?= EMAIL_EMPRESA ?>
              </address>
            </div>
            <div class="col-4">
              <address><strong>CLIENTE</strong><br>
                <strong><?= $cliente['nombre'];?></strong><br>
                Direccíon: <?= $cliente['direccion']; ?><br>
                Ciudad: <?= $cliente['ciudad'] ?><br>
                Tel: <?= $cliente['telefono'] ?><br>
                Email: <?= $cliente['email'] ?>
               </address>
            </div>
            <div class="col-4">
              <b>INF. PEDIDO</b><br> 
            <input type="hidden" id="idpedidoGral" name="idpedidoGral" value="<?= $orden['idpedido']?>">
                <b>CN: <?= $orden['cn'] ?></b><br> 
                <b>Sucursal: </b><?= $orden['sucursal'] ?><br>
                <b>M. Entrega: </b><?= $orden['entrega'] ?><br>
                <strong>Precio x ft2: $ <?= $orden['precioft2'] ?> </strong>  <br>
                <!-- <strong>Motor: <= $orden['tipoMotor'] ?> </strong><br> -->
                <!-- <b>Monto:</b> <= SMONEY.' '. formatMoney($orden['monto']) ?> -->
            </div>
          </div>

          <p><b>Nota: Antes de ingresar las medidas es importante que las verifiques y esten acorde a su conversión; el sistema solo admite FT2.</b></p>

          <!-- --------------------------------------------ADD -->
          <div>
            <h2> Persianas
            <?php if($_SESSION['permisosMod']['w']){ ?>
                <button class="btn btn-primary" type="button" onclick="openModalRoller();"><i class="fas fa-plus-circle"></i> Nuevo</button>
              <?php } ?>
            </h2>
        </div>
        <br>

          <div class="row">
            <div class="col-12 table-responsive">
            <table class="table table-hover table-bordered" id="tableShutters">
                      <thead>
                        <tr>
                          <th>Cant.</th>
                          <th>Ubicacion</th>
                          <th>Tipo</th>
                          <th>Ancho</th>
                          <th>Largo</th>
                          <th>Color</th>
                          <!-- <th>Total ft2</th> -->
                          <th>Precio Total</th>
                          <th>Acciones</th>
                          
                        </tr>
                      </thead>
                      <thead>
                <tbody>
                    <?php 
                    $importe = 0;
                    $ft2xPed=0;
                        if(count($roller) > 0){
                            foreach ($roller as $persiana) {
                                $importe +=$persiana['shut_totalprecio'];
                                $ft2xPed +=$persiana['shut_ft2'];

                     ?>
                  <tr>
                    <!-- <td>?= $persiana['en_cantidad'] ?></td> -->
                    <td><?= $persiana['shut_cantidad'] ?></td>
                    <td><?= $persiana['shut_identificacion'] ?></td>
                    <?php
                    if(empty($persiana['shut_nota'])){ ?>
                    <td><span class="badge badge-success">Normal</span></td>
                    <?php }else{ ?>
                      <td><span class="badge badge-warning">Especial</span></td>
                    <?php }?>
                    <!-- <td><= $persiana['shut_nota'] ?></td> -->
                    <td><?= $persiana['shut_ancho'] ?></td>
                    <td><?= $persiana['shut_largo'] ?></td>
                    <td><?= $persiana['shut_color'] ?></td>
                    <!-- <td><?= $persiana['shut_ft2'] ?></td> -->
                    <td><?= $persiana['shut_totalprecio'] ?></td>

                    <td>
                          <!-- <button class="btn btn-info btn-sm"    onClick="fntViewShutter(<?=$persiana['ID_SHUTTER']?>)" title="Ver Shutter"><i class="far fa-eye"></i> </button> -->
                          <button class="btn btn-primary btn-sm" onClick="fntEditShutter(<?=$persiana['ID_SHUTTER']?>)" title="Editar Shutter"><i class="fas fa-pencil-alt"></i></button>
                          <button class="btn btn-danger btn-sm"   onClick="fntDelShutter(<?=$persiana['ID_SHUTTER']?>)" title="Eliminar Shutter"><i class="far fa-trash-alt"></i></button>                                 
                    </td>
                  </tr>
                  <?php 
                            }
                        }
                   ?>
                </tbody>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
         
          <form id="formPrice" name="formPrice" class="form-horizontal">
              <!-- <input type="hidden" id="idPE" name="idPE" value="<= $orden['idpedido'] ?>">
              <input type="hidden" id="id" name="id" value=""> -->
              <table class="table table-hover" >
                  <?php if($precio>0){ ?>
                    <input type="hidden" id="idPE" name="idPE" value="<?= $orden['idpedido'] ?>">
              <input type="hidden" id="id" name="id" value="<?= $precio['id']?>">
                <tfoot>
                <tr>
                        <th colspan="4" class="text-right">Total de ft2: &nbsp; 
                        <td><input type="text" id="txtFt2" name="txtFt2"  class="form-control"  value="<?= $ft2xPed ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-right col-md-10">Importe: &nbsp;</th>
                        <td class="text-right"><input type="text" id="txtImporte" name="txtImporte" class="monto" onkeyup="calculateTotal();" value=" <?=$importe?>" readonly >
                        </td>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-right">Distribuidor: &nbsp;
                        <input type="text"    class="monto" id="txtdescuento" name="txtdescuento" onkeyup="calculateTotal();" value="<?= $precio['porcentaje'] ?>"> %
                       </th> 
                        <td class="text-right">
                        <input type="text" id="txtDesc"  name="txtDesc" class="form-control" value="<?= $precio['totalPor'] ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-right">Sub-Total:</th>
                        <td class="text-right" >
                        <input type="text" id="txtSubtotal" name="txtSubtotal"  class="form-control"  value="<?= $precio['subtotal'] ?>" readonly>
                        </td>
                    </tr>                    
                    <tr>
                    <th colspan="4" class="text-right">Instalacion: </th> 
                        <td class="text-right">
                        <input type="text"   class="form-control" id="txtInstall" name="txtInstall" onkeyup="calculateTotal();"  value="<?= $precio['instalacion'] ?>" ></td>
                    </tr>
                    <!--  -->
                    <tr>
                        <th colspan="4" class="text-right">Impuesto: &nbsp;
                        <input type="text"    class="monto" id="txtimpuesto" name="txtimpuesto" onkeyup="calculateTotal();" value="<?= $precio['percenimp'] ?>"> %
                       </th> 
                        <td class="text-right">
                        <input type="text" id="txtImp"  name="txtImp" class="form-control" value="<?= $precio['totalimp'] ?>" readonly>
                        </td>
                    </tr>
                    <!--  -->
                    <tr>
                        <th colspan="4" class="text-right">Total:</th>
                        <td class="text-right">
                        <input type="text" id="txtTotal" name="txtTotal"  class="form-control"  value="<?= $precio['total'] ?>" readonly>
                        
                      </td>
                    </tr>
                    <tr>
                    <th colspan="4" class="text-right">Anticipo:</th> 
                        <td class="text-right"><input type="text"  class="form-control" onkeyup="calculateTotal();" id="txtAnticipo" name="txtAnticipo"  value="<?= $precio['anticipacion'] ?>" ></td>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-right">Saldo:</th>
                        <td class="text-right"><input type="text"  class="form-control" id="txtSaldo" name="txtSaldo" readonly   value="<?= $precio['saldo'] ?>">
                        </td>
                    </tr>
                </tfoot>
                <?php }else{ ?>
                 <tfoot>
                 <input type="hidden" id="idPE" name="idPE" value="<?= $orden['idpedido'] ?>">
                 <input type="hidden" id="id" name="id" value="">
                    <tr>
                        <th colspan="4" class="text-right col-md-10">Importe:</th>
                        <td class="text-right"><input type="text" id="txtImporte" name="txtImporte" class="monto" onkeyup="calculateTotal();" value=" <?=$importe?>" readonly >
                        </td>
                    </tr>
                    <?php
                    ?>
                    <tr>
                        <th colspan="4" class="text-right">Distribuidor: &nbsp;
                        <input type="text"    class="monto" id="txtdescuento" name="txtdescuento" onkeyup="calculateTotal();"> %
                       </th> 
                        <td class="text-right">
                        <input type="text" id="txtDesc"  name="txtDesc" class="form-control" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-right">Sub-Total:</th>
                        <td class="text-right" >
                        <input type="text" id="txtSubtotal" name="txtSubtotal"  class="form-control" readonly>
                        </td>
                    </tr>                    
                    <tr>
                    <th colspan="4" class="text-right">Instalacion: </th> 
                        <td class="text-right">
                        <input type="text"   class="form-control" id="txtInstall" name="txtInstall" onkeyup="calculateTotal();"></td>
                    </tr>
                     <!--  -->
                     <tr>
                        <th colspan="4" class="text-right">Impuesto: &nbsp;
                        <input type="text"    class="monto" id="txtimpuesto" name="txtimpuesto" onkeyup="calculateTotal();"> %
                       </th> 
                        <td class="text-right">
                        <input type="text" id="txtImp"  name="txtImp" class="form-control" readonly>
                        </td>
                    </tr>
                    <!--  -->
                    <tr>
                        <th colspan="4" class="text-right">Total:</th>
                        <td class="text-right">
                        <input type="text" id="txtTotal" name="txtTotal"  class="form-control" readonly>
                        
                      </td>
                    </tr>
                    <tr>
                    <th colspan="4" class="text-right">Anticipo:</th> 
                        <td class="text-right"><input type="text"  class="form-control" onkeyup="calculateTotal();" id="txtAnticipo" name="txtAnticipo"></td>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-right">Saldo:</th>
                        <td class="text-right"><input type="text"  class="form-control" id="txtSaldo" name="txtSaldo" readonly>
                        </td>
                    </tr>
                </tfoot>
                <?php } ?>
            </table>

            <div class="row d-print-none mt-2">
              <div class="col-12 text-right"> 
                <?php
                if(empty($precio['subtotal'])){ ?>
              <button class="btn btn-primary" type="button" value="Guardar" onclick="valida_envia()"><i class="fas fa-save"></i> Guardar</button>   
               <?php } else{?>
              <button class="btn btn-info" type="button" value="<?= $precio['id']?> " onclick="editar()"><i class="fas fa-edit"></i> Actualizar</button> 
              <?php } ?>
              <!-- <input class="btn btn-primary" type="button" value="Guardar" onclick="valida_envia()">   -->
              <br>
              <br> 
              <?php 
              if(isset($roller['shut_nota'])){ ?>
              <p>No hay notas especiales</p>

             <?php }else{ ?>
              
                <a class="btn btn-outline-info" href="<?=base_url().'/shutters/PDFNOTES/'.$orden['idpedido']?>" target="_blanck"><i class="fa fa-print"></i> Imprimir notas especiales</a> 


             <?php }
              ?>           
           
              <a class="btn btn-success" href="<?=base_url().'/shutters/facturacliente/'.$orden['idpedido']?>" target="_blanck"><i class="fa fa-print"></i> PDF Cliente</a> 
               <a class="btn btn-warning" href="<?=base_url().'/shutters/facturaproduccion/'.$orden['idpedido']?>" target="_blanck" ><i class="fa fa-print"></i> PDF Produccion</a>
              </div> 
          </div>
          </form>
          <!-- <div class="row d-print-none mt-2">
            <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print('#sPedido');" ><i class="fa fa-print"></i> Imprimir</a></div>
          </div> -->
        </section>
        <?php } ?>
      </div>
    </div>
  </div>
</main>
<?php footerAdmin($data); ?>