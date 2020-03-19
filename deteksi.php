<?php
date_default_timezone_set('Asia/Jakarta');
include'control/koneksi.php';
include'modal/bmi.php';
include'modal/range.php';
include'modal/jarak.php';
include'modal/ordering.php';
include'modal/prediksi.php';
include'control/pengaturan.php';
include'control/data_uji.php';
$atr = new pengaturan();

$du = new datauji();

$datape = $atr->all();
foreach ($datape as $key) {
    $exp=$key['eks'];
}

$nilai_k=$atr->ambil();
if(isset($_POST['cek'])){
//mengambil data waktu
$date=date("Y-m-d H:i:s");
$classs=$_POST['class'];
//memasukkan data ke database
$du->masuk($_POST['jk'],$_POST['umur'],$_POST['gula'],$_POST['bmi'],$_POST['hipertensi'],$_POST['jantung'],$_POST['rokok'],$_POST['tinggal'],$_POST['kerja'],$_POST['nikah'],$date,$_POST['class']);
//menghitung nilai bmi dari hasil perhitungan tinggi dan berat
//$bmi=bmi($_POST['tinggi_b'], $_POST['berat_b']);

//memasukkan data hasil inputan form ke array
$datauji = array(
    1 => $_POST['nama'] ,
    2 => $_POST['jk'] ,
    3 => $_POST['umur'] ,
    4 => $_POST['jantung'] ,
    5 => $_POST['hipertensi'] ,
    6 => $_POST['gula'] ,
    7 => $_POST['bmi'] ,
    8 => $_POST['rokok'],
    9 => $_POST['nikah'],
    10 => $_POST['tinggal'],
    11 => $_POST['kerja'] 
);

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <link rel="icon" type="image/png" href="assets/img/logo.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
      <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/adminlte.min.css">
    <title>Deictum</title>
  </head>
  <body>
<!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
    <a class="navbar-brand" href="index.php">Deictum</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">
            <a class="nav-item nav-link active" href="index.php#home">Home <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="index.php#tentang">Tentang</a>
            <a class="nav-item nav-link" href="index.php#deteksi">Deteksi</a>
            
            </div>
        </div>
      </div>
    </nav>
<!-- End Nav -->
<!-- Prediksi -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 text-center">
        <br><h2 class="">Prediksi</h2><br>
        </div>
    </div>
</div>
<!-- Prediksi -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 text-center">
                <table class="table table-bordered table-striped table-responsive-lg" cellpading="0" cellspacing="0">
                        <thead>
                            <tr>
                                <th>KONDISI SEBENARNYA</th>
                                <th>FUZZY</th>
                                <th>WEIGTED</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                        <?php
                        //Mencari Range atribut umur, gula, bmi
                        $ra = new rangee();
                        $rangeum=$ra->rangeum($datauji[3]);
                        $rangegul=$ra->rangegul($datauji[6]);
                        $rangebmi=$ra->rangebmi($datauji[7]);

                        //bersihkan
                        $oor = new ordering();
                        $oor->bersih();
                        //memanggil data latih dari database
                        $datalatih = $koneksi->prepare("SELECT * FROM data_latih") or die ("Gagal menampilkan data latih");
                        $datalatih->execute();
                        $dt = $datalatih->fetchALL(PDO::FETCH_ASSOC);
                            if(!empty($dt)){
                                foreach($dt as $rows){
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
                                }
                                //mengurutkan jarak dari yang terbesar sampai terkecil
                                $oor->order();
                                //melakukan prediksi
                                $predik = new prediksi();
                                $r=$predik->knn($nilai_k);
                                $q=$predik->weightedknn($nilai_k,$exp);
                                $w=$predik->fuzzyknn($nilai_k,$exp);
                                
                }
                ?>
                <tr>
                    <td><?php if($classs==0){ echo 'Tidak Stroke';} else { echo 'Stroke'; } ?></td>
                    <td><?php if($w==$classs){ echo 'Benar';} else { echo 'Salah'; } ?></td>
                    <td><?php if($q==$classs){ echo 'Benar';} else { echo 'Salah'; } ?></td>
                </tr>
                </tbody>
                </table>
                        <!-- -->
        </div>
    </div>
<!-- Data Pengguna -->
                <div class="row">
                <!-- /.col -->
                <div class="col-md-12">
                    <!-- Widget: user widget style 1 -->
                    <div class="widget-user card-light">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header">
                        <h3 class="widget-user-username"><?= $_POST['nama']?></h3>
                        <h5 class="widget-user-desc"><?php if ($_POST['tinggal'] == 1) { echo "Tinggal di Desa"; } else { echo "Tinggal di Kota";} ?></h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2" <?php if ($_POST['jk'] == 1) { echo "src='assets/img/avatar.png'"; } else { echo "src='assets/img/avatar2.png'";} ?> alt="User Avatar">
                    </div>
                    <div class="card-body">
                        <div class="row">
                        <div class="col-sm-3 border-right">
                            <div class="description-block">
                            <h5 class="description-header"><?= $_POST['umur'] ?> Tahun <span style="color:green;" class="fa fa-check-circle"></span></h5>
                            <span class="description-text">Usia</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 border-right">
                            <div class="description-block">
                            <h5 class="description-header"><?php if ($_POST['nikah']==1){ echo "Ya"; } else { echo "Tidak"; }?> <span style="color:green;" class="fa fa-check-circle"></span></h5>
                            <span class="description-text">Menikah</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 border-right">
                            <div class="description-block">
                            <h5 class="description-header"><?php if ($_POST['kerja']==1){ echo "Private"; } elseif($_POST['kerja']==2){ echo "Self-Employed"; } elseif($_POST['kerja']==3){ echo "Govt_Job"; } else { echo "Child"; } ?> <span style="color:green;" class="fa fa-check-circle"></span></h5>
                            <span class="description-text">Pekerjaan</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3">
                            <div class="description-block">
                            <h5 class="description-header"><?= $_POST['bmi']?> <span style="color:green;" class="fa fa-check-circle"></span></h5>
                            <span class="description-text">Body Mass Index</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <div class="col-sm-3 border-right border-top">
                            <div class="description-block">
                            <h5 class="description-header"><?= $_POST['gula']?> mg/dL <span style="color:green;" class="fa fa-check-circle"></span></h5>
                            <span class="description-text">Kadar Gula</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <div class="col-sm-3 border-right border-top">
                            <div class="description-block">
                            <h5 class="description-header"><?php if ($_POST['hipertensi'] == 1) { echo "Ya"; } else { echo "Tidak";} ?> 
                                <span <?php if ($_POST['hipertensi'] == 1) { echo "style='color:orange;'"; } else { echo "style='color:green;'";} ?> class="fa fa-check-circle"></span></h5>
                            <span class="description-text">Riwayat Hipertensi</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <div class="col-sm-3 border-right border-top">
                            <div class="description-block">
                            <h5 class="description-header"><?php if ($_POST['jantung'] == 1) { echo "Ya"; } else { echo "Tidak";} ?> 
                                <span <?php if ($_POST['jantung'] == 1) { echo "style='color:orange;'"; } else { echo "style='color:green;'";} ?> class="fa fa-check-circle"></span></h5>
                            <span class="description-text">Riwayat Jantung</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <div class="col-sm-3 border-top">
                            <div class="description-block">
                            <h5 class="description-header"><?php if ($_POST['rokok'] == 1) { echo "Tidak Merokok"; } elseif ($_POST['rokok'] == 2) { echo "Jarang Merokok"; } else { echo "Sering Merokok"; } ?>
                                <span <?php if ($_POST['rokok'] == 1) { echo "style='color:green;'"; } elseif ($_POST['rokok'] == 2) { echo "style='color:orange;'"; } else { echo "style='color:red;'"; } ?> class="fa fa-check-circle"></span></h5>
                            <span class="description-text">Status Merokok</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    </div>
                    <!-- /.widget-user -->
                </div>
                <!-- /.row -->
</div>
<!-- / container -->
<!-- Data Pengguna -->

<!-- Peringatan-->

<!-- Peringatan-->
<!-- Footer -->
<div class="container">
  <div class="row footer">
    <div class="col text-center">
      <a href="login.php">You're Admin?</a>
      <p>Copyright &copy; 2019 <strong><a href="index.php">Deictum</a>.</strong> All rights
    reserved.</p>
    </div>
  </div>
</div>
<?php
}
else
    header("Location: index.php");
?>
<!-- End Footer -->
<script src="assets/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/js/demo.js"></script>
</body>
</html>