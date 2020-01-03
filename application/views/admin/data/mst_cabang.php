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
                            Tambah Cabang
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-hover" id="table-id" style="font-size:14px;">
                                <thead>
                                    <th>#</th>
                                    <th>Kode Cabang</th>
                                    <th>Nama Cabang</th>
                                    <th>No Telp</th>
                                    <th>Manager</th>
                                    <th>Edit</th>
                                    <th>Hapus</th>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($cabang as $lu) : ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $lu['kode_cabang']; ?></td>
                                            <td><?php echo $lu['nama_cabang']; ?></td>
                                            <td><?php echo $lu['no_telp_cabang']; ?></td>
                                            <td><?php echo $lu['manager']; ?></td>
                                            <td><button class="tombol-edit btn btn-info btn-block btn-sm" data-id="<?php echo $lu['id_cabang']; ?>" data-toggle="modal" data-target="#edit-user">Edit</button></td>
                                            <td><a href="<?php echo base_url('admin/del_cabang/') . $lu['id_cabang']; ?>" class="tombol-hapus btn btn-danger btn-block btn-sm">Hapus</a> </td>
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
                <h4 class="modal-title">Tambah Cabang</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('admin/mst_kendaraan'); ?>" method="post">
                        <div class="form-group">
                            <label>Kode Cabang</label>
                            <input type="text" class="form-control form-control-sm" name="kode_cabang" readonly>
                        </div>
                        <div class="form-group">
                            <label>No Polisi</label>
                            <input type="text" class="form-control form-control-sm" name="nopol" required>
                        </div>
                        <div class="form-group">
                            <label>Bahan Bakar</label>
                            <input type="text" class="form-control form-control-sm" name="bbm" required>
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
                    <form action="<?php echo base_url('admin/edit_kendaraan'); ?>" method="post">
                        <div class="form-group">
                            <label>Nama Kendaraan</label>
                            <input type="hidden" name="id_kendaraan" id="id_kendaraan">
                            <input type="text" class="form-control form-control-sm" name="nama_kendaraan" id="nama_kendaraan" required>
                        </div>
                        <div class="form-group">
                            <label>No Polisi</label>
                            <input type="text" class="form-control form-control-sm" name="nopol" id="nopol" required>
                        </div>
                        <div class="form-group">
                            <label>Bahan Bakar</label>
                            <input type="text" class="form-control form-control-sm" name="bbm" id="bbm" required>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right">Simpan Perubahan</button>
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
        const id_kendaraan = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('admin/get_kendaraan'); ?>',
            data: {
                id_kendaraan: id_kendaraan
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#nama_kendaraan').val(data.nama_kendaraan);
                $('#nopol').val(data.nopol);
                $('#bbm').val(data.bbm);
                $('#id_kendaraan').val(data.id_kendaraan);
            }
        });
    });
</script>