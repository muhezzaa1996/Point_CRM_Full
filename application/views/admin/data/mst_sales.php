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
                            Tambah Sales
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-hover" id="table-data" style="font-size:14px;">
                                <thead>
                                    <th>#</th>
                                    <th>Inisial Sales</th>
                                    <th>Nama Sales</th>
                                    <th>Handphone</th>
                                    <th>Email</th>
                                    <th>Edit</th>
                                    <th>Hapus</th>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($sales as $lu) : ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $lu['kode_sales']; ?></td>
                                            <td><?php echo $lu['nama_sales']; ?></td>
                                            <td><?php echo $lu['hp']; ?></td>
                                            <td><?php echo $lu['email']; ?></td>
                                            <td><button class="tombol-edit btn btn-info btn-block btn-sm" data-id="<?php echo $lu['id_sales']; ?>" data-toggle="modal" data-target="#edit-user">Edit</button></td>
                                            <td><a href="<?php echo base_url('admin/del_sales/') . $lu['id_sales']; ?>" class="tombol-hapus btn btn-danger btn-block btn-sm">Hapus</a> </td>
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
                <h4 class="modal-title">Tambah Sales</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('admin/mst_sales'); ?>" method="post">
                        <div class="form-group">
                            <label>Inisial Sales</label>
                            <input type="text" class="form-control form-control-sm" name="kode_sales" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Sales</label>
                            <input type="text" class="form-control form-control-sm" name="nama_sales" required>
                        </div>
                        <div class="form-group">
                            <label>Handphone</label>
                            <input type="number" class="form-control form-control-sm" name="hp" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control form-control-sm" name="email" required>
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
                <h4 class="modal-title">Edit Sales</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('admin/edit_sales'); ?>" method="post">
                        <div class="form-group">
                            <label>Kode Sales</label>
                            <input type="number" class="form-control form-control-sm" name="id_sales" id="id_sales" hidden>
                            <input type="text" class="form-control form-control-sm" name="kode_sales" id="kode_sales" readonly>

                        </div>
                        <div class="form-group">
                            <label>Nama Sales</label>
                            <input type="text" class="form-control form-control-sm" name="nama_sales" id="nama_sales" required>
                        </div>
                        <div class="form-group">
                            <label>Handphone</label>
                            <input type="number" class="form-control form-control-sm" name="hp" id="hp" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control form-control-sm" name="email" id="email" required>
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
        const id_sales = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('admin/get_sales'); ?>',
            data: {
                id_sales: id_sales
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#kode_sales').val(data.kode_sales);
                $('#nama_sales').val(data.nama_sales);
                $('#hp').val(data.hp);
                $('#email').val(data.email);
                $('#id_sales').val(data.id_sales);
            }
        });
    });
</script>