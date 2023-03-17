<!-- MODAL PERSIANA -->

<div class="modal fade" id="modalFormShutters" tabindex="-1" role="dialog" aria-hidden="true">
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
              <form id="formShutters" name="formShutters">
                <!-- --------------------------------------------------DATOS GENERALES -->
                <label for="exampleSelect1">De acuerdo a la lista de precios por pais, el precio final cambiara de acuerdo al lugar que selecciones</label> 
                <div class="row">
                  <div class="col">
                      <label for="exampleSelect1">Pais: </label>
                        <select class="form-control select2" id="Inst_Pais" name="Inst_Pais" onchange="calculate();">
                          <option selected="selected">---</option>
                          <option value="USA Instalada">USA Instalada</option>
                          <option value="USA No instalada">USA No instalada</option>
                          <option value="MX Instalada">MX Instalada </option>
                          <option value="MX No instalada">MX No instalada</option>
                          <!-- <option value="Igualacion">Igualacion</option>                           -->
                        </select>
                      </div> 
                      <?php
                       if(empty($data['arrPedido'])){
                      ?>
                          <p>Datos no encontrados</p>
                      <?php
                      }else{
                          $orden = $data['arrPedido']['orden'];
                      ?>
                      <div class="col">
                      <input type="hidden" id="idPedidoS" name="idPedidoS" value="<?= $orden['idpedido'] ?>">
                      <label for="exampleSelect1">Precio Base:</label>
                      <input type="text" class="form-control" id="idprecio" name="idprecio" value="<?= $orden['precioft2'] ?>" readonly>
                      </div>
                      <div class="col">
                      <label for="exampleSelect1">Precio con complementos:</label>
                      <input type="text" class="form-control" id="precioComp" name="precioComp" readonly  >
                      </div>
                      <?php
                    } ?>  
                    </div> <br>


                    <div class="row"> 
                    <div class="col">
                      <label for="exampleSelect1">Cantidad:</label>
                       <input type="text" class="form-control" placeholder="Unidades" id="unidades_shutters" name="unidades_shutters" onkeyup="calculate();">
                      </div> 
                      <div class="col">
                      <input type="hidden" id="idShutter" name="idShutter">
                      <input type="hidden" id="foto_actual" name="foto_actual" value="">
                      <input type="hidden" id="foto_remove" name="foto_remove" value="0">
                                        
                      <label for="exampleSelect1">Identificacion:</label>
                       <input type="text" class="form-control" placeholder="Identificacion" id="Iden_shutters" name="Iden_shutters">
                      </div>  
                      <div class="col">
                      <label for="exampleSelect1">Medidas (in):</label>
                        <input type="text" class=" form-control monto" placeholder="Ancho" id="anc_shutters" name="anc_shutters" onkeyup="calculate();" >
                        <input type="text" class="form-control" placeholder="Alto" id="alt_shutters" name="alt_shutters" onkeyup="calculate();" >
                      </div>
                      <div class="col">
                       <label for="exampleSelect1">Tipo de instalacion:</label>
                        <select class="form-control select2" id="Med_shutters" name="Med_shutters" onchange="calculate();">
                          <option selected="selected">---</option>
                          <option value="PDCD/Z-Std">PDCD/Z-Std </option>
                          <option value="PDSD-F2F/Z-Std">PDSD-F2F/Z-Std</option>

                          <option value="PDCD/Z-Rd">PDCD/Z-Rd </option>
                          <option value="PDSD-F2F/Z-Rd">PDSD-F2F/Z-Rd</option>

                          <option value="PDCD/Z-Dlx">PDCD/Z-Dlx </option>
                          <option value="PDSD-F2F/Z-Dlx">PDSD-F2F/Z-Dlx</option>

                          <option value="PDCD/Z-Dm">PDCD/Z-Dm </option>
                          <option value="PDSD-F2F/Z-Dm">PDSD-F2F/Z-Dm</option>

                          <option value="PFCA/L-Std">PFCA/L-Std</option>
                          <option value="PFF2F/L-Std">PFF2F/L-Std</option>

                          <option value="PFCA/Eleg">PFCA/Eleg</option>
                          <option value="PFF2F/Eleg">PFF2F/Eleg</option>
                        </select>
                      </div> 
                      
                    </div> <br>

                    <div class="row">  
                    <div class="col">
                      <label for="exampleSelect1">Profundidad (in):</label>
                       <input type="text" class="form-control" placeholder="Profundidad" id="prof_shutters" name="prof_shutters">
                      </div>
                      <div class="col">
                      <label for="exampleSelect1">Color</label>
                        <select class="form-control select2" id="color_shutters" name="color_shutters" onchange="calculate();">
                          <option selected="selected">---</option>
                          <option value="Picolo">Picolo</option>
                          <option value="Bolero">Bolero</option>
                          <option value="Clarinete">Clarinete</option>
                          <option value="Natural">Natural</option>
                          <option value="Sugar Maple">Sugar Maple</option>
                          <option value="Nogal Clasico">Nogal Clasico</option>
                          <option value="Roble">Roble</option>
                          <option value="Cappuccino">Cappuccino</option>
                          <option value="Chocolate">Chocolate</option>
                          <option value="Dark Mahogany">Dark Mahogany</option>
                          <option value="Coffee">Coffee</option>
                          <option value="Igualacion">Igualacion</option>
                        </select>
                      </div> 
                     <div class="col">
                      <label for="exampleSelect1">Medida del Louver</label>
                        <select class="form-control select2" id="Louver_shutters" name="Louver_shutters">
                          <option selected="selected">---</option>
                          <option>2 1/2 "</option>
                          <option>3 1/2 "</option>
                          <option>4 1/2 "</option>
                          <!-- <option>2 1/2 "</option> -->
                        </select>
                      </div>  
                      <div class="col">
                      <label for="exampleSelect1">Baston</label>
                        <select class="form-control select2" id="baston_shutters" name="baston_shutters" onchange="calculate();">
                          <option selected="selected">---</option>
                          <option value="Visible">Visible</option>
                          <option value="Oculto">Oculto</option>
                          <option value="Visible (Split/ dividido)">Visible (Split/ dividido)</option>
                          <option value="Oculto (Split/ dividido)">Oculto (Split/ dividido)</option>
                        </select>
                      </div>
                    </div> <br>

                    <div class="row">   
                     <div class="col">
                      <label for="exampleSelect1">Configuracion</label>
                        <select class="form-control select2" id="typeConfig" name="typeConfig">
                          <option selected="selected">---</option>
                          <option>1-A</option>
                          <option>1-B</option>
                          <option>2-A</option>
                          <option>2-B & 2-C</option>
                          <option>3-E</option>
                          <option>4-A</option>
                          <option>4-B</option>
                          <option>4-C</option>
                        </select>
                      </div>  
                      <div class="col">
                        <div class="col-md-6">
                          <div class="photo">
                              <label for="foto">Diagrama Conf.</label>
                              <div class="prevPhoto">
                                <span class="delPhoto notBlock">X</span>
                                <label for="foto"></label>
                                <div>
                                  <img id="img" src="<?= media(); ?>/images/uploads/portada_categoria.png" width="100px">
                                </div>
                              </div>
                              <div class="upimg">
                                <input type="file" name="foto" id="foto">
                              </div>
                              <div id="form_alert"></div>
                          </div>
                      </div>
                      </div>
                      <div class="col">
                        <label for="exampleSelect1">Posición Poste #1</label>
                        <input type="text" class="form-control" placeholder="Poste#1" id="poste1" name="poste1">
                      </div>
                      <div class="col">
                        <label for="exampleSelect1">Posición Poste #2</label>
                        <input type="text" class="form-control" placeholder="Poste#2" id="poste2" name="poste2">
                      </div>
                    </div>
                    <div class="row">
                    <div class="col">
                        <label for="exampleSelect1">Total ft2</label>
                        <input type="text" class="form-control" placeholder="Total ft2" id="Tft2" name="Tft2" readonly>
                      </div>
                    <div class="col">
                        <label for="exampleSelect1">Ubicación del riel divisor</label>
                        <input type="text" class="form-control" placeholder="Riel divisor" id="rielD" name="rielD">
                      </div>
                      <div class="col">
                            <label for="exampleSelect1">Precio</label>
                        <input type="text" class="form-control" placeholder="Precio" id="precio_shutters" name="precio_shutters" readonly>
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
                 <div class="form-group col-md-12">
                     <div id="containerGallery">
                         <span>Agregar foto de referencia</span>
                         <button class="btnAddImage btn btn-info btn-sm" type="button">
                             <i class="fas fa-plus"></i>
                         </button>
                     </div>
                     <hr>
                     <div id="containerImages">
                         <!-- <div id="div24">
                             <div class="prevImage">
                                 <img src="<= media(); ?>/images/uploads/producto1.jpg">
                             </div>
                             <input type="file" name="foto" id="img1" class="inputUploadfile">
                             <label for="img1" class="btnUploadfile"><i class="fas fa-upload "></i></label>
                             <button class="btnDeleteImage" type="button" onclick="fntDelItem('div24')"><i class="fas fa-trash-alt"></i></button>
                         </div>
                         <div id="div24">
                             <div class="prevImage">
                                 <img class="loading" src="<= media(); ?>/images/loading.svg">
                             </div>
                             <input type="file" name="foto" id="img1" class="inputUploadfile">
                             <label for="img1" class="btnUploadfile"><i class="fas fa-upload "></i></label>
                             <button class="btnDeleteImage" type="button" onclick="fntDelItem('div24')"><i class="fas fa-trash-alt"></i></button>
                         </div> -->
                        
                     </div>
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