<!-- Modal -->
<div class="modal fade" id="modalFormPedido" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Rollers Shades</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="tile">
            <div class="tile-body">
            <form id="formPedidoHorizontal" name="formPedidoHorizontal">
                <!-- --------------------------------------------------DATOS GENERALES -->
                <div class="form-group">
                <h3 class="box-title">Datos generales</h3>
                </div>
                    <div class="row">  
                      <div class="col">
                      <input type="hidden" id="idPedido" name="idPedido" value="">

                      <label for="exampleSelect1">CN:</label>
                       <input type="text" class="form-control" placeholder="CN" id="cnhorizontal" name="cnhorizontal">
                      </div> 
                     <div class="col">
                      <label for="exampleSelect1">Sucursal:</label>
                      <select class="form-control select2" id="suc_horizontal" name="suc_horizontal">
                          <option selected="selected">---</option>
                          <option>Nacionales</option>
                          <option>Guaycura</option>
                          <option>Romano</option>
                          <option>CA</option>
                        </select>
                      </div>  
                      <div class="col">
                      <label for="exampleSelect1">Presupuestado por:</label>
                       <input type="text" class="form-control" id="vend_horizontal" name="vend_horizontal" placeholder="Nombre y Apellido">
                      </div>
                      <div class="col">
                      <label for="exampleSelect1">Medido por:</label>
                        <input type="text" class="form-control" id="medid_horizontal" name="medid_horizontal" placeholder="Nombre y Apellido">
                      </div>
                      <div class="col">
                      <label for="exampleSelect1">Metodo de entrega:</label>
                        <select class="form-control select2" id="entre_horizontal" name="entre_horizontal">
                          <option selected="selected">---</option>
                          <option>Sucursal</option>
                          <option>Instalacion</option>
                          <option>Paqueteria</option>
                        </select>
                      </div>
                      <div class="col">
                      <label for="exampleSelect1">Fecha:</label>
                        <input type="date" class="form-control" id="date_horizontal" name="date_horizontal">
                      </div>                      
                    </div> 
                    
                    <br>

                    <div class="row">
                        <div class="col">
                        <label for="listClient">Nombre Del Cliente: <span class="required">*</span></label>
                          <select class="form-control" data-live-search="true" id="listClient" name="listClient" required="">
                            <!-- <option value="1">Shutters</option>
                            <option value="2">Rollers</option> -->
                          </select>                     
                      </div>
                    </div>
                    </div>
                    <br>
                    
                    <div class="tile-footer">
                  <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#" data-dismiss="modal" ><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                  <!-- <button class="btn btn-primary" type="button" onclick="formWindow();"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Agregar</span></button> -->
             <!-- <button class="btn btn-primary" type="button" onclick="openModal();"><i class="fas fa-plus-circle"></i> Nuevo</button> -->
                </div>
                <br>
                 </form> 
            </div>
          </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalViewPedido" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Datos Generales</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>CN</td>
              <td id="celCN">654654654</td>
            </tr>
            <tr>
              <td>Cliente</td>
              <td id="celCLIENTE">Jacob</td>
            </tr>
            <tr>
              <td>Fecha:</td>
              <td id="celFECHA">Jacob</td>
            </tr>
            <tr>
              <td>Sucursal:</td>
              <td id="celSUCURSAL">Jacob</td>
            </tr>
            <tr>
              <td>Presupuestado por:</td>
              <td id="celPRESUP">Larry</td>
            </tr>
            <tr>
              <td>Medido por:</td>
              <td id="celMEDIDO">Larry</td>
            </tr>
            <tr>
              <td>M. Entrega:</td>
              <td id="celENTREGA">Larry</td>
            </tr> 
            <tr>
              <td>Tipo:</td>
              <td id="celTIPO">Larry</td>
            </tr>  <tr>
              <td>Motor:</td>
              <td id="celMOTOR">Larry</td>
            </tr> 
            <!-- <tr>
              <td>Estado</td>
              <td id="celSTATUS">Larry</td>
            </tr>            -->
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>