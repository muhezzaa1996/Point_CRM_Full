<?php 

function count_kontrak($kode_customer){

    //Deklarasi variabel buat nyimpen nama host, username database, password database, nama database
    $host = "localhost";
    $username_db = "root";
    $password_db = "";
    $nama_db = "point_db";

    //Koneksi ke database
    $koneksi = mysqli_connect($host, $username_db, $password_db, $nama_db);

    $query = "SELECT COUNT(id_kontrak) as jml_kontrak FROM tb_kontrak WHERE kode_customer_kontrak = '$kode_customer'";

    $count_kontrak = mysqli_query($koneksi, $query);

    $result = mysqli_fetch_row($count_kontrak);

    echo $result['0'];

}

function sum_kontrak($kode_customer){

    //Deklarasi variabel buat nyimpen nama host, username database, password database, nama database
    $host = "localhost";
    $username_db = "root";
    $password_db = "";
    $nama_db = "point_db";

    //Koneksi ke database
    $koneksi = mysqli_connect($host, $username_db, $password_db, $nama_db);

    $query = "SELECT SUM(nilai_project_kontrak) as total_kontrak FROM tb_kontrak WHERE kode_customer_kontrak = '$kode_customer'";

    $sum_kontrak = mysqli_query($koneksi, $query);

    $result = mysqli_fetch_row($sum_kontrak);

    echo rupiah($result['0']);

}

?>

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
                        <div class="table-responsive">
                            <table class=" table table-bordered table-hover" id="table-data" style="font-size:14px;">
                                <thead>
                                    <th>#</th>
                                    <th>Kode Customer</th>
                                    <th>Customer</th>
                                    <th>Jumlah Project</th>
                                    <th>Total Nilai Project</th>
                                    <th>-</th>
                                    <th>-</th>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($cust_kontrak as $lu) : ?>
                                    <!-- Inisiasi variabel buat dipakai sebagai parameter untuk fungsi sum dan count -->
                                    <?php $kode_customer = $lu['kode_cust'];?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $lu['kode_cust']; ?> </td>
                                            <td><?php echo $lu['nama_cust']; ?> </td>
                                            <td><?php count_kontrak($kode_customer); ?></td>
                                            <td>Rp <?php sum_kontrak($kode_customer); ?></td>
                                            <td><button type="button" class="tombol-tambah btn btn-primary btn-block btn-sm"  data-toggle="modal" data-placement="bottom" data-target="#add-user" data-toggle ="tooltip" title="Tambah Data"><i class="nav-icon fas fa-plus" aria-hidden="true"></i></button></td>

                                            <td><a href="<?php echo base_url('admin/tampil_kontrak/') . $lu['kode_cust']; ?>" data-toggle="tooltip" data-placement="bottom" title="Lihat Data" class="btn btn-danger btn-block btn-sm"><i class="nav-icon fas fa-eye"></i></a> </td>
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
                <h4 class="modal-title">Tambah Kontrak Project Baru</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <form action="<?php echo base_url('admin/cust_kontrak_project'); ?>" method="post" id="form_id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tgl Kontrak Baru</label>
                                    <input type="date" class="form-control tgl_project" name="tgl_project" required>
                                </div>
                            </div>   
                            <div class="col-md-6"> 
                                <div class="form-group"> 
                                    <label>Nomor Job</label>
                                    <input type="text" class="form-control no_job" name="no_jobTambah" value="<?php echo $no_job; ?>" readonly>    
                                </div>
                            </div>  
                        </div>    
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kode_customer">Customer</label>       
                                       <select class="form-control customer" name="kode_customerTambah" id="kode_customerTambah">
                                        <option value="">- Pilih Customer -</option> 
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
                                        <input type="text" class="form-control uang" autocomplete= "off" name="nilai_projectTambahKontrak" id="nilai_projectTambahKontrak" required>
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

        // -------------- Nilai Project untuk Form Tambah Project ------- //
        var nilai_projectTambah = document.getElementById('nilai_projectTambahKontrak');
        nilai_projectTambah.addEventListener('keyup', function(e){
            nilai_projectTambah.value = formatRupiah(this.value, '');
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


