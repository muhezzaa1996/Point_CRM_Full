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
                            Tambah Project
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-hover" id="table-data" style="font-size:14px;">
                                <thead>
                                    <th>#</th>
                                    <th># Job</th>
                                    <th>Nama Project</th>
                                    <th>Customer</th>
                                    <th>Comp</th>
                                    <th>Nilai Project</th>
                                    <th>Peluang</th>
                                    <th>Sales</th>
                                    <th>Keterangan</th>
                                    <th>1</th>
                                    <th>2</th>
                                    <th>3</th>
                                    <!-- <th>4</th>
                                    <th>5</th> -->
                                    <th>6</th>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($project as $pro) : ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $pro['no_job']; ?></td>
                                            <td><?php echo $pro['nama_project']; ?></td>
                                            <td><?php echo $pro['nama_cust']; ?> </td>
                                            <td><?php echo $pro['perusahaan']; ?> </td>
                                            <td>Rp <?php echo rupiah($pro['nilai_project']); ?></td>
                                            <td><?php echo $pro['peluang'];?> %</td>
                                            <td><?php echo $pro['sales1']; ?> </td>
                                            <td><?php echo $pro['keterangan']; ?></td>
                                            <td>
                                            <button class="tombol-edit btn btn-info btn-block btn-sm" data-id="<?php echo $pro['id_project']; ?>" data-toggle="modal" data-placement="bottom" data-target="#edit-user" data-toggle ="tooltip" title="Edit"><i class="nav-icon fas fa-pencil-alt"></i></button> </td>

                                            <td><a href="<?php echo base_url('admin/del_project/') . $pro['id_project']; ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus" class="tombol-hapus btn-danger btn-block btn-sm"><i class="nav-icon fas fa-trash"></i></a> </td>
                                            
                                            <td><button class="tombol-log btn btn-warning btn-block btn-sm"  data-toggle="modal" data-placement="bottom" data-target="#log-user-<?php echo $pro['no_job']; ?>" data-toggle ="tooltip" title="Log"><i class="nav-icon fas fa-cog"></i></button></td>

                                            <td><button class="tombol-cp btn btn-info btn-block btn-sm" data-id="<?php echo $pro['id_project']; ?>" data-toggle="modal" data-placement="bottom" data-target="#cp-user" data-toggle ="tooltip" title="Edit"><i class="nav-icon fas fa-percent"></i></button> </td>
                                            
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
                <h4 class="modal-title">Tambah Project</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('admin/pra_project'); ?>" method="post" id="form_id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tgl. Pra Project</label>
                                    <input type="date" class="form-control tgl_project" name="tgl_project" required>
                                </div>
                            </div>   
                            <div class="col-md-6"> 
                                <div class="form-group"> 
                                    <label>Nomor Job</label>
                                    <!-- <input type="number" class="form-control form-control-sm" name="id_project"  hidden> -->
                                    <input type="text" class="form-control no_job" name="no_job" value="<?php echo $no_job; ?>" readonly>    
                                </div>
                            </div>    
                        </div>    
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kode_customer">Customer</label> <!-- kode_customer ini diambil dari js id kode_customer yg isinya dari kolom kode_customer di db -->                          
                                    <select class="form-control customer" name="kode_customer"  required>
                                        <option value="">- Pilih Customer -</option>
                                        <!-- $kustomer ini diambil dari  query di controller pra_project -->
                                        <?php foreach ($kustomer as $t) : ?>
                                            <option value="<?php echo $t['kode_cust']; ?>"><?php echo $t['nama_cust']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="perusahaan">Perusahaan </label>
                                    <select class="form-control perusahaan" name="perusahaan"  required>
                                        <option value="">- Pilih Perusahaan -</option>
                                        <?php foreach ($kompany as $t) : ?>
                                            <option value="<?php echo $t['kode_comp']; ?>"><?php echo $t['nama_comp']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>    
                        </div>
                        <div class="form-group">
                            <label>Nama Project </label>
                            <input type="text" class="form-control nama_project" name="nama_project" autocomplete= "off" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nilai Project </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="text" class="form-control uang" autocomplete= "off" name="nilai_projectTambah" id="nilai_projectTambah" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">                                                    
                                <div class="form-group">
                                    <label for="peluang">Peluang</label>
                                    <select class="form-control peluang" name="peluang" required>
                                        <option value="">- Pilih Peluang -</option>
                                        <option value="10">10 %</option>
                                        <option value="25">25 %</option>
                                        <option value="50">50 %</option>
                                        <option value="100">100 %</option>
                                    </select>                                
                                </div>
                            </div>    
                        </div>    
                        <div class="row">
                            <div class="col-md-3">            
                                <div class="form-group">
                                    
                                    <!-- <label>Sales 1 </label>
                                    <input type="text" class="form-control form-control-sm" name="sales1" > -->
                                       
                                    <label for="sales1">Sales 1</label>                   
                                    <select class="form-control sales1" name="sales1" >
                                        <option value="N/A">N/A</option>
                                        <?php foreach ($sales as $t) : ?>
                                            <option value="<?php echo $t['kode_sales']; ?>"><?php echo $t['kode_sales']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-3">    
                                <div class="form-group"> 
                                    <!--
                                    <label>Sales 2 </label>
                                    <input type="text" class="form-control form-control-sm" name="sales2" >
                                        -->
                                    <label for="sales2">Sales 2</label>                   
                                    <select class="form-control sales2" name="sales2" >
                                        <option value="N/A">N/A</option>
                                        <?php foreach ($sales as $t) : ?>
                                            <option value="<?php echo $t['kode_sales']; ?>"><?php echo $t['kode_sales']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>
                            </div>    
                      
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sales3">Sales 3</label>                   
                                    <select class="form-control sales3" name="sales3" >
                                        <option value="N/A">N/A</option>
                                        <?php foreach ($sales as $t) : ?>
                                            <option value="<?php echo $t['kode_sales']; ?>"><?php echo $t['kode_sales']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-3">    
                                <div class="form-group">
                                    <!--
                                    <label>Sales 4 </label>
                                    <input type="text" class="form-control form-control-sm" name="sales4" >
                                        -->
                                    <label for="sales4">Sales 4</label>                   
                                    <select class="form-control sales4" name="sales4" >
                                        <option value="N/A">N/A</option>
                                        <?php foreach ($sales as $t) : ?>
                                            <option value="<?php echo $t['kode_sales']; ?>"><?php echo $t['kode_sales']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>
                            </div>    
                        </div>
                            <div class="form-group">
                                <label>Keterangan Project </label>
                                <input type="text" class="form-control keterangan" name="keterangan" autocomplete= "off" required>
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

<div class="modal fade" id="edit-user">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit project </h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('admin/edit_project'); ?>" method="post" id="form_id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Tgl. Project </label>
                                    <input type="text" class="form-control id_project" name="id_project" id="id_project" hidden>
                                    <input type="date" class="form-control tgl_project" name="tgl_project" id="tgl_project" required>
                                </div>
                            </div>
                            <div class="col-md-6">    
                                <div class="form-group">
                                    <label> Nomor Job </label>
                                    <input type="text" class="form-control no_job" name="no_job" id="no_job" readonly>
                                </div>            
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kode_customer">Customer</label>                           
                                    <select class="form-control customer" name="kode_customer" id="kode_customer" required>
                                        <option value="">- Pilih Customer -</option>
                                        <?php foreach ($kustomer as $t) : ?>
                                            <option value="<?php echo $t['kode_cust']; ?>"><?php echo $t['nama_cust']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">      
                                    <label for="perusahaan">Perusahaan</label>                   
                                    <select class="form-control perusahaan" name="perusahaan" id="perusahaan" >
                                        <option value="">- Pilih Perusahaan -</option>
                                        <?php foreach ($kompany as $t) : ?>
                                            <option value="<?php echo $t['kode_comp']; ?>"><?php echo $t['nama_comp']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>             
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Nama Project</label>
                            <input type="text" class="form-control nama_project" name="nama_project" id="nama_project" autocomplete= "off" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                     <label> Nilai Project </label>
                                     <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="text" class="form-control uang" autocomplete= "off" name="nilai_projectEdit" id="nilai_projectEdit" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="peluang">Peluang</label>
                                    <select class="form-control peluang" name="peluang"  id="peluang" required>
                                        <option value="">- Pilih Peluang -</option>
                                        <option value="10">10 %</option>
                                        <option value="25">25 %</option>
                                        <option value="50">50 %</option>
                                        <option value="100">100 %</option>
                                    </select>                                 
                                </div>
                            </div>
                        </div>      


                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sales1">Sales 1</label>                   
                                    <select class="form-control sales1" name="sales1" id="sales1" >
                                        <option value="N/A">N/A</option>
                                        <?php foreach ($sales as $t) : ?>
                                            <option value="<?php echo $t['kode_sales']; ?>"><?php echo $t['kode_sales']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sales2">Sales 2</label>                   
                                    <select class="form-control sales2" name="sales2" id="sales2" >
                                        <option value="N/A">N/A</option>
                                        <?php foreach ($sales as $t) : ?>
                                            <option value="<?php echo $t['kode_sales']; ?>"><?php echo $t['kode_sales']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sales3">Sales 3</label>                   
                                    <select class="form-control sales3" name="sales3" id="sales3" >
                                        <option value="N/A">N/A</option>
                                        <?php foreach ($sales as $t) : ?>
                                            <option value="<?php echo $t['kode_sales']; ?>"><?php echo $t['kode_sales']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>
            
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sales4">Sales 4</label>                   
                                    <select class="form-control sales4" name="sales4" id="sales4" >
                                        <option value="N/A">N/A</option>
                                        <?php foreach ($sales as $t) : ?>
                                            <option value="<?php echo $t['kode_sales']; ?>"><?php echo $t['kode_sales']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <label>Keterangan </label>
                            <input type="text" class="form-control keterangan" name="keterangan" id="keterangan" autocomplete= "off" required>
                        </div>

                        <div class="form-group">
                            <label>Alasan Perubahan </label>
                            <input type="text" class="form-control alasan" name="alasan" id="alasan" autocomplete= "off" required>
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

<?php foreach ($project as $row) : ?>
<div class="modal fade" id="log-user-<?=$row['no_job'];?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Data Log</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="id-table2 table table-bordered table-hover" style="font-size: 14px;">
                            <thead>
                                <th>No</th>
                                <th>Kode Project</th>
                                <th>Nama Project</th>
                                <th>Status Log</th>
                                <th>Tanggal Update Log</th>
                                <th>Username</th>
                                <th>View</th>
                            </thead>
                            <tbody>
                                <?php 
                                $no_job = $row['no_job'];
                                $data_log1 = $this->db->get_where('log_project', ['no_job' => $no_job])->result_array(); ?>
                                <!-- <?php var_dump($data_log1) ?> -->
                                <?php $no=1; foreach($data_log1 as $log): ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $log['no_job']; ?></td>
                                    <td><?php echo $log['nama_project']; ?></td>
                                    <td>
                                        <?php if($log['status'] == 1){
                                            echo "Data Project & Data Cashflow Telah Ditambahkan";

                                        }else if($log['status'] == 2){
                                            echo "Data Project Telah Diperbarui";

                                        }else if ($log['status'] == 3){
                                            echo "Data Project & Data Cashflow Telah Dihapus";

                                        }else if ($log['status'] == 4){
                                            echo "Data Cashflow Telah Diperbarui";
                                    }  ?>
                                        
                                    </td>

                                    <td><?php echo $log['tgl_update']; ?></td>
                                    <td><?php echo $log['username']; ?></td>
                                    <td><button class="tombol-view btn btn-info btn-block btn-sm" data-id="<?php echo $log['id_log']; ?>" data-toggle="modal" data-target="#view-user">View</button></td>
                                    <!-- <?php var_dump($log['id_log']); ?> -->
                                </tr>
                               <?php endforeach; ?>
                                
                            </tbody>
                        </table>
                        <div class="box-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<div class="modal fade" id="view-user">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">View Detail Log Project </h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Tgl. Project </label>
                                    <input type="text" class="form-control form-control-sm" name="id_projectLog" id="id_projectLog" hidden>
                                    <input type="date" class="form-control form-control-sm" name="tgl_projectLog" id="tgl_projectLog" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">    
                                <div class="form-group">
                                    <label> Nomor Job </label>
                                    <input type="text" class="form-control form-control-sm" name="no_jobLog" id="no_jobLog" readonly>
                                </div>            
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kode_customer">Customer</label>                           
                                    <select class="form-control form-control-sm" name="kode_customerLog" id="kode_customerLog" required disabled>
                                        <option value="">- Pilih Customer -</option>
                                        <?php foreach ($kustomer as $t) : ?>
                                            <option value="<?php echo $t['kode_cust']; ?>"><?php echo $t['nama_cust']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">           
                                    <label for="perusahaan">Perusahaan</label>                   
                                    <select class="form-control form-control-sm" name="perusahaanLog" id="perusahaanLog" disabled>
                                        <option value="">- Pilih Perusahaan -</option>
                                        <?php foreach ($kompany as $t) : ?>
                                            <option value="<?php echo $t['kode_comp']; ?>"><?php echo $t['nama_comp']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                                   
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Nama Project</label>
                            <input type="text" class="form-control form-control-sm" name="nama_projectLog" id="nama_projectLog" requried readonly>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                     <label> Nilai Project </label>
                                     <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="text" class="form-control uang" name="nilai_projectLog" id="nilai_projectLog" required readonly>
                                    </div>      
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="peluang">Peluang</label>
                                    <select class="form-control form-control-sm" name="peluangLog"  id="peluangLog" required disabled>
                                        <option value="">- Pilih Peluang -</option>
                                        <option value="10">10 %</option>
                                        <option value="25">25 %</option>
                                        <option value="50">50 %</option>
                                        <option value="100">100 %</option>
                                    </select>                                 
                                </div>
                            </div>
                        </div>      


                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <!--
                                    <label>Sales 1</label>
                                    <input type="text" class="form-control form-control-sm" name="sales1" id="sales1" > -->
                                    <label for="sales1">Sales 1</label>                   
                                    <select class="form-control form-control-sm" name="sales1Log" id="sales1Log" readonly>
                                        <option value="N/A">N/A</option>
                                        <?php foreach ($sales as $t) : ?>
                                            <option value="<?php echo $t['kode_sales']; ?>"><?php echo $t['kode_sales']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <!--
                                    <label>Sales 2</label>
                                    <input type="text" class="form-control form-control-sm" name="sales2" id="sales2">
                                        -->
                                    <label for="sales2">Sales 2</label>                   
                                    <select class="form-control form-control-sm" name="sales2Log" id="sales2Log" readonly>
                                        <option value="N/A">N/A</option>
                                        <?php foreach ($sales as $t) : ?>
                                            <option value="<?php echo $t['kode_sales']; ?>"><?php echo $t['kode_sales']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <!--
                                    <label>sales 3</label>
                                    <input type="text" class="form-control form-control-sm" name="sales3" id="sales3">
                                    -->
                                    <label for="sales3">Sales 2</label>                   
                                    <select class="form-control form-control-sm" name="sales3Log" id="sales3Log" readonly>
                                        <option value="N/A">N/A</option>
                                        <?php foreach ($sales as $t) : ?>
                                            <option value="<?php echo $t['kode_sales']; ?>"><?php echo $t['kode_sales']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>
            
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <!--
                                    <label>Sales 4</label>
                                    <input type="text" class="form-control form-control-sm" name="sales4" id="sales4">
                                        -->
                                    <label for="sales4">Sales 4</label>                   
                                    <select class="form-control form-control-sm" name="sales4Log" id="sales4Log" readonly>
                                        <option value="N/A">N/A</option>
                                        <?php foreach ($sales as $t) : ?>
                                            <option value="<?php echo $t['kode_sales']; ?>"><?php echo $t['kode_sales']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <label>Keterangan </label>
                            <input type="text" class="form-control form-control-sm" name="keterangan2Log" id="keteranganLog" required readonly>
                        </div>

                         <div class="form-group">
                            <label>Alasan Perubahan </label>
                            <input type="text" class="form-control form-control-sm" name="alasanLog" id="alasanLog" required readonly>
                        </div>
                    
                        <div class="box-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>

<!-- Modal Cashflow -->
<div class="modal fade" id="cp-user">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cashflow Project</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('admin/edit_cashflow_project'); ?>" method="post" id="form_id">
                        <div class="row">
                            <div class="col-md-6">    
                                <div class="form-group">
                                    <label> Nomor Job </label>
                                    <input type="text" class="form-control form-control-sm" name="id_project_cp" id="id_project_cp" hidden readonly>
                                    <input type="text" class="form-control form-control-sm" name="id_cashflow_cp" id="id_cashflow_cp" hidden readonly>
                                    <input type="text" class="form-control form-control-sm" name="no_job_cp" id="no_job_cp" readonly>
                                </div>            
                            </div>
                            <div class="col-md-6">    
                                <div class="form-group">
                                    <label> Nama Project </label>
                                    <input type="text" class="form-control form-control-sm" name="nama_project_cp" id="nama_project_cp" readonly>
                                </div>            
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">    
                                <div class="form-group">
                                    <label> Nama Customer </label>
                                    <input type="text" class="form-control form-control-sm" name="customer_cp" id="customer_cp" readonly>
                                </div>            
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Nama Sales </label>
                                    <input type="text" class="form-control form-control-sm" name="sales1_cp" id="sales1_cp" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Tanggal Project </label>
                                    <input type="date" class="form-control form-control-sm" name="tgl_project_cp" id="tgl_project_cp" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- Baris Januari -->
                        <div class="row">
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <label> Bulan </label>
                                    <input type="text" class="form-control form-control-sm" value="Januari" name="januari" id="januari" readonly>
                                </div>            
                            </div>
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <label> Revenue </label>
                                    <!-- <input type="hidden" class="form-control form-control-sm" name="H01" id="H01"> -->
                                    <input type="text" class="form-control form-control-sm" name="R01" id="R01" value= "" >
                                </div>            
                            </div>
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <label> Expense </label>
                                    <input type="text" class="form-control form-control-sm" name="E01" id="E01" value="" >
                                </div>            
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label> Instalasi </label>
                                    <input type="text" class="form-control form-control-sm" name="I01" id="I01" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label> Differensial </label>
                                    <input type="text" class="form-control form-control-sm" name="D01" id="D01" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label> Margin </label>
                                    <input type="text" class="form-control form-control-sm" name="M01" id="M01" value="" readonly>
                                </div>
                            </div>
                        </div>
                        <!-- Baris Februari -->
                        <div class="row">
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" value="Februari" name="februari" id="februari" readonly>
                                </div>            
                            </div>
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="R02" id="R02" value="">
                                </div>            
                            </div>
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="E02" id="E02" value="">
                                </div>            
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="I02" id="I02" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="D02" id="D02" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="M02" id="M02" value="" readonly>
                                </div>
                            </div>
                        </div>
                        <!-- Baris Maret -->
                        <div class="row">
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" value="Maret" name="maret" id="maret" readonly>
                                </div>            
                            </div>
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="R03" id="R03" value="">
                                </div>            
                            </div>
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="E03" id="E03" value="">
                                </div>            
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="I03" id="I03" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="D03" id="D03" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="M03" id="M03" value="" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- Baris April -->
                        <div class="row">
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" value="April" name="april" id="april" readonly>
                                </div>            
                            </div>
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="R04" id="R04" value="">
                                </div>            
                            </div>
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="E04" id="E04" value="">
                                </div>            
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="I04" id="I04" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="D04" id="D04" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="M04" id="M04" value="" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- Baris Mei -->
                        <div class="row">
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" value="Mei" name="mei" id="mei" readonly>
                                </div>            
                            </div>
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="R05" id="R05" value="">
                                </div>            
                            </div>
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="E05" id="E05" value="">
                                </div>            
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="I05" id="I05" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="D05" id="D05" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="M05" id="M05" value="" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- Baris Juni -->
                        <div class="row">
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" value="Juni" name="juni" id="juni" readonly>
                                </div>            
                            </div>
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="R06" id="R06" value="">
                                </div>            
                            </div>
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="E06" id="E06" value="">
                                </div>            
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="I06" id="I06" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="D06" id="D06" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="M06" id="M06" value="" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- Baris Juli -->
                        <div class="row">
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" value="Juli" name="juli" id="juli" readonly>
                                </div>            
                            </div>
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="R07" id="R07" value="">
                                </div>            
                            </div>
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="E07" id="E07" value="">
                                </div>            
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="I07" id="I07" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="D07" id="D07" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="M07" id="M07" value="" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- Baris Agustus -->
                        <div class="row">
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" value="Agustus" name="agustus" id="agustus" readonly>
                                </div>            
                            </div>
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="R08" id="R08" value="">
                                </div>            
                            </div>
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="E08" id="E08" value="">
                                </div>            
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="I08" id="I08" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="D08" id="D08" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="M08" id="M08" value="" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- Baris September -->
                        <div class="row">
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" value="September" name="september" id="september" readonly>
                                </div>            
                            </div>
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="R09" id="R09" value="">
                                </div>            
                            </div>
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="E09" id="E09" value="">
                                </div>            
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="I09" id="I09" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="D09" id="D09" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="M09" id="M09"  value="" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- Baris Oktober -->
                        <div class="row">
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" value="Oktober" name="oktober" id="oktober" readonly>
                                </div>            
                            </div>
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="R10" id="R10" value="">
                                </div>            
                            </div>
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="E10" id="E10" value="">
                                </div>            
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="I10" id="I10" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="D10" id="D10" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="M10" id="M10" value="" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- Baris November -->
                        <div class="row">
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" value="November" name="november" id="november" readonly>
                                </div>            
                            </div>
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="R11" id="R11" value="">
                                </div>            
                            </div>
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="E11" id="E11" value="">
                                </div>            
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="I11" id="I11" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="D11" id="D11" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="M11" id="M11" value="" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- Baris Desember -->
                        <div class="row">
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" value="Desember" name="desember" id="desember" readonly>
                                </div>            
                            </div>
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="R12" id="R12" value="">
                                </div>            
                            </div>
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="E12" id="E12" value="">
                                </div>            
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="I12" id="I12" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="D12" id="D12" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="M12" id="M12" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- Baris Total -->                        
                        <div class="row">
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" value="TOTAL" name="total" id="total" readonly>
                                </div>            
                            </div>
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="TR" id="TR" value="" readonly>
                                </div>            
                            </div>
                            <div class="col-md-2">    
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="TE" id="TE" value="" readonly>
                                </div>            
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="TI" id="TI" value="" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="TD" id="TD" value="" readonly>
                                </div>
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
    $('.tombol-edit').on('click', function() {
        const id_project = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('admin/get_project'); ?>',
            data: {
                id_project: id_project
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#tgl_project').val(data.tgl_project);
                $('#no_job').val(data.no_job);
                $('#id_project').val(data.id_project);
                $('#kode_customer').val(data.kode_customer);
                $('#nama_project').val(data.nama_project);
                $('#nilai_projectEdit').val(data.snilai_project);
                $('#peluang').val(data.peluang);
                $('#sales1').val(data.sales1);
                $('#sales2').val(data.sales2);
                $('#sales3').val(data.sales3);
                $('#sales4').val(data.sales4);
                $('#keterangan').val(data.keterangan);
                $('#perusahaan').val(data.perusahaan);
                $('#alasan').val(data.alasan);

            }
        });
    });
</script>

<script>
    $('.tombol-log').on('click', function() {
        // $('[data-toggle="modal"]').tooltip();
        const no_job = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('admin/get_log'); ?>',
            data: {
                no_job: no_job
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('.id-table').html(data);

            }
        });
    });

    $(function() {
        $('.id-table2').DataTable({
        });
    });
</script>

<script>
    $('.tombol-view').on('click', function() {
        const id_log = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('admin/get_log'); ?>',
            data: {
                id_log: id_log
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#tgl_projectLog').val(data.tgl_project);
                $('#no_jobLog').val(data.no_job);
                $('#id_projectLog').val(data.id_project);
                $('#kode_customerLog').val(data.kode_customer);
                $('#nama_projectLog').val(data.nama_project);
                $('#nilai_projectLog').val(data.snilai_project);
                $('#peluangLog').val(data.peluang);
                $('#sales1Log').val(data.sales1);
                $('#sales2Log').val(data.sales2);
                $('#sales3Log').val(data.sales3);
                $('#sales4Log').val(data.sales4);
                $('#keteranganLog').val(data.keterangan);
                $('#perusahaanLog').val(data.perusahaan);
                $('#alasanLog').val(data.alasan);

            }
        });
    });
</script>

<!-- Cashflow -->
<script>
    $('.tombol-cp').on('click', function() {
        const id_project = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url('admin/get_cashflow_project'); ?>',
            data: {
                id_projectResult: id_project
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {

                $('#nama_project_cp').val(data.nama_project);
                $('#no_job_cp').val(data.no_job);
                $('#sales1_cp').val(data.sales1);
                $('#tgl_project_cp').val(data.tgl_project);
                $('#customer_cp').val(data.nama_cust);
                $('#id_project_cp').val(data.id_project);
                $('#id_cashflow_cp').val(data.id_cashflow);

                // Buat nampilin data revenue, expense, inst, diff dari db
                $('#R01').val(data.sr01);   $('#E01').val(data.se01); 
                $('#R02').val(data.sr02);   $('#E02').val(data.se02);
                $('#R03').val(data.sr03);   $('#E03').val(data.se03);
                $('#R04').val(data.sr04);   $('#E04').val(data.se04);
                $('#R05').val(data.sr05);   $('#E05').val(data.se05);
                $('#R06').val(data.sr06);   $('#E06').val(data.se06);
                $('#R07').val(data.sr07);   $('#E07').val(data.se07);
                $('#R08').val(data.sr08);   $('#E08').val(data.se08);
                $('#R09').val(data.sr09);   $('#E09').val(data.se09);
                $('#R10').val(data.sr10);   $('#E10').val(data.se10);
                $('#R11').val(data.sr11);   $('#E11').val(data.se11);
                $('#R12').val(data.sr12);   $('#E12').val(data.se12);

                $('#I01').val(data.si01);   $('#D01').val(data.sd01); 
                $('#I02').val(data.si02);   $('#D02').val(data.sd02);
                $('#I03').val(data.si03);   $('#D03').val(data.sd03);
                $('#I04').val(data.si04);   $('#D04').val(data.sd04);
                $('#I05').val(data.si05);   $('#D05').val(data.sd05);
                $('#I06').val(data.si06);   $('#D06').val(data.sd06);
                $('#I07').val(data.si07);   $('#D07').val(data.sd07);
                $('#I08').val(data.si08);   $('#D08').val(data.sd08);
                $('#I09').val(data.si09);   $('#D09').val(data.sd09);
                $('#I10').val(data.si10);   $('#D10').val(data.sd10);
                $('#I11').val(data.si11);   $('#D11').val(data.sd11);
                $('#I12').val(data.si12);   $('#D12').val(data.sd12);

                //Buat nampilin nilai total margin dari database
                $('#M01').val(data.sm01);
                $('#M02').val(data.sm02);
                $('#M03').val(data.sm03);
                $('#M04').val(data.sm04);
                $('#M05').val(data.sm05);
                $('#M06').val(data.sm06);
                $('#M07').val(data.sm07);
                $('#M08').val(data.sm08);
                $('#M09').val(data.sm09);
                $('#M10').val(data.sm10);
                $('#M11').val(data.sm11);
                $('#M12').val(data.sm12);

                //Buat nampilin nilai total revenue, exp, inst, diff dari db
                $('#TR').val(data.stotal_revenue);
                $('#TE').val(data.stotal_expense);
                $('#TI').val(data.stotal_instalasi);
                $('#TD').val(data.stotal_differensial);
            }
        });
    });
</script> 

<!-- Fungsi untuk mengembalikan tampilan integer menjadi string atau menjadi ada titiknya -->
<script>
    function numberWithCommas(x) {

        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
</script>

<!-- Tampilan untuk merubah dari yg tadinya titik/string jadi bentuk integer -->
<script>
    function angkaAbc(x){
        var str1 = x;
        var str2 = str1.replace(/[.](?=.*?\.)/g, '');
        var hasil = parseFloat(str2.replace(/[^0-9]/g,'')); 
        return hasil;
    }
</script>

<!-- Fungsi Menampilkan format rupiah -->
<script type="text/javascript">

        //===================== REVENUE ====================//
        var r01 = document.getElementById('R01'); 
        r01.addEventListener('keyup', function(e){
            r01.value = formatRupiah(this.value, '');
        });

        var r02 = document.getElementById('R02');
        r02.addEventListener('keyup', function(e){
            r02.value = formatRupiah(this.value, '');
        }); 

        var r03 = document.getElementById('R03');
        r03.addEventListener('keyup', function(e){
            r03.value = formatRupiah(this.value, '');
        });

        var r04 = document.getElementById('R04');
        r04.addEventListener('keyup', function(e){
            r04.value = formatRupiah(this.value, '');
        });  

        var r05 = document.getElementById('R05');
        r05.addEventListener('keyup', function(e){
            r05.value = formatRupiah(this.value, '');
        });

        var r06 = document.getElementById('R06');
        r06.addEventListener('keyup', function(e){
            r06.value = formatRupiah(this.value, '');
        });

        var r07 = document.getElementById('R07');
        r07.addEventListener('keyup', function(e){
            r07.value = formatRupiah(this.value, '');
        });

        var r08 = document.getElementById('R08');
        r08.addEventListener('keyup', function(e){
            r08.value = formatRupiah(this.value, '');
        });

        var r09 = document.getElementById('R09');
        r09.addEventListener('keyup', function(e){
            r09.value = formatRupiah(this.value, '');
        }); 

        var r10 = document.getElementById('R10');
        r10.addEventListener('keyup', function(e){
            r10.value = formatRupiah(this.value, '');
        }); 

        var r11 = document.getElementById('R11');
        r11.addEventListener('keyup', function(e){
            r11.value = formatRupiah(this.value, '');
        });

        var r12 = document.getElementById('R12');
        r12.addEventListener('keyup', function(e){
            r12.value = formatRupiah(this.value, '');
        });

        //===================== EXPENSE ====================//
        var e01 = document.getElementById('E01');    
        e01.addEventListener('keyup', function(e){
            e01.value = formatRupiah(this.value, '');
        });

        var e02 = document.getElementById('E02');
        e02.addEventListener('keyup', function(e){
            e02.value = formatRupiah(this.value, '');
        }); 

        var e03 = document.getElementById('E03');
        e03.addEventListener('keyup', function(e){
            e03.value = formatRupiah(this.value, '');
        });

        var e04 = document.getElementById('E04');
        e04.addEventListener('keyup', function(e){
            e04.value = formatRupiah(this.value, '');
        });  

        var e05 = document.getElementById('E05');
        e05.addEventListener('keyup', function(e){
            e05.value = formatRupiah(this.value, '');
        });

        var e06 = document.getElementById('E06');
        e06.addEventListener('keyup', function(e){
            e06.value = formatRupiah(this.value, '');
        });

        var e07 = document.getElementById('E07');
        e07.addEventListener('keyup', function(e){
            e07.value = formatRupiah(this.value, '');
        });

        var e08 = document.getElementById('E08');
        e08.addEventListener('keyup', function(e){
            e08.value = formatRupiah(this.value, '');
        });

        var e09 = document.getElementById('E09');
        e09.addEventListener('keyup', function(e){
            e09.value = formatRupiah(this.value, '');
        }); 

        var e10 = document.getElementById('E10');
        e10.addEventListener('keyup', function(e){
            e10.value = formatRupiah(this.value, '');
        }); 

        var e11 = document.getElementById('E11');
        e11.addEventListener('keyup', function(e){
            e11.value = formatRupiah(this.value, '');
        });
         
        var e12 = document.getElementById('E12');
        e12.addEventListener('keyup', function(e){
            e12.value = formatRupiah(this.value, '');
        });

        //===================== INSTALASI ====================//
        var i01 = document.getElementById('I01');    
        i01.addEventListener('keyup', function(e){
            i01.value = formatRupiah(this.value, '');
        });

        var i02 = document.getElementById('I02');
        i02.addEventListener('keyup', function(e){
            i02.value = formatRupiah(this.value, '');
        }); 

        var i03 = document.getElementById('I03');
        i03.addEventListener('keyup', function(e){
            i03.value = formatRupiah(this.value, '');
        });

        var i04 = document.getElementById('I04');
        i04.addEventListener('keyup', function(e){
            i04.value = formatRupiah(this.value, '');
        });  

        var i05 = document.getElementById('I05');
        i05.addEventListener('keyup', function(e){
            i05.value = formatRupiah(this.value, '');
        });

        var i06 = document.getElementById('I06');
        i06.addEventListener('keyup', function(e){
            i06.value = formatRupiah(this.value, '');
        });

        var i07 = document.getElementById('I07');
        i07.addEventListener('keyup', function(e){
            i07.value = formatRupiah(this.value, '');
        });

        var i08 = document.getElementById('I08');
        i08.addEventListener('keyup', function(e){
            i08.value = formatRupiah(this.value, '');
        });

        var i09 = document.getElementById('I09');
        i09.addEventListener('keyup', function(e){
            i09.value = formatRupiah(this.value, '');
        }); 

        var i10 = document.getElementById('I10');
        i10.addEventListener('keyup', function(e){
            i10.value = formatRupiah(this.value, '');
        }); 

        var i11 = document.getElementById('I11');
        i11.addEventListener('keyup', function(e){
            i11.value = formatRupiah(this.value, '');
        });
         
        var i12 = document.getElementById('I12');
        i12.addEventListener('keyup', function(e){
            i12.value = formatRupiah(this.value, '');
        });

        //===================== DIFFERENSIAL ====================//
        var d01 = document.getElementById('D01');    
        d01.addEventListener('keyup', function(e){
            d01.value = formatRupiah(this.value, '');
        });

        var d02 = document.getElementById('D02');
        d02.addEventListener('keyup', function(e){
            d02.value = formatRupiah(this.value, '');
        }); 

        var d03 = document.getElementById('D03');
        d03.addEventListener('keyup', function(e){
            d03.value = formatRupiah(this.value, '');
        });

        var d04 = document.getElementById('D04');
        d04.addEventListener('keyup', function(e){
            d04.value = formatRupiah(this.value, '');
        });  

        var d05 = document.getElementById('D05');
        d05.addEventListener('keyup', function(e){
            d05.value = formatRupiah(this.value, '');
        });

        var d06 = document.getElementById('D06');
        d06.addEventListener('keyup', function(e){
            d06.value = formatRupiah(this.value, '');
        });

        var d07 = document.getElementById('D07');
        d07.addEventListener('keyup', function(e){
            d07.value = formatRupiah(this.value, '');
        });

        var d08 = document.getElementById('D08');
        d08.addEventListener('keyup', function(e){
            d08.value = formatRupiah(this.value, '');
        });

        var d09 = document.getElementById('D09');
        d09.addEventListener('keyup', function(e){
            d09.value = formatRupiah(this.value, '');
        }); 

        var d10 = document.getElementById('D10');
        d10.addEventListener('keyup', function(e){
            d10.value = formatRupiah(this.value, '');
        }); 

        var d11 = document.getElementById('D11');
        d11.addEventListener('keyup', function(e){
            d11.value = formatRupiah(this.value, '');
        });
         
        var d12 = document.getElementById('D12');
        d12.addEventListener('keyup', function(e){
            d12.value = formatRupiah(this.value, '');
        });

        // -------------- Nilai Project untuk Form Tambah Project ------- //
        var nilai_projectTambah = document.getElementById('nilai_projectTambah');
        nilai_projectTambah.addEventListener('keyup', function(e){
            nilai_projectTambah.value = formatRupiah(this.value, '');
        });


        // -------------- Nilai Project untuk Form Edit Project ------- //
        var nilai_projectEdit = document.getElementById('nilai_projectEdit');
        nilai_projectEdit.addEventListener('keyup', function(e){
            nilai_projectEdit.value = formatRupiah(this.value, '');
        });
           
        // Fungsi formatRupiah //
        function formatRupiah(angka, prefix){
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split           = number_string.split(','),
            sisa            = split[0].length % 3,
            rupiah          = split[0].substr(0, sisa),
            ribuan          = split[0].substr(sisa).match(/\d{3}/gi);
 
            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if(ribuan){
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
 
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
        }
</script>

 <!-- Fungsi Hitung Klik -->
<script type="text/javascript">
 $('document').ready(function() {
    $('#R01,#E01,#I01,#D01,#R02,#E02,#I02,#D02').each(function()   {$(this).on('change',recalculate);}
       );
    $('#R03,#E03,#I03,#D03,#R04,#E04,#I04,#D04').each(function()   {$(this).on('change',recalculate);}
       );
    $('#R05,#E05,#I05,#D05,#R06,#E06,#I06,#D06').each(function()   {$(this).on('change',recalculate);}
       );
    $('#R07,#E07,#I07,#D07,#R08,#E08,#I08,#D08').each(function()   {$(this).on('change',recalculate);}
       );
    $('#R09,#E09,#I09,#D09,#R10,#E10,#I10,#D10').each(function()   {$(this).on('change',recalculate);}
       );
    $('#R11,#E11,#I11,#D11,#R12,#E12,#I12,#D12').each(function()   {$(this).on('change',recalculate);}
       );
});

function recalculate()
{
        //ini untuk menghilangkan titik supaya bisa di jumlahkan
        //Juga pengkondisian untuk mengecek semisal user tidak mengisi field maka penjumlahan tetap akan berjalan
        
        // ================================ REVENUE ======================== //
        /* ------------------- R001 -------------------------- */
        var R001User = ($('#R01').val());
        if((R001User === "")){
            R001User = "0";
        }
        var R001 = angkaAbc(R001User);       
        console.log(R001);
        
        /* ------------------- R002 -------------------------- */                                                
        var R002User = ($('#R02').val());
        if((R002User === "")){
            R002User = "0";
        }
        var R002 = angkaAbc(R002User);

        /* ------------------- R003 -------------------------- */
        var R003User = ($('#R03').val());
        if((R003User === "")){
            R003User = "0";
        }
        var R003 = angkaAbc(R003User);

        /* ------------------- R004 -------------------------- */
        var R004User = ($('#R04').val());
        if((R004User === "")){
            R004User = "0";
        }
        var R004 = angkaAbc(R004User);

        /* ------------------- R005 -------------------------- */
        var R005User = ($('#R05').val());
        if((R005User === "")){
            R005User = "0";
        }
        var R005 = angkaAbc(R005User);

        /* ------------------- R006 -------------------------- */
        var R006User = ($('#R06').val());
        if((R006User === "")){
            R006User = "0";
        }
        var R006 = angkaAbc(R006User);

        /* ------------------- R007 -------------------------- */
        var R007User = ($('#R07').val());
        if((R007User === "")){
            R007User = "0";
        }
        var R007 = angkaAbc(R007User);

        /* ------------------- R008 -------------------------- */
        var R008User = ($('#R08').val());
        if((R008User === "")){
            R008User = "0";
        }
        var R008 = angkaAbc(R008User);

        /* ------------------- R009 -------------------------- */
        var R009User = ($('#R09').val());
        if((R009User === "")){
            R009User = "0";
        }
        var R009 = angkaAbc(R009User);

        /* ------------------- R010 -------------------------- */
        var R010User = ($('#R10').val());
        if((R010User === "")){
            R010User = "0";
        }
        var R010 = angkaAbc(R010User);

        /* ------------------- R011 -------------------------- */
        var R011User = ($('#R11').val());
        if((R011User === "")){
            R011User = "0";
        }
        var R011 = angkaAbc(R011User);

        /* ------------------- R012 -------------------------- */
        var R012User = ($('#R12').val());
        if((R012User === "")){
            R012User = "0";
        }
        var R012 = angkaAbc(R012User);


        // ================================ EXPENSE ======================== //
        /* ------------------- E001 -------------------------- */
        var E001User = ($('#E01').val());
        if((E001User === "")){
            E001User = "0";
        }
        var E001 = angkaAbc(E001User);       
        
        /* ------------------- E002 -------------------------- */                                                
        var E002User = ($('#E02').val());
        if((E002User === "")){
            E002User = "0";
        }
        var E002 = angkaAbc(E002User);

        /* ------------------- E003 -------------------------- */
        var E003User = ($('#E03').val());
        if((E003User === "")){
            E003User = "0";
        }
        var E003 = angkaAbc(E003User);

        /* ------------------- E004 -------------------------- */
        var E004User = ($('#E04').val());
        if((E004User === "")){
            E004User = "0";
        }
        var E004 = angkaAbc(E004User);

        /* ------------------- E005 -------------------------- */
        var E005User = ($('#E05').val());
        if((E005User === "")){
            E005User = "0";
        }
        var E005 = angkaAbc(E005User);

        /* ------------------- E006 -------------------------- */
        var E006User = ($('#E06').val());
        if((E006User === "")){
            E006User = "0";
        }
        var E006 = angkaAbc(E006User);

        /* ------------------- E007 -------------------------- */
        var E007User = ($('#E07').val());
        if((E007User === "")){
            E007User = "0";
        }
        var E007 = angkaAbc(E007User);

        /* ------------------- E008 -------------------------- */
        var E008User = ($('#E08').val());
        if((E008User === "")){
            E008User = "0";
        }
        var E008 = angkaAbc(E008User);

        /* ------------------- E009 -------------------------- */
        var E009User = ($('#E09').val());
        if((E009User === "")){
            E009User = "0";
        }
        var E009 = angkaAbc(E009User);

        /* ------------------- E010 -------------------------- */
        var E010User = ($('#E10').val());
        if((E010User === "")){
            E010User = "0";
        }
        var E010 = angkaAbc(E010User);

        /* ------------------- E011 -------------------------- */
        var E011User = ($('#E11').val());
        if((E011User === "")){
            E011User = "0";
        }
        var E011 = angkaAbc(E011User);

        /* ------------------- E012 -------------------------- */
        var E012User = ($('#E12').val());
        if((E012User === "")){
            E012User = "0";
        }
        var E012 = angkaAbc(E012User);


        // ================================ INSTALASI ======================== //
        /* ------------------- I001 -------------------------- */
        var I001User = ($('#I01').val());
        if((I001User === "")){
            I001User = "0";
        }
        var I001 = angkaAbc(I001User);       
        
        /* ------------------- I002 -------------------------- */                                                
        var I002User = ($('#I02').val());
        if((I002User === "")){
            I002User = "0";
        }
        var I002 = angkaAbc(I002User);

        /* ------------------- I003 -------------------------- */
        var I003User = ($('#I03').val());
        if((I003User === "")){
            I003User = "0";
        }
        var I003 = angkaAbc(I003User);

        /* ------------------- I004 -------------------------- */
        var I004User = ($('#I04').val());
        if((I004User === "")){
            I004User = "0";
        }
        var I004 = angkaAbc(I004User);

        /* ------------------- I005 -------------------------- */
        var I005User = ($('#I05').val());
        if((I005User === "")){
            I005User = "0";
        }
        var I005 = angkaAbc(I005User);

        /* ------------------- I006 -------------------------- */
        var I006User = ($('#I06').val());
        if((I006User === "")){
            I006User = "0";
        }
        var I006 = angkaAbc(I006User);

        /* ------------------- I007 -------------------------- */
        var I007User = ($('#I07').val());
        if((I007User === "")){
            I007User = "0";
        }
        var I007 = angkaAbc(I007User);

        /* ------------------- I008 -------------------------- */
        var I008User = ($('#I08').val());
        if((I008User === "")){
            I008User = "0";
        }
        var I008 = angkaAbc(I008User);

        /* ------------------- I009 -------------------------- */
        var I009User = ($('#I09').val());
        if((I009User === "")){
            I009User = "0";
        }
        var I009 = angkaAbc(I009User);

        /* ------------------- I010 -------------------------- */
        var I010User = ($('#I10').val());
        if((I010User === "")){
            I010User = "0";
        }
        var I010 = angkaAbc(I010User);

        /* ------------------- I011 -------------------------- */
        var I011User = ($('#I11').val());
        if((I011User === "")){
            I011User = "0";
        }
        var I011 = angkaAbc(I011User);

        /* ------------------- I012 -------------------------- */
        var I012User = ($('#I12').val());
        if((I012User === "")){
            I012User = "0";
        }
        var I012 = angkaAbc(I012User);


        // ================================ DIFFERENSIAL ======================== //
        /* ------------------- D001 -------------------------- */
        var D001User = ($('#D01').val());
        if((D001User === "")){
            D001User = "0";
        }
        var D001 = angkaAbc(D001User);       
        
        /* ------------------- D002 -------------------------- */                                                
        var D002User = ($('#D02').val());
        if((D002User === "")){
            D002User = "0";
        }
        var D002 = angkaAbc(D002User);

        /* ------------------- D003 -------------------------- */
        var D003User = ($('#D03').val());
        if((D003User === "")){
            D003User = "0";
        }
        var D003 = angkaAbc(D003User);

        /* ------------------- D004 -------------------------- */
        var D004User = ($('#D04').val());
        if((D004User === "")){
            D004User = "0";
        }
        var D004 = angkaAbc(D004User);

        /* ------------------- D005 -------------------------- */
        var D005User = ($('#D05').val());
        if((D005User === "")){
            D005User = "0";
        }
        var D005 = angkaAbc(D005User);

        /* ------------------- D006 -------------------------- */
        var D006User = ($('#D06').val());
        if((D006User === "")){
            D006User = "0";
        }
        var D006 = angkaAbc(D006User);

        /* ------------------- D007 -------------------------- */
        var D007User = ($('#D07').val());
        if((D007User === "")){
            D007User = "0";
        }
        var D007 = angkaAbc(D007User);

        /* ------------------- D008 -------------------------- */
        var D008User = ($('#D08').val());
        if((D008User === "")){
            D008User = "0";
        }
        var D008 = angkaAbc(D008User);

        /* ------------------- D009 -------------------------- */
        var D009User = ($('#D09').val());
        if((D009User === "")){
            D009User = "0";
        }
        var D009 = angkaAbc(D009User);

        /* ------------------- D010 -------------------------- */
        var D010User = ($('#D10').val());
        if((D010User === "")){
            D010User = "0";
        }
        var D010 = angkaAbc(D010User);

        /* ------------------- D011 -------------------------- */
        var D011User = ($('#D11').val());
        if((D011User === "")){
            D011User = "0";
        }
        var D011 = angkaAbc(D011User);

        /* ------------------- D012 -------------------------- */
        var D012User = ($('#D12').val());
        if((D012User === "")){
            D012User = "0";
        }
        var D012 = angkaAbc(D012User);

        //Menghitung Total
        var totalR =  R001 + R002 + R003 + R004 + R005 + R006 + 
                      R007 + R008 + R009 + R010 + R011 + R012;               

        var totalE =  E001 + E002 + E003 + E004 + E005 + E006 + 
                      E007 + E008 + E009 + E010 + E011 + E012;

        var totalI =  I001 + I002 + I003 + I004 + I005 + I006 + 
                      I007 + I008 + I009 + I010 + I011 + I012;

        var totalD =  D001 + D002 + D003 + D004 + D005 + D006 + 
                      D007 + D008 + D009 + D010 + D011 + D012;

        //Merubah ke tampilan titik lagi
        var totalRFormat = numberWithCommas(totalR);
        var totalEFormat = numberWithCommas(totalE);
        var totalIFormat = numberWithCommas(totalI);
        var totalDFormat = numberWithCommas(totalD);

        //Menampilkan hasil perhitungan di dalam field total pada html
        $('#TR').val(totalRFormat);
        $('#TE').val(totalEFormat);
        $('#TI').val(totalIFormat);
        $('#TD').val(totalDFormat);

        //Menghitung Margin                                                         //Mengmbalikan nilai menjadi berformat titik
        var marginJanuari   =  R001 - E001 - I001 - D001;                           var mJanuari = numberWithCommas(marginJanuari);
        var marginFebruari  =  marginJanuari + R002 - E002 - I002 - D002;           var mFebruari = numberWithCommas(marginFebruari);
        var marginMaret     =  marginFebruari + R003 - E003 - I003 - D003;          var mMaret = numberWithCommas(marginMaret);
        var marginApril     =  marginMaret + R004 - E004 - I004 - D004;             var mApril = numberWithCommas(marginApril);
        var marginMei       =  marginApril + R005 - E005 - I005 - D005;             var mMei = numberWithCommas(marginMei);
        var marginJuni      =  marginMei + R006 - E006 - I006 - D006;               var mJuni = numberWithCommas(marginJuni);
        var marginJuli      =  marginJuni + R007 - E007 - I007 - D007;              var mJuli = numberWithCommas(marginJuli);
        var marginAgustus   =  marginJuli + R008 - E008 - I008 - D008;              var mAgustus = numberWithCommas(marginAgustus);
        var marginSeptember =  marginAgustus + R009 - E009 - I009 - D009;           var mSeptember = numberWithCommas(marginSeptember);
        var marginOktober   =  marginSeptember + R010 - E010 - I010 - D010;         var mOktober = numberWithCommas(marginOktober);
        var marginNovember  =  marginOktober + R011 - E011 - I011 - D011;           var mNovember = numberWithCommas(marginNovember);
        var marginDesember  =  marginNovember + R012 - E012 - I012 - D012;          var mDesember = numberWithCommas(marginDesember);

        //Menampilkan hasil dari perhitungan di field total margin pada html
        $('#M01').val(mJanuari);
        $('#M02').val(mFebruari);
        $('#M03').val(mMaret);
        $('#M04').val(mApril);
        $('#M05').val(mMei);
        $('#M06').val(mJuni);
        $('#M07').val(mJuli);
        $('#M08').val(mAgustus);
        $('#M09').val(mSeptember);
        $('#M10').val(mOktober);
        $('#M11').val(mNovember);
        $('#M12').val(mDesember);
    
        }
</script>

<!-- Fungsi Enter -->
<script>
    jQuery.extend(jQuery.expr[':'], {
    focusable: function (el, index, selector) {
        return $(el).is('a, button, :input, [tabindex]');
    }
});
$(document).on('keydown', ':focusable', function (e) {
    if (e.which == 13) {
        e.preventDefault();
        // Get all focusable elements on the page
        var $canfocus = $(':focusable');
        var index = $canfocus.index(this) + 1;
        if (index >= $canfocus.length) index = 0;
        $canfocus.eq(index).focus();
    }
});
</script>


