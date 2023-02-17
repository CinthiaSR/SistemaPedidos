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
                      <label for="exampleSelect1">Nombre de la Tela</label>
                       <input type="text" class="form-control" placeholder="Tipo y Color (Tela)" id="colTela_neolux" name="colTela_neolux" >
                      </div> 
                      <div class="col">
                      <label for="exampleSelect1">Color Comp.</label>
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
                      <label for="exampleSelect1">Tipo de pesa</label>
                        <select class="form-control select2" id="Pesa_neolux" name="Pesa_neolux" >
                          <option selected="selected">---</option>
                          <option>Clasica</option>
                          <option>Redonda</option>
                          <option>Sellada</option>
                          <option>Otro</option>
                        </select>
                      </div>
                      <div class="col">
                      <label for="exampleSelect1">Posicion del motor y sentido de enrrolle</label>
                       <select class="form-control select2" id="motor_neolux" name="motor_neolux" >
                          <option selected="selected">---</option>
                          <option>Izq/N</option>
                          <option>Der/N</option>
                          <option>Izq/R</option>
                          <option>Der/R</option>
                          <option>Otro</option>
                        </select>
                      </div>
                    </div> <br>

                    <div class="row"> 
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
                      <div class="col">
                      <label for="exampleSelect1">Marca del motor</label>
                      <select class="form-control select2" id="marca" name="marca" onchange="h();">
                          <option data-hab="">---</option>
                          <option data-hab="hS1 hS2 hS3 hS4">Motores Somfy</option>
                          <option data-hab="hV1 hV2 hV3 hV4 hV5">Motores Vertilux</option>
                          <option data-hab="hT1 hT2 hT3">Motores Tube</option>
                          <option data-hab="hSC1 hSC2 hSC3">Controles Somfy</option>
                          <option data-hab="hVC1 hVC2 hVC3">Controles Vertilux</option>
                          <option data-hab="hTC1 hTC2 hTC3">Controles Tube</option>
                          <option data-hab="hSCA1">Cargadores Somfy</option>
                          <option data-hab="hVCA1 hVCA2">Cargadores Vertilux</option>
                          <option data-hab="hTCA1">Cargadores Tube</option>
                          <option data-hab="hSI1">Interface Somfy</option>
                          <option data-hab="hVI1">Interface Vertilux</option>
                          <option data-hab="hTI1">Interface Tube</option>
                          <option data-hab="hSEX1">Ext Somfy</option>
                          <option data-hab="hVEX1">Ext Vertilux</option>
                        </select>
                      </div>

                      <div class="col">
                      <label for="exampleSelect1">Tipo de elemento:</label>
                      <select class="form-control select2" id="tipo" name="tipo">
                          <option>---</option>
                          <option class="hALL hS1">Baterias Altus 28</option>
                          <option class="hALL hS2">Baterias Sonesse 30</option>
                          <option class="hALL hS3">Electrico LSN 406</option>
                          <option class="hALL hS4">Electrico LSN 510</option>
                          <option class="hALL hSC1">1 Canal</option>
                          <option class="hALL hSC2">5 Canales</option>
                          <option class="hALL hSC3">16 Canales</option>
                          <option class="hALL hSCA1">Cargador</option>
                          <option class="hALL hSEX1">Extension</option>

                          <option class="hALL hSI1">InteO</option>

                          <option class="hALL hV1">Baterias Celtic 1.2 Nw</option>
                          <option class="hALL hV2">Baterias Celtic 6 Nw</option>
                          <option class="hALL hV3">Electrico Celtic 6 Nw</option>
                          <option class="hALL hV4">Electrico Celtic 10 Nw</option>
                          <option class="hALL hV5">Electrico Celtic 20 Nw</option>                          
                          <option class="hALL hVC1">1 Canal</option>
                          <option class="hALL hVC2">6 Canales</option>
                          <option class="hALL hVC3">16 Canales</option>                          
                          <option class="hALL hVCA1">Cargador 1.2 Nw</option>
                          <option class="hALL hVCA2">Cargador 6 Nw</option>
                          <option class="hALL hVEX1">Extension</option>

                          <option class="hALL hVI1">VTI Smart HUB</option>

                          <option class="hALL hT1">Baterias Tube 1.1 Nw</option>
                          <option class="hALL hT2">Baterias Tube 406 Nw</option>
                          <option class="hALL hT3">Electrico Tube 510</option>
                          <option class="hALL hTC1">1 Canal</option>
                          <option class="hALL hTC2">5 Canales</option>
                          <option class="hALL hTC3">15 Canales</option>
                          <option class="hALL hTCA1">Cargador</option>

                          <option class="hALL hTI1">BOX RTL</option>
                          
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