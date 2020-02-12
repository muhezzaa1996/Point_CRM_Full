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
            <div class="card card-primary card-outline">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add-user">
                            Tambah Tarif
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-hover" id="table-id" style="font-size:14px;">
                                <thead>
                                    <th>#</th>
                                    <th>Kota Asal</th>
                                    <th>Kota Tujuan</th>
                                    <th>Tarif Volume</th>
                                    <th>Tarif Berat</th>
                                    <th>Edit</th>
                                    <th>Hapus</th>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($tarif as $lu) : ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $lu['kota_asal']; ?></td>
                                            <td><?php echo $lu['kota_tujuan']; ?></td>
                                            <td>Rp. <?php echo rupiah($lu['tarif_volume']); ?>/M<sup>3</sup></td>
                                            <td>Rp. <?php echo rupiah($lu['tarif_jarak']); ?>/Kg</td>
                                            <td><button class="tombol-edit btn btn-info btn-block btn-sm" data-id="<?php echo $lu['id_tarif']; ?>" data-toggle="modal" data-target="#edit-user">Edit</button></td>
                                            <td><a href="<?php echo base_url('admin/del_tarif/') . $lu['id_tarif']; ?>" class="tombol-hapus btn btn-danger btn-block btn-sm">Hapus</a> </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- Modal -->
<div class="modal fade" id="add-user">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Tarif</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('admin/mst_tarif'); ?>" method="post">
                        <div class="form-group">
                            <label>Kota Asal</label>
                            <input type="text" class="form-control form-control-sm" name="kota_asal" required>
                        </div>
                        <div class="form-group">
                            <label>Kota Tujuan</label>
                            <input type="text" class="form-control form-control-sm" name="kota_tujuan" required>
                        </div>
                        <div class="form-group">
                            <label>Tarif Volume (../M<sup>3</sup>)</label>
                            <input type="number" class="form-control form-control-sm" name="tarif_volume" required>
                        </div>
                        <div class="form-group">
                            <label>Tarif Berat (../Kg)</label>
                            <input type="number" class="form-control form-control-sm" name="tarif_jarak" required>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right">Simpan Data</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>

<div class="modal fade" id="edit-user">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Tarif</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('admin/edit_tarif'); ?>" method="post">
                        <div class="form-group">
                            <label>Kota Asal</label>
                            <input type="hidden" name="id_tarif" id="id_tarif">
                            <input type="text" class="form-control form-control-sm" name="kota_asal" id="kota_asal" required>
                        </div>
                        <div class="form-group">
                            <label>Kota Tujuan</label>
                            <input type="text" class="form-control form-control-sm" name="kota_tujuan" id="kota_tujuan" required>
                        </div>
                        <div class="form-group">
                            <label>Tarif Volume (../M<sup>3</sup>)</label>
                            <input type="number" class="form-control form-control-sm" name="tarif_volume" id="tarif_volume" required>
                        </div>
                        <div class="form-group">
                            <label>Tarif Berat (../Kg)</label>
                            <input type="number" class="form-control form-control-sm" name="tarif_jarak" id="tarif_jarak" required>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right">Simpan Data</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>

<script>
    $('.tombol-edit').on('click', function() {
        const id_tarif = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('admin/get_tarif'); ?>',
            data: {
                id_tarif: id_tarif
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#kota_asal').val(data.kota_asal);
                $('#kota_tujuan').val(data.kota_tujuan);
                $('#tarif_volume').val(data.tarif_volume);
                $('#tarif_jarak').val(data.tarif_jarak);
                $('#id_tarif').val(data.id_tarif);
            }
        });
    });
</script>