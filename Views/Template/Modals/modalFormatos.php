<!-- Modal -->
<div class="modal fade" id="modalFormFormato" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Formato</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="tile">
            <div class="tile-body">
              <form id="formFormato" name="formFormato">
                <input type="hidden" id="idFormato" name="idFormato" value="">
                <div class="form-group">
                  <label class="control-label">Nombre</label>
                  <input class="form-control" id="txtNombre" name="txtNombre" type="text" placeholder="Nombre del Formato" required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Descripción</label>
                  <textarea class="form-control" id="txtArchivo" name="txtArchivo" rows="2" placeholder="Subir" required=""></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleSelect1">Estado</label>
                    <select class="form-control" id="listStatus" name="listStatus" required="">
                      <option value="1">Vigente</option>
                      <option value="2">Sin actualizar</option>
                    </select>

                    <div class="col-md-6">
                    <div class="file">
                        <label for="foto"> Selecciona archivo .PDF</label>
                        <div class="upimg">
                        <input type="file" class="form-control" id="file" name="file">
                        </div>
                        <div id="form_alert"></div>
                    </div>
                </div>


                </div>
                <div class="tile-footer">
                  <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#" data-dismiss="modal" ><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                </div>
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalViewFormato" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Datos del Formato</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>Nombre completo:</td>
              <td id="celNombre">Persianas</td>
            </tr>
            <tr>
              <td>Archivo:</td>
              <td id="celArchivo">PDF</td>
            </tr>
            <tr>
              <td>Estado:</td>
              <td id="celEstado">Actualizado</td>
            </tr>
            <tr>
              <td>PDF</td>
              <td id="filePDF"></td>
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

