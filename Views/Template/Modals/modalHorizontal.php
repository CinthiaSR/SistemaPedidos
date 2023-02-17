<!-- MODAL PERSIANA -->

<div class="modal fade" id="modalFormHorizontal" tabindex="-1" role="dialog" aria-hidden="true">
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
              <form id="formHorizontal" name="formHorizontal">
                <!-- --------------------------------------------------DATOS GENERALES -->
                    <div class="row">  
                      <div class="col">
                      <input type="hidden" id="idHorizontal" name="idHorizontal">

                    <?php
                      if(empty($data['arrPedido'])){
                    ?>
                    <p>Datos no encontrados</p>
                    <?php }else{
                        $orden = $data['arrPedido']['orden'];
                    ?>
                      <input type="hidden" id="idPedidoH" name="idPedidoH" value="<?= $orden['idpedido'] ?>">
                      <?php
                    }
?>
                      <label for="exampleSelect1">Cantidad:</label>
                       <input type="text" class="form-control" placeholder="Cantidad" id="can_horizontal" name="can_horizontal" onkeyup="calculate();">
                      </div> 
                     <!-- <div class="col">
                     <label for="exampleSelect1">ID:</label>
                       <input type="text" class="form-control" placeholder="ID" id="ID_roller" name="ID_roller">
                      </div>   -->
                      <div class="col">
                      <label for="exampleSelect1">Localizacion:</label>
                       <input type="text" class="form-control" placeholder="Localizacion" id="loc_horizontal" name="loc_horizontal">
                      </div>
                      <div class="col">
                      <label for="exampleSelect1">Instalacion:</label>
                        <select class="form-control select2" id="inst_horizontal" name="inst_horizontal">
                          <option selected="selected">---</option>
                          <option>IB</option>
                          <option>OB</option>
                          <option>Exacta</option>
                          <option>Otro</option>
                        </select>
                      </div>
                      <div class="col">
                      <label for="exampleSelect1">Medidas (in):</label>
                        <input type="text" class="form-control monto" placeholder="Ancho" id="anc_horizontal" name="anc_horizontal" onkeyup="calculate();">
                        <input type="text" class="form-control" placeholder="Alto" id="alt_horizontal" name="alt_horizontal">
                      </div>
                      <div class="col">
                      <label for="exampleSelect1">Tipo de escalera:</label>
                        <select class="form-control select2" id="esc_horizontal" name="esc_horizontal">
                          <option selected="selected">---</option>
                          <option>Normal</option>
                          <option>Routless</option>
                          <option>Cinta de Tela</option>
                          <option>Otro</option>
                        </select>
                      </div>
                    </div> <br>

                    <div class="row">  
                      <div class="col">
                      <label for="exampleSelect1">Estilo y Color</label>
                       <input type="text" class="form-control" placeholder="Color" id="col_horizontal" name="col_horizontal" >
                      </div> 
                     <div class="col">
                      <label for="exampleSelect1">Configuración:</label>
                      <input type="text" class="form-control" placeholder="Normal/ otra medida" id="config_horizontal" name="config_horizontal" >
                      </div>  
                      <div class="col">
                      <label for="exampleSelect1">Control</label>
                        <select class="form-control select2" id="ctrl_horizontal" name="ctrl_horizontal">
                          <option selected="selected">---</option>
                          <option value="C-Der">C-Der</option>
                          <option value="C-Izq">C-Izq</option>
                          <option value="B-Der">B-Der</option>
                          <option value="B-Izq">B-Izq</option>
                          <option value="M-Der">M-Der</option>
                          <option value="M-Izq">M-Izq</option>
                          <option value="Otro">Otro</option>
                        </select>
                      </div>
                      <div class="col">
                      <label for="exampleSelect1">Elevador</label>
                      <select class="form-control select2" id="elev_horizontal" name="elev_horizontal">
                          <option selected="selected">---</option>
                          <option>Der</option>
                          <option>Izq</option>
                          <option>Otro</option>
                        </select>
                      </div>
                    </div> <br>

                    <div class="row">   
                     <div class="col">
                      <label for="exampleSelect1">Tipo de galería</label>
                        <select class="form-control select2" id="gal_horizontal" name="gal_horizontal">
                          <option selected="selected">---</option>
                          <option>Royal</option>
                          <option>Italic</option>
                          <option>Majestic</option>
                          <option>Otro</option>
                        </select>
                      </div>  
                      <div class="col">
                      <label for="exampleSelect1">Retornos de Valance:</label>
                        <input type="text" class="form-control monto" placeholder="Normal o ingrese otra medida" id="val_horizontal" name="val_horizontal">
                      </div>
                      <div class="col">
                      <label for="exampleSelect1">Hold-down Bracket</label>
                       <select class="form-control select2" id="brack_horizontal" name="brack_horizontal" >
                          <option selected="selected">---</option>
                          <option>Si</option>
                          <option>No</option>
                          <option>Otro</option>
                        </select>
                      </div>                   
                    </div>
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