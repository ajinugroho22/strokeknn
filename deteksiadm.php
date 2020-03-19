<?php
set_time_limit(6000);
session_start();
if ($_SESSION['login']!="admin") {
  header('Location: login.php');
exit;
}
include'control/koneksi.php';
include'modal/bmi.php';
include'modal/range.php';
include'modal/jarak2.php';
include'modal/ordering.php';
include'modal/prediksi2.php';
include'control/data_uji.php';
include'control/pengaturan.php';
include'control/data_latih.php';
include'modal/akurasi.php';

$du = new datauji(); 
$predik = new prediksi();
$atr = new pengaturan();
$dt = new datalatih2();
$ak = new akurasi();

$total_data=$dt->total();

$total_dt=$du->total();

if(isset($_POST['jalan'])){
  $a=$_POST['range_1'];
  $b=$_POST['range_2'];
  $c=explode(';',$a);
  $atr->update($b,$c[0],$c[1]); 
  }
  else
  {
     echo "<script>alert('Tidak bisa mengakses halaman ini, silahkan menuju ke halaman data uji')</script>";
     echo "<script>location='view/datauji.php'</script>";
  }

$datape = $atr->all();
foreach ($datape as $key) {
  $exp=$key['eks'];
}

$akurasi[][] = array();
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
  <!-- Ion Slider -->
  <link rel="stylesheet" href="assets/plugins/ion-rangeslider/css/ion.rangeSlider.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/adminlte.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
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
          <li class="nav-item has-treeview">
            <a href="dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <!-- -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active bg-cyan">
              <i class="nav-icon fas fa-search"></i>
              <p>Deteksi</p>
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
            <h1 class="m-0 text-dark">Hasil Deteksi</h1>
              
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a class="text-cyan" href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Hasil Deteksi</li>
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
        <div class="col-lg-12">
        <br>
              <label>Nilai Ketetanggan</label>
                <input id="range_1" class="form-control" type="text" name="range_1" value="" required>
              <label>Nilai Eksponensial</label>
                <input id="range_2" class="form-control" type="text" name="range_2" value="" required>
        <br>
        <!-- Data Latih -->
        <div class="card collapsed-card card-outline card-cyan">
              <div class="card-header">
                <h3 class="card-title right"><i class="fas fa-table"></i> Data Latih
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                </div>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-responsive-lg">
                  <thead>
                  <tr>
                  <th>No</th>
                    <th>Gender</th>
                    <th>Umur</th>
                    <th>Jantung</th>
                    <th>Hipertensi</th>
                    <th>Gula</th>
                    <th>BMI</th>
                    <th>Status Merokok</th>
                    <th>Menikah</th>
                    <th>Tinggal</th>
                    <th>Pekerjaan</th>
                    <th>Kelas</th>
                  </tr>
                  </thead>
                  <tbody>
                      <?php
                      $no=1;
                      $tampil = $dt->all();
                      if(!empty($tampil)){
                          foreach ($tampil as $key) {     
                      ?>
                  <tr>
                  <td><?= $no ?></td>
                  <td><?php if ($key['j_kelamin'] == 1) { echo "Laki-laki"; } else { echo "Perempuan";} ?></td>
                  <td><?= $key['umur'] ?> Tahun</td>
                  <td><?php if ($key['jantung'] == 1) { echo "Ya"; } else { echo "Tidak";} ?></td>
                  <td><?php if ($key['hipertensi'] == 1) { echo "Ya"; } else { echo "Tidak";} ?></td>
                  <td><?= $key['gula'] ?> mg/dl</td>
                  <td><?= $key['bmi'] ?></td>
                  <td><?php if ($key['merokok'] == 1) { echo "Tidak Merokok"; } elseif($key['merokok'] == 2) {echo "Jarang Merokok";} else { echo "Sering Merokok";} ?></td>
                  <td><?php if ($key['nikah']==1){ echo "Ya"; } else { echo "Tidak"; } ?></td>
                  <td><?php if ($key['tinggal']==1){ echo "Desa"; } else { echo "Kota"; } ?></td>
                  <td><?php if ($key['kerja']==1){ echo "Private"; } elseif($key['kerja']==2){ echo "Self-Employed"; } elseif($key['kerja']==3){ echo "Govt_Job"; } else { echo "Child"; }  ?></td>
                  <td><?php if ($key['class'] == 1) { echo "Stroke"; } else { echo "Tidak Stroke";} ?></td>
                  </tr>
                  <?php
                  $no++;
                          }
                      }
                      else{
                      echo '
                      <tr>
                        <td colspan="10">
                            Data Tidak Ada
                        </td>
                      </tr>
                        ';
                      }
                  ?>
                </table>
              </div>
              </div>
              <!-- / Data Latih -->
              <!-- Data Uji -->
              <div class="card collapsed-card card-outline card-cyan">
              <div class="card-header">
                <h3 class="card-title right"> <i class="fas fa-table"></i> Data Uji
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                </div>
              </div>
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped table-responsive-lg">
                  <thead>
                  <tr>
                    <th>Kode</th>
                    <th>Gender</th>
                    <th>Umur</th>
                    <th>Jantung</th>
                    <th>Hipertensi</th>
                    <th>Gula</th>
                    <th>BMI</th>
                    <th>Status Merokok</th>
                    <th>Menikah</th>
                    <th>Tinggal</th>
                    <th>Pekerjaan</th>
                  </tr>
                  </thead>
                  <tbody>
                      <?php
                      $no=1;
                      $tampil = $du->all();
                      if(!empty($tampil)){
                          foreach ($tampil as $key) {     
                      ?>
                  <tr>
                  <td><?= $key['no'] ?></td>
                    <td><?php if ($key['j_kelamin'] == 1) { echo "Laki-laki"; } else { echo "Perempuan";} ?></td>
                    <td><?= $key['umur'] ?> Tahun</td>
                    <td><?php if ($key['jantung'] == 1) { echo "Ya"; } else { echo "Tidak";} ?></td>
                    <td><?php if ($key['hipertensi'] == 1) { echo "Ya"; } else { echo "Tidak";} ?></td>
                    <td><?= $key['gula'] ?> mg/dl</td>
                    <td><?= $key['bmi'] ?></td>
                    <td><?php if ($key['merokok'] == 1) { echo "Tidak Merokok"; } elseif($key['merokok'] == 2) {echo "Jarang Merokok";} else { echo "Sering Merokok";} ?></td>
                    <td><?php if ($key['nikah']==1){ echo "Ya"; } else { echo "Tidak"; } ?></td>
                    <td><?php if ($key['tinggal']==1){ echo "Desa"; } else { echo "Kota"; } ?></td>
                    <td><?php if ($key['kerja']==1){ echo "Private"; } elseif($key['kerja']==2){ echo "Self-Employed"; } elseif($key['kerja']==3){ echo "Govt_Job"; } else { echo "Child"; }  ?></td>
                  </tr>
                  <?php
                  $no++;
                          }
                      }
                      else{
                      echo '
                      <tr>
                        <td colspan="10">
                            Data Tidak Ada
                        </td>
                      </tr>
                        ';
                      }
                  ?>
                </table>
              </div>
              </div>
              <!-- / Data Uji -->
              <!-- DETEKSI -->
        <div class="card card-primary card-outline collapsed-card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-edit"></i>
              Perhitungan
            </h3>
            <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
            </div>
          </div>
          <div class="card-body">
            <?php
              //memanggil data uji
              $dat=$du->all();
              $nno=1;
             
              //membersihkan tabel prediksi
              $predik->bersih();
              $ak->hapus();
              foreach ($dat as $key) {
                  $datauji = array(
                      1 => $key['no'],
                      2 => $key['j_kelamin'] ,
                      3 => $key['umur'] ,
                      4 => $key['jantung'] ,
                      5 => $key['hipertensi'] ,
                      6 => $key['gula'] ,
                      7 => $key['bmi'] ,
                      8 => $key['merokok'],
                      9 => $key['nikah'],
                      10 => $key['tinggal'],
                      11 => $key['kerja']  
                  );
              //Mencari Range atribut umur, gula, bmi
              $ra = new rangee();
              $rangeum=$ra->rangeum($key['umur']);
              $rangegul=$ra->rangegul($key['gula']);
              $rangebmi=$ra->rangebmi($key['bmi']);
              
              //membersihkan tabel ordering
              $oor = new ordering();
              $oor->bersih();
            ?>
            <h4>Data Uji-<?= $key['no']?></h4>
            <!-- Tabel Perhitungan Jarak -->
            <table id="jarak<?= $nno ?>" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th></th>
                  <th> Range = <?= $rangeum ?></th>
                  <th colspan="2"></th>
                  <th> Range = <?= $rangegul ?></th>
                  <th> Range = <?= $rangebmi ?></th>
                  <th colspan="7"></th>
                </tr>
                <tr>
                  <th>S1</th>
                  <th>S2</th>
                  <th>S3</th>
                  <th>S4</th>
                  <th>S5</th>
                  <th>S6</th>
                  <th>S7</th>
                  <th>S8</th>
                  <th>S9</th>
                  <th>S10</th>
                  <th>Total S</th>
                  <th>Total Bobot</th>
                  <th>Jarak</th>
                </tr>
              </thead>
              <tbody>
            
            <?php
            $datalatih = $koneksi->prepare("SELECT * FROM data_latih") or die ("Gagal menampilkan data latih");
                $datalatih->execute();
                $dt = $datalatih->fetchALL(PDO::FETCH_ASSOC);
                    if(!empty($dt)){
                        foreach($dt as $rows){
                        echo '<tr>';
                            $datlat = array(
                                2 => $rows['j_kelamin'] ,
                                3 => $rows['umur'] ,
                                4 => $rows['jantung'] ,
                                5 => $rows['hipertensi'] ,
                                6 => $rows['gula'] ,
                                7 => $rows['bmi'] ,
                                8 => $rows['merokok'],
                                9 => $rows['nikah'],
                                10 => $rows['tinggal'],
                                11 => $rows['kerja'] 
                            );
                            //mencari jarak kedekatan
                            $jrk=jarak($datauji,$datlat,$rangeum,$rangegul,$rangebmi,$rows['id']);
                        echo '</tr>';
                        }
                        ?>
                </tbody>
                </table>
                
              <?php
                        //mengurutkan jarak dari yang terbesar sampai terkecil
                        $oor->order();

                        //backup data jarak
                        $dlatih = $oor->all();
                        $jarak[$nno]=[
                          'jarak' => ['data_latih' => $dlatih]
                        ];


                        //echo $jarak[$nno]['data_latih'][9]['jarak'];
                         //melakukan prediksi
                         if($c[0]==$c[1]){?>
                              <h5>Deteksi</h5>
                              <table class="table table-bordered table-striped table-responsive-lg">
                              <thead>
                              <tr>
                                <th></th>
                                <th colspan="3">KNN</th>
                                <th colspan="7">Fuzzy KNN</th>
                                <th colspan="7">Weighted KNN</th>
                              </tr>
                              <tr>
                                <th>Nilai K</th>
                                <th>Skor-0</th>
                                <th>Skor-1</th>
                                <th>Deteksi</th>
                                <th>U (0,0)</th>
                                <th>U (0,1)</th>
                                <th>U (1,0)</th>
                                <th>U (1,1)</th>
                                <th>U0</th>
                                <th>U1</th>
                                <th>Deteksi</th>
                                <th>Bobot 0</th>
                                <th>Bobot 1</th>
                                <th>Skor-0</th>
                                <th>Skor-1</th>
                                <th>(Skor * Bobot) 0</th>
                                <th>(Skor * Bobot) 1</th>
                                <th>Deteksi</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                              echo '<tr>';
                              echo '<td>';
                              echo $c[0];
                              echo '</td>';
                              $r=$predik->knn($c[0]);
                              $w=$predik->fuzzyknn($c[0],$exp);
                              $q=$predik->weightedknn($c[0],$exp);
                              echo '</tr>';
                              //prediksi
                              $predik->masukknn($key['no'],$key['class'],$r,$c[0]);
                              $predik->masukfuzzy($key['no'],$w,$c[0]);
                              $predik->masukweighted($key['no'],$q,$c[0]);
                              //backup data prediksi
                              $dpre = $predik->all();
                              $pre=[
                                0 => ['prediksi' => $dpre]
                              ];
                              $ak->masukawal($c[0]);
                              //akurasi
                              $aki1=$ak->hitungknn($c[0]);
                              $aki2=$ak->hitungF($c[0]);
                              $aki3=$ak->hitungW($c[0]);
                              $ak->masukknn($c[0],$aki1);
                              $ak->masukF($c[0],$aki2);
                              $ak->masukW($c[0],$aki3);
                              // $akurasi=[
                              //   0 => ['tetangga' => $c[0], 'knn' => $aki1, 'fuzzy' => $aki2, 'weigted' => $aki3]
                              // ];
                              ?>
                              </tbody>
                            </table>
                            <br>
                              <?php
                         }
                         else{
                          ?>
                          <h5>Deteksi</h5>
                          <table class="table table-bordered table-striped table-responsive-lg text-center">
                          <thead>
                          <tr>
                            <th></th>
                            <th colspan="3">KNN</th>
                            <th colspan="7">Fuzzy KNN</th>
                            <th colspan="7">Weighted KNN</th>
                          </tr>
                          <tr>
                            <th>Nilai K</th>
                            <th>Skor-0</th>
                            <th>Skor-1</th>
                            <th>Deteksi</th>
                            <th>U (0,0)</th>
                            <th>U (0,1)</th>
                            <th>U (1,0)</th>
                            <th>U (1,1)</th>
                            <th>U0</th>
                            <th>U1</th>
                            <th>Deteksi</th>
                            <th>Bobot 0</th>
                            <th>Bobot 1</th>
                            <th>Skor-0</th>
                            <th>Skor-1</th>
                            <th>(Skor * Bobot) 0</th>
                            <th>(Skor * Bobot) 1</th>
                            <th>Deteksi</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                              for ($i=$c[0]; $i <= $c[1]; $i++) {
                              
                                
                                echo '<tr>';
                                echo '<td>';
                                echo $i;
                                echo '</td>';
                                $r=$predik->knn($i);
                                $w=$predik->fuzzyknn($i,$exp);
                                $q=$predik->weightedknn($i,$exp);
                                echo '</tr>';
                                //prediksi
                                $predik->masukknn($key['no'],$key['class'],$r,$i);
                                $predik->masukfuzzy($key['no'],$w,$i);
                                $predik->masukweighted($key['no'],$q,$i);
                                //backup data prediksi
                                $dpre = $predik->all();
                                $pre=[
                                  0 => ['prediksi' => $dpre]
                                ];
                                $ak->masukawal($i);
                                // $akurasiknn=[
                                //    $i => ['akurasi' => $aki1] 
                                // ];q
                              }
                              ?>
                              </tbody>
                            </table>
                            <br>
                              <?php
                              for ($i=$c[0]; $i <= $c[1]; $i++) {
                                $aki1=$ak->hitungknn($i);
                                $aki2=$ak->hitungF($i);
                                $aki3=$ak->hitungW($i);
                                $ak->masukknn($i,$aki1);
                                $ak->masukF($i,$aki2);
                                $ak->masukW($i,$aki3);
                              }
                              
                         }
                        
                     }
         $nno++;
         }
              ?>
            </div>
          </div>
              
              <!-- Perhitungan Jarak -->
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-edit"></i>
              Jarak
            </h3>
            <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
          </div>
          <div class="card-body">
          <?php
                //total data latih
                $total_du=$du->total();
                  ?>
                <table id="example3" class="table table-bordered table-striped table-responsive-lg">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Gender</th>
                    <th>Umur</th>
                    <th>Hipertensi</th>
                    <th>Jantung</th>
                    <th>Gula</th>
                    <th>BMI</th>
                    <th>Status Merokok</th>
                    <th>Klasifikasi</th>
                    <th>Jarak</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  for ($b=1; $b<=$total_dt ; $b++){
                  for ($a=0; $a <10; $a++) {
                    //echo $jarak[$i]['data_latih'][$a]['jarak'];
                    $iid=$jarak[$b]['jarak']['data_latih'][$a]['no_data_latih'];
                    $dtlatih1 = $koneksi->prepare("SELECT * FROM data_latih WHERE id=:id") or die ("Gagal menampilkan data latih");
                    $dtlatih1->BindParam(":id",$iid,PDO::PARAM_INT);
                    $dtlatih1->execute();
                    $dt1 = $dtlatih1->fetchALL(PDO::FETCH_ASSOC);
                    foreach ($dt1 as $gg) {
                      # code...
                    
                  ?>
                    <tr>
                      <td><?php echo $a+1;?></td>
                      <td><?php if ($gg['j_kelamin'] == 1) { echo "Laki-laki"; } else { echo "Perempuan";} ?></td>
                      <td><?= $gg['umur'] ?> Tahun</td>
                      <td><?php if ($gg['jantung'] == 1) { echo "Ya"; } else { echo "Tidak";} ?></td>
                      <td><?php if ($gg['hipertensi'] == 1) { echo "Ya"; } else { echo "Tidak";} ?></td>
                      <td><?= $gg['gula'] ?> mg/dl</td>
                      <td><?= $gg['bmi'] ?></td>
                      <td><?php if ($gg['merokok'] == 1) { echo "Tidak Merokok"; } elseif($gg['merokok'] == 2) {echo "Jarang Merokok";} else { echo "Sering Merokok";} ?></td>
                      <td><?php if($jarak[$b]['jarak']['data_latih'][$a]['class']==1){ echo "Stroke"; } else { echo "Tidak Storke";}?></td>
                      <td><?php echo $jarak[$b]['jarak']['data_latih'][$a]['jarak'];?></td>
                    </tr>
                    <?php
                      }
                    }
                  }
                    ?>
                </table>
              

              </div>
            </div>
          </div>
        </div>
              <!-- / Perhitungan Jarak-->
        <!-- Deteksi -->
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-edit"></i>
              Deteksi
            </h3>
            <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
          </div>
          <div class="card-body">
          <?php
                //total data latih
                
                $rt=(($c[1]-$c[0])+1)*$total_dt;
                  ?>
                <table id="example4" class="table table-bordered table-striped table-responsive-lg">
                <thead>
                  <tr>
                    <th>Data Uji</th>
                    <th>Klasifikasi</th>
                    <th>Akurasi KNN</th>
                    <th>Deteksi Fuzzy KNN</th>
                    <th>Deteksi Weighted KNN</th>
                    <th>Nilai K</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    //echo $pre[$i]['prediksi'][''][$a];
                   //print_r($pre);
                   $nn=1;
                   for ($i=0; $i < $rt; $i++) {
                  ?>
                    <tr>
                      <td><?php echo $pre[0]['prediksi'][$i]['id_datauji']; ?></td>
                      <td><?php if($pre[0]['prediksi'][$i]['class']==1){ echo "Stroke"; } else { echo "Tidak Storke";} ?></td>
                      <td><?php if($pre[0]['prediksi'][$i]['knn']==1){ echo "Stroke"; } else { echo "Tidak Storke";}  ?></td>
                      <td><?php if($pre[0]['prediksi'][$i]['fuzzy']==1){ echo "Stroke"; } else { echo "Tidak Storke";} ?></td>
                      <td><?php if($pre[0]['prediksi'][$i]['weigted']==1){ echo "Stroke"; } else { echo "Tidak Storke";} ?></td>
                      <td><?= $pre[0]['prediksi'][$i]['k'] ?></td>
                    </tr>
                    <?php
                    $nn++;
                    }
                    ?>
                </table>
              

              </div>
            </div>
      
            <!-- / Perhitungan -->
            <!-- Akurasi -->
        <div class="card card-warning card-outline">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-edit"></i>
              Akurasi
            </h3>
            <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
          </div>
          <div class="card-body">
          <?php
                  ?>
                <table id="example4" class="table table-bordered table-striped table-responsive-lg">
                <thead>
                  <tr>
                    <th>Nilai Ketetanggaan</th>
                    <th>Akurasi KNN</th>
                    <th>Akurasi Fuzzy KNN</th>
                    <th>Akurasi Weighted KNN</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    //echo $pre[$i]['prediksi'][''][$a];
                   //print_r($pre);
                    $kur = $koneksi->prepare("SELECT * FROM akurasi GROUP BY k") or die ("Gagal menampilkan data latih");
                    $kur->execute();
                    $kurs = $kur->fetchALL(PDO::FETCH_ASSOC);
                    foreach ($kurs as $ggg) {
                  ?>
                    <tr>
                      <td><?= $ggg['k'] ?></td>
                      <td><?= number_format($ggg['akurasiknn'],2)?>%</td>
                      <td><?= number_format($ggg['akurasiF'],2) ?>%</td>
                      <td><?= number_format($ggg['akurasiW'],2) ?>%</td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
              

              </div>
            </div>
            <?php
            $kuco = new datalatih2();
            $aaaa = $kuco->total();
            ?>
            <!-- -->
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Grafik Tingkat Akurasi</h3>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg"><?= $aaaa; ?> </span>
                    <span>Jumlah Data Latih</span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-check-circle"></i> <?= $total_dt ?>
                    </span>
                    <span class="text-muted">Jumlah Data Uji</span>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="visitors-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> KNN
                    <i class="fas fa-square text-gray-dark"></i> FKNN
                    <i class="fas fa-square text-warning"></i> NWKNN
                  </span>
                </div>
              </div>
            </div>
            <!-- / Card -->
          </div>
        </div>
            <!-- / -->

        
            <!-- -->
        </div>
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
<script src="assets/js/demo.js"></script><!-- DataTables -->
<script src="assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<!-- Ion Slider -->
<script src="assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>

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
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": true,
    });
    $('#example3').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": true,
    });
    $('#example4').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": true,
    });
    <?php for($i=1; $i<=$total_du;$i++) { ?>
    $('#jarak<?= $i ?>').DataTable({
      "pageLength":5,
      "paging": true,
      "lengthChange": true,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": true,
    });
    <?php
    }
    ?>
  });
</script>
 <script>
$(function () {
      /* ION SLIDER */
      $('#range_1').ionRangeSlider({
        min: 3,
        max: <?= $total_data ?>,
        from: <?= $c[0] ?>,
        to: <?= $c[1] ?>,
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
      $(function () {
      'use strict'

      
  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode = 'index'
  var intersect = true


      var $visitorsChart = $('#visitors-chart')
  var visitorsChart = new Chart($visitorsChart, {
    data: {
      labels: [<?php for($i=$c[0]; $i<=$c[1]; $i++){ echo '"K- '.$i.'",';} ?>],
      datasets: [{
          type: 'line',
          data: [<?php foreach ($kurs as $gggg) { echo '"'.$gggg['akurasiknn'].'",';} ?>],
          backgroundColor: 'transparent',
          borderColor: '#007bff',
          pointBorderColor: '#007bff',
          pointBackgroundColor: '#007bff',
          fill: false
          // pointHoverBackgroundColor: '#007bff',
          // pointHoverBorderColor    : '#007bff'
        },
        {
          type: 'line',
          data: [<?php foreach ($kurs as $gggg) { echo '"'.$gggg['akurasiF'].'",';} ?>],
          backgroundColor: 'transparent',
          borderColor: '#343a40',
          pointBorderColor: '#343a40',
          pointBackgroundColor: '#343a40',
          fill: false
        },
        {
          type: 'line',
          data: [<?php foreach ($kurs as $gggg) { echo '"'.$gggg['akurasiW'].'",';} ?>],
          backgroundColor: 'transparent',
          borderColor: '#ffaa00',
          pointBorderColor: '#ffaa00',
          pointBackgroundColor: '#ffaa00',
          fill: false
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,
            suggestedMax: 100
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })
})
      </script>
</body>
</html>
