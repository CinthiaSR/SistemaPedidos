<!-- MODAL PERSIANA -->

<div class="modal fade" id="modalFormNeolux" tabindex="-1" role="dialog" aria-hidden="true">
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
              <form id="formNeolux" name="formNeolux">
                <!-- --------------------------------------------------DATOS GENERALES -->
                    <div class="row">  
                      <div class="col">
                      <input type="hidden" id="idNeolux" name="idNeolux">

                    <?php
                      if(empty($data['arrPedido'])){
                    ?>
                    <p>Datos no encontrados</p>
                    <?php }else{
                        $orden = $data['arrPedido']['orden'];
                    ?>
                      <input type="hidden" id="idPedidoN" name="idPedidoN" value="<?= $orden['idpedido'] ?>">
                      <?php
                    }
    ?>
                      <label for="exampleSelect1">Cantidad:</label>
                       <input type="text" class="form-control" placeholder="Cantidad" id="can_neolux" name="can_neolux" onkeyup="calculate();">
                      </div> 
                     <div class="col">
                     <label for="exampleSelect1">ID:</label>
                       <input type="text" class="form-control" placeholder="ID" id="ID_neolux" name="ID_neolux">
                      </div>  
                      <div class="col">
                      <label for="exampleSelect1">Localizacion:</label>
                       <input type="text" class="form-control" placeholder="Localizacion" id="loc_neolux" name="loc_neolux">
                      </div>
                      <div class="col">
                      <label for="exampleSelect1">Instalacion:</label>
                        <select class="form-control select2" id="inst_neolux" name="inst_neolux">
                          <option selected="selected">---</option>
                          <option>IB</option>
                          <option>OB</option>
                          <option>Exacta</option>
                          <option>Otro</option>
                        </select>
                      </div>
                      <div class="col">
                      <label for="exampleSelect1">Medidas (in):</label>
                        <input type="text" class="form-control monto" placeholder="Ancho" id="anc_neolux" name="anc_neolux">
                        <input type="text" class="form-control" placeholder="Alto" id="alt_neolux" name="alt_neolux">
                      </div>
                    </div> <br>

                    <div class="row">  
                      <div class="col">
                      <label for="exampleSelect1">Tipo y Color (Tela)</label>
                       <input type="text" class="form-control" placeholder="Tipo y Color (Tela)" id="colTela_neolux" name="colTela_neolux" >
                      </div> 
                     <div class="col">
                      <label for="exampleSelect1">Tipo de Control</label>
                        <select class="form-control select2" id="control_neolux" name="control_neolux">
                          <option selected="selected">---</option>
                          <option>Motor</option>
                          <option>Manual</option>
                          <option>Otro</option>
                        </select>
                      </div>  
                      <div class="col">
                      <label for="exampleSelect1">Color (componentes)</label>
                        <select class="form-control select2" id="colorComp_neolux" name="colorComp_neolux" >
                          <option selected="selected">---</option>
                          <option>White</option>
                          <option>Ivory</option>
                          <option>Grey</option>
                          <option>Brown</option>
                          <option>Black</option>
                          <option>Otro</option>

                        </select>
                      </div>
                      <div class="col">
                      <label for="exampleSelect1">Cadena (in)</label>
                      <input type="text" class="form-control" placeholder="Medida (in)" id="cad_neolux" name="cad_neolux">
                      </div>
                    </div> <br>

                    <div class="row">   
                     <div class="col">
                      <label for="exampleSelect1">Tipo de cadena</label>
                        <select class="form-control select2" id="typeCad_neolux" name="typeCad_neolux">
                          <option selected="selected">---</option>
                          <option>Inoxidable</option>
                          <option>Plastico</option>
                          <option>Otro</option>
                        </select>
                      </div>  
                      <div class="col">
                      <label for="exampleSelect1">Tipo de pesa</label>
                        <select class="form-control select2" id="typePesa_neolux" name="typePesa_neolux" >
                          <option selected="selected">---</option>
                          <option>Cerrada</option>
                          <option>Abierta</option>
                          <option>Otro</option>
                        </select>
                      </div>
                      <div class="col">
                      <label for="exampleSelect1">Posicion del motor y sentido de enrrolle</label>
                       <select class="form-control select2" id="motor_neolux" name="motor_neolux" >
                          <option selected="selected">---</option>
                          <option>Izq</option>
                          <option>Der</option>
                          <!-- <option>Izq/R</option>
                          <option>Der/R</option> -->
                          <option>Otro</option>
                        </select>
                      </div>
                      <div class="col">
                      <label for="exampleSelect1">Cassete</label>
                      <select class="form-control select2" id="balance_neolux" name="balance_neolux">
                          <option selected="selected">---</option>
                          <option value="Cassette 100">Cassette 100</option>
                          <option value="Cassette 120">Cassette 120</option>
                          <option value="Cassette 100 Rd">Cassette 100 Rd</option>
                          <option value="Cassette 100 Flat">Cassette 100 Flat</option>
                          <option value="Cassette 120 Rd">Cassette 120 Rd</option>
                          <option value="Cassette 120 Flat">Cassette 120 Flat</option>
                          <!-- <option value="Manual">Manual</option> -->
                          <option value="Otro">Otro</option>
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
<div class="modal fade" id="modalViewNeolux" tabindex="-1" role="dialog" aria-hidden="true">
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
              <td>Identificación:</td>
              <td id="celID_sheer">654654654</td>
            </tr>
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
              <td>Color de Tela:</td>
              <td id="celtela">Larry</td>
            </tr>
            <tr>
              <td>Tipo de control:</td>
              <td id="celcontrol">Jacob</td>
            </tr>
            <tr>
              <td>Color de componentes:</td>
              <td id="celcomponentes">Jacob</td>
            </tr>
            <tr>
              <td>Tipo de pesa:</td>
              <td id="celpesa">Larry</td>
            </tr>
            <tr>
              <td>Tipo de cadena:</td>
              <td id="celcadena">Larry</td>
            </tr>
            <tr>
              <td>Cadena (in)</td>
              <td id="celmcadena">Larry</td>
            </tr>
            <tr>
              <td>Posicion del motor y sentido de enrrolle:</td>
              <td id="celmotor">Jacob</td>
            </tr>
            <tr>
              <td>Precio:</td>
              <td id="celprecio">Jacob</td>
            </tr>
            <!-- <tr>
              <td>Precio:</td>
              <td id="celnota">Jacob</td>
            </tr> -->
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