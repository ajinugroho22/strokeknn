<?php
set_time_limit(1500);
session_start();
if ($_SESSION['login']!="admin") {
  header('Location: ../login.php');
exit;
}

include'../control/koneksi.php';
include'../control/data_latih.php';
include'../modal/ordering.php';
include'../control/pengaturan.php';
$atr = new pengaturan();

//jika menekan tombol kosongkan
if(isset($_POST['kosong'])){
  //membersihkan tabel ordering
  $oor = new ordering();
  $oor->bersih();
  //membersihkan tabel data latih
  $dl= new datalatih();
  $hsl=$dl->kosong();
  $atr->ulang();
  if($hsl==1){
    header("Location : datalatih.php");
  }
  else{
  }
}

//jika menekan tombol import
if (isset($_POST['import'])) {
  include'../assets/plugins/spreadsheet-reader-master/php-excel-reader/excel_reader2.php';  
  include'../assets/plugins/spreadsheet-reader-master/SpreadsheetReader.php';

    $target_dir = "../file/".basename($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'],$target_dir);  
    $Reader = new SpreadsheetReader($target_dir);
    $jk=$umur=$hiper=$jantung=$kelas=0;
    $gula=$bmi=0.0;
    $rokok=1; 
    foreach ($Reader as $Key=> $Row){
      $jk=$Row[1];
      $umur=$Row[2];
      $hiper=$Row[3];
      $jantung=$Row[4];
      $gula=$Row[8];
      $bmi=$Row[9];
      $rokok=$Row[10];
      $kerja=$Row[6];
      $tinggal=$Row[7];
      $nikah=$Row[5];
      $class=$Row[11];
      //merubah data ordering
      //jenis_kelamin
      if($jk=="Female"){
        $jk=0;
      }
      else{
        $jk=1;
      }
      //status menikah
      if($nikah=="Yes"){
        $nikah=1;
      }
      else{
        $nikah=0;
      }
      //tempat tinggal
      if($tinggal=="Urban"){
        $tinggal=1;
      }
      else{
        $tinggal=2;
      }
      //tipe pekerjaan
      if($kerja=="Private"){
        $kerja=1;
      }
      elseif($kerja=="Self-employed"){
        $kerja=2;
      }
      elseif($kerja=="Govt_Job"){
        $kerja=3;
      }
      else{
        $kerja=4;
      }
      //status merokok
      if($rokok=="never smoked"){
        $rokok=1;
      }
      elseif($rokok=="formerly smoked"){
        $rokok=2;
      }
      else{
        $rokok=3;
      }
        // import data excel mulai baris ke-4 (karena ada header pada baris 1)
        if ($Key > 0) {
        if($umur!=""){
          //ceks
          $cek = new datalatih3;
          $nilai = $cek->cekdata($umur,$jk,$kerja,$hiper,$jantung,$class,$tinggal,$rokok,$nikah,$bmi,$gula);
          if($nilai==0){
              //memasukkan data baru
              $cek->masuk($jk,$umur,$gula,$bmi,$hiper,$jantung,$rokok,$tinggal,$kerja,$nikah,$class);
              echo "<script>location='datalatih.php'</script>";
          }
          else{
              //mengupdate data lama
              //$cek->update($jk,$umur,$gula,$bmi,$hiper,$jantung,$rokok,$tinggal,$kerja,$nikah,$date);
              echo "<script>location='datalatih.php'</script>";
          }
        }
      }
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Deictum | Data Latih</title>
  <!-- Tell the browser to be responsive to screen width -->
  <link rel="icon" type="image/png" href="../assets/img/logo.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
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

  <!-- Modal Kosongkan -->
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><span></span>Kosongkan Data Latih</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Yakin ingin mengosongkan data latih?</p>
            </div>
            <form method="post" enctype="multipart/form-data">
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
  <!-- / Modal Kosongkan -->

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
                <a href="datalatih.php" class="nav-link active">
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
            <h1>Data Latih</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a class="text-cyan" href="../dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Data Latih</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <!-- Import -->
        <div class="card card-info collapsed-card">
          <div class="card-header">
            <h3 class="card-title">Import Data   <button onclick="window.location.href='../file/template/templatedatalatih.xlsx'" class="btn btn-info"><i class="nav-icon fas fa-download"></i></button></h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
            </div>
          </div>
          <div class="card-body align-content-center">
            <div class="row align-content-center">
              <div class="col-md-10">
              <div class="form-group">
                <!-- Form -->
                    <form method="post" enctype="multipart/form-data">
                    <label for="exampleInputFile">File import</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input required name="file" accept=".xlsx, .xls" type="file" onchange="document.getElementById('prepend-big-btn').value = this.value; class="custom-file-input" id="exampleInputFile">
                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        <div class="input-group-append">
                        <button type="submit" id="import" name="import" class="btn btn-primary waves-effect waves-light">Import</button>
                        </div>
                      </div>
                    </form>
                  <!-- End Form -->
                </div>
                </div>
            </div>
          </div>
        </div>
          <!-- End Import -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title right">
                <?php 
                $dla = new datalatih2();
                $by = $dla->total();
                ?>
                  <a href="tambahlatih.php"><button class="btn btn-info"><i class="nav-icon fas fa-plus"></i> Tambah</button></a>
                  <button <?php if($by==0){echo "hidden";} ?> type="button" data-toggle="modal" data-target="#modal-default" class="btn btn-danger"><i class="nav-icon fas fa-trash"></i> Kosongkan</button>
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped table-responsive-lg">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Gender</th>
                    <th>Umur</th>
                    <th>Hipertensi</th>
                    <th>Jantung</th>
                    <th>Menikah</th>
                    <th>Pekerjaan</th>
                    <th>Tinggal</th>
                    <th>Gula</th>
                    <th>BMI</th>
                    <th>Status Merokok</th>
                    <th>Kelas</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    $no=1;
                    
                    $tampil = $dla->all();
                    if(!empty($tampil)){
                        foreach ($tampil as $key) {         
                    ?>
                <tr>
                  <td><?= $no ?></td>
                  <td><?php if ($key['j_kelamin'] == 1) { echo "Laki-laki"; } else { echo "Perempuan";} ?></td>
                  <td><?= $key['umur'] ?> Tahun</td>
                  <td><?php if ($key['hipertensi'] == 1) { echo "Ya"; } else { echo "Tidak";} ?></td>
                  <td><?php if ($key['jantung'] == 1) { echo "Ya"; } else { echo "Tidak";} ?></td>
                  <td><?php if ($key['nikah']==1){ echo "Ya"; } else { echo "Tidak"; } ?></td>
                  <td><?php if ($key['kerja']==1){ echo "Private"; } elseif($key['kerja']==2){ echo "Self-Employed"; } elseif($key['kerja']==3){ echo "Govt_Job"; } else { echo "Child"; }  ?></td>
                  <td><?php if ($key['tinggal']==1){ echo "Desa"; } else { echo "Kota"; } ?></td>
                  <td><?= $key['gula'] ?> mg/dl</td>
                  <td><?= $key['bmi'] ?></td>
                  <td><?php if ($key['merokok'] == 1) { echo "Tidak Merokok"; } elseif($key['merokok'] == 2) {echo "Jarang Merokok";} else { echo "Sering Merokok";} ?></td>
                  <td><?php if ($key['class'] == 1) { echo "Stroke"; } else { echo "Tidak Stroke";} ?></td>
                </tr>
                <?php
                $no++;
                        }
                    }
                    else{
                    echo '
                    <tr>
                      <td colspan="12">
                          Data Tidak Ada
                      </td>
                    </tr>
                      ';
                    }
                ?>
                </tbody>
              </table>
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
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1
    </div>
    Copyright &copy; 2019 <strong><a class="text-cyan" href="../dashboard.php">Deictum</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="../assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="../assets/js/adminlte.min.js"></script>
 <!-- bs-custom-file-input -->
 <script src="../assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../assets/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": true,
    });
  });
</script>
<script type="text/javascript">
    $(document).ready(function () {
      bsCustomFileInput.init();
    });

  </script>

</body>
</html>
