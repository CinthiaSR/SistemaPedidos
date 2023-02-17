<!-- MODAL PERSIANA -->

<div class="modal fade" id="modalComplemento" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerRegister" style="background-color:#5e2129;">
        <h5 class="modal-title" id="titleModal">Agregar Complemento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="tile">
            <div class="tile-body">
              <form id="formComplemento" name="formComplemento">
                <!-- --------------------------------------------------DATOS GENERALES -->
                    <div class="row">  
                      <div class="col">
                      <input type="hidden" id="idComp" name="idComp">

                    <?php
                      if(empty($data['arrPedido'])){
                    ?>
                    <p>Datos no encontrados</p>
                    <?php }else{
                        $orden = $data['arrPedido']['orden'];
                    ?>
                      <input type="hidden" id="idPedidoR" name="idPedidoR" value="<?= $orden['idpedido'] ?>">
                      <?php
                    }
?>
                      <label for="exampleSelect1">Cantidad:</label>
                       <input type="text" class="form-control" placeholder="Cantidad" id="can_roller" name="can_roller" onkeyup="calculate();">
                      </div> 
                     <!-- <div class="col">
                     <label for="exampleSelect1">ID:</label>
                       <input type="text" class="form-control" placeholder="ID" id="ID_roller" name="ID_roller">
                      </div>   -->
                      <div class="col">
                      <label for="exampleSelect1">Localizacion:</label>
                       <input type="text" class="form-control" placeholder="Localizacion" id="loc_roller" name="loc_roller">
                      </div>
                    </div> <br>
                    <div class="row"> 
                     <!-- ------------------------------------------------------------------------ -->
                      <div class="col">
                      <label for="exampleSelect1">Marca del motor</label>
                      <select class="form-control select2 monto" id="marca" name="marca" onchange="cambiante();">
                          <option selected="selected">---</option>
                          <option value="Somfy">Somfy</option>
                          <option value="Vertilux">Vertilux</option>
                          <option value="Tube">Tube</option>
                        </select>
                      </div>

                      <div class="col">
                      <label for="exampleSelect1">Tipo de elemento:</label>
                      <select class="form-control select2 monto" id="tipo" name="tipo" onchange="cambiante();">
                          <option selected="selected">---</option>
                          <option value="Motor">Motor</option>
                          <option value="Control">Control</option>
                          <option value="Cargador">Cargador</option>
                          <option value="Interface">Interface</option>
                          <option value="Ext">Ext</option>
                        </select>
                      </div>
                      
                      <div class="col">
                      <label for="exampleSelect1">Nombre del motor</label>
                      <select class="form-control select2" id="nombre_motor" name="nombre_motor" onchange="cambiante();">
                          <option value="0">---</option>
                          <!-- <option value="Recargable">Recargable</option>
                          <option value="Eléctrico">Eléctrico</option>
                          <option value="Otro">Otro</option> -->
                        </select>
                      </div>                     
                    </div>                 
                    <!-- ---------------------------------------------------------------Dinamismo -->
                    <br>

                    <div class="row">
                    <div class="col">
                      <label for="exampleSelect1">Precio de lista</label>
                      <input type="text" class="form-control monto" placeholder="Precio" id="precioLista" name="precioLista" onchange="calculate();">
                      </div>   
                     <div class="col">
                      <label for="exampleSelect1">Precio unitario</label>
                      <input type="text" class="form-control" placeholder="Precio" id="precio_unitario" name="precio_unitario" readonly>
                      </div>  
                      <div class="col">
                      <label for="exampleSelect1">Precio Total</label>
                      <input type="text" class="form-control" placeholder="Precio total" id="precio_total" name="precio_total" readonly>
                      </div>                   
                    </div>
                    <br>
                    <div class="row">
                    <div class="col">
                        <label for="exampleSelect1">Nota Especial.</label>
                        <input type="text" class="form-control" placeholder="Agrega especificaciones especiales" id="nota" name="nota">
                      </div>
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
