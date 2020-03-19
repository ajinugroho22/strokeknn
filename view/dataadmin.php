<?php
session_start();
if ($_SESSION['login']!="admin") {
  header('Location: ../login.php');
exit;
}

include'../control/data_admin.php';
$da = new dataadmin();
if(isset($_POST['hapus'])){
  $user=$_POST['us'];
  if($_SESSION['username']!=$user){
    $hsl=$da->delete($user);
    if($hsl==1){
      header('Location: dataadmin.php');
    }
  }
  else{
    header('Location: dataadmin.php');
  }
  
}
?>
<script type="text/javascript">
    function deladm(username) {
        $("#us").val(username);
        $("#user").text(username);
        $('#modal_hapus').modal('show'); 
  }
</script>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Deictum | Data Admin</title>
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

  <!-- Modal Hapus -->
  <div class="modal fade" id="modal-hapus">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-warning">
              <h4 class="modal-title"><span></span>Hapus</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <p>Anda Yakin ingin hapus data <b><a id="user"></a></b></p>
              <div class="row">
                 <div hidden="false" class="col-md-6">
                    <div class="md-input-wrapper">
                        <input name="us" id="us" type="text" class="md-form-control  md-static" />
                        <label>ID</label>
                    </div>
                  </div>
              </div> 
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
              <button type="submit" id="hapus" name="hapus" class="btn btn-warning">Ya</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  <!-- / Modal Hapus -->

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
                <a href="datauji.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Uji</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="dataadmin.php" class="nav-link active">
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
            <h1>Data Admin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a class="text-cyan" href="../dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Data Admin</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title right">
                  <a href="tambahadmin.php"><button class="btn btn-info"><i class="nav-icon fas fa-plus"></i> Tambah</button></a>
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped table-responsive-lg">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    $no=1;
                    $tampil = $da->all();
                    if(!empty($tampil)){
                        foreach ($tampil as $key) {
                            
                    ?>
                <tr>
                  <td><?= $no ?></td>
                  <td><?= $key['username'] ?></td>
                  <td><?= md5($key['password']) ?></td>
                  <td><button <?php if ($_SESSION['username']==$key['username']) { echo "hidden"; } ?> data-toggle="modal" onclick="deladm('<?= $key['username'] ?>')" data-target="#modal-hapus" id="del" name="del" class="btn btn-danger"><i class="nav-icon fas fa-trash"></i></button></td>
                </tr>
                <?php
                $no++;
                        }
                    }
                    else{
                    echo '
                    <tr>
                      <td colspan=10>
                          Data Tidak Ada
                      </td>
                    </tr>
                      ';
                    }
                ?>
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
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  <footer class="main-footer">
  Copyright &copy; 2019 <strong><a class="text-cyan" href="dashboard.php">Deictum</a>.</strong> All rights
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
<!-- DataTables -->
<script src="../assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="../assets/js/adminlte.min.js"></script>
<!-- overlayScrollbars -->
<script src="../assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../assets/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
    });
  });
</script>
</body>
</html>
