
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
    <title>Deictum</title>
  </head>
  <body>
<!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
    <a class="navbar-brand" href="index.php">Deictum</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">
            <a class="nav-item nav-link active" href="#home">Home <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="#tentang">Tentang</a>
            <a class="nav-item nav-link" href="#deteksi">Deteksi</a>
            <a class="nav-item nav-link" href="login.php">Login</a>
            </div>
        </div>
      </div>
    </nav>
<!-- End Nav -->
<!-- Jumbroton -->
      <div id="home" class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-4">Perbandingan Metode Fuzzy K-Nearest Neighbor dan Neighbor Weighted K-Nearest Neighbor untuk deteksi penyakit stroke
          <p>- Syamsul Aji Nugroho (5150411038) -</p>
          </h1>
          <p class="lead"></p>
        </div>
      </div>
<!-- End Jumbroton -->
<!-- Tentang -->
<div id="tentang" class="container">
<div class="row tentang">
    <div class="col-lg-6">
        <img src="assets/img/logo2.png" alt="Tentang" class="img-circle">
    </div>
    <div class="col-lg-5">
      <h3><span>De</span>ictum</h3>
      <p>Deictum adalah website untuk mendeteksi penyakit stroke dengan menggunakan 
        data mining untuk klasifikasi data. Deteksi sedari dini diri anda anggar tidak menyesal dikemudian hari.</p>
      <a href="#deteksi" class="btn btn-primary tombol">Deteksi</a>
    </div>
  </div>
</div>
<!-- End Tentang -->
<!-- Judul Form-->
<div  class="container">
  <div class="row">
    <div class="col text-center judul">
      <h3>Deteksi Penyakit <span>Stroke</span></h3>
      <p>Isi form di bawah ini</p>
    </div>
  </div>
</div>
<!-- End Judul Form -->
<!-- Form -->
          <?php
            include'./control/data_latih.php';
            $dl = new datalatih2();
            $cek = $dl->total();
          ?>
      <div id="deteksi" class="container">
        <form class="needs-validation" novalidate method="post" action="deteksi.php">
          <div class="row justify-content-center">
            <div class="col-lg-8">
              <div <?php if ($cek>=1){ echo "hidden";} ?> class="alert alert-warning" role="alert">
                <b>Deictum sedang maintenance</b>, fitur deteksi sedang tidak bisa digunakan.
              </div>
            </div>
          <!-- Nama -->
          
          <div class="col-lg-8">
              <label for="validationCustom01">NAMA</label>
                <input <?php if ($cek==0){ echo "readonly";} ?> placeholder="Nama anda" name="nama" type="text" class="form-control" id="validationCustom01" value="" required>
                  <div class="invalid-feedback">
                    Tolong diisi terlebih dahulu!
                  </div>
          </div>
          <!-- Jenis Kelamin -->
          <div class="col-lg-8">
            <label for="validationCustomUsername"><br>JENIS KELAMIN</label>
              <div class="custom-control custom-radio">
                <input <?php if ($cek==0){ echo "readonly";} ?> value="1" type="radio" class="custom-control-input" id="customControlValidation2" name="jk" required>
                <label class="custom-control-label" for="customControlValidation2">Laki-laki</label>
              </div>
              <div class="custom-control custom-radio">
                <input <?php if ($cek==0){ echo "readonly";} ?> value="0" type="radio" class="custom-control-input" id="customControlValidation3" name="jk" required>
                <label class="custom-control-label" for="customControlValidation3">Perempuan</label>
                  <div class="invalid-feedback">Pilih terlebih dahulu</div>
              </div>
          </div>
          <!-- Umur -->
          <div class="col-lg-8">
              <label for="validationCustomUsername">UMUR</label>
                <div class="input-group">
                  <input <?php if ($cek==0){ echo "readonly";} ?> placeholder="0" name="umur" type="number" max="120" min="1" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend">Tahun</span>
                  </div>
                  <div class="invalid-feedback">
                  Tolong diisi terlebih dahulu! Nilai antara 1-120
                  </div>
                </div>
          </div>
          <!-- Hipertensi -->
          <div class="col-lg-8">
            <label for="validationCustomUsername"><br>RIWAYAT PENYAKIT HIPERTENSI</label>
              <div class="custom-control custom-radio">
                <input <?php if ($cek==0){ echo "readonly";} ?> value="1" type="radio" class="custom-control-input" id="customControlValidation4" name="hipertensi" required>
                <label class="custom-control-label" for="customControlValidation4">Ya</label>
              </div>
              <div class="custom-control custom-radio">
                <input <?php if ($cek==0){ echo "readonly";} ?> value="0" type="radio" class="custom-control-input" id="customControlValidation5" name="hipertensi" required>
                <label class="custom-control-label" for="customControlValidation5">Tidak</label>
                  <div class="invalid-feedback">Pilih terlebih dahulu</div>
              </div>
          </div>
          <!-- Jantung -->
          <div class="col-lg-8">
            <label for="validationCustomUsername"><br>RIWAYAT PENYAKIT JANTUNG</label>
              <div class="custom-control custom-radio">
                <input <?php if ($cek==0){ echo "readonly";} ?> value="1" type="radio" class="custom-control-input" id="customControlValidation6" name="jantung" required>
                <label class="custom-control-label" for="customControlValidation6">Ya</label>
              </div>
              <div class="custom-control custom-radio">
                <input <?php if ($cek==0){ echo "readonly";} ?>  value="0" type="radio" class="custom-control-input" id="customControlValidation7" name="jantung" required>
                <label class="custom-control-label" for="customControlValidation7">Tidak</label>
                  <div class="invalid-feedback">Pilih terlebih dahulu</div>
              </div>
          </div>
          <!-- Status Menikah -->
          <div class="col-lg-8">
            <label for="validationCustomUsername"><br>STATUS MENIKAH</label>
              <div class="custom-control custom-radio">
                <input <?php if ($cek==0){ echo "readonly";} ?> value="1" type="radio" class="custom-control-input" id="customControlValidation8" name="nikah" required>
                <label class="custom-control-label" for="customControlValidation8">Ya</label>
              </div>
              <div class="custom-control custom-radio">
                <input <?php if ($cek==0){ echo "readonly";} ?> value="0" type="radio" class="custom-control-input" id="customControlValidation9" name="nikah" required>
                <label class="custom-control-label" for="customControlValidation9">Tidak</label>
                  <div class="invalid-feedback">Pilih terlebih dahulu</div>
              </div>
          </div>
          <!-- Kandungan Gula -->
          <div class="col-lg-8">
              <label for="validationCustomUsername">KADAR GULA ( Setelah Makan )</label>
                <div class="input-group">
                  <input <?php if ($cek==0){ echo "readonly";} ?> placeholder="0" name="gula" type="number" step="0.01" max="500" min="1" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend">mg/dL</span>
                  </div>
                  <div class="invalid-feedback">
                  Tolong diisi terlebih dahulu! Nilai minimal 1
                  </div>
                </div>
          </div>
          <!-- BMI -->
          <div class="col-lg-8">
              <label for="validationCustomUsername">BODY MASS INDEX</label>
                <div class="input-group">
                  <input <?php if ($cek==0){ echo "readonly";} ?> placeholder="0" name="bmi" type="number" step="0.01" max="500" min="1" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend">KG</span>
                  </div>
                  <div class="invalid-feedback">
                  Tolong diisi terlebih dahulu! Nilai minimal 1
                  </div>
                </div>
          </div>
          <!-- Jenis Pekerjaan -->
          <div class="col-lg-8">
              <label for="validationCustom04">JENIS PEKERJAAN</label>
                <select name="kerja" class="custom-select" id="validationCustom04" required>
                  <option selected disabled value="">Choose...</option>
                  <option <?php if ($cek==0){ echo "disabled";} ?> value="1">Private</option>
                  <option <?php if ($cek==0){ echo "disabled";} ?> value="2">Self-Employed</option>
                  <option <?php if ($cek==0){ echo "disabled";} ?> value="3">Gov_Job</option>
                  <option <?php if ($cek==0){ echo "disabled";} ?> value="4">Children</option>
                </select>
              <div class="invalid-feedback">
                Tolong dipilih terlebih dahulu!
              </div>
          </div>
          <!-- Tempat Tinggal -->
          <div class="col-lg-8">
              <label for="validationCustom04">TEMPAT TINGGAL</label>
                <select name="tinggal" class="custom-select" id="validationCustom04" required>
                  <option selected disabled value="">Choose...</option>
                  <option <?php if ($cek==0){ echo "disabled";} ?> value="2">KOTA</option>
                  <option <?php if ($cek==0){ echo "disabled";} ?> value="1">DESA</option>
                </select>
              <div class="invalid-feedback">
                Tolong dipilih terlebih dahulu!
              </div>
          </div>
          <!-- Status Merokok -->
          <div class="col-lg-8">
              <label for="validationCustom04">STATUS MEROKOK</label>
                <select name="rokok" class="custom-select" id="validationCustom04" required>
                  <option selected disabled value="">Choose...</option>
                  <option <?php if ($cek==0){ echo "disabled";} ?> value="1">Tidak Merokok</option>
                  <option <?php if ($cek==0){ echo "disabled";} ?> value="2">Kadang Merokok</option>
                  <option <?php if ($cek==0){ echo "disabled";} ?> value="3">Sering Merokok</option>
                </select>
              <div class="invalid-feedback">
                Tolong dipilih terlebih dahulu!
              </div>
          </div>
        <!-- Tempat Tinggal -->
        <div class="col-lg-8">
              <label for="validationCustom04">KONDISI SEBENARNYA</label>
                <select name="class" class="custom-select" id="validationCustom04" required>
                  <option selected disabled value="">Choose...</option>
                  <option <?php if ($cek==0){ echo "disabled";} ?> value="1">STROKE</option>
                  <option <?php if ($cek==0){ echo "disabled";} ?> value="0">TIDAK STROKE</option>
                </select>
              <div class="invalid-feedback">
                Tolong dipilih terlebih dahulu!
              </div>
          </div>
        </div>
        <div class="row justify-content-center" <?php if ($cek==0){ echo "hidden";} ?>>
            <button name="cek" id="cek" class="btn btn-primary tombol" type="submit">Cek Data</button>
        </div>
        </form>
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

<!-- End Form -->

<!-- Footer -->
<div class="container">
  <div class="row footer">
    <div class="col text-center">
      <a href="login.php">You're Admin?</a>
      <p>Copyright &copy; 2019 <strong><a href="#">Deictum</a>.</strong> All rights
    reserved.</p>
    </div>
  </div>
</div>
<!-- End Footer -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!-- Toastr -->
    <script src="assets/plugins/toastr/toastr.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>