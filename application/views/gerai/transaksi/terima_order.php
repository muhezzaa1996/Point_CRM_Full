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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Terima Order</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('gerai/mst_toko'); ?>" method="post">
                        <div class="form-group">
                            <label>Kode Order</label>
                            <input type="text" class="form-control form-control-sm" name="pemilik" value="<?php echo $kode_order; ?>" disabled="">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Pengirim</label>
                                    <input type="text" class="form-control form-control-sm" name="alamat_toko" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>No Telp Pengirim</label>
                                    <input type="text" class="form-control form-control-sm" name="alamat_toko" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Alamat Pengirim</label>
                            <input type="text" class="form-control form-control-sm" name="alamat_toko" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Penerima</label>
                                    <input type="text" class="form-control form-control-sm" name="alamat_toko" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>No Telp Penerima</label>
                                    <input type="text" class="form-control form-control-sm" name="alamat_toko" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Alamat Penerima</label>
                            <input type="text" class="form-control form-control-sm" name="alamat_toko" required>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Tujuan</label>
                                    <select class="form-control form-control-sm" name="color" id="select_box">
                                        <?php foreach ($tarif as $t) : ?>
                                            <option value="<?php echo $t['tarif_volume']; ?>"><?php echo $t['kota_asal']; ?> - <?php echo $t['kota_tujuan']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="exampleFormControlSelect1">Harga (Kubik)</label>
                                <input type="text" class="form-control form-control-sm" id="show_only" disabled="">
                            </div>
                            <div class="col-md-2">
                                <label for="exampleFormControlSelect1">Total Volume</label>
                                <input type="text" class="form-control form-control-sm" id="jumlah">
                            </div>
                            <div class="col-md-3">
                                <label for="exampleFormControlSelect1">Total Harga</label>
                                <input type="text" class="form-control form-control-sm" id="total" disabled="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Tujuan</label>
                                    <select class="form-control form-control-sm" name="color" id="jarak">
                                        <?php foreach ($tarif as $t) : ?>
                                            <option value="<?php echo $t['tarif_volume']; ?>"><?php echo $t['kota_asal']; ?> - <?php echo $t['kota_tujuan']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="exampleFormControlSelect1">Harga (KM)</label>
                                <input type="text" class="form-control form-control-sm" id="jarak_show" disabled="">
                            </div>
                            <div class="col-md-2">
                                <label for="exampleFormControlSelect1">Total KM</label>
                                <input type="text" class="form-control form-control-sm" id="total_km">
                            </div>
                            <div class="col-md-3">
                                <label for="exampleFormControlSelect1">Total Harga</label>
                                <input type="text" class="form-control form-control-sm" id="grandtotal_km" disabled="">
                            </div>
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
    $("#jumlah").keyup(function() {
        var harga = parseInt($("#show_only").val())
        var jumlah = parseInt($("#jumlah").val())

        var total = harga * jumlah;
        $("#total").attr("value", total)

    });
</script>
<script>
    $("#total_km").keyup(function() {
        var harga = parseInt($("#jarak_show").val())
        var jumlah = parseInt($("#total_km").val())

        var total = harga * jumlah;
        $("#grandtotal_km").attr("value", total)

    });
</script>
<script>
    $(document).ready(function() {
        $('body').on('change', '#select_box', function() {
            $('#show_only').val(this.value);
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('body').on('change', '#jarak', function() {
            $('#jarak_show').val(this.value);
        });
    });
</script>