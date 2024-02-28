<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center mt-2 mb-2" href="<?php echo base_url(); ?>admin">
        <div class="sidebar-brand-icon">
            <!-- <i class="fas fa-basketball-ball"></i> -->
            <img src="<?php echo base_url(); ?>assets/front/img/logo.png" style="width:60px;">
        </div>
        <div class="sidebar-brand-text mx-1">ARENA</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <?php
    $orders = '';
    $harga_diskon_event = '';
    $nav_show = '';

    switch ($page_name) {
        case 'orders':
        case 'order_add':
        case 'order_edit':
        case 'order_event':
            $orders = 'active';
            break;
        case 'manage':
        case 'harga':
        case 'diskon':
        case 'harga_event':
            $harga_diskon_event = 'active';
            $nav_show = 'show';
            break;
    }
    ?>

    <!-- Nav Item -->
    <li class="nav-item <?php if ($page_name == 'dashboard') echo 'active'; ?>">
        <a class="nav-link" href="<?php echo base_url(); ?>admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <?php if ($this->session->userdata('admin_role') == 1 || $this->session->userdata('admin_role') == 2) { ?>
        <li class="nav-item <?php echo $orders; ?>">
            <a class="nav-link" href="<?php echo base_url(); ?>back/orders">
                <i class="fas fa-dollar-sign"></i>
                <span>Orders</span></a>
        </li>

    <?php } ?>

    <?php if ($this->session->userdata('admin_role') == 1) { ?>
        <li class="nav-item <?php if ($page_name == 'users') echo 'active'; ?>">
            <a class="nav-link" href="<?php echo base_url(); ?>back/users">
                <i class="fas fa-users"></i>
                <span>Manage Users</span></a>
        </li>

        <li class="nav-item <?php if ($page_name == 'admin') echo 'active'; ?>">
            <a class="nav-link" href="<?php echo base_url(); ?>back/admin/list">
                <i class="fas fa-fw fa-users-cog"></i>
                <span>Manage Admin</span></a>
        </li>

        <li class="nav-item <?php echo $harga_diskon_event; ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#manageHargaDiskon" aria-expanded="true" aria-controls="manageHargaDiskon">
                <i class="fas fa-fw fa-folder"></i>
                <span>Manage Harga / Diskon</span>
            </a>
            <div id="manageHargaDiskon" class="collapse <?php echo $nav_show; ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item <?php if ($page_name == 'harga') echo 'active'; ?>" href="<?php echo base_url(); ?>back/harga">Harga</a>
                    <a class="collapse-item <?php if ($page_name == 'diskon') echo 'active'; ?>" href="<?php echo base_url(); ?>back/diskon">Diskon</a>
                    <a class="collapse-item <?php if ($page_name == 'harga_event') echo 'active'; ?>" href="<?php echo base_url(); ?>back/harga/event">Harga Event</a>
                </div>
            </div>
        </li>
    <?php } ?>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>