<!-- MODAL PERSIANA -->

<div class="modal fade" id="modalFormBalance" tabindex="-1" role="dialog" aria-hidden="true">
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
              <form id="formBalance" name="formBalance">
                <!-- --------------------------------------------------DATOS GENERALES -->
                    <div class="row">  
                      <div class="col">
                      <input type="hidden" id="idBalance" name="idBalance">

                    <?php
                      if(empty($data['arrPedido'])){
                    ?>
                    <p>Datos no encontrados</p>
                    <?php }else{
                        $orden = $data['arrPedido']['orden'];
                    ?>
                      <input type="hidden" id="idPedidoB" name="idPedidoB" value="<?= $orden['idpedido'] ?>">
                      <?php
                    }
?>
                      <label for="exampleSelect1">Cantidad:</label>
                       <input type="text" class="form-control" placeholder="Cantidad" id="can" name="can" onkeyup="calculate();">
                      </div> 
                     <!-- <div class="col">
                     <label for="exampleSelect1">ID:</label>
                       <input type="text" class="form-control" placeholder="ID" id="ID_roller" name="ID_roller">
                      </div>   -->
                      <div class="col">
                      <label for="exampleSelect1">Localizacion:</label>
                       <input type="text" class="form-control" placeholder="Localizacion" id="loc" name="loc">
                      </div>
                      <div class="col">
                      <label for="exampleSelect1">Instalacion:</label>
                        <select class="form-control select2" id="inst" name="inst">
                          <option selected="selected">---</option>
                          <option>Interna</option>
                          <option>Externa</option>
                          <option>Otro</option>
                        </select>
                      </div>
                      <div class="col">
                      <label for="exampleSelect1">Medidas (in):</label>
                      <input type="text" class="form-control" placeholder="Alto" id="alt" name="alt">
                        <input type="text" class="form-control monto" placeholder="Largo" id="anc" name="anc" onkeyup="calculate();">
                      </div>
                    </div> <br>

                    <div class="row"> 
                    <div class="col">
                      <label for="exampleSelect1">Color</label>
                       <input type="text" class="form-control" placeholder="Color" id="col" name="col" >
                      </div> 
                      <div class="col">
                      <label for="exampleSelect1">Tamaño de retorno:</label>
                       <input type="text" class="form-control" placeholder="Retorno" id="tam" name="tam" >
                      </div> 
                      <div class="col">
                      <label for="exampleSelect1">Cortes Especiales:</label>
                        <select class="form-control select2" id="cortesEsp" name="cortesEsp">
                          <option selected="selected">---</option>
                          <option>Si</option>
                          <option>No</option>
                          <option>Otro</option>
                        </select>
                      </div>
                      <div class="col">
                      <label for="exampleSelect1">L para Instalación:</label>
                      <select class="form-control select2" id="L_inst" name="L_inst">
                          <option selected="selected">---</option>
                          <option>Si</option>
                          <option>No</option>
                          <option>Otro</option>
                        </select>
                      </div>
                    </div> <br>

                    <div class="row">   
                     <div class="col">
                      <label for="exampleSelect1">Tapa Superior</label>
                        <select class="form-control select2" id="Sup" name="Sup">
                          <option selected="selected">---</option>
                          <option>Si</option>
                          <option>No</option>
                          <option>Otro</option>
                        </select>
                      </div>  
                      <div class="col">
                      <label for="exampleSelect1">Forrado:</label>
                       <select class="form-control select2" id="Forr" name="Forr" >
                          <option selected="selected">---</option>
                          <option>Si</option>
                          <option>No</option>
                          <option>Otro</option>
                        </select>
                      </div> 
                       <div class="col">
                      <label for="exampleSelect1">Nombre del Forro</label>
                      <input type="text" class="form-control monto" placeholder="Nombre del Forro" id="NameFrr" name="NameFrr">
                      </div>                    
                    </div>
                                      
                    <!-- </div> -->
                    <br>

                    <div class="row">
                    <!-- <div class="col">
                      <label for="exampleSelect1">Precio Unitario</label>
                      <input type="text" class="form-control monto" placeholder="Precio" id="precioLista" name="precioLista" onchange="calculate();">
                      </div>    -->
                     <div class="col">
                      <label for="exampleSelect1">Precio unitario</label>
                      <input type="text" class="form-control" placeholder="Precio" id="precio_unitario" name="precio_unitario" onchange="calculate();">
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

<!-- Modal -->
<div class="modal fade" id="modalViewHorizontal" tabindex="-1" role="dialog" aria-hidden="true">
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
              <td id="celcantidad">Jacob</td>
            </tr>
            <tr>
              <td>Ubicacion:</td>
              <td id="cellocalizacion">Jacob</td>
            </tr>
            <tr>
              <td>Instalacion:</td>
              <td id="celinstalacion">Jacob</td>
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
              <td>Escalera:</td>
              <td id="celEsc">Larry</td>
            </tr>

            <tr>
              <td>Color:</td>
              <td id="celcolor">Larry</td>
            </tr>
            <tr>
              <td>Configuración:</td>
              <td id="celconfiguracion">Jacob</td>
            </tr>
            <tr>
              <td>CMB:</td>
              <td id="celcbm">Jacob</td>
            </tr>
            <tr>
              <td>Elevador:</td>
              <td id="celelev">Larry</td>
            </tr>
            <tr>
              <td>Galeria:</td>
              <td id="celgal">Larry</td>
            </tr>
            <tr>
              <td>Retornos de Valence</td>
              <td id="celVal">Larry</td>
            </tr>
            <tr>
              <td>Holddown:</td>
              <td id="celBrack">Jacob</td>
            </tr>
            <tr>
              <td>Precio:</td>
              <td id="celprecio">Jacob</td>
            </tr>
            <tr>
              <td>Nota:</td>
              <td id="celnota">Jacob</td>
            </tr>
            <!-- <tr>
              <td>Estado:</td>
              <td id="celstatus">Jacob</td>
            </tr> -->
            
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>