<?php
session_start();
if ($_SESSION['login']!="admin") {
  header('Location: ../login.php');
exit;
}

include'../control/pengaturan.php';
include'../control/data_admin.php';
include'../control/data_latih.php';

$atr = new pengaturan();
$adm = new dataadmin();
$dl= new datalatih2();
$dldl=$dl->total();

$datape = $atr->all();
foreach ($datape as $key) {
  $akhir=$key['k_akhir'];
  $awal=$key['k_awal'];
  $exp=$key['eks'];
}

//pengaturan
if(isset($_POST['simpan'])){
  $a=$_POST['range_1'];
  $b=$_POST['range_2'];
  $c=explode(';',$a);
  $atr->update($b,$c[0],$c[1]);
  header('Location: pengaturan.php'); 
}

//user
if(isset($_POST['simpan2'])){
  $pasa=$_POST['pass'];
  $us=$_POST['username'];
  $pasa=md5($pasa);
  $adm->update($us,$pasa);
  header('Location: pengaturan.php'); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="../assets/img/logo.png">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Deictum | Pengaturan </title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ion Slider -->
  <link rel="stylesheet" href="../assets/plugins/ion-rangeslider/css/ion.rangeSlider.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/css/adminlte.min.css">
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
          <img height="35px" src="../assets/img/avatar3.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
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
            <form action="../logout.php">
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
              <button type="submit" id="keluar" name="keluar" class="btn btn-danger">Ya</button>
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
    <a href="../dashboard.php" class="brand-link">
      <img src="../assets/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
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
          <li class="nav-item has-treeview">
            <a href="../dashboard.php" class="nav-link">
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
                <a href="datalatih.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Latih</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="datauji.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Uji</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="dataadmin.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Admin</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview menu-open">
            <a href="pengaturan.php" class="nav-link active bg-gradient-warning">
              <i class="nav-icon fas fa-cog "></i>
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
            <h1 class="m-0 text-dark">Pengaturan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a class="text-warning" href="../dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Pengaturan</li>
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
        <div class="card card-dark collapsed-card card-outline">
          <div class="card-header">
            <h3 class="card-title">Data Admin</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body align-content-center">
            <div class="row align-content-center">
              <div class="col-md-12">
                <form class="needs-validation" novalidate method="post">
                <div class="col-lg-12">
                    <label for="validationCustom01">Username</label>
                      <input disabled name="username" type="text" class="form-control" placeholder="Username" id="validationCustom01" value="<?= $_SESSION['username']; ?>" required>
                        <div class="invalid-feedback">
                          Tolong diisi terlebih dahulu!
                        </div>
                  </div>
                  <!-- /.form-group -->
                  <div class="col-lg-12">
                    <label for="validationCustom02">Password</label>
                      <input name="pass" type="password" placeholder="**********" class="form-control" id="validationCustom02" value="<?= $_SESSION['password']; ?>" required>
                        <div class="invalid-feedback">
                          Tolong diisi terlebih dahulu!
                        </div>
                  </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
              <!-- /.col -->
            </div>
            <div class="card-footer">
              <div class="row">
                  <div class="col-lg-8">
                      <button name="simpan2" id="simpan2" type="submit" class="btn btn-dark">Simpan</button>
                    </form>
                  </div>
              </div>
            </div>
            </div>
          <!-- /.card-body -->
        </div>
          <!-- /.card -->

          <!-- Info boxes -->
        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title">Pengaturan</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body align-content-center">
            <div class="row align-content-center">
              <div class="col-md-12">
                <form class="needs-validation" novalidate method="post">
                  <div class="col-lg-12">
                    <label>Nilai Ketetanggan</label>
                      <input id="range_1" class="form-control" type="text" name="range_1" value="" required>
                        <div class="invalid-feedback">
                          Tolong diisi terlebih dahulu!
                        </div>
                  </div>
                  <!-- /.form-group -->
                  <div class="col-lg-12">
                    <label>Nilai Eksponensial</label>
                    <input id="range_2" class="form-control" type="text" name="range_2" value="" required>
                        <div class="invalid-feedback">
                          Tolong diisi terlebih dahulu!
                        </div>
                  </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
              <!-- /.col -->
            </div>
            <div class="card-footer">
              <div class="row">
                  <div class="col-lg-8">
                      <button name="simpan" id="simpan" type="submit" class="btn btn-warning">Simpan</button>
                    </form>
                  </div>
              </div>
            </div>
            </div>
          <!-- /.card-body -->
        </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        
        </div>
        <!-- /.col -->
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
  Copyright &copy; 2019 <strong><a class="text-warning" href="../dashboard.php">Deictum</a>.</strong> All rights
    reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="../assets/js/demo.js"></script>
<!-- Ion Slider -->
<script src="../assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="../assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="../assets/plugins/raphael/raphael.min.js"></script>
<script src="../assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../assets/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="../assets/plugins/chart.js/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="../assets/js/pages/dashboard2.js"></script>
<script>
$(function () {

      /* ION SLIDER */
      $('#range_1').ionRangeSlider({
        min: 3,
        max: <?= $dldl ?>,
        from: <?= $awal ?>,
        to: <?= $akhir ?>,
        type: 'double',
        step: 1,
        prefix: '',
        prettify: false,
        hasGrid: true
      })
      $('#range_2').ionRangeSlider({
        min: 2,
        max: 10,
        from: <?= $exp ?>,
        type: 'single',
        step: 1,
        prefix: '',
        prettify: false,
        hasGrid: true
      })
})
      </script>
      <script>
  // Example starter JavaScript for disabling form submissions if there are invalid fields
  (function() {
    'use strict';
    window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
  </script>
</body>
</html>
