<!-- MODAL PERSIANA -->

<div class="modal fade" id="modalFormArcos" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerRegister" style="background-color:#5e2129;">
        <h5 class="modal-title" id="titleModal">Detalles Persiana</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="tile">
            <div class="tile-body">
              <form id="formArcos" name="formArcos">
                <!-- --------------------------------------------------DATOS GENERALES -->
                <!-- <div class="form-group">
                <h3 class="box-title">Cantidad</h3>
                </div> -->
                    <div class="row"> 
                    <div class="col">
                      <label for="exampleSelect1">Cantidad:</label>
                       <input type="text" class="form-control" placeholder="Unidades" id="unidades" name="unidades" onkeyup="calculate();">
                      </div> 
                      <div class="col">
                      <input type="hidden" id="idArcos" name="idArcos">
                    <?php
                      if(empty($data['arrPedido'])){
                    ?>
                    <p>Datos no encontrados</p>
                    <?php }else{
                        $orden = $data['arrPedido']['orden'];
                    ?>
                      <input type="hidden" id="idPedidoS" name="idPedidoS" value="<?= $orden['idpedido'] ?>">
                      <!-- <input type="hidden" id="idprecio" name="idprecio" value="<= $orden['precioft2'] ?>"> -->
                      <?php
                    } ?>                      
                      <label for="exampleSelect1">Identificacion:</label>
                       <input type="text" class="form-control" placeholder="Identificacion" id="Iden" name="Iden">
                      </div>  
                      <div class="col">
                       <label for="exampleSelect1">Tipo de instalacion:</label>
                        <select class="form-control select2" id="Inst" name="Inst" onchange="calculate();">
                          <option selected="selected">---</option>
                          <option>IB</option>
                          <option>OB</option>
                          <option>SOBRE</option>
                          <option>OTRO</option>
                        </select>
                      </div> 
                      <div class="col">
                      <label for="exampleSelect1">Medidas (in):</label>
                        <input type="text" class=" form-control monto" placeholder="Ancho" id="base" name="base" onkeyup="calculate();" >
                        <input type="text" class="form-control" placeholder="Alto" id="altura" name="altura" onkeyup="calculate();" >
                      </div>                      
                    </div> <br>

                    <div class="row">  
                      <div class="col">
                      <label for="exampleSelect1">Color</label>
                        <select class="form-control select2" id="color" name="color">
                          <option selected="selected">---</option>
                          <option>Picolo</option>
                          <option>Bolero</option>
                          <option>Clarinete</option>
                          <option>Natural</option>
                          <option>Sugar Maple</option>
                          <option>Nogal Clasico</option>
                          <option>Roble</option>
                          <option>Cappuccino</option>
                          <option>Chocolate</option>
                          <option>Dark Mahogany</option>
                          <option>Coffee</option>
                          <option>Igualacion</option>
                        </select>
                      </div> 
                     <div class="col">
                      <label for="exampleSelect1">Tipo de configuración</label>
                        <select class="form-control select2" id="config" name="config" onchange="calculate();">
                          <option selected="selected">---</option>
                          <option value='Horizontal 2" Arriba'>Horizontal 2" Arriba</option>
                          <option value='Horizontal 2" Abajo'>Horizontal 2" Abajo</option>
                          <option value='Sunburst 2" Perfecto'>Sunburst 2" Perfecto</option>
                          <option value='Sunburst 2" Tipo Ceja'>Sunburst 2" Tipo Ceja</option>
                          <option value='Shutter Regular'>Shutter Regular</option>
                          <option value='Shutter Irregular'>Shutter Irregular</option>
                          <!-- <option>2 1/2 "</option> -->
                        </select>
                      </div>  
                      <div class="col">
                      <label for="exampleSelect1">Marco</label>
                        <select class="form-control select2" id="marco" name="marco" onchange="calculate();">
                          <option selected="selected">---</option>
                          <option value="Z-Delux">Z-Delux</option>
                          <option value="Z-Standar">Z-Standar</option>
                          <option value="Z-Redondo">Z-Redondo</option>
                          <option value="L-Standar">L-Standar</option>
                          <option value="Otro">Otro</option>
                        </select>
                      </div>
                    </div> <br>
                    <div class="row">
                      <div class="col">
                            <label for="exampleSelect1">Precio de Lista/ Precio por FT2</label>
                        <input type="text" class="form-control monto" placeholder="Precio" id="precio" name="precio" onchange="calculate();">
                      </div>
                      <div class="col">
                        <label for="exampleSelect1">Total ft2</label>
                        <input type="text" class="form-control" placeholder="Total ft2" id="Tft2" name="Tft2" readonly>
                      </div>
                      <div class="col">
                            <label for="exampleSelect1">Precio Total</label>
                        <input type="text" class="form-control" placeholder="Precio total" id="precio_total" name="precio_total" readonly>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                     <div class="col">
                      <label for="exampleSelect1">Plantilla</label>
                        <select class="form-control select2" id="plant" name="plant">
                          <option selected="selected">---</option>
                          <option value="Si">Si</option>
                          <option value="No">No</option>
                          <option value="Otro">Otro</option>
                        </select>
                      </div>
                      <div class="col">
                        <label for="exampleSelect1">Nota Especial.</label>
                        <input type="text" class="form-control" placeholder="Agrega especificaciones especiales" id="nota" name="nota">
                      </div>
                    </div>
                    <div class="tile-footer">                                
              </div>
                  
                <div class="tile-footer">
                  <!-- <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#" data-dismiss="modal" ><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a> -->
                  <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Agregar</span></button>
                  &nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#" data-dismiss="modal" ><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
             <!-- <button class="btn btn-primary" type="button" onclick="openModal();" ><i class="fas fa-plus-circle"></i> Nuevo</button> -->

                </div>
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalViewShutter" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Datos de la persiana</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
          <tr>
              <td>Cantidad:</td>
              <td id="celCant">654654654</td>
            </tr>
            <tr>
              <td>Identificación:</td>
              <td id="celIdent">654654654</td>
            </tr>
            <tr>
              <td>Ancho:</td>
              <td id="celancho">Larry</td>
            </tr>
            <tr>
              <td>Alto:</td>
              <td id="celalto">Larry</td>
            </tr>
            <tr>
              <td>Profundidad:</td>
              <td id="celprof">Jacob</td>
            </tr>
            <tr>
              <td>Tipo de medida:</td>
              <td id="celMed">Jacob</td>
            </tr>
            <tr>
              <td>Color:</td>
              <td id="celColor">Larry</td>
            </tr>
            <tr>
              <td>M. Louver:</td>
              <td id="celLouver">Jacob</td>
            </tr>
            <tr>
              <td>Tipo de bastón:</td>
              <td id="celBaston">Larry</td>
            </tr>
            <tr>
              <td>Tipo de configuración:</td>
              <td id="celConfig">Larry</td>
            </tr>
            <tr>
              <td>Diagrama:</td>
              <td id="imgCategoria">Larry</td>
            </tr>
            <tr>
              <td>Poste 1:</td>
              <td id="celPoste1">Larry</td>
            </tr>
            <tr>
              <td>Poste 2:</td>
              <td id="celPoste2">Larry</td>
            </tr>
            <tr>
              <td>Ubicación Riel:</td>
              <td id="celRiel">Larry</td>
            </tr>
            <tr>
              <td>Total FT2:</td>
              <td id="celTft2">Jacob</td>
            </tr>
            <tr>
              <td>Precio:</td>
              <td id="celprecio">Jacob</td>
            </tr>
            <tr>
              <td>Precio Total:</td>
              <td id="celTotal">Jacob</td>
            </tr>
            <tr>
              <td>Notas Especiales:</td>
              <td id="celnota">Jacob</td>
            </tr>
            
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>