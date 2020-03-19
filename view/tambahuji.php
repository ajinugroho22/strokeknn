<?php
date_default_timezone_set('Asia/Jakarta');
session_start();
if ($_SESSION['login']!="admin") {
  header('Location: ../login.php');
exit;
}

if(isset($_POST['simpan'])){
include'../control/data_uji.php';

$dtu = new datauji();
//ambil data dari form
      $jk=$_POST['jk'];
      $umur=$_POST['umur'];
      $hiper=$_POST['hipertensi'];
      $jantung=$_POST['jantung'];
      $gula=$_POST['gula'];
      $bmi=$_POST['bmi'];
      $kerja=$_POST['kerja'];
      $tinggal=$_POST['tinggal'];
      $nikah=$_POST['nikah'];
      $rokok=$_POST['rokok'];
      $class=$_POST['class'];
//cek data sudah ada atau blm
  $date=date("Y-m-d H:i:s");
  $byk=$dtu->cekdata($umur,$jk,$kerja,$hiper,$jantung,$tinggal,$rokok,$nikah,$bmi,$gula);
  //jika username blm digunakan
  if($byk==0){
      //memasukkan data baru
      $dtu->masuk($jk,$umur,$gula,$bmi,$hiper,$jantung,$rokok,$tinggal,$kerja,$nikah,$date,$class);
      echo "<script>location='datauji.php'</script>";
  }
  else{
    echo "<script>alert('Data Sudah Ada')</script>";
    echo "<script>location='tambahuji.php'</script>";
  }
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Deictum | Data Uji</title>
  <!-- Tell the browser to be responsive to screen width -->
  <link rel="icon" type="image/png" href="../assets/img/logo.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
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
  <!-- End Navbar -->

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
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active bg-cyan">
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
                <a href="datauji.php" class="nav-link active">
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
          <li class="nav-item has-treeview">
            <a href="pengaturan.php" class="nav-link">
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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Uji</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a class="text-cyan" href="../dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Data Uji</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <!-- Main content -->
    <section class="content ">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Tambah data</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body align-content-center">
            <div class="row">
              <div class="col-lg-12">
              <!-- Form -->
                <form class="needs-validation" novalidate method="post">
                <!-- Jenis Kelamin -->
                <div class="col-lg-10">
                  <label for="validationCustomUsername"><br>JENIS KELAMIN</label>
                    <div class="custom-control custom-radio">
                      <input value="1" type="radio" class="custom-control-input" id="customControlValidation2" name="jk" required>
                      <label class="custom-control-label" for="customControlValidation2">Laki-laki</label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input value="0" type="radio" class="custom-control-input" id="customControlValidation3" name="jk" required>
                      <label class="custom-control-label" for="customControlValidation3">Perempuan</label>
                        <div class="invalid-feedback">Pilih terlebih dahulu</div>
                    </div>
                </div>
                <!-- -->
                <!-- Umur -->
                <div class="col-lg-10">
                    <label for="validationCustomUsername">UMUR</label>
                      <div class="input-group">
                        <input placeholder="0" name="umur" type="number" max="120" min="1" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroupPrepend">Tahun</span>
                        </div>
                        <div class="invalid-feedback">
                        Tolong diisi terlebih dahulu! Nilai antara 1-120
                        </div>
                      </div>
                </div>
                <!-- -->
                <!-- Hipertensi -->
                <div class="col-lg-10">
                  <label for="validationCustomUsername"><br>RIWAYAT PENYAKIT HIPERTENSI</label>
                    <div class="custom-control custom-radio">
                      <input value="1" type="radio" class="custom-control-input" id="customControlValidation4" name="hipertensi" required>
                      <label class="custom-control-label" for="customControlValidation4">Ya</label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input value="0" type="radio" class="custom-control-input" id="customControlValidation5" name="hipertensi" required>
                      <label class="custom-control-label" for="customControlValidation5">Tidak</label>
                        <div class="invalid-feedback">Pilih terlebih dahulu</div>
                    </div>
                </div>
                <!-- -->
                <!-- Jantung -->
                <div class="col-lg-10">
                  <label for="validationCustomUsername"><br>RIWAYAT PENYAKIT JANTUNG</label>
                    <div class="custom-control custom-radio">
                      <input value="1" type="radio" class="custom-control-input" id="customControlValidation6" name="jantung" required>
                      <label class="custom-control-label" for="customControlValidation6">Ya</label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input value="0" type="radio" class="custom-control-input" id="customControlValidation7" name="jantung" required>
                      <label class="custom-control-label" for="customControlValidation7">Tidak</label>
                        <div class="invalid-feedback">Pilih terlebih dahulu</div>
                    </div>
                </div>
                <!-- -->
                <!-- Status Menikah -->
                <div class="col-lg-10">
                  <label for="validationCustomUsername"><br>STATUS MENIKAH</label>
                    <div class="custom-control custom-radio">
                      <input value="1" type="radio" class="custom-control-input" id="customControlValidation8" name="nikah" required>
                      <label class="custom-control-label" for="customControlValidation8">Ya</label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input value="0" type="radio" class="custom-control-input" id="customControlValidation9" name="nikah" required>
                      <label class="custom-control-label" for="customControlValidation9">Tidak</label>
                        <div class="invalid-feedback">Pilih terlebih dahulu</div>
                    </div>
                </div>
                <!-- Kandungan Gula -->
                <div class="col-lg-10">
                    <label for="validationCustomUsername">KADAR GULA</label>
                      <div class="input-group">
                        <input placeholder="0" name="gula" type="number" step="0.01" max="500" min="1" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroupPrepend">mg/dL</span>
                        </div>
                        <div class="invalid-feedback">
                        Tolong diisi terlebih dahulu! Nilai antara 1-200
                        </div>
                      </div>
                </div>
                <!-- -->
                <div class="col-lg-10">
                    <label for="validationCustomUsername">BODY MASS INDEX</label>
                      <div class="input-group">
                        <input placeholder="0" name="bmi" type="number" step="0.1" max="500" min="1" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                        <div class="input-group-prepend">
                        </div>
                        <div class="invalid-feedback">
                        Tolong diisi terlebih dahulu! Nilai antara 1-200
                        </div>
                      </div>
                </div>
                <!-- Jenis Pekerjaan -->
                <div class="col-lg-10">
                    <label for="validationCustom04">JENIS PEKERJAAN</label>
                      <select name="kerja" class="custom-select" id="validationCustom04" required>
                        <option selected disabled value="">Choose...</option>
                        <option value="1">Private</option>
                        <option value="2">Self-Employed</option>
                        <option value="3">Gov_Job</option>
                        <option value="4">Children</option>
                      </select>
                    <div class="invalid-feedback">
                      Tolong dipilih terlebih dahulu!
                    </div>
                </div>
                <!-- Tempat Tinggal -->
                <div class="col-lg-10">
                    <label for="validationCustom04">TEMPAT TINGGAL</label>
                      <select name="tinggal" class="custom-select" id="validationCustom04" required>
                        <option selected disabled value="">Choose...</option>
                        <option value="2">KOTA</option>
                        <option value="1">DESA</option>
                      </select>
                    <div class="invalid-feedback">
                      Tolong dipilih terlebih dahulu!
                    </div>
                </div>
                <!-- Status Merokok -->
                <div class="col-lg-10">
                    <label for="validationCustom04">STATUS MEROKOK</label>
                      <select name="rokok" class="custom-select" id="validationCustom04" required>
                        <option selected disabled value="">Choose...</option>
                        <option value="1">Tidak Merokok</option>
                        <option value="2">Kadang Merokok</option>
                        <option value="3">Sering Merokok</option>
                      </select>
                    <div class="invalid-feedback">
                      Tolong dipilih terlebih dahulu!
                    </div>
                </div>
                 <!-- Tempat Tinggal -->
                 <div class="col-lg-10">
                    <label for="validationCustom04">KELAS</label>
                      <select name="class" class="custom-select" id="validationCustom04" required>
                        <option selected disabled value="">Choose...</option>
                        <option value="1">STROKE</option>
                        <option value="0">TIDAK STROKE</option>
                      </select>
                    <div class="invalid-feedback">
                      Tolong dipilih terlebih dahulu!
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
                  <div class="col-lg-10">
                      <button id="simpan" name="simpan" type="submit" class="btn btn-primary bg-cyan">Submit</button>
                    </form>
                    <!-- /. Form -->
                  </div>
              </div>
            </div>
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
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
        </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  <footer class="main-footer">
  Copyright &copy; 2019 <strong><a class="text-cyan" href="../dashboard.php">Deictum</a>.</strong> All rights
    reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/js/adminlte.min.js"></script>
<!-- overlayScrollbars -->
<script src="../assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../assets/js/demo.js"></script>
<!-- page script -->

</body>
</html>
