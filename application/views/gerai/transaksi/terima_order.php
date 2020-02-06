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
                         <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#trans_jarak">
                             Input Order Jarak
                         </button>
                         <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#trans_volume">
                             Input Order Volume
                         </button>
                         <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#status_sukses">
                             Status Pick Up
                         </button>
                     </div>
                     <div class="card-body">
                         <div class="row">
                             <div class="col-md-12">
                                 <div class="table-responsive">
                                     <h4>Penerimaan Order Jarak</h4>
                                     <table class=" table table-bordered table-hover" id="table-id" style="font-size:14px;">
                                         <thead>
                                             <th>#</th>
                                             <th>Kode Order</th>
                                             <th>Pengirim</th>
                                             <th>Alamat</th>
                                             <th>Penerima</th>
                                             <th>Alamat</th>
                                             <th>Total Bayar</th>
                                             <th>Status</th>
                                             <!-- <th>Edit</th> -->
                                         </thead>
                                         <tbody>
                                             <?php $i = 1; ?>
                                             <?php foreach ($terima_order as $lu) : ?>
                                                 <tr>
                                                     <td><?php echo $i++; ?></td>
                                                     <td><?php echo $lu['kode_order']; ?></td>
                                                     <td><?php echo $lu['nama_pengirim']; ?></td>
                                                     <td><?php echo $lu['alamat_pengirim']; ?></td>
                                                     <td><?php echo $lu['nama_penerima']; ?></td>
                                                     <td><?php echo $lu['alamat_penerima']; ?></td>
                                                     <td>Rp. <?php echo rupiah($lu['pembayaran']); ?></td>
                                                     <?php if ($lu['status_pickup'] == 1) : ?>
                                                         <td><button type="button" class="btn btn-warning btn-sm btn-block">Pending</button></td>
                                                     <?php else : ?>
                                                         <td><button type="button" class="btn btn-success btn-sm btn-block">Picked Up</button></td>
                                                     <?php endif; ?>
                                                     <!-- <td><button class="tombol-edit btn btn-info btn-block btn-sm" data-id="<?php echo $lu['id_order']; ?>" data-toggle="modal" data-target="#edit-user">Edit</button></td> -->
                                                 </tr>
                                             <?php endforeach; ?>
                                         </tbody>
                                     </table>
                                 </div>
                             </div>
                             <div class="col-md-12 mt-4">
                                 <div class="table-responsive">
                                     <h4>Penerimaan Order Volume</h4>
                                     <table class=" table table-bordered table-hover" id="id-table" style="font-size:14px;">
                                         <thead>
                                             <th>#</th>
                                             <th>Kode Order</th>
                                             <th>Pengirim</th>
                                             <th>Alamat</th>
                                             <th>Penerima</th>
                                             <th>Alamat</th>
                                             <th>Total Bayar</th>
                                             <th>Status</th>
                                             <!-- <th>Edit</th> -->
                                         </thead>
                                         <tbody>
                                             <?php $i = 1; ?>
                                             <?php foreach ($terima_order_volume as $lu) : ?>
                                                 <tr>
                                                     <td><?php echo $i++; ?></td>
                                                     <td><?php echo $lu['kode_order']; ?></td>
                                                     <td><?php echo $lu['nama_pengirim']; ?></td>
                                                     <td><?php echo $lu['alamat_pengirim']; ?></td>
                                                     <td><?php echo $lu['nama_penerima']; ?></td>
                                                     <td><?php echo $lu['alamat_penerima']; ?></td>
                                                     <td>Rp. <?php echo rupiah($lu['pembayaran']); ?></td>
                                                     <?php if ($lu['status_pickup'] == 1) : ?>
                                                         <td><button type="button" class="btn btn-warning btn-sm btn-block">Pending</button></td>
                                                     <?php else : ?>
                                                         <td><button type="button" class="btn btn-success btn-sm btn-block">Picked Up</button></td>
                                                     <?php endif; ?>
                                                     <!-- <td><button class="tombol-edit btn btn-info btn-block btn-sm" data-id="<?php echo $lu['id_order']; ?>" data-toggle="modal" data-target="#edit-user">Edit</button></td> -->
                                                 </tr>
                                             <?php endforeach; ?>
                                         </tbody>
                                     </table>
                                 </div>
                             </div>
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
 <div class="modal fade" id="trans_jarak">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title">Input Order Jarak</h4>
             </div>
             <div class="modal-body">
                 <div class="box-body">
                     <form action="<?php echo base_url('gerai/terima_order'); ?>" method="post" id="myform">
                         <div class="row">
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label>Tgl Order</label>
                                     <input type="date" class="form-control form-control-sm" name="tgl_order" required>
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label>Kode Order</label>
                                     <input type="text" class="form-control form-control-sm" name="kode_order" value="<?php echo $kode_order_jarak; ?>" readonly>
                                 </div>
                             </div>
                         </div>
                         <div class="row">
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label>Nama Pengirim</label>
                                     <input type="text" class="form-control form-control-sm" name="nama_pengirim" required>
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label>No Telp Pengirim</label>
                                     <input type="text" class="form-control form-control-sm" name="telp_pengirim" required>
                                 </div>
                             </div>
                         </div>
                         <div class="form-group">
                             <label>Alamat Pengirim</label>
                             <input type="text" class="form-control form-control-sm" name="alamat_pengirim" required>
                         </div>
                         <div class="row">
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label>Nama Penerima</label>
                                     <input type="text" class="form-control form-control-sm" name="nama_penerima" required>
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label>No Telp Penerima</label>
                                     <input type="text" class="form-control form-control-sm" name="telp_penerima" required>
                                 </div>
                             </div>
                         </div>
                         <div class="form-group">
                             <label>Alamat Penerima</label>
                             <input type="text" class="form-control form-control-sm" name="alamat_penerima" required>
                         </div>
                         <div class="row">
                             <div class="col-md-5">
                                 <div class="form-group">
                                     <label for="exampleFormControlSelect1">Tujuan</label>
                                     <select class="form-control form-control-sm" name="color" id="jarak" required>
                                         <option value="">- Pilih -</option>
                                         <?php foreach ($tarif as $t) : ?>
                                             <option value="<?php echo $t['tarif_jarak']; ?>"><?php echo $t['kota_asal']; ?> - <?php echo $t['kota_tujuan']; ?></option>
                                         <?php endforeach; ?>
                                     </select>
                                 </div>
                             </div>
                             <div class="col-md-2">
                                 <label for="exampleFormControlSelect1">Harga</label>
                                 <input type="text" class="form-control form-control-sm" name="nominal" id="jarak_show" readonly>
                             </div>
                             <div class="col-md-2">
                                 <label for="exampleFormControlSelect1">KM</label>
                                 <input type="number" class="numerical form-control form-control-sm" name="jarak" id="total_km">
                             </div>
                             <div class="col-md-3">
                                 <label for="exampleFormControlSelect1">Total Harga</label>
                                 <input type="text" class="form-control form-control-sm" name="pembayaran" id="grandtotal_km" readonly>
                             </div>
                         </div>
                         <div class="box-footer">
                             <button type="reset" class="btn btn-info pull-right">Reset</button>
                             <button type="submit" class="btn btn-primary pull-right">Simpan Data</button>
                             <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <div class="modal fade" id="trans_volume">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title">Input Order Volume</h4>
             </div>
             <div class="modal-body">
                 <div class="box-body">
                     <form action="<?php echo base_url('gerai/add_order_volume'); ?>" method="post" id="myform">
                         <div class="row">
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label>Tgl Order</label>
                                     <input type="date" class="form-control form-control-sm" name="tgl_order" required>
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label>Kode Order</label>
                                     <input type="char" class="form-control form-control-sm" name="kode_order" value="<?php echo $kode_order_volume; ?>" readonly>
                                 </div>
                             </div>
                         </div>
                         <div class="row">
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label>Nama Pengirim</label>
                                     <input type="text" class="form-control form-control-sm" name="nama_pengirim" required>
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label>No Telp Pengirim</label>
                                     <input type="text" class="form-control form-control-sm" name="telp_pengirim" required>
                                 </div>
                             </div>
                         </div>
                         <div class="form-group">
                             <label>Alamat Pengirim</label>
                             <input type="text" class="form-control form-control-sm" name="alamat_pengirim" required>
                         </div>
                         <div class="row">
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label>Nama Penerima</label>
                                     <input type="text" class="form-control form-control-sm" name="nama_penerima" required>
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label>No Telp Penerima</label>
                                     <input type="text" class="form-control form-control-sm" name="telp_penerima" required>
                                 </div>
                             </div>
                         </div>
                         <div class="form-group">
                             <label>Alamat Penerima</label>
                             <input type="text" class="form-control form-control-sm" name="alamat_penerima" required>
                         </div>
                         <div class="row">
                             <div class="col-md-5">
                                 <div class="form-group">
                                     <label for="exampleFormControlSelect1">Tujuan</label>
                                     <select class="form-control form-control-sm" name="color" id="select_box">
                                         <option value="">- Pilih -</option>
                                         <?php foreach ($tarif as $t) : ?>
                                             <option value="<?php echo $t['tarif_jarak']; ?>"><?php echo $t['kota_asal']; ?> - <?php echo $t['kota_tujuan']; ?></option>
                                         <?php endforeach; ?>
                                     </select>
                                 </div>
                             </div>
                             <div class="col-md-2">
                                 <label for="exampleFormControlSelect1">Harga</label>
                                 <input type="text" class="form-control form-control-sm" name="nominal" id="show_only" readonly>
                             </div>
                             <div class="col-md-2">
                                 <label for="exampleFormControlSelect1">Volume</label>
                                 <input type="number" class="numerical form-control form-control-sm" name="volume" id="jumlah">
                             </div>
                             <div class="col-md-3">
                                 <label for="exampleFormControlSelect1">Total Harga</label>
                                 <input type="text" class="form-control form-control-sm" name="pembayaran" id="total" readonly>
                             </div>
                         </div>
                         <div class="box-footer">
                             <button type="reset" class="btn btn-info pull-right">Reset</button>
                             <button type="submit" class="btn btn-primary pull-right">Simpan Data</button>
                             <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
 </div>


 <div class="modal fade" id="status_sukses">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title">Status Pick Up</h4>
             </div>
             <div class="modal-body">
                 <div class="box-body">
                     <div class="table-responsive">
                         <table class=" table table-bordered table-hover" id="id-table" style="font-size:14px;">
                             <thead>
                                 <th>#</th>
                                 <th>Kode Order</th>
                                 <th>Pengirim</th>
                                 <th>Alamat</th>
                                 <th>Penerima</th>
                                 <th>Alamat</th>
                                 <th>Status</th>
                                 <!-- <th>Edit</th> -->
                             </thead>
                             <tbody>
                                 <?php $i = 1; ?>
                                 <?php foreach ($order_sukses as $lu) : ?>
                                     <tr>
                                         <td><?php echo $i++; ?></td>
                                         <td><?php echo $lu['kode_order']; ?></td>
                                         <td><?php echo $lu['nama_pengirim']; ?></td>
                                         <td><?php echo $lu['alamat_pengirim']; ?></td>
                                         <td><?php echo $lu['nama_penerima']; ?></td>
                                         <td><?php echo $lu['alamat_penerima']; ?></td>
                                         <?php if ($lu['status_pickup'] == 1) : ?>
                                             <td><button type="button" class="btn btn-warning btn-sm btn-block">Pending</button></td>
                                         <?php else : ?>
                                             <td><button type="button" class="btn btn-success btn-sm btn-block">Picked Up</button></td>
                                         <?php endif; ?>
                                         <!-- <td><button class="tombol-edit btn btn-info btn-block btn-sm" data-id="<?php echo $lu['id_order']; ?>" data-toggle="modal" data-target="#edit-user">Edit</button></td> -->
                                     </tr>
                                 <?php endforeach; ?>
                             </tbody>
                         </table>
                     </div>
                     <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>

                 </div>
             </div>
         </div>
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