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
                            Tambah Biaya
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-hover" id="table-data" style="font-size:14px;">
                                <thead>
                                    <th>#</th>
                                    <th>Nama Biaya Operasional</th>
                                    <th>Jumlah Biaya Operasional</th>
                                    <th>Edit</th>
                                    <th>Hapus</th>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($biaya as $lu) : ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $lu['nama_biaya']; ?></td>
                                            <td>Rp. <?php echo rupiah($lu['jml_biaya']); ?></td>
                                            <td><button class="tombol-edit btn btn-info btn-block btn-sm" data-id="<?php echo $lu['id_biaya']; ?>" data-toggle="modal" data-target="#edit-user">Edit</button></td>
                                            <td><a href="<?php echo base_url('admin/del_biaya/') . $lu['id_biaya']; ?>" class="tombol-hapus btn btn-danger btn-block btn-sm">Hapus</a> </td>
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
                <h4 class="modal-title">Tambah Biaya</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('admin/mst_biaya'); ?>" method="post">
                        <div class="form-group">
                            <label>Nama Biaya Operasional</label>
                            <input type="text" class="form-control form-control-sm" name="nama_biaya" required>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Biaya Operasional</label>
                            <input type="number" class="form-control form-control-sm" name="jml_biaya" required>
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
                <h4 class="modal-title">Edit Biaya</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('admin/edit_biaya'); ?>" method="post">
                        <div class="form-group">
                            <label>Nama Biaya Operasional</label>
                            <input type="hidden" name="id_biaya" id="id_biaya">
                            <input type="text" class="form-control form-control-sm" name="nama_biaya" id="nama_biaya" required>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Biaya Operasional</label>
                            <input type="number" class="form-control form-control-sm" name="jml_biaya" id="jml_biaya" required>
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
        const id_biaya = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('admin/get_biaya'); ?>',
            data: {
                id_biaya: id_biaya
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#nama_biaya').val(data.nama_biaya);
                $('#jml_biaya').val(data.jml_biaya);
                $('#id_biaya').val(data.id_biaya);
            }
        });
    });
</script>