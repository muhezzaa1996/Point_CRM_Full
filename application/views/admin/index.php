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
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-teal">
                        <div class="inner">
                            <h3><?php echo $user_perbulan; ?></h3>
                            <p>User Register</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <a href="#" class="small-box-footer">-</a>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3><?php echo $count_user; ?></h3>
                            <p>Total User</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="#" class="small-box-footer">-</a>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-purple">
                        <div class="inner">
                            <h3><?php echo $user_aktif; ?></h3>
                            <p>User Aktif</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <a href="#" class="small-box-footer">-</a>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3><?php echo $user_tak_aktif; ?></h3>
                            <p>User Tidak Aktif</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-times"></i>
                        </div>
                        <a href="#" class="small-box-footer">-</a>
                    </div>
                </div>
            </div>
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
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?php echo base_url('assets/dist/img/profile/' . $user['image']); ?>" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center"><?php echo $user['nama']; ?></h3>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Tgl Register</b> <a class="float-right"><?php echo format_indo($user['date_created']); ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Level</b> <a class="float-right"><?php echo $user['level']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right"><?php echo $user['email']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>No HP</b> <a class="float-right"><?php echo $user['hp']; ?></a>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#edit-profile"><b>Ubah Profile</b></button>
                            <button type="button" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#edit-pass"><b>Ubah Password</b></button>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->

                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card card-primary card-outline">
                        <div class="card">
                            <div class="card-header p-2">
                                <h4>List User</h4>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover" id="table-data" style="font-size:14px;">
                                                <thead>
                                                    <th>#</th>
                                                    <th>Nama</th>
                                                    <th>User</th>
                                                    <th>Level</th>
                                                    <th>Status</th>
                                                    <th>Tgl Register</th>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    <?php foreach ($list_user as $lu) : ?>
                                                        <tr>
                                                            <td><?php echo $i++; ?></td>
                                                            <td><?php echo $lu['nama']; ?></td>
                                                            <td><?php echo $lu['username']; ?></td>
                                                            <td><?php echo $lu['level']; ?></td>
                                                            <?php if ($lu['is_active'] == 1) : ?>
                                                                <td>Aktif</td>
                                                            <?php else : ?>
                                                                <td>Tidak Aktif</td>
                                                            <?php endif; ?>
                                                            <td><?php echo format_indo($lu['date_created']); ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="edit-profile">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Profile</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('admin/index'); ?>
                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="hidden" name="id_user" value="<?php echo $user['id_user']; ?>">
                        <input type="text" class="form-control" id="username" value="<?php echo $user['username']; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $user['nama']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="email" value="<?php echo $user['email']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">No HP</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="nama" name="hp" value="<?php echo $user['hp']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2"><label>Photo</label></div>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="<?php echo base_url('assets/dist/img/profile/') . $user['image']; ?>" class="img-thumbnail">
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Upload Photo</label>
                                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-default float-right ml-1" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary float-right">Simpan Perubahan</button>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="edit-pass">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('admin/ubah_password'); ?>" method="post">
                    <div class="form-group">
                        <label for="current_password">Password Lama</label>
                        <input type="password" class="form-control" id="current_password" name="current_password">
                    </div>
                    <div class="form-group">
                        <label for="new_password1">Password Baru</label>
                        <input type="password" class="form-control" id="new_password1" name="new_password1">
                    </div>
                    <div class="form-group">
                        <label for="new_password2">Ulang Password Baru</label>
                        <input type="password" class="form-control" id="new_password2" name="new_password2" placeholder="Ketik ulang password baru">
                    </div>
                    <button type="button" class="btn btn-default float-right ml-1" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary float-right">Simpan Perubahan</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>