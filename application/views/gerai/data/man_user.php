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
                            Tambah Pelanggan
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-hover" id="table-data" style="font-size:14px;">
                                <thead>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No HP</th>
                                    <th>Status</th>
                                    <th>Tgl Register</th>
                                    <th>Edit</th>
                                    <th>Hapus</th>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($list_user as $lu) : ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $lu['nama']; ?></td>
                                            <td><?php echo $lu['email']; ?></td>
                                            <td><?php echo $lu['hp']; ?></td>
                                            <?php if ($lu['is_active'] == 1) : ?>
                                                <td>Aktif</td>
                                            <?php else : ?>
                                                <td>Tidak Aktif</td>
                                            <?php endif; ?>
                                            <td><?php echo format_indo($lu['date_created']); ?></td>
                                            <td> <a href="<?php echo base_url('gerai/edit_user/') . $lu['id_user']; ?>" class="tombol-edit btn btn-primary btn-block btn-sm" data-id="<?php echo $lu['id_user']; ?>" data-toggle="modal" data-target="#edit-user">Edit</a></td>
                                            <td><a href="<?php echo base_url('gerai/del_user/') . $lu['id_user']; ?>" class="tombol-hapus btn btn-danger btn-block btn-sm">Hapus</a> </td>
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
                <h4 class="modal-title">Tambah Pelanggan</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('gerai/man_user'); ?>" method="post" id="form_id">
                        <div class="form-group">
                            <label for="level">Level</label>
                            <select class="form-control form-control-sm" name="level" required>
                                <option value="User">USER</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control form-control-sm" name="nama" required>
                        </div>

                        <div class="form-group">
                            <label>No HP</label>
                            <input type="number" class="form-control form-control-sm" name="hp" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control form-control-sm" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control form-control-sm" name="username" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control form-control-sm" name="password1" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password2">Ketik Ulang Password</label>
                                    <input type="password" class="form-control form-control-sm" name="password2" required>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
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
                <h4 class="modal-title">Edit User</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('gerai/proses_edit_user'); ?>" method="post" id="form_id">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control form-control-sm" name="username" id="username" readonly>
                        </div>
                        <div class="form-group">
                            <label for="level">Level</label>
                            <input type="hidden" name="id_user" id="idjson">
                            <select class="form-control form-control-sm" name="level" id="level" required>
                                <option value="">- Pilih Level -</option>
                                <option value="User">USER</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control form-control-sm" name="nama" id="nama" required>
                        </div>
                        <div class="form-group">
                            <label>No HP</label>
                            <input type="number" class="form-control form-control-sm" name="hp" id="hp" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control form-control-sm" name="email" id="email" required>
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_active" value="1" checked>
                                <label class="form-check-label">Aktif</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_active" value="0">
                                <label class="form-check-label">Tidak Aktif</label>
                            </div>
                        </div>
                        <!-- /.box-body -->
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
        const id_user = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('gerai/edit_user'); ?>',
            data: {
                id_user: id_user
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#hp').val(data.hp);
                $('#email').val(data.email);
                $('#nama').val(data.nama);
                $('#username').val(data.username);
                $('#level').val(data.level);
                $('#idjson').val(data.id_user);
            }
        });
    });
</script>