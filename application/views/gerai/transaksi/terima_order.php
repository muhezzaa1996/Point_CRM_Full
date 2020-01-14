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
                            Tambah Penerimaan
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-hover" id="table-id" style="font-size:14px;">
                                <thead>
                                    <th>#</th>
                                    <th>Kode Order</th>
                                    <th>Pelanggan</th>
                                    <th>Kota Asal</th>
                                    <th>Kota Tujuan</th>
                                    <th>Tarif Vol</th>
                                    <th>Tarif Jarak</th>
                                    <th>Diskon</th>
                                    <!-- <th>Edit</th> -->
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($terima_order as $lu) : ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $lu['kode_order']; ?></td>
                                            <td><?php echo $lu['nama_pelanggan']; ?></td>
                                            <td><?php echo $lu['kota_asal']; ?></td>
                                            <td><?php echo $lu['kota_tujuan']; ?></td>
                                            <td><?php echo $lu['tarif_volume']; ?></td>
                                            <td><?php echo $lu['tarif_jarak']; ?></td>
                                            <td><?php echo $lu['diskon']; ?></td>
                                            <!-- <td><button class="tombol-edit btn btn-info btn-block btn-sm" data-id="<?php echo $lu['id_order']; ?>" data-toggle="modal" data-target="#edit-user">Edit</button></td> -->
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
                    <form action="<?php echo base_url('gerai/mst_toko'); ?>" method="post">
                        <div class="form-group">
                            <label>Kode Order</label>
                            <input type="text" class="form-control form-control-sm" name="pemilik" value="<?php echo $kode_order; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Tujuan</label>
                            <select class="form-control" name="color" onchange='CheckColors(this.value);'>
                                <?php foreach ($tarif as $t) : ?>
                                    <option><?php echo $t['kota_asal']; ?> - <?php echo $t['kota_tujuan']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <input type="text" name="othercolor" id="othercolor" />
                        <div class="form-group">
                            <label>Harga Volume</label>
                            <input type="text" class="form-control form-control-sm" name="tarif_id" list="tujuan" required>
                            <datalist id="tujuan">
                                <?php foreach ($tarif as $t) : ?>
                                    <option><?php echo $t['kota_asal']; ?> - <?php echo $t['kota_tujuan']; ?></option>
                                <?php endforeach; ?>
                            </datalist>
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
                    <form action="<?php echo base_url('gerai/edit_toko'); ?>" method="post">
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
            url: '<?php echo base_url('gerai/get_toko'); ?>',
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