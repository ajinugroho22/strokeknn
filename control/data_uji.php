<?php
class datauji{
    
    //Fungsi untuk mencari data
    function view($id){
        include('koneksi.php');
        $view = $koneksi->prepare("SELECT * FROM data_uji WHERE no=:key");
        $view->BindParam(":key",$id,PDO::PARAM_INT);
        $view->execute();
        $views=$view->rowCount();
        return $views;
    }

    //Fungsi untuk menampilkan semua data
    function all(){
        include('koneksi.php');
        $all = $koneksi->prepare("SELECT * FROM data_uji");
        $all->execute();
        $alls = $all->fetchALL(PDO::FETCH_ASSOC);
        return $alls;
    }

    //fungsi untuk menghapus daya
    function delete($id){
        include('koneksi.php');
        $del = $koneksi->prepare("DELETE FROM data_uji WHERE no=:key");
        $del->BindParam(":key",$id,PDO::PARAM_STR);
        $del->execute();
    }

    //fungsi untuk mengedit data
    function update($jk,$umur,$gula,$bmi,$hiper,$jantung,$merokok,$tinggal,$kerja,$nikah,$date){
        include('koneksi.php');
        $upd = $koneksi->prepare("UPDATE data_uji SET hipertensi=:hip, jantung=:jan, merokok=:rokok, date=:dt, nikah=:nkh, kerja=:krj, tinggal=:tgl  WHERE j_kelamin=:jk AND umur=:usia AND gula=:gul AND bmi=:bm");
        $upd->BindParam(":jk",$jk,PDO::PARAM_INT);
        $upd->BindParam(":usia",$umur,PDO::PARAM_INT);
        $upd->BindParam(":gul",$gula,PDO::PARAM_STR);
        $upd->BindParam(":bm",$bmi,PDO::PARAM_STR);
        $upd->BindParam(":hip",$hiper,PDO::PARAM_INT);
        $upd->BindParam(":jan",$jantung,PDO::PARAM_INT);
        $upd->BindParam(":rokok",$merokok,PDO::PARAM_INT);
        $upd->BindParam(":tgl",$tinggal,PDO::PARAM_INT);
        $upd->BindParam(":krj",$kerja,PDO::PARAM_INT);
        $upd->BindParam(":nkh",$nikah,PDO::PARAM_INT);
        $upd->BindParam(":dt",$date,PDO::PARAM_STR);
        $upd->execute();
    }

    //mengecek data sebelum import
    function cekdata($umur,$jk,$kerja,$hiper,$jantung,$tinggal,$merokok,$nikah,$bmi,$gula){
        include('koneksi.php');
        $cek = $koneksi->prepare("SELECT COUNT(*) AS jml FROM data_uji WHERE umur=:usia AND j_kelamin=:jk AND kerja=:krj AND hipertensi=:hip AND jantung=:jan AND tinggal=:tgl AND merokok=:rokok AND nikah=:nkh AND bmi=:bm AND gula=:gul");
        $cek->BindParam(":jk",$jk,PDO::PARAM_INT);
        $cek->BindParam(":usia",$umur,PDO::PARAM_INT);
        $cek->BindParam(":krj",$kerja,PDO::PARAM_STR);
        $cek->BindParam(":hip",$hiper,PDO::PARAM_INT);
        $cek->BindParam(":jan",$jantung,PDO::PARAM_INT);
        $cek->BindParam(":tgl",$tinggal,PDO::PARAM_INT);
        $cek->BindParam(":rokok",$merokok,PDO::PARAM_INT);
        $cek->BindParam(":nkh",$nikah,PDO::PARAM_INT);
        $cek->BindParam(":bm",$bmi,PDO::PARAM_STR);
        $cek->BindParam(":gul",$gula,PDO::PARAM_STR);
        $cek->execute();
        $ceks=$cek->fetchALL(PDO::FETCH_ASSOC);
        foreach ($ceks as $kye) {
            $a = $kye['jml'];
        }
        return $a;
    }

    //fungis untuk memasukkan data
    function masuk($jk,$umur,$gula,$bmi,$hiper,$jantung,$merokok,$tinggal,$kerja,$nikah,$date,$kls){
        include('koneksi.php');
        $inp = $koneksi->prepare("INSERT INTO data_uji (j_kelamin,umur,hipertensi,jantung,gula,bmi,merokok,nikah,kerja,tinggal,date,class) VALUES (:jk,:usia,:hip,:jan,:gul,:bm,:rokok,:nkh,:krj,:tgl,:dt,:kls)");
        $inp->BindParam(":jk",$jk,PDO::PARAM_INT);
        $inp->BindParam(":usia",$umur,PDO::PARAM_INT);
        $inp->BindParam(":gul",$gula,PDO::PARAM_STR);
        $inp->BindParam(":bm",$bmi,PDO::PARAM_STR);
        $inp->BindParam(":hip",$hiper,PDO::PARAM_INT);
        $inp->BindParam(":jan",$jantung,PDO::PARAM_INT);
        $inp->BindParam(":rokok",$merokok,PDO::PARAM_INT);
        $inp->BindParam(":tgl",$tinggal,PDO::PARAM_INT);
        $inp->BindParam(":krj",$kerja,PDO::PARAM_INT);
        $inp->BindParam(":nkh",$nikah,PDO::PARAM_INT);
        $inp->BindParam(":dt",$date,PDO::PARAM_STR);
        $inp->BindParam(":kls",$kls,PDO::PARAM_INT);
        $inp->execute();
    }

    //banyak data uji
    function total(){
        include('koneksi.php');
        $tot = $koneksi->prepare("SELECT * FROM data_uji");
        $tot->execute();
        $tots=$tot->rowCount();
        return $tots;
    }

    function kosong(){
        include('koneksi.php');
        $del = $koneksi->prepare("DELETE FROM data_uji") or die ("Gagal Membersihkan");
        $del->execute();
    }

    function showlakistr(){
        include('koneksi.php');
        $lk = $koneksi->prepare("SELECT j_kelamin FROM data_uji WHERE j_kelamin=1 AND class=1");
        $lk->execute();
        $lks = $lk->rowCount();
        return $alls;
    }

    function showperemstr(){
        include('koneksi.php');
        $perem = $koneksi->prepare("SELECT j_kelamin FROM data_uji WHERE j_kelamin=0 AND class=1");
        $perem->execute();
        $perems = $perem->rowCount();
        return $perems;
    }

    function showstroke(){
        include('koneksi.php');
        $str = $koneksi->prepare("SELECT umur FROM data_uji WHERE class=1");
        $str->execute();
        $strs = $str->rowCount();
        return $strs;
    }

    function shownostroke(){
        include('koneksi.php');
        $nstr = $koneksi->prepare("SELECT umur FROM data_uji WHERE class=0");
        $nstr->execute();
        $nstrs = $nstr->rowCount();
        return $nstrs;
    }

    function showlakinostr(){
        include('koneksi.php');
        $lk = $koneksi->prepare("SELECT j_kelamin FROM data_uji WHERE j_kelamin=1 AND class=0");
        $lk->execute();
        $lks = $lk->rowCount();
        return $alls;
    }

    function showperemnostr(){
        include('koneksi.php');
        $perem = $koneksi->prepare("SELECT j_kelamin FROM data_uji WHERE j_kelamin=0 AND class=0");
        $perem->execute();
        $perems = $perem->rowCount();
        return $perems;
    }

}
