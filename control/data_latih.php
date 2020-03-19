<?php
class datalatih{

    //fungsi untuk menghapus daya
    function kosong(){
        include('koneksi.php');
        $del = $koneksi->prepare("DELETE FROM data_latih") or die ("Gagal Membersihkan");
        $del->execute();
    }

}

class datalatih2{
        //Fungsi untuk menampilkan semua data
    function all(){
        include('koneksi.php');
        $all = $koneksi->prepare("SELECT * FROM data_latih");
        $all->execute();
        $alls = $all->fetchALL(PDO::FETCH_ASSOC);
        return $alls;
    }

     //banyak data uji
     function total(){
        include('koneksi.php');
        $tot = $koneksi->prepare("SELECT * FROM data_latih");
        $tot->execute();
        $tots=$tot->rowCount();
        return $tots;
    }

    function showlakistr(){
        include('koneksi.php');
        $lk = $koneksi->prepare("SELECT j_kelamin FROM data_latih WHERE j_kelamin=1 AND class=1");
        $lk->execute();
        $lks = $lk->rowCount();
        return $alls;
    }

    function showperemstr(){
        include('koneksi.php');
        $perem = $koneksi->prepare("SELECT j_kelamin FROM data_latih WHERE j_kelamin=0 AND class=1");
        $perem->execute();
        $perems = $perem->rowCount();
        return $perems;
    }

    function showstroke(){
        include('koneksi.php');
        $str = $koneksi->prepare("SELECT umur FROM data_latih WHERE class=1");
        $str->execute();
        $strs = $str->rowCount();
        return $strs;
    }

    function shownostroke(){
        include('koneksi.php');
        $nstr = $koneksi->prepare("SELECT umur FROM data_latih WHERE class=0");
        $nstr->execute();
        $nstrs = $nstr->rowCount();
        return $nstrs;
    }

    function showlakinostr(){
        include('koneksi.php');
        $lk = $koneksi->prepare("SELECT j_kelamin FROM data_latih WHERE j_kelamin=1 AND class=0");
        $lk->execute();
        $lks = $lk->rowCount();
        return $alls;
    }

    function showperemnostr(){
        include('koneksi.php');
        $perem = $koneksi->prepare("SELECT j_kelamin FROM data_latih WHERE j_kelamin=0 AND class=0");
        $perem->execute();
        $perems = $perem->rowCount();
        return $perems;
    }
}

class datalatih3{
    
    //memasukkan data latih ke database
    function masuk($jk,$umur,$gula,$bmi,$hiper,$jantung,$merokok,$tinggal,$kerja,$nikah,$kls){
        include('koneksi.php');
        $inp = $koneksi->prepare("INSERT INTO data_latih(j_kelamin,umur,hipertensi,jantung,gula,bmi,merokok,nikah,kerja,tinggal,class) VALUES (:jk,:usia,:hip,:jan,:gul,:bm,:rokok,:nkh,:krj,:tgl,:kls)");
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
        $inp->BindParam(":kls",$kls,PDO::PARAM_INT);
        $inp->execute();
    }

    //mengecek data sebelum import
    function cekdata($umur,$jk,$kerja,$hiper,$jantung,$tinggal,$merokok,$nikah,$bmi,$gula){
        include('koneksi.php');
        $cek = $koneksi->prepare("SELECT j_kelamin FROM data_latih WHERE umur=:usia AND j_kelamin=:jk AND kerja=:krj AND hipertensi=:hip AND jantung=:jan AND tinggal=:tgl AND merokok=:rokok AND nikah=:nkh AND bmi=:bm AND gula=:gul");
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
        $ceks = $cek->rowCount();
        return $ceks;
    }

    function update($jk,$umur,$gula,$bmi,$hiper,$jantung,$merokok,$tinggal,$kerja,$nikah,$date){
        include('koneksi.php');
        $upd = $koneksi->prepare("UPDATE data_latih SET hipertensi=:hip, jantung=:jan, merokok=:rokok, date=:dt, nikah=:nkh, kerja=:krj, tinggal=:tgl WHERE j_kelamin=:jk AND umur=:usia AND gula=:gul AND bmi=:bm");
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

}
?>