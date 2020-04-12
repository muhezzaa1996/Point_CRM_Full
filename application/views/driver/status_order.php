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
                             Status Terkirim
                         </button>
                     </div>
                     <div class="card-body">
                         <div class="row">
                             <div class="col-md-12">
                                 <div class="table-responsive">
                                     <table class=" table table-bordered table-hover" id="table-data" style="font-size:14px;">
                                         <thead>
                                             <th>#</th>
                                             <th>Kode Order</th>
                                             <th>Pengirim</th>
                                             <th>Alamat</th>
                                             <th>Penerima</th>
                                             <th>Alamat</th>
                                             <th>Status Kirim</th>
                                             <th>Konfirmasi</th>
                                         </thead>
                                         <tbody>
                                             <?php $i = 1; ?>
                                             <?php foreach ($pickup as $lu) : ?>
                                                 <tr>
                                                     <td><?php echo $i++; ?></td>
                                                     <td><?php echo $lu['kode_order']; ?></td>
                                                     <td><?php echo $lu['nama_pengirim']; ?></td>
                                                     <td><?php echo $lu['alamat_pengirim']; ?></td>
                                                     <td><?php echo $lu['nama_penerima']; ?></td>
                                                     <td><?php echo $lu['alamat_penerima']; ?></td>
                                                     <?php if ($lu['sukses'] == 1) : ?>
                                                         <td><button type="button" class="btn btn-warning btn-sm btn-block">Pending</button></td>
                                                     <?php else : ?>
                                                         <td><button type="button" class="btn btn-success btn-sm btn-block">Sukses</button></td>
                                                     <?php endif; ?>
                                                     <?php if ($lu['status_pickup'] == 1) : ?>
                                                         <td><button type="button" class="btn btn-warning btn-sm btn-block">Pending</button></td>
                                                     <?php else : ?>
                                                         <td><button class="tombol-edit btn btn-info btn-block btn-sm" data-id="<?php echo $lu['id_order']; ?>" data-toggle="modal" data-target="#edit-user">Konfirmasi</button></td>
                                                     <?php endif; ?>
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


 <div class="modal fade" id="edit-user">
     <div class="modal-dialog modal-sm">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title">Konfirmasi Terkirim</h4>
             </div>
             <div class="modal-body">
                 <div class="box-body">
                     <form action="<?php echo base_url('driver/update_kirim'); ?>" method="post">
                         <div class="form-group">
                             <label>Kode Order</label>
                             <input type="hidden" name="id_order" id="id_order">
                             <input type="hidden" name="id_pickup" id="id_pickup">
                             <input type="text" class="form-control form-control-sm" name="order_kd" id="kode_order" readonly>
                         </div>
                         <div class="form-group">
                             <label>Tgl Kirim</label>
                             <input type="date" class="form-control form-control-sm" name="tgl_kirim" value="<?php echo date('Y-m-d'); ?>" readonly>
                         </div>
                         <div class="box-footer">
                             <button type="submit" class="btn btn-primary pull-right">Simpan Konfirmasi</button>
                             <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
 </div>


 <!-- Modal -->
 <div class="modal fade" id="add-user">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title">Status Kirim Sukses</h4>
             </div>
             <div class="modal-body">
                 <div class="box-body">
                     <div class="table-responsive">
                         <table class=" table table-bordered table-hover" id="data-table" style="font-size:14px;">
                             <thead>
                                 <th>#</th>
                                 <th>Kode Order</th>
                                 <th>Pengirim</th>
                                 <th>Alamat</th>
                                 <th>Penerima</th>
                                 <th>Alamat</th>
                                 <th>Status Kirim</th>
                             </thead>
                             <tbody>
                                 <?php $i = 1; ?>
                                 <?php foreach ($kirim as $lu) : ?>
                                     <tr>
                                         <td><?php echo $i++; ?></td>
                                         <td><?php echo $lu['kode_order']; ?></td>
                                         <td><?php echo $lu['nama_pengirim']; ?></td>
                                         <td><?php echo $lu['alamat_pengirim']; ?></td>
                                         <td><?php echo $lu['nama_penerima']; ?></td>
                                         <td><?php echo $lu['alamat_penerima']; ?></td>
                                         <?php if ($lu['sukses'] == 1) : ?>
                                             <td><button type="button" class="btn btn-warning btn-sm btn-block">Pending</button></td>
                                         <?php else : ?>
                                             <td><button type="button" class="btn btn-success btn-sm btn-block">Sukses</button></td>
                                         <?php endif; ?>
                                     </tr>
                                 <?php endforeach; ?>
                             </tbody>
                         </table>
                     </div>
                     <hr>
                     <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                 </div>
             </div>
             <!-- /.modal-content -->
         </div>
         <!-- /.modal-dialog -->
     </div>
 </div>






 <script>
     $('.tombol-edit').on('click', function() {
         const id_order = $(this).data('id');
         $.ajax({
             url: '<?php echo base_url('driver/get_kirim'); ?>',
             data: {
                 id_order: id_order
             },
             method: 'post',
             dataType: 'json',
             success: function(data) {
                 $('#kode_order').val(data.kode_order);
                 $('#id_pickup').val(data.id_pickup);
                 $('#id_order').val(data.id_order);
             }
         });
     });
 </script>