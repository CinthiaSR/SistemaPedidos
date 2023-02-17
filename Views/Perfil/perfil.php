<?php 
    headerAdmin($data); 
    getModal('modalPedido',$data);
    // getForm('rollers',$data);
?>
    <div id="divModal"></div>
    <main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fas fa-box"></i> <?= $data['page_title'] ?>
            <!-- <php if($_SESSION['permisosMod']['w']){ ?>
                 <button class="btn btn-primary" type="button" onclick="openModal();" ><i class="fas fa-plus-circle"></i> Nuevo</button> -->
                <!-- <button class="btn btn-primary" type="button" onclick="formWindow();" ><i class="fas fa-plus-circle"></i> Nuevo</button> 

              <php } ?> -->
          </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/pedidos"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>
        <div class="modal-body">
          <div class="tile">
            <div class="tile-body">
              <form id="formPedidoRoller" name="formPedidoRoller">
                <!-- --------------------------------------------------DATOS GENERALES -->
                <div class="form-group">
                <h3 class="box-title">Datos generales</h3>
                </div>
                    <div class="row">  
                      <div class="col">
                      <input type="hidden" id="idPedido" name="idPedido" value="">

                      <label for="exampleSelect1">CN:</label>
                       <input type="text" class="form-control" placeholder="CN" id="cnroller" name="cnroller">
                      </div> 
                     <div class="col">
                      <label for="exampleSelect1">Sucursal:</label>
                      <select class="form-control select2" id="suc_roller" name="suc_roller">
                          <option selected="selected">---</option>
                          <option>Nacionales</option>
                          <option>Guaycura</option>
                          <option>Romano</option>
                          <option>CA</option>
                        </select>
                      </div>  
                      <div class="col">
                      <label for="exampleSelect1">Presupuestado por:</label>
                       <input type="text" class="form-control" id="vend_roller" name="vend_roller" placeholder="Nombre y Apellido">
                      </div>
                      <div class="col">
                      <label for="exampleSelect1">Medido por:</label>
                        <input type="text" class="form-control" id="medid_roller" name="medid_roller" placeholder="Nombre y Apellido">
                      </div>
                      <div class="col">
                      <label for="exampleSelect1">Metodo de entrega:</label>
                        <select class="form-control select2" id="entre_roller" name="entre_roller">
                          <option selected="selected">---</option>
                          <option>Sucursal</option>
                          <option>Instalacion</option>
                          <option>Paqueteria</option>
                        </select>
                      </div>
                      <div class="col">
                      <label for="exampleSelect1">Fecha:</label>
                        <input type="date" class="form-control" id="date_roller" name="date_roller">
                      </div>
                    </div> <br>
                    
                <!-- --------------------------------------------------DATOS EMPRESA -->
                <div class="form-group">
                <h3 class="box-title">Datos del Cliente</h3>
                </div>
                    <div class="row">     
                      <div class="col">
                        <label for="listClient">Nombre: <span class="required">*</span></label>
                          <select class="form-control" data-live-search="true" id="listClient" name="listClient" required="">
                            <!-- <option value="1">Shutters</option>
                            <option value="2">Rollers</option> -->
                          </select>                     
                      </div>
                    </div>
                    <div class="tile-footer">
                  <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#" data-dismiss="modal" ><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                  <!-- <button class="btn btn-primary" type="button" onclick="formWindow();"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Agregar</span></button> -->
             <!-- <button class="btn btn-primary" type="button" onclick="openModal();"><i class="fas fa-plus-circle"></i> Nuevo</button> -->
                </div>
               
                <br>
                 </form> 















            <div class="form-group">
                <h3 class="box-title">Datos de la persiana</h3>
                </div>      
                <!-- ---------------------------------------------------- -->
                <!-- ----------------------------------------------------- -->
                <div class="tile-footer">
                  <!-- <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#" data-dismiss="modal" ><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a> -->
                  <button class="btn btn-primary" type="button" onclick="formWindow();"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Agregar</span></button>
                  &nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#" data-dismiss="modal" ><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
             <!-- <button class="btn btn-primary" type="button" onclick="openModal();"><i class="fas fa-plus-circle"></i> Nuevo</button> -->
                </div>
              <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableRoller">
                      <thead>
                        <tr>
                          <th>Identificacion</th>
                          <th>Cantidad</th>
                          <th>Instalacion</th>
                          <th>Ancho(in)</th>
                          <th>Alto(in)</th>
                          <th>Color de tela</th>
                          <th>Precio</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>  
              
              
            

                <div class="tile-footer">
                  <!-- <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#" data-dismiss="modal" ><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a> -->
                  <!-- <button id="btnActionFormPedido" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button> -->
                  &nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#" data-dismiss="modal" ><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
             <button class="btn btn-primary" type="button" onclick="openModal();" ><i class="fas fa-plus-circle"></i> Nuevo</button>

                </div>
            </div>
          </div>
      </div>
    </main>
<?php footerAdmin($data); ?>
    