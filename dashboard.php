<?php
session_start();
if ($_SESSION['login']!="admin") {
  header('Location: login.php');
exit;
}

include'./control/data_latih.php';
include'./control/data_uji.php';
include'./control/data_admin.php';

$dl = new datalatih2();
$du = new datauji();

$total_datauji = $du->total();
$total_datalatih = $dl->total();
$datauji_stroke = $du->showstroke();
$datauji_nostroke = $du->shownostroke();
$datalatih_stroke = $dl->showstroke();
$datalatih_nostroke = $dl->shownostroke(); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="assets/img/logo.png">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Deictum | Dashboard </title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini sidebar-collapse layout-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- User -->
        <li class="nav-item dropdown">
          <img height="35px" src="assets/img/avatar3.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8"><a style="color:white;">  <?= $_SESSION['username']; ?></a>
        </li>
    </ul>
  </nav>
  <!-- /.navbar -->

   <!-- Modal Keluar -->
   <div class="modal fade" id="modal-keluar">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h4 class="modal-title"><span></span>Keluar</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Anda Yakin ingin keluar?</p>
            </div>
            <form action="logout.php">
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
              <button type="submit" id="kosong" name="kosong" class="btn btn-danger">Ya</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  <!-- / Modal Keluar -->
  

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
      <img src="assets/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Deictum</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <!-- Dashboard -->
          <li class="nav-item has-treeview menu-open">
            <a href="dashboard.php" class="nav-link active bg-cyan">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <!-- Data Master -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>Data
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="view/datalatih.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Latih</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="view/datauji.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Uji</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="view/dataadmin.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Admin</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="view/pengaturan.php" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>Pengaturan</p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a data-toggle="modal" data-target="#modal-keluar"  href="#" class="nav-link">
              <i class="nav-icon fas fa-door-open"></i>
              <p>Keluar</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a class="text-cyan" href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12">
            <div class="alert alert-info alert-dismissible elevation-3">
                  <h5><i class="icon fas fa-info"></i> Informasi</h5><br>
                  <h6>
                  <p><b>Langkah 1</b>, Memasukkan data latih dengan mengimport file bertipe .xls/.xlxs. Format file bisa di download dengan mengklik simbol import di halaman data latih.</p>
                  <p><b>Langkah 2</b>, Memasukkan data uji dengan menginputkan satu persatu atau dengan mengimport file. Jika data latih dan data uji sudah terisi.</p>
                  <p><b>Langkah 3</b>, Pada halaman data uji akan muncul tombol play. Tombol tersebut berfungsi untuk melakukan testing.</p>
                  <p><b>Langkah 4</b>, Klik tombol play, maka akan muncul dialog pengaturan nilai ketetanggaan dan nilai eksponen, lalu tekan jalankan dan hasilnya akan muncul.</p>
                  </h6>
                </div>
          </div>
        </div>
        <!-- -->
        <div class="row">
          <div class="col-12 col-sm-6">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-book-open"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Data Latih</span>
                <span class="info-box-number">
                  <?= $total_datalatih; ?>
                  <small></small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Data Uji</span>
                <span class="info-box-number"><?= $total_datauji; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box bg-primary ">
              <span class="info-box-icon"><i class="fas fa-sad-cry"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Data Terkena Stroke</span>
                <span class="info-box-number">
                  <?= $datalatih_stroke ?>
                  <small></small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3 bg-primary">
              <span class="info-box-icon"><i class="fas fa-smile-wink"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Data Tidak Terkena Stroke</span>
                <span class="info-box-number"> <?= $datalatih_nostroke ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3 bg-dark">
              <span class="info-box-icon"><i class="fas fa-sad-cry"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Data Terkena Stroke</span>
                <span class="info-box-number"><?= $datauji_stroke ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3 bg-dark">
              <span class="info-box-icon"><i class="fas fa-smile-wink"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Data Tidak Terkena Stroke</span>
                <span class="info-box-number"><?= $datauji_nostroke ?></span>
                
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div hidden class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box bg-primary ">
              <span class="info-box-icon"><i class="fas fa-sad-cry"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Laki-laki</span>
                <span class="info-box-number">
                  <?= $datalatih_stroke ?>
                  <small></small>
                </span>
              </div>
              <span class="info-box-icon"><i class="fas fa-sad-cry"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Perempuan</span>
                <span class="info-box-number">
                  <?= $datalatih_stroke ?>
                  <small></small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3 bg-primary">
              <span class="info-box-icon"><i class="fas fa-smile-wink"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Laki-laki</span>
                <span class="info-box-number"> <?= $datalatih_nostroke ?></span>
              </div>
              <span class="info-box-icon"><i class="fas fa-smile-wink"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Perempuan</span>
                <span class="info-box-number"> <?= $datalatih_nostroke ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3 bg-dark">
              <span class="info-box-icon"><i class="fas fa-sad-cry"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Laki-laki</span>
                <span class="info-box-number"><?= $datauji_stroke ?></span>
              </div>
              <span class="info-box-icon"><i class="fas fa-sad-cry"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Perempuan</span>
                <span class="info-box-number"><?= $datauji_stroke ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3 bg-dark">
              <span class="info-box-icon"><i class="fas fa-smile-wink"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Laki-laki</span>
                <span class="info-box-number"><?= $datauji_nostroke ?></span> 
              </div>
              <span class="info-box-icon"><i class="fas fa-smile-wink"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Perempuan</span>
                <span class="info-box-number"><?= $datauji_nostroke ?></span> 
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        


      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
  Copyright &copy; 2019 <strong><a class="text-cyan" href="dashboard.php">Deictum</a>.</strong> All rights
    reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="assets/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="assets/plugins/raphael/raphael.min.js"></script>
<script src="assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="assets/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="assets/plugins/chart.js/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="assets/js/pages/dashboard2.js"></script>
</body>
</html>
