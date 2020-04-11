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
                            Tambah Tujuan
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-hover" id="table-data" style="font-size:14px;">
                                <thead>
                                    <th>#</th>
                                    <th>Nama Tujuan</th>
                                    <th>Kota</th>
                                    <th>Jarak</th>
                                    <th>Edit</th>
                                    <th>Hapus</th>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($tujuan as $lu) : ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $lu['nama_tujuan']; ?></td>
                                            <td><?php echo $lu['kota']; ?></td>
                                            <td><?php echo $lu['jarak']; ?> Km</td>
                                            <td><button class="tombol-edit btn btn-info btn-block btn-sm" data-id="<?php echo $lu['id_tujuan']; ?>" data-toggle="modal" data-target="#edit-user">Edit</button></td>
                                            <td><a href="<?php echo base_url('spv/del_kendaraan/') . $lu['id_tujuan']; ?>" class="tombol-hapus btn btn-danger btn-block btn-sm">Hapus</a> </td>
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
                <h4 class="modal-title">Tambah Tujuan</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('spv/mst_tujuan'); ?>" method="post">
                        <div class="form-group">
                            <label>Nama Tujuan</label>
                            <input type="text" class="form-control form-control-sm" name="nama_tujuan" required>
                        </div>
                        <div class="form-group">
                            <label>Kota</label>
                            <input type="text" class="form-control form-control-sm" name="kota" required>
                        </div>
                        <div class="form-group">
                            <label>Jarak (dalam Km)</label>
                            <input type="number" class="form-control form-control-sm" name="jarak" required>
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
                <h4 class="modal-title">Edit Kendaraan</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('spv/edit_tujuan'); ?>" method="post">
                        <div class="form-group">
                            <label>Nama Kendaraan</label>
                            <input type="hidden" name="id_tujuan" id="id_tujuan">
                            <input type="text" class="form-control form-control-sm" name="nama_tujuan" id="nama_tujuan" required>
                        </div>
                        <div class="form-group">
                            <label>Kota Tujuan</label>
                            <input type="text" class="form-control form-control-sm" name="kota" id="kota" required>
                        </div>
                        <div class="form-group">
                            <label>Jarak (dalam Km)</label>
                            <input type="number" class="form-control form-control-sm" name="jarak" id="jarak" required>
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
        const id_tujuan = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('spv/get_tujuan'); ?>',
            data: {
                id_tujuan: id_tujuan
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#nama_tujuan').val(data.nama_tujuan);
                $('#kota').val(data.kota);
                $('#jarak').val(data.jarak);
                $('#id_tujuan').val(data.id_tujuan);
            }
        });
    });
</script>