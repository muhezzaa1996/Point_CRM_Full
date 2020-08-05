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
                            Tambah Company
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-hover" id="table-data" style="font-size:14px;">
                                <thead>
                                    <th>#</th>
                                    <th>Kode Company</th>
                                    <th>Nama Company</th>
                                    <th>Alamat</th>
                                    <th>No Telp</th>
                                    <th>Email</th>
                                    <th>Direktur</th>
                                    <th>Edit</th>
                                    <th>Hapus</th>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($company as $com) : ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $com['kode_comp']; ?></td>
                                            <td><?php echo $com['nama_comp']; ?></td>
                                            <td><?php echo $com['alamat_comp']; ?></td>
                                            <td><?php echo $com['telp_comp']; ?></td>
                                            <td><?php echo $com['email']; ?></td>
                                            <td><?php echo $com['direktur']; ?></td>
                                            <td><button class="tombol-edit btn btn-info btn-block btn-sm" data-id="<?php echo $com['id_comp']; ?>" data-toggle="modal" data-target="#edit-user">Edit</button></td>
                                            <td><a href="<?php echo base_url('admin/del_company/') . $com['id_comp']; ?>" class="tombol-hapus btn btn-danger btn-block btn-sm">Hapus</a> </td>
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
                <h4 class="modal-title">Tambah Company</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('admin/mst_company'); ?>" method="post">
                        <div class="form-group">
                            <label>Kode Company</label>
                                <input type="text" class="form-control form-control-sm" name="kode_comp" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Company</label>
                            <input type="text" class="form-control form-control-sm" name="nama_comp" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control form-control-sm" name="alamat_comp" required>
                        </div>
                        <div class="form-group">
                            <label>No Telp</label>
                            <input type="number" class="form-control form-control-sm" name="telp_comp" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control form-control-sm" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Direktur</label>
                            <input type="text" class="form-control form-control-sm" name="direktur" required>
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
                <h4 class="modal-title">Edit Company</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('admin/edit_company'); ?>" method="post">
                        <div class="form-group">
                            <label>Kode Company</label>
                            <input type="hidden" name="id_comp" id="id_comp">
                            <input type="text" class="form-control form-control-sm" name="kode_comp" id="kode_comp" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nama Company</label>
                            <input type="text" class="form-control form-control-sm" name="nama_comp" id="nama_comp" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control form-control-sm" name="alamat_comp" id="alamat_comp" required>
                        </div>
                        <div class="form-group">
                            <label>No Telp</label>
                            <input type="number" class="form-control form-control-sm" name="telp_comp" id="telp_comp" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control form-control-sm" name="email" id="email" required>
                        </div>
                        <div class="form-group">
                            <label>Direktur</label>
                            <input type="text" class="form-control form-control-sm" name="direktur" id="direktur" required>
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
        const id_comp = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('admin/get_company'); ?>',
            data: {
                id_comp: id_comp
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#kode_comp').val(data.kode_comp);
                $('#nama_comp').val(data.nama_comp);
                $('#alamat_comp').val(data.alamat_comp);
                $('#telp_comp').val(data.telp_comp);
                $('#email').val(data.email);
                $('#direktur').val(data.direktur);
                $('#id_comp').val(data.id_comp);
            }
        });
    });
</script>