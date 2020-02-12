<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="<?php echo base_url('assets/'); ?>dist/img/adonia.png" alt="ADONIA Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold ml-2">LOGISTIK</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo base_url('assets/dist/img/profile/' . $user['image']); ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $user['nama']; ?></a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?php echo base_url('user/index'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p class="text">Beranda</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('user/mst_bank'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-coins"></i>
                        <p class="text">Data Bank</p>
                    </a>
                </li>
                <!-- <li class="nav-header">user</li> -->
                <li class="nav-item">
                    <a href="<?php echo base_url('user/mst_tarif'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-money-bill-wave"></i>
                        <p class="text">Data Tarif</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('user/mst_toko'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-store-alt"></i>
                        <p class="text">Data Toko</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo base_url('auth/logout'); ?>" id="tombol-logout" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                        <p class="text">Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>