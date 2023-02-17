<!-- MODAL PERSIANA -->

<div class="modal fade" id="modalFormMotor" tabindex="-1" role="dialog" aria-hidden="true">
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
              <form id="formMotor" name="formMotor">
                <!-- --------------------------------------------------DATOS GENERALES -->
                    <div class="row">  
                      <div class="col">
                      <input type="hidden" id="idRoller" name="idRoller">

                    <?php
                      if(empty($data['arrPedido'])){
                    ?>
                    <p>Datos no encontrados</p>
                    <?php }else{
                        $orden = $data['arrPedido']['orden'];
                    ?>
                      <input type="hidden" id="idPedidoR" name="idPedidoR" value="<?= $orden['idpedido'] ?>">

                    <?php
                    } ?>
                      <label for="exampleSelect1">Cantidad:</label>
                       <input type="text" class="form-control" placeholder="Cantidad" id="can_roller" name="can_roller" onkeyup="calculate();">
                      </div> 
                      <div class="col">
                      <label for="exampleSelect1">Localizacion:</label>
                       <input type="text" class="form-control" placeholder="Localizacion" id="loc_roller" name="loc_roller">
                      </div>
                      <div class="col">
                      <label for="exampleSelect1">Instalacion:</label>
                        <select class="form-control select2" id="inst_roller" name="inst_roller">
                          <option selected="selected">---</option>
                          <option>IB</option>
                          <option>OB</option>
                          <option>Exacta</option>
                          <option>Otro</option>
                        </select>
                      </div>
                      <div class="col">
                      <label for="exampleSelect1">Medidas (in):</label>
                        <input type="text" class="form-control monto" placeholder="Ancho" id="anc_roller" name="anc_roller" onkeyup="calculate();">
                        <input type="text" class="form-control" placeholder="Alto" id="alt_roller" name="alt_roller">
                      </div>
                    </div> <br>

                    <div class="row">  
                      <div class="col">
                      <label for="exampleSelect1">Nombre de la Tela</label>
                       <input type="text" class="form-control" placeholder="Tipo y Color (Tela)" id="colTela_roller" name="colTela_roller" >
                      </div> 
                      <div class="col">
                      <label for="exampleSelect1">Color Comp.</label>
                        <select class="form-control select2" id="colorComp_roller" name="colorComp_roller" >
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
                        <select class="form-control select2" id="Pesa_roller" name="Pesa_roller" >
                          <option selected="selected">---</option>
                          <option>Clasica</option>
                          <option>Redonda</option>
                          <option>Sellada</option>
                          <option>Otro</option>
                        </select>
                      </div>
                      <div class="col">
                      <label for="exampleSelect1">Posicion del motor y sentido de enrrolle</label>
                       <select class="form-control select2" id="motor_roller" name="motor_roller" >
                          <option selected="selected">---</option>
                          <option>Izq/N</option>
                          <option>Der/N</option>
                          <option>Izq/R</option>
                          <option>Der/R</option>
                          <option>Otro</option>
                        </select>
                      </div>
                    </div>
                    <div class="row"> 
                      <div class="col">
                      <label for="exampleSelect1">Balance</label>
                      <select class="form-control select2" id="balance_roller" name="balance_roller" onchange="calculate();">
                          <option selected="selected">---</option>
                          <option value="Cassette 100">Cassette 100</option>
                          <option value="Cassette 120">Cassette 120</option>
                          <option value="Fascia 3">Fascia 3"</option>
                          <option value="Fascia 4">Fascia 4"</option>
                          <option value="Custom">Custom</option>
                          <option value="Otro">Otro</option>
                        </select>
                      </div> 

                      <!-- ------------------------------------------------------------------------ -->
                      <!-- <div class="col">
                      <label for="exampleSelect1">Marca</label>
                      <select class="form-control" data-live-search="true" id="marca" name="marca" onchange="ftnMotor();">
                            <option>---</option>
                            <option value="1">Somfy Motores</option>
                            <option value="2">Somfy Control</option>
                            <option value="3">Somfy Cargador</option>
                            <option value="4">Somfy Interface</option>

                            <option value="5">Vertilux Motores</option>
                            <option value="6">Vertilux Control</option>
                            <option value="7">Vertilux Cargador</option>
                            <option value="8">Vertilux Interface</option>

                            <option value="9">Tube Motores</option>
                            <option value="10">Tube Control</option>
                            <option value="11">Tube Cargador</option>
                            <option value="12">Tube Interface</option>     
                    
                          </select> 
                      </div> -->
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
                    <!-- <label for="exampleSelect1">Tipo de elemento:</label>
                       <select class="form-control" data-live-search="true"  id="tipo" name="tipo">                          
                        </select> -->
                      <label for="exampleSelect1">Tipo de elemento:</label>
                      <select class="form-control select2 montos" id="tipo" name="tipo">
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
                      <!-- <div class="col">
                      <label for="exampleSelect1">Nombre del motor</label>
                       <select class="form-control select2" id="nombre_motor" name="nombre_motor">
                          <option value="0">---</option>
                       </select>
                    </div> -->
                    <div class="col">
                      <label for="exampleSelect1">Precio de lista</label>
                      <input type="text" class="form-control monto" placeholder="Precio" id="precioLista" name="precioLista" onchange="calculate();">
                      </div>  
                    </div>    
                                
                    <!-- ---------------------------------------------------------------Dinamismo -->
                    <br>

                    <div class="row">
                    <!-- <div class="col">
                      <label for="exampleSelect1">Precio de lista</label>
                      <input type="text" class="form-control monto" placeholder="Precio" id="precioLista" name="precioLista" onchange="calculate();">
                      </div>    -->
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

<script>
  // $(document).ready(function(e){
	//  	$("#marca").change(function(){
	//  		var parametros= "id="+$("#marca").val();
	//  		$.ajax({
  //               data:  parametros,
  //               url:   base_url+'/Motores/gettipo',
  //               type:  'post',
  //               beforeSend: function () { },
  //               success:  function (response) {                	
  //                   $("#tipo").html(response);
  //               },
  //               error:function(){
  //               	alert("error")
  //               }
  //           });
	//  	})      
  // })
</script>

