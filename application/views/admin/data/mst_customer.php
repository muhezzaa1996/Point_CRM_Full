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
                            Tambah Customer
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-hover" id="table-data" style="font-size:14px;">
                                <thead>
                                    <th>#</th>
                                    <th>Kode Customer</th>
                                    <th>Nama Customer</th>
                                    <th>Alamat</th>
                                    <th>No Telp</th>
                                    <th>Keterangan</th>
                                    <th>Edit</th>
                                    <th>Hapus</th>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($customer as $lu) : ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $lu['kode_cust']; ?></td>
                                            <td><?php echo $lu['nama_cust']; ?></td>
                                            <td><?php echo $lu['alamat_cust']; ?></td>
                                            <td><?php echo $lu['telp_cust']; ?></td>
                                            <td><?php echo $lu['ket_cust']; ?></td>
                                            <td><button class="tombol-edit btn btn-info btn-block btn-sm" data-id="<?php echo $lu['id_cust']; ?>" data-toggle="modal" data-target="#edit-user">Edit</button></td>
                                            <td><a href="<?php echo base_url('admin/del_customer/') . $lu['id_cust']; ?>" class="tombol-hapus btn btn-danger btn-block btn-sm">Hapus</a> </td>
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
                <h4 class="modal-title">Tambah Customer</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('admin/mst_customer'); ?>" method="post">
                        <div class="form-group">
                            <label>Kode Customer</label>
                            <input type="text" class="form-control form-control-sm" name="kode_cust" value="<?php echo $kode_cust; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nama Customer</label>
                            <input type="text" class="form-control form-control-sm" name="nama_cust" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control form-control-sm" name="alamat_cust" required>
                        </div>
                        <div class="form-group">
                            <label>No Telp</label>
                            <input type="text" class="form-control form-control-sm" name="telp_cust" required>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control form-control-sm" name="ket_cust">
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
                <h4 class="modal-title">Edit Customer</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('admin/edit_customer'); ?>" method="post">
                        <div class="form-group">
                            <label>Kode Customer</label>
                            <input type="hidden" name="id_cust" id="id_cust">
                            <input type="text" class="form-control form-control-sm" id="kode_cust" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nama Customer</label>
                            <input type="text" class="form-control form-control-sm" name="nama_cust" id="nama_cust" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control form-control-sm" name="alamat_cust" id="alamat_cust" required>
                        </div>
                        <div class="form-group">
                            <label>No Telp</label>
                            <input type="number" class="form-control form-control-sm" name="telp_cust" id="telp_cust" required>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control form-control-sm" name="ket_cust" id="ket_cust" required>
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
        const id_cust = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('admin/get_customer'); ?>',
            data: {
                id_cust: id_cust
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#kode_cust').val(data.kode_cust);
                $('#nama_cust').val(data.nama_cust);
                $('#alamat_cust').val(data.alamat_cust);
                $('#telp_cust').val(data.telp_cust);
                $('#ket_cust').val(data.ket_cust);
                $('#id_cust').val(data.id_cust);
            }
        });
    });
</script>