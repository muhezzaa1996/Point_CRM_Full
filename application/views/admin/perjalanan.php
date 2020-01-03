<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                    <?php echo $this->session->flashdata('msg'); ?>
                    <?php if (validation_errors()) { ?>
                        <div class="alert alert-danger">
                            <strong><?php echo strip_tags(validation_errors()); ?></strong>
                            <a href="" class="float-right text-decoration-none" data-dismiss="alert"><i class="fas fa-times"></i></a>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card">
                            <div class="card-header p-2">

                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover" id="table-id" style="font-size:14px;">
                                                <thead>
                                                    <th>#</th>
                                                    <th>Driver</th>
                                                    <th>Tgl Dinas</th>
                                                    <th>Armada</th>
                                                    <th>Tujuan</th>
                                                    <th>Biaya Dinas</th>
                                                    <th>Km Awal</th>
                                                    <th>Km Akhir</th>
                                                    <th>BBM</th>
                                                    <th>Detail</th>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    <?php foreach ($rute as $lu) : ?>
                                                        <tr>
                                                            <td><?php echo $i++; ?></td>
                                                            <td><?php echo $lu['nama']; ?></td>
                                                            <td><?php echo format_indo($lu['tgl_dinas']); ?></td>
                                                            <td><?php echo $lu['nama_kendaraan']; ?></td>
                                                            <td><?php echo $lu['nama_tujuan']; ?></td>
                                                            <td>Rp. <?php echo rupiah($lu['biaya_dinas']); ?></td>
                                                            <td><?php echo rupiah($lu['km_awal']); ?></td>
                                                            <td><?php echo rupiah($lu['km_akhir']); ?></td>
                                                            <td>Rp. <?php echo rupiah($lu['beli_bbm']); ?></td>
                                                            <?php if ($lu['confirm'] == 1) : ?>
                                                                <td><button class="btn btn-info btn-block btn-sm">MENUNGGU</button></td>
                                                            <?php else : ?>
                                                                <td><button class="btn btn-success btn-block btn-sm">SUKSES</button></td>
                                                                </td>
                                                            <?php endif; ?>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->