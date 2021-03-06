<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="<?php echo base_url('assets/'); ?>dist/img/mitg.jpg" alt="MITG Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold ml-2">CRM Selling Point</span>
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
                    <a href="<?php echo base_url('gerai/index'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p class="text">Beranda</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('gerai/man_user'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p class="text">Management Pelanggan</p>
                    </a>
                </li>
                <!-- <li class="nav-header">gerai</li> -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-clone"></i>
                        <p>
                            Data Logistik
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url('gerai/mst_bank'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Bank</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('gerai/mst_toko'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Toko</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('gerai/mst_kendaraan'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Kendaraan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('gerai/mst_tarif'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Tarif</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('gerai/mst_biaya'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Biaya Ops</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>
                            Transaksi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url('gerai/terima_order'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Penerimaan Order</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('gerai/nota_order'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Nota Order</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('gerai/pengiriman'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pengiriman Order</p>
                            </a>
                        </li>
                    </ul>
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