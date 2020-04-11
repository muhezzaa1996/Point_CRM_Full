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
                            Tambah Toko
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-hover" id="table-data" style="font-size:14px;">
                                <thead>
                                    <th>#</th>
                                    <th>Nama Pemilik</th>
                                    <th>Nama Toko</th>
                                    <th>Alamat Toko</th>
                                    <th>No Telp</th>
                                    <th>NPWP</th>
                                    <th>Diskon</th>
                                    <th>Edit</th>
                                    <th>Hapus</th>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($toko as $lu) : ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $lu['pemilik']; ?></td>
                                            <td><?php echo $lu['nama_toko']; ?></td>
                                            <td><?php echo $lu['alamat_toko']; ?></td>
                                            <td><?php echo $lu['telp_toko']; ?></td>
                                            <td><?php echo $lu['npwp']; ?></td>
                                            <td><?php echo $lu['diskon']; ?></td>
                                            <td><button class="tombol-edit btn btn-info btn-block btn-sm" data-id="<?php echo $lu['id_toko']; ?>" data-toggle="modal" data-target="#edit-user">Edit</button></td>
                                            <td><a href="<?php echo base_url('spv/del_toko/') . $lu['id_toko']; ?>" class="tombol-hapus btn btn-danger btn-block btn-sm">Hapus</a> </td>
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
                <h4 class="modal-title">Tambah Toko</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('spv/mst_toko'); ?>" method="post">
                        <div class="form-group">
                            <label>Nama Pemilik</label>
                            <input type="text" class="form-control form-control-sm" name="pemilik" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Toko</label>
                            <input type="text" class="form-control form-control-sm" name="nama_toko" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat Toko</label>
                            <input type="text" class="form-control form-control-sm" name="alamat_toko" required>
                        </div>
                        <div class="form-group">
                            <label>No Telp Toko</label>
                            <input type="number" class="form-control form-control-sm" name="telp_toko" required>
                        </div>
                        <div class="form-group">
                            <label>No NPWP</label>
                            <input type="number" class="form-control form-control-sm" name="npwp" required>
                        </div>
                        <div class="form-group">
                            <label>Diskon</label>
                            <input type="number" class="form-control form-control-sm" name="diskon" required>
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
                <h4 class="modal-title">Edit Toko</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('spv/edit_toko'); ?>" method="post">
                        <div class="form-group">
                            <label>Nama Pemilik</label>
                            <input type="hidden" name="id_toko" id="id_toko">
                            <input type="text" class="form-control form-control-sm" name="pemilik" id="pemilik" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Toko</label>
                            <input type="text" class="form-control form-control-sm" name="nama_toko" id="nama_toko" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat Toko</label>
                            <input type="text" class="form-control form-control-sm" name="alamat_toko" id="alamat_toko" required>
                        </div>
                        <div class="form-group">
                            <label>No Telp Toko</label>
                            <input type="number" class="form-control form-control-sm" name="telp_toko" id="telp_toko" required>
                        </div>
                        <div class="form-group">
                            <label>No NPWP</label>
                            <input type="number" class="form-control form-control-sm" name="npwp" id="npwp" required>
                        </div>
                        <div class="form-group">
                            <label>Diskon</label>
                            <input type="number" class="form-control form-control-sm" name="diskon" id="diskon" required>
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
        const id_toko = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('spv/get_toko'); ?>',
            data: {
                id_toko: id_toko
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#pemilik').val(data.pemilik);
                $('#nama_toko').val(data.nama_toko);
                $('#alamat_toko').val(data.alamat_toko);
                $('#telp_toko').val(data.telp_toko);
                $('#npwp').val(data.npwp);
                $('#diskon').val(data.diskon);
                $('#id_toko').val(data.id_toko);
            }
        });
    });
</script>