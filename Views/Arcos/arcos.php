<?php 
    headerAdmin($data); 
    getModal('ModalPedArcos',$data);
    // getForm('rollers',$data);
?>
    <div id="divModal"></div>
    <main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fas fa-box"></i> <?= $data['page_title'] ?>
            <?php if($_SESSION['permisosMod']['w']){ ?>
                <button class="btn btn-primary" type="button" onclick="openModal();" ><i class="fas fa-plus-circle"></i> Nuevo</button>
              <?php } ?>
          </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <!-- <li class="breadcrumb-item"><a href="<= base_url(); ?>/pedidos"><= $data['page_title'] ?></a></li> -->
        </ul>
      </div>
        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tablePedidosArcos">
                      <thead>
                        <tr>
                          <!-- <th>ID</th> -->
                          <th>CN</th>
                          <th>Cliente</th>
                          <th>Fecha</th>
                          <th>Sucursal</th>
                          <!-- <th>Precio x ft2</th> -->
                          <!-- <th>Estado</th> -->
                          <th>Acciones</th>                          
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </main>
<?php footerAdmin($data); ?>
    