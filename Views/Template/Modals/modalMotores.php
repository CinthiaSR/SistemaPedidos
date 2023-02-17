<!-- Modal -->
<div class="modal fade" id="modalFormMotores" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="formMotores" name="formMotores">
              <input type="hidden" id="idMotor" name="idMotor" value="">
              <div class="form-row">
               <div class="form-group col-md-4">
                  <label for="txtCodigo">Código </label>
                  <input type="text" class="form-control" id="txtCodigo" name="txtCodigo" >
                </div>
                <div class="form-group col-md-4">
                  <label>Marca </label>
                  <select class="form-control" name="marca" id="marca">
                     <!-- <option selected="selected">---</option>
                      <option>Somfy Motores</option>
                      <option>Somfy Control</option>
                      <option>Somfy Cargador</option>
                      <option>Somfy Interface</option>

                      <option>Vertilux Motores</option>
                      <option>Vertilux Control</option>
                      <option>Vertilux Cargador</option>
                      <option>Vertilux Interface</option>

                      <option>Tube Motores</option>
                      <option>Tube Control</option>
                      <option>Tube Cargador</option>
                      <option>Tube Interface</option> -->
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="txtNombre">Nombre </label>
                  <input type="text" class="form-control" id="txtNombre" name="txtNombre" >
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label>Precio</label>
                  <input type="text" class="form-control" id="txtPrecio" name="txtPrecio" >
                </div>
                <div class="form-group col-md-6">
                    <label for="listStatus">Status</label>
                    <select class="form-control selectpicker" id="listStatus" name="listStatus">
                        <option value="1">Activo</option>
                        <option value="2">Inactivo</option>
                    </select>
                </div>
             </div>
              <div class="tile-footer">
                <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
              </div>
            </form>
      </div>
    </div>
  </div>
</div>


