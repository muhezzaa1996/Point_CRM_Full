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
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card">
                            <div class="card-header p-2">
                                <?php if ($accept['confirm'] == 0) : ?>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add-user">
                                        Tambah Data
                                    </button>
                                <?php elseif ($accept['confirm'] == 2) : ?>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add-user">
                                        Tambah Data
                                    </button>
                                <?php else : ?>
                                <?php endif; ?>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover" id="table-id" style="font-size:14px;">
                                                <thead>
                                                    <th>#</th>
                                                    <th>Tgl Dinas</th>
                                                    <th>Armada</th>
                                                    <th>Tujuan</th>
                                                    <th>Biaya Dinas</th>
                                                    <th>Km Awal</th>
                                                    <th>Km Akhir</th>
                                                    <th>BBM</th>
                                                    <th>Status</th>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    <?php foreach ($rute as $lu) : ?>
                                                        <tr>
                                                            <td><?php echo $i++; ?></td>
                                                            <td><?php echo format_indo($lu['tgl_dinas']); ?></td>
                                                            <td><?php echo $lu['nama_kendaraan']; ?></td>
                                                            <td><?php echo $lu['nama_tujuan']; ?></td>
                                                            <td>Rp. <?php echo rupiah($lu['biaya_dinas']); ?></td>
                                                            <td><?php echo rupiah($lu['km_awal']); ?></td>
                                                            <td><?php echo rupiah($lu['km_akhir']); ?></td>
                                                            <td>Rp. <?php echo rupiah($lu['beli_bbm']); ?></td>
                                                            <?php if ($lu['confirm'] == 1) : ?>
                                                                <td style="font-weight:800;color:gray;">MENUNGGU</td>
                                                            <?php elseif ($lu['confirm'] == 2) : ?>
                                                                <td style="font-weight:800;color:red;">DITOLAK</td>
                                                            <?php else : ?>
                                                                <td style="font-weight:800;color:green;">DISETUJUI</td>
                                                            <?php endif; ?>
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
<div class="modal fade" id="add-user">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Perjalanan Dinas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('driver/rute'); ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Armada</label>
                            <select class="form-control form-control-sm" name="kendaraan_id" required>
                                <option value="">- Pilih Armada -</option>
                                <?php foreach ($armada as $a) : ?>
                                    <option value="<?php echo $a['id_kendaraan']; ?>"><?php echo $a['nama_kendaraan']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tujuan</label>
                            <select class="form-control form-control-sm" name="tujuan_id" required>
                                <option value="">- Pilih Tujuan -</option>
                                <?php foreach ($tujuan as $t) : ?>
                                    <option value="<?php echo $t['id_tujuan']; ?>"><?php echo $t['nama_tujuan']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tgl Dinas</label>
                            <input type="date" class="form-control form-control-sm" name="tgl_dinas" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Pengajuan Biaya Dinas</label>
                            <input type="number" class="form-control form-control-sm" name="biaya_dinas" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>KM Awal Armada</label>
                            <input type="number" class="form-control form-control-sm" name="km_awal" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>KM Akhir Armada</label>
                            <input type="text" class="form-control form-control-sm" name="km_akhir" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Pembelian Bahan Bakar</label>
                            <input type="number" class="form-control form-control-sm" name="beli_bbm" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Biaya Lain-Lain</label>
                            <input type="number" class="form-control form-control-sm" name="biaya_lain" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" rows="2" name="ket"></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Upload Gambar Struk BBM</label>
                            <input type="file" class="form-control-file" name="file1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Upload Gambar Nota Biaya Lain</label>
                            <input type="file" class="form-control-file" name="file2">
                        </div>
                    </div>
                </div>
                <span style="font-size:12px;font-weight:600;">* Ukuran Gambar tidak lebih dari 2 MB.<br>
                    * Ekstensi file JPG, JPEG, dan PNG.</span>
                <hr>
                <button type="submit" class="btn btn-primary pull-right">Kirim Data</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>

                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
</div>