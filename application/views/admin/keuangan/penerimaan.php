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

                     </div>
                     <div class="card-body">
                         <div class="row">
                             <div class="col-md-6">
                                 <div class="table-responsive">
                                     <h5><?php echo $title; ?> Dari Transaksi Berat (Kg)</h5>
                                     <div class="mb-2 font-weight-bolder">Total Penerimaan Bulan ini : Rp. <?php echo rupiah($uang_jarak); ?></div>
                                     <table class=" table table-bordered table-hover" id="table-id" style="font-size:14px;">
                                         <thead>
                                             <th>#</th>
                                             <th>Kode Order</th>
                                             <th>Tgl Order</th>
                                             <th>Nominal Harga</th>
                                             <th>Total Bayar</th>
                                         </thead>
                                         <tbody>
                                             <?php $i = 1; ?>
                                             <?php foreach ($terima_uang as $lu) : ?>
                                                 <tr>
                                                     <td><?php echo $i++; ?></td>
                                                     <td><?php echo $lu['transaksi_kode']; ?></td>
                                                     <td><?php echo $lu['tgl_transaksi']; ?></td>
                                                     <td>Rp. <?php echo rupiah($lu['nominal']); ?></td>
                                                     <td>Rp. <?php echo rupiah($lu['pembayaran']); ?></td>
                                                 </tr>
                                             <?php endforeach; ?>
                                         </tbody>
                                     </table>
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="table-responsive">
                                     <h5><?php echo $title; ?> Dari Transaksi Volume (M<sup>3</sup>)</h5>
                                     <div class="mb-2 font-weight-bolder">Total Penerimaan Bulan ini : Rp. <?php echo rupiah($uang_volume); ?></div>
                                     <table class=" table table-bordered table-hover" id="id-table" style="font-size:14px;">
                                         <thead>
                                             <th>#</th>
                                             <th>Kode Order</th>
                                             <th>Tgl Order</th>
                                             <th>Nominal Harga</th>
                                             <th>Total Bayar</th>
                                         </thead>
                                         <tbody>
                                             <?php $i = 1; ?>
                                             <?php foreach ($terima_volume as $lu) : ?>
                                                 <tr>
                                                     <td><?php echo $i++; ?></td>
                                                     <td><?php echo $lu['transaksi_kode']; ?></td>
                                                     <td><?php echo $lu['tgl_transaksi']; ?></td>
                                                     <td>Rp. <?php echo rupiah($lu['nominal']); ?></td>
                                                     <td>Rp. <?php echo rupiah($lu['pembayaran']); ?></td>
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
 </div>
 <!-- /.content-wrapper -->