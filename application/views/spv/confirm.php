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
                        <a href="<?php echo base_url('spv/rute'); ?>" class="btn btn-default btn-sm">Kembali</a>
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
            <div class="row mb-2">
                <div class="col-md-12">
                    <?php if ($confirm['confirm'] == 1) : ?>
                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#verif">Verifikasi Data</button>
                    <?php else : ?>
                        <button type="button" class="btn btn-success btn-block">Konfirmasi Data Sukses</button>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?php echo base_url('assets/dist/img/profile/' . $confirm['image']); ?>" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center"><?php echo $confirm['nama']; ?></h3>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Tgl Register</b> <a class="float-right"><?php echo format_indo($confirm['date_created']); ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Level</b> <a class="float-right"><?php echo $confirm['level']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right"><?php echo $confirm['email']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>No HP</b> <a class="float-right"><?php echo $confirm['hp']; ?></a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <h3 class="profile-username text-center">Data Dinas</h3>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Tgl Dinas</b> <a class="float-right"><?php echo format_indo($confirm['tgl_dinas']); ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Armada</b> <a class="float-right"><?php echo $confirm['nama_kendaraan']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Tujuan</b> <a class="float-right"><?php echo $confirm['nama_tujuan']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Jarak Acuan</b> <a class="float-right"><?php echo $confirm['jarak']; ?> KM</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Keterangan</b> <a class="float-right"><?php echo $confirm['ket']; ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <h3 class="profile-username text-center">Data Perjalanan</h3>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>KM Awal</b> <a class="float-right"><?php echo rupiah($confirm['km_awal']); ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>KM Akhir</b> <a class="float-right"><?php echo rupiah($confirm['km_akhir']); ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Jarak Tempuh</b> <a class="float-right"><?php echo rupiah($confirm['km_akhir'] - $confirm['km_awal']); ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Pembelian BBM</b> <a class="float-right">Rp. <?php echo rupiah($confirm['beli_bbm']); ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Biaya Lain</b> <a class="float-right">Rp. <?php echo rupiah($confirm['beli_bbm']); ?></a>
                                </li>
                            </ul>
                            <button type="button" class="tombol-bbm btn btn-info btn-sm" data-id="<?php echo $confirm['id_route']; ?>" data-toggle="modal" data-target="#view-struk">View Struk BBM</button>
                            <button type="button" class="tombol-biaya btn btn-info btn-sm" data-id="<?php echo $confirm['id_route']; ?>" data-toggle="modal" data-target="#view-biaya">View Biaya Lain</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- Modal -->
<div class="modal fade" id="view-struk">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">View Struk BBM</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id_route" name="id_route">
                <img src="" class="img-thumbnail" alt="User Image" style="width:500px;" id="image"><br>
            </div> <!-- /.modal-content -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>

<div class="modal fade" id="view-biaya">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">View Biaya Lain</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id_route" name="id_route">
                <img src="" class="img-thumbnail" alt="User Image" style="width:500px;" id="image2"><br>

            </div>
            <!-- /.modal-content -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>


<div class="modal fade" id="verif">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Verifikasi Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('spv/verif'); ?>" method="post">
                    <div class="form-group">
                        <label>Nama Driver</label>
                        <input type="hidden" name="id_route" value="<?php echo $confirm['id_route']; ?>">
                        <input type="text" class="form-control form-control-sm" value="<?php echo $confirm['nama']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="confirm" value="0" required>
                            <label class="form-check-label">
                                Setuju
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="confirm" value="2">
                            <label class="form-check-label">
                                Tolak
                            </label>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right">Simpan Data</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
            <div class="modal-footer">
            </div>
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>



<script>
    $('.tombol-bbm').on('click', function() {
        const id_route = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('spv/get_image'); ?>',
            data: {
                id_route: id_route
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $("#image").attr('src', '<?php echo base_url() ?>assets/files/' + data.file1);
                $('#id_route').val(data.id_route);
            }
        });
    });
</script>

<script>
    $('.tombol-biaya').on('click', function() {
        const id_route = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('spv/get_image'); ?>',
            data: {
                id_route: id_route
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $("#image2").attr('src', '<?php echo base_url() ?>assets/files/' + data.file2);
                $('#id_route').val(data.id_route);
            }
        });
    });
</script>