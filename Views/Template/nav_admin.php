    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?= media();?>/images/avatar.png" alt="User Image">
        <div>
          <p class="app-sidebar__user-name"><?= $_SESSION['userData']['nombres']; ?></p>
          <p class="app-sidebar__user-designation"><?= $_SESSION['userData']['nombrerol']; ?></p>
        </div>
      </div>
      <ul class="app-menu">
        <?php if(!empty($_SESSION['permisos'][1]['r'])){ ?>
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/dashboard">
                <i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">Dashboard</span>
            </a>
        </li>
        <?php } ?>
        <?php if(!empty($_SESSION['permisos'][2]['r'])){ ?>
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-users" aria-hidden="true"></i>
                <span class="app-menu__label">Usuarios</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="<?= base_url(); ?>/usuarios"><i class="icon fa fa-circle-o"></i> Usuarios</a></li>
                <li><a class="treeview-item" href="<?= base_url(); ?>/roles"><i class="icon fa fa-circle-o"></i> Roles</a></li>
            </ul>
        </li>
        <?php } ?>
        <?php if(!empty($_SESSION['permisos'][3]['r'])){ ?>
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/clientes">
                <i class="app-menu__icon fa fa-user" aria-hidden="true"></i>
                <span class="app-menu__label">Clientes</span>
            </a>
        </li>
        <?php } ?>
      
        <!-- <php if(!empty($_SESSION['permisos'][5]['r'])){ ?> -->
        <li class="treeview">
            <!-- <a class="app-menu__item" href="<= base_url(); ?>/pedidos"> -->
            <a class="app-menu__item" href="#" data-toggle="treeview">
               <i class="app-menu__icon fa fa-shopping-cart" aria-hidden="true"></i>
                <span class="app-menu__label"> Pedidos de Persianas</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <?php if(!empty($_SESSION['permisos'][4]['r'])){   ?>
                <li><a class="treeview-item" href="<?= base_url(); ?>/arcos"><i class="icon fa fa-circle-o"></i> Arcos</a></li>
                <li><a class="treeview-item" href="<?= base_url(); ?>/balance"><i class="icon fa fa-circle-o"></i> Balances de madera</a></li>
                <li><a class="treeview-item" href="<?= base_url(); ?>/horizontales"><i class="icon fa fa-circle-o"></i> Horizontales </a></li>

                <li><a class="treeview-item" href="<?= base_url(); ?>/neolux"><i class="icon fa fa-circle-o"></i> Neolux Manuales</a></li>
                <li><a class="treeview-item" href="<?= base_url(); ?>/elegance"><i class="icon fa fa-circle-o"></i> Neolux Motorizadas</a></li>
                <li><a class="treeview-item" href="<?= base_url(); ?>/rollers"><i class="icon fa fa-circle-o"></i> Roller Shades Manuales</a></li>
                <li><a class="treeview-item" href="<?= base_url(); ?>/motorizacion"><i class="icon fa fa-circle-o"></i> Roller Shades Motorizadas</a></li>
                <li><a class="treeview-item" href="<?= base_url(); ?>/romana"><i class="icon fa fa-circle-o"></i> Romana</a></li>
                <li><a class="treeview-item" href="<?= base_url(); ?>/shutters"><i class="icon fa fa-circle-o"></i> Shutters</a></li>
                <?php } if(!empty($_SESSION['permisos'][5]['r'])){   ?>
                
                    <li><a class="treeview-item" href="<?= base_url(); ?>/rollers"><i class="icon fa fa-circle-o"></i> Roller Shades Manuales</a></li>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/motorizacion"><i class="icon fa fa-circle-o"></i> Roller Shades Motorizadas</a></li>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/romana"><i class="icon fa fa-circle-o"></i> Romana</a></li>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/shutters"><i class="icon fa fa-circle-o"></i> Shutters</a></li>
                <?php } ?>
            </ul>
        </li>
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/logout">
                <i class="app-menu__icon fa fa-sign-out" aria-hidden="true"></i>
                <span class="app-menu__label">Logout</span>
            </a>
        </li>
      </ul>
    </aside>