<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">CRM SELLING POINT
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
        <div class="container-fluid" id="graph-container">
            <!-- <div class="row">
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
            </div> -->
            <div class="row">
                <div class="col-lg-6 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3><?php echo $jml_project; ?></h3>
                            <p>Jumlah Project</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <a href="#" class="small-box-footer">-</a>
                    </div>
                </div>

                <div class="col-lg-6 col-xs-6">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>Rp <?php echo rupiah($total_margin); ?></h3>
                            <p>Total Margin</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="#" class="small-box-footer">-</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h2><b>Rp <?php echo rupiah($total_revenue); ?></b></h2>
                            <p>Revenue</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <a href="#" class="small-box-footer">-</a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-teal">
                        <div class="inner">
                            <h2><b>Rp <?php echo rupiah($total_expense); ?></b></h2>
                            <p>Expense</p>
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
                            <h2><b>Rp <?php echo rupiah($total_instalasi); ?></b></h2>
                            <p>Instalasi</p>
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
                            <h2><b>Rp <?php echo rupiah($total_differensial); ?></b></h2>
                            <p>Differensial</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-check"></i>
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
                    <div class="card card-warning">
                      <div class="card-header">
                        <h3 class="card-title"><b>Filter</b></h3>

                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                          </button>
                          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                      </div>
                    <div class="card-body">
                    <!-- <form method="post" action=""> -->  
                        <label>Pilih Nama Sales</label>
                        <select class="form-control" name="sales1" id="sales1">
                            <option value="all">All</option>
                                <?php foreach ($sales as $s) : ?>
                                    <option value="<?php echo $s['kode_sales']; ?>"><?php echo $s['nama_sales']; ?></option>
                                <?php endforeach; ?>
                        </select> <br>
                        <button id="submitButton" class="tombol-preview btn btn-primary btn-block btn-sm" data-id="<?php echo $s['kode_sales']; ?>">Preview</button>
                    <!-- </form> -->
                    </div>
                      <!-- /.card-body -->
                    </div>
                </div>
                    <!-- /.card -->
                    <!-- DONUT CHART -->
                <div class="col-md-9">
                    <div class="card card-danger" id="cardProbabilitasChart">
                      <div class="card-header">
                        <h3 class="card-title"><b>Probabilitas Project Chart</b></h3>

                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                          </button>
                          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                      </div>
                      <div class="card-body">
                        <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                      </div>
                      <!-- /.card-body -->
                    </div>
                </div>
            </div>
                    <!-- /.card -->
            <div clas="row">
                <div class="col-md-12">
                    <!-- AREA CHART -->
                    <div class="card card-primary" id="cardAreaChart" hidden>
                      <div class="card-header">
                        <h3 class="card-title">Area Chart</h3>
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                          </button>
                          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="chart">
                          <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                </div>
            </div>

            <!-- BAR CHART -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-success" id="cardForecastChart">
                      <div class="card-header">
                        <h3 class="card-title"><b>Forecast Chart</b></h3>
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                          </button>
                          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="chart">
                          <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                </div>
            </div>
            </div>
    </div><!-- /.container-fluid -->
</section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Fungsi untuk menampilkan data all atau semua sales pada pertama kali -->
<script>
  $(function () {

    //Query semua pencarian
    <?php 
    //Query REVENUE
            $this->db->select('SUM(r01) as total');
            $this->db->from('tb_cashflow');
    $r01 =  $this->db->get()->row()->total;

            $this->db->select('SUM(r02) as total');
            $this->db->from('tb_cashflow');
    $r02 =  $this->db->get()->row()->total;

            $this->db->select('SUM(r03) as total');
            $this->db->from('tb_cashflow');
    $r03 =  $this->db->get()->row()->total;

            $this->db->select('SUM(r04) as total');
            $this->db->from('tb_cashflow');
    $r04 =  $this->db->get()->row()->total;

            $this->db->select('SUM(r05) as total');
            $this->db->from('tb_cashflow');
    $r05 =  $this->db->get()->row()->total;

            $this->db->select('SUM(r06) as total');
            $this->db->from('tb_cashflow');
    $r06 =  $this->db->get()->row()->total;

            $this->db->select('SUM(r07) as total');
            $this->db->from('tb_cashflow');
    $r07 =  $this->db->get()->row()->total;

            $this->db->select('SUM(r08) as total');
            $this->db->from('tb_cashflow');
    $r08 =  $this->db->get()->row()->total;

            $this->db->select('SUM(r09) as total');
            $this->db->from('tb_cashflow');
    $r09 =  $this->db->get()->row()->total;

            $this->db->select('SUM(r10) as total');
            $this->db->from('tb_cashflow');
    $r10 =  $this->db->get()->row()->total;

            $this->db->select('SUM(r11) as total');
            $this->db->from('tb_cashflow');
    $r11 =  $this->db->get()->row()->total;

            $this->db->select('SUM(r12) as total');
            $this->db->from('tb_cashflow');
    $r12 =  $this->db->get()->row()->total;
                                     
    //QUERY EXPENSE

            $this->db->select('SUM(e01) as total');
            $this->db->from('tb_cashflow');
    $e01 =  $this->db->get()->row()->total;

            $this->db->select('SUM(e02) as total');
            $this->db->from('tb_cashflow');
    $e02 =  $this->db->get()->row()->total;

            $this->db->select('SUM(e03) as total');
            $this->db->from('tb_cashflow');
    $e03 =  $this->db->get()->row()->total;

            $this->db->select('SUM(e04) as total');
            $this->db->from('tb_cashflow');
    $e04 =  $this->db->get()->row()->total;

            $this->db->select('SUM(e05) as total');
            $this->db->from('tb_cashflow');
    $e05 =  $this->db->get()->row()->total;

            $this->db->select('SUM(e06) as total');
            $this->db->from('tb_cashflow');
    $e06 =  $this->db->get()->row()->total;

            $this->db->select('SUM(e07) as total');
            $this->db->from('tb_cashflow');
    $e07 =  $this->db->get()->row()->total;

            $this->db->select('SUM(e08) as total');
            $this->db->from('tb_cashflow');
    $e08 =  $this->db->get()->row()->total;

            $this->db->select('SUM(e09) as total');
            $this->db->from('tb_cashflow');
    $e09 =  $this->db->get()->row()->total;

            $this->db->select('SUM(e10) as total');
            $this->db->from('tb_cashflow');
    $e10 =  $this->db->get()->row()->total;

            $this->db->select('SUM(e11) as total');
            $this->db->from('tb_cashflow');
    $e11 =  $this->db->get()->row()->total;

            $this->db->select('SUM(e12) as total');
            $this->db->from('tb_cashflow');
    $e12 =  $this->db->get()->row()->total;

    //QUERY INSTALASI

            $this->db->select('SUM(i01) as total');
            $this->db->from('tb_cashflow');
    $i01 =  $this->db->get()->row()->total;

            $this->db->select('SUM(i02) as total');
            $this->db->from('tb_cashflow');
    $i02 =  $this->db->get()->row()->total;

            $this->db->select('SUM(i03) as total');
            $this->db->from('tb_cashflow');
    $i03 =  $this->db->get()->row()->total;

            $this->db->select('SUM(i04) as total');
            $this->db->from('tb_cashflow');
    $i04 =  $this->db->get()->row()->total;

            $this->db->select('SUM(i05) as total');
            $this->db->from('tb_cashflow');
    $i05 =  $this->db->get()->row()->total;

            $this->db->select('SUM(i06) as total');
            $this->db->from('tb_cashflow');
    $i06 =  $this->db->get()->row()->total;

            $this->db->select('SUM(i07) as total');
            $this->db->from('tb_cashflow');
    $i07 =  $this->db->get()->row()->total;

            $this->db->select('SUM(i08) as total');
            $this->db->from('tb_cashflow');
    $i08 =  $this->db->get()->row()->total;

            $this->db->select('SUM(i09) as total');
            $this->db->from('tb_cashflow');
    $i09 =  $this->db->get()->row()->total;

            $this->db->select('SUM(i10) as total');
            $this->db->from('tb_cashflow');
    $i10 =  $this->db->get()->row()->total;

            $this->db->select('SUM(i11) as total');
            $this->db->from('tb_cashflow');
    $i11 =  $this->db->get()->row()->total;

            $this->db->select('SUM(i12) as total');
            $this->db->from('tb_cashflow');
    $i12 =  $this->db->get()->row()->total;

    //QUERY DIFFERENSIAL

            $this->db->select('SUM(d01) as total');
            $this->db->from('tb_cashflow');
    $d01 =  $this->db->get()->row()->total;

            $this->db->select('SUM(d02) as total');
            $this->db->from('tb_cashflow');
    $d02 =  $this->db->get()->row()->total;

            $this->db->select('SUM(d03) as total');
            $this->db->from('tb_cashflow');
    $d03 =  $this->db->get()->row()->total;

            $this->db->select('SUM(d04) as total');
            $this->db->from('tb_cashflow');
    $d04 =  $this->db->get()->row()->total;

            $this->db->select('SUM(d05) as total');
            $this->db->from('tb_cashflow');
    $d05 =  $this->db->get()->row()->total;

            $this->db->select('SUM(d06) as total');
            $this->db->from('tb_cashflow');
    $d06 =  $this->db->get()->row()->total;

            $this->db->select('SUM(d07) as total');
            $this->db->from('tb_cashflow');
    $d07 =  $this->db->get()->row()->total;

            $this->db->select('SUM(d08) as total');
            $this->db->from('tb_cashflow');
    $d08 =  $this->db->get()->row()->total;

            $this->db->select('SUM(d09) as total');
            $this->db->from('tb_cashflow');
    $d09 =  $this->db->get()->row()->total;

            $this->db->select('SUM(d10) as total');
            $this->db->from('tb_cashflow');
    $d10 =  $this->db->get()->row()->total;

            $this->db->select('SUM(d11) as total');
            $this->db->from('tb_cashflow');
    $d11 =  $this->db->get()->row()->total;

            $this->db->select('SUM(d12) as total');
            $this->db->from('tb_cashflow');
    $d12 =  $this->db->get()->row()->total;

    //QUERY MARGIN
            $this->db->select('SUM(r01 - e01 - i01 - d01) as total');
            $this->db->from('tb_cashflow');
    $m01 =  $this->db->get()->row()->total;

            $this->db->select('SUM(r02 - e02 - i02 - d02) as total');
            $this->db->from('tb_cashflow');
    $m02 =  $this->db->get()->row()->total;

            $this->db->select('SUM(r03 - e03 - i03 - d03) as total');
            $this->db->from('tb_cashflow');
    $m03 =  $this->db->get()->row()->total;

            $this->db->select('SUM(r04 - e04 - i04 - d04) as total');
            $this->db->from('tb_cashflow');
    $m04 =  $this->db->get()->row()->total;

            $this->db->select('SUM(r05 - e05 - i05 - d05) as total');
            $this->db->from('tb_cashflow');
    $m05 =  $this->db->get()->row()->total;

            $this->db->select('SUM(r06 - e06 - i06 - d06) as total');
            $this->db->from('tb_cashflow');
    $m06 =  $this->db->get()->row()->total;

            $this->db->select('SUM(r07 - e07 - i07 - d07) as total');
            $this->db->from('tb_cashflow');
    $m07 =  $this->db->get()->row()->total;

            $this->db->select('SUM(r08 - e08 - i08 - d08) as total');
            $this->db->from('tb_cashflow');
    $m08 =  $this->db->get()->row()->total;

            $this->db->select('SUM(r09 - e09 - i09 - d09) as total');
            $this->db->from('tb_cashflow');
    $m09 =  $this->db->get()->row()->total;

            $this->db->select('SUM(r10 - e10 - i10 - d10) as total');
            $this->db->from('tb_cashflow');
    $m10 =  $this->db->get()->row()->total;

            $this->db->select('SUM(r11 - e11 - i11 - d11) as total');
            $this->db->from('tb_cashflow');
    $m11 =  $this->db->get()->row()->total;

            $this->db->select('SUM(r12 - e12 - i12 - d12) as total');
            $this->db->from('tb_cashflow');
    $m12 =  $this->db->get()->row()->total;

            $this->db->select('SUM(r12 - e12 - i12 - d12) as total');
            $this->db->from('tb_cashflow');
    $m12 =  $this->db->get()->row()->total;

    ?>

    var barChartCanvas = $('#barChart').get(0).getContext('2d');
    var data1   = [<?php echo $r01; ?>, <?php echo $e01 ?>, <?php echo $i01 ?>, <?php echo $d01 ?>, <?php echo $m01; ?>];
    var data2   = [<?php echo $r02; ?>, <?php echo $e02 ?>, <?php echo $i02 ?>, <?php echo $d02 ?>, <?php echo $m02; ?>];
    var data3   = [<?php echo $r03; ?>, <?php echo $e03 ?>, <?php echo $i03 ?>, <?php echo $d03 ?>, <?php echo $m03; ?>];
    var data4   = [<?php echo $r04; ?>, <?php echo $e04 ?>, <?php echo $i04 ?>, <?php echo $d04 ?>, <?php echo $m04; ?>];
    var data5   = [<?php echo $r05; ?>, <?php echo $e05 ?>, <?php echo $i05 ?>, <?php echo $d05 ?>, <?php echo $m05; ?>];
    var data6   = [<?php echo $r06; ?>, <?php echo $e06 ?>, <?php echo $i06 ?>, <?php echo $d06 ?>, <?php echo $m06; ?>];
    var data7   = [<?php echo $r07; ?>, <?php echo $e07 ?>, <?php echo $i07 ?>, <?php echo $d07 ?>, <?php echo $m07; ?>];
    var data8   = [<?php echo $r08; ?>, <?php echo $e08 ?>, <?php echo $i08 ?>, <?php echo $d08 ?>, <?php echo $m08; ?>];
    var data9   = [<?php echo $r09; ?>, <?php echo $e09 ?>, <?php echo $i09 ?>, <?php echo $d09 ?>, <?php echo $m09; ?>];
    var data10  = [<?php echo $r10; ?>, <?php echo $e10 ?>, <?php echo $i10 ?>, <?php echo $d10 ?>, <?php echo $m10; ?>];
    var data11  = [<?php echo $r11; ?>, <?php echo $e11 ?>, <?php echo $i11 ?>, <?php echo $d11 ?>, <?php echo $m11; ?>];
    var data12  = [<?php echo $r12; ?>, <?php echo $e12 ?>, <?php echo $i12 ?>, <?php echo $d12 ?>, <?php echo $m12; ?>];
    
    var barChartData = {
              labels  : ['Revenue', 'Expense', 'Instalasi', 'Differensial', 'Margin'],
              datasets: [
                {
                  label               : 'Januari',
                  backgroundColor     : 'rgba(0,192,239)',
                  borderColor         : 'rgba(0,192,239)',
                  pointRadius         : false,
                  pointColor          : '#00C0EF',
                  pointStrokeColor    : 'rgba(60,141,188,1)',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(60,141,188,1)',
                  data                : data1 
                },
                {
                  label               : 'Februari',
                  backgroundColor     : 'rgba(245,105,84)',
                  borderColor         : 'rgba(245,105,84)',
                  pointRadius         : false,
                  pointColor          : 'rgba(210, 214, 222, 1)',
                  pointStrokeColor    : '#f56954',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(220,220,220,1)',
                  data                : data2
                },
                {
                  label               : 'Maret',
                  backgroundColor     : 'rgba(0, 166, 90)',
                  borderColor         : 'rgba(0, 166, 90)',
                  pointRadius         : false,
                  pointColor          : 'rgba(210, 214, 222, 1)',
                  pointStrokeColor    : '#00a65a',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(220,220,220,1)',
                  data                : data3
                },
                {
                  label               : 'April',
                  backgroundColor     : 'rgba(243,156,18)',
                  borderColor         : 'rgba(243,156,18)',
                  pointRadius         : false,
                  pointColor          : 'rgba(210, 214, 222, 1)',
                  pointStrokeColor    : '#f39c12',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(220,220,220,1)',
                  data                : data4
                },
                {
                  label               : 'Mei',
                  backgroundColor     : 'rgba(214,45,45)',
                  borderColor         : 'rgba(214,45,45)',
                  pointRadius         : false,
                  pointColor          : 'rgba(210, 214, 222, 1)',
                  pointStrokeColor    : '#D62D2D',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(220,220,220,1)',
                  data                : data5
                },
                {
                  label               : 'Juni',
                  backgroundColor     : 'rgba(60,141,188)',
                  borderColor         : 'rgba(60,141,188)',
                  pointRadius         : false,
                  pointColor          : 'rgba(210, 214, 222, 1)',
                  pointStrokeColor    : '#3c8dbc',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(220,220,220,1)',
                  data                : data6
                },
                {
                  label               : 'Juli',
                  backgroundColor     : 'rgba(151,54,195)',
                  borderColor         : 'rgba(151,54,195)',
                  pointRadius         : false,
                  pointColor          : 'rgba(210, 214, 222, 1)',
                  pointStrokeColor    : '#9736C3',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(220,220,220,1)',
                  data                : data7
                },
                {
                  label               : 'Agustus',
                  backgroundColor     : 'rgba(201,115,57)',
                  borderColor         : 'rgba(201,115,57)',
                  pointRadius         : false,
                  pointColor          : 'rgba(210, 214, 222, 1)',
                  pointStrokeColor    : '#C97339',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(220,220,220,1)',
                  data                : data8
                },
                {
                  label               : 'September',
                  backgroundColor     : 'rgba(210, 214, 222, 1)',
                  borderColor         : 'rgba(210, 214, 222, 1)',
                  pointRadius         : false,
                  pointColor          : 'rgba(210, 214, 222, 1)',
                  pointStrokeColor    : '#c1c7d1',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(220,220,220,1)',
                  data                : data9
                },
                {
                  label               : 'Oktober',
                  backgroundColor     : 'rgba(122,219,9)',
                  borderColor         : 'rgba(122,219,9)',
                  pointRadius         : false,
                  pointColor          : 'rgba(210, 214, 222, 1)',
                  pointStrokeColor    : '#7ADB09',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(220,220,220,1)',
                  data                : data10
                },
                {
                  label               : 'November',
                  backgroundColor     : 'rgba(222,147,227)',
                  borderColor         : 'rgba(222,147,227)',
                  pointRadius         : false,
                  pointColor          : 'rgba(210, 214, 222, 1)',
                  pointStrokeColor    : '#DE93E3',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(220,220,220,1)',
                  data                : data11
                },
                {
                  label               : 'Desember',
                  backgroundColor     : 'rgba(24,206,183)',
                  borderColor         : 'rgba(24,206,183)',
                  pointRadius         : false,
                  pointColor          : 'rgba(210, 214, 222, 1)',
                  pointStrokeColor    : '#18CEB7',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(220,220,220,1)',
                  data                : data12
                },
               ]
            }

            var barChartOptions = {
              responsive              : true,
              maintainAspectRatio     : false,
              datasetFill             : false
            }

            if(window.bar != undefined) 
            window.bar.destroy(); 
            window.bar = new Chart(barChartCanvas, {
              type: 'bar', 
              data: barChartData,
              options: barChartOptions
            })

            var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
            var donutData        = {
              labels: [
                  'Peluang 10%', 
                  'Peluang 25%',
                  'Peluang 50%', 
                  'Peluang 100%',
              ],
              datasets: [
                {
                  data: [ <?php 
                            $query = $this->db->query(
                            "SELECT COUNT(id_project) as peluang_10
                                               FROM tb_project
                                               WHERE peluang = 10"
                            );
                            if ($query->num_rows() > 0) {
                                echo $query->row()->peluang_10;
                            } 
                          ?> ,

                          <?php 
                            $query = $this->db->query(
                            "SELECT COUNT(id_project) as peluang_25
                                               FROM tb_project
                                               WHERE peluang = 25"
                            );
                            if ($query->num_rows() > 0) {
                                echo $query->row()->peluang_25;
                            } 
                          ?> ,

                          <?php 
                            $query = $this->db->query(
                            "SELECT COUNT(id_project) as peluang_50
                                               FROM tb_project
                                               WHERE peluang = 50"
                            );
                            if ($query->num_rows() > 0) {
                                echo $query->row()->peluang_50;
                            } 
                          ?> ,

                          <?php 
                            $query = $this->db->query(
                            "SELECT COUNT(id_project) as peluang_100
                                               FROM tb_project
                                               WHERE peluang = 100"
                            );
                            if ($query->num_rows() > 0) {
                                echo $query->row()->peluang_100;
                            } 
                          ?> ],
                  backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                }
              ]
            }
            var donutOptions     = {
              maintainAspectRatio : false,
              responsive : true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            var donutChart = new Chart(donutChartCanvas, {
              type: 'doughnut',
              data: donutData,
              options: donutOptions      
            })

            //-------------
            //- BAR CHART -
            //-------------
            // var barChartCanvas = $('#barChart').get(0).getContext('2d')
            // var barChartData = jQuery.extend(true, {}, areaChartData)
            // var temp0 = areaChartData.datasets[0]
            // var temp1 = areaChartData.datasets[1]
            // barChartData.datasets[0] = temp1
            // barChartData.datasets[1] = temp0

  })
</script>

<!-- Fungsi untuk menampilkan data berdasarkan filter by name sales dari user -->
<script>
    $('.tombol-preview').on('click', function() {
         // document.getElementById("cardAreaChart").hidden = true;
         document.getElementById("cardProbabilitasChart").hidden = false;
         document.getElementById("cardForecastChart").hidden = false;

         var sales = document.getElementById("sales1");
         var salesResult = sales.options[sales.selectedIndex].value;
         // console.log(salesResult);

        $.ajax({
            url: '<?php echo base_url('admin/get_dashboardSales'); ?>',
            data: {
                sales: salesResult
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {

            var barChartCanvas = $('#barChart').get(0).getContext('2d');

            var data1   = [data.dataBar.t_r01, data.dataBar.t_e01, data.dataBar.t_i01, data.dataBar.t_d01, data.dataBar.t_m01];
            var data2   = [data.dataBar.t_r02, data.dataBar.t_e02, data.dataBar.t_i02, data.dataBar.t_d02, data.dataBar.t_m02];
            var data3   = [data.dataBar.t_r03, data.dataBar.t_e03, data.dataBar.t_i03, data.dataBar.t_d03, data.dataBar.t_m03];
            var data4   = [data.dataBar.t_r04, data.dataBar.t_e04, data.dataBar.t_i04, data.dataBar.t_d04, data.dataBar.t_m04];
            var data5   = [data.dataBar.t_r05, data.dataBar.t_e05, data.dataBar.t_i05, data.dataBar.t_d05, data.dataBar.t_m05];
            var data6   = [data.dataBar.t_r06, data.dataBar.t_e06, data.dataBar.t_i06, data.dataBar.t_d06, data.dataBar.t_m06];
            var data7   = [data.dataBar.t_r07, data.dataBar.t_e07, data.dataBar.t_i07, data.dataBar.t_d07, data.dataBar.t_m07];
            var data8   = [data.dataBar.t_r08, data.dataBar.t_e08, data.dataBar.t_i08, data.dataBar.t_d08, data.dataBar.t_m08];
            var data9   = [data.dataBar.t_r09, data.dataBar.t_e09, data.dataBar.t_i09, data.dataBar.t_d09, data.dataBar.t_m09];
            var data10  = [data.dataBar.t_r10, data.dataBar.t_e10, data.dataBar.t_i10, data.dataBar.t_d10, data.dataBar.t_m10];
            var data11  = [data.dataBar.t_r11, data.dataBar.t_e11, data.dataBar.t_i11, data.dataBar.t_d11, data.dataBar.t_m11];
            var data12  = [data.dataBar.t_r12, data.dataBar.t_e12, data.dataBar.t_i12, data.dataBar.t_d12, data.dataBar.t_m12];
            console.log(data);
            
            var barChartData = {
              labels  : ['Revenue', 'Expense', 'Instalasi', 'Differensial', 'Margin'],
              datasets: [
                {
                  label               : 'Januari',
                  backgroundColor     : 'rgba(0,192,239)',
                  borderColor         : 'rgba(0,192,239)',
                  pointRadius         : false,
                  pointColor          : '#00C0EF',
                  pointStrokeColor    : 'rgba(60,141,188,1)',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(60,141,188,1)',
                  data                : data1 
                },
                {
                  label               : 'Februari',
                  backgroundColor     : 'rgba(245,105,84)',
                  borderColor         : 'rgba(245,105,84)',
                  pointRadius         : false,
                  pointColor          : 'rgba(210, 214, 222, 1)',
                  pointStrokeColor    : '#f56954',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(220,220,220,1)',
                  data                : data2
                },
                {
                  label               : 'Maret',
                  backgroundColor     : 'rgba(0, 166, 90)',
                  borderColor         : 'rgba(0, 166, 90)',
                  pointRadius         : false,
                  pointColor          : 'rgba(210, 214, 222, 1)',
                  pointStrokeColor    : '#00a65a',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(220,220,220,1)',
                  data                : data3
                },
                {
                  label               : 'April',
                  backgroundColor     : 'rgba(243,156,18)',
                  borderColor         : 'rgba(243,156,18)',
                  pointRadius         : false,
                  pointColor          : 'rgba(210, 214, 222, 1)',
                  pointStrokeColor    : '#f39c12',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(220,220,220,1)',
                  data                : data4
                },
                {
                  label               : 'Mei',
                  backgroundColor     : 'rgba(214,45,45)',
                  borderColor         : 'rgba(214,45,45)',
                  pointRadius         : false,
                  pointColor          : 'rgba(210, 214, 222, 1)',
                  pointStrokeColor    : '#D62D2D',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(220,220,220,1)',
                  data                : data5
                },
                {
                  label               : 'Juni',
                  backgroundColor     : 'rgba(60,141,188)',
                  borderColor         : 'rgba(60,141,188)',
                  pointRadius         : false,
                  pointColor          : 'rgba(210, 214, 222, 1)',
                  pointStrokeColor    : '#3c8dbc',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(220,220,220,1)',
                  data                : data6
                },
                {
                  label               : 'Juli',
                  backgroundColor     : 'rgba(151,54,195)',
                  borderColor         : 'rgba(151,54,195)',
                  pointRadius         : false,
                  pointColor          : 'rgba(210, 214, 222, 1)',
                  pointStrokeColor    : '#9736C3',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(220,220,220,1)',
                  data                : data7
                },
                {
                  label               : 'Agustus',
                  backgroundColor     : 'rgba(201,115,57)',
                  borderColor         : 'rgba(201,115,57)',
                  pointRadius         : false,
                  pointColor          : 'rgba(210, 214, 222, 1)',
                  pointStrokeColor    : '#C97339',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(220,220,220,1)',
                  data                : data8
                },
                {
                  label               : 'September',
                  backgroundColor     : 'rgba(210, 214, 222, 1)',
                  borderColor         : 'rgba(210, 214, 222, 1)',
                  pointRadius         : false,
                  pointColor          : 'rgba(210, 214, 222, 1)',
                  pointStrokeColor    : '#c1c7d1',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(220,220,220,1)',
                  data                : data9
                },
                {
                  label               : 'Oktober',
                  backgroundColor     : 'rgba(122,219,9)',
                  borderColor         : 'rgba(122,219,9)',
                  pointRadius         : false,
                  pointColor          : 'rgba(210, 214, 222, 1)',
                  pointStrokeColor    : '#7ADB09',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(220,220,220,1)',
                  data                : data10
                },
                {
                  label               : 'November',
                  backgroundColor     : 'rgba(222,147,227)',
                  borderColor         : 'rgba(222,147,227)',
                  pointRadius         : false,
                  pointColor          : 'rgba(210, 214, 222, 1)',
                  pointStrokeColor    : '#DE93E3',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(220,220,220,1)',
                  data                : data11
                },
                {
                  label               : 'Desember',
                  backgroundColor     : 'rgba(24,206,183)',
                  borderColor         : 'rgba(24,206,183)',
                  pointRadius         : false,
                  pointColor          : 'rgba(210, 214, 222, 1)',
                  pointStrokeColor    : '#18CEB7',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(220,220,220,1)',
                  data                : data12
                },
               ]
            }

            var barChartOptions = {
              responsive              : true,
              maintainAspectRatio     : false,
              datasetFill             : false
            }

            if(window.bar != undefined) 
            window.bar.destroy(); 
            window.bar = new Chart(barChartCanvas, {
              type: 'bar', 
              data: barChartData,
              options: barChartOptions
            })
            var barChart = new Chart(barChartCanvas, {
              type: 'bar', 
              data: barChartData,
              options: barChartOptions
            })

            var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
            var donutData        = {
              labels: [
                  'Peluang 10%', 
                  'Peluang 25%',
                  'Peluang 50%', 
                  'Peluang 100%',
              ],
              datasets: [
                {
                  data: [ data.dataPeluang10.peluang_10 ,

                          data.dataPeluang25.peluang_25 ,

                          data.dataPeluang50.peluang_50 ,

                          data.dataPeluang100.peluang_100 ],
                  backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                }
              ]
            }
            var donutOptions     = {
              maintainAspectRatio : false,
              responsive : true,
            }
            // Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            if(window.bar != undefined) 
            window.bar.destroy(); 
            window.bar = new Chart(donutChartCanvas, {
              type: 'doughnut',
              data: donutData,
              options: donutOptions      
            })
        }
    });
  });
</script>

