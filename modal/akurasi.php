<?php
class akurasi{

    //hapus
    function hapus(){
        include('koneksi.php');
        $dele = $koneksi->prepare("DELETE FROM akurasi");
        $dele->execute();
    }

    //hitung akurasi KNN
    function hitungknn($k){
        $hasil=0.0;
        $ak = new akurasi();
        $ntp = $ak->caritpknn($k);
        $nfp = $ak->carifpknn($k);
        $nfn = $ak->carifnknn($k);
        $ntn = $ak->caritnknn($k);
        $hasil=(($ntp+$ntn)/($ntp+$nfp+$nfn+$ntn))*100;
        return $hasil;
    }

     //hitung akurasi Fuzzy
     function hitungF($k){
        $hasil=0.0;
        $ak = new akurasi();
        $ntp = $ak->caritpF($k);
        $nfp = $ak->carifpF($k);
        $nfn = $ak->carifnF($k);
        $ntn = $ak->caritnF($k);
        $hasil=(($ntp+$ntn)/($ntp+$nfp+$nfn+$ntn))*100;
        return $hasil;
    }

     //hitung akurasi KNN
     function hitungW($k){
        $hasil=0.0;
        $ak = new akurasi();
        $ntp = $ak->caritpW($k);
        $nfp = $ak->carifpW($k);
        $nfn = $ak->carifnW($k);
        $ntn = $ak->caritnW($k);
        $hasil=(($ntp+$ntn)/($ntp+$nfp+$nfn+$ntn))*100;
        return $hasil;
    }
   //------------------------------//
   function masukawal($k){
    include('koneksi.php');
    $mk = $koneksi->prepare("INSERT INTO akurasi(k) VALUES (:k)");
    $mk->BindParam(":k",$k,PDO::PARAM_INT);
    $mk->execute();
}
    function masukknn($k,$hasil){
        include('koneksi.php');
        $mk = $koneksi->prepare("UPDATE akurasi SET akurasiknn=:knn WHERE k=:k");
        $mk->BindParam(":knn",$hasil,PDO::PARAM_STR);
        $mk->BindParam(":k",$k,PDO::PARAM_INT);
        $mk->execute();
    }
    function masukF($k,$hasil){
        include('koneksi.php');
        $mf = $koneksi->prepare("UPDATE akurasi SET akurasiF=:fuzzy WHERE k=:k");
        $mf->BindParam(":fuzzy",$hasil,PDO::PARAM_STR);
        $mf->BindParam(":k",$k,PDO::PARAM_INT);
        $mf->execute();
    }
    function masukW($k,$hasil){
        include('koneksi.php');
        $mw = $koneksi->prepare("UPDATE akurasi SET akurasiW=:weighted WHERE k=:k");
        $mw->BindParam(":weighted",$hasil,PDO::PARAM_STR);
        $mw->BindParam(":k",$k,PDO::PARAM_INT);
        $mw->execute();
    }
   //------------------------------//
    //Mencari nilai True Positif
    function caritpknn($te){
        include('koneksi.php');
        $tp = $koneksi->prepare("SELECT COUNT(*) AS jml FROM prediksi WHERE k=:te AND knn=1 AND class=1");
        $tp->BindParam(":te",$te,PDO::PARAM_INT);
        $tp->execute();
        $tps=$tp->fetchALL(PDO::FETCH_ASSOC);
        foreach ($tps as $kye) {
            $a = $kye['jml'];
        }
        return $a;
    }
    //Mencari nilai False Positif
    function carifpknn($te){
        include('koneksi.php');
        $fp = $koneksi->prepare("SELECT COUNT(*) AS jml FROM prediksi WHERE k=:te AND knn=0 AND class=1");
        $fp->BindParam(":te",$te,PDO::PARAM_INT);
        $fp->execute();
        $fps=$fp->fetchALL(PDO::FETCH_ASSOC);
        foreach ($fps as $kye) {
            $a = $kye['jml'];
        }
        return $a;
    }
    //Mencari nilai False Negatif
    function carifnknn($te){
        include('koneksi.php');
        $fn = $koneksi->prepare("SELECT COUNT(*) AS jml FROM prediksi WHERE k=:te AND knn=1 AND class=0");
        $fn->BindParam(":te",$te,PDO::PARAM_INT);
        $fn->execute();
        $fns=$fn->fetchALL(PDO::FETCH_ASSOC);
        foreach ($fns as $kye) {
            $a = $kye['jml'];
        }
        return $a;
    }
    //Mencari nilai True Negatif
    function caritnknn($te){
        include('koneksi.php');
        $tn = $koneksi->prepare("SELECT COUNT(*) AS jml FROM prediksi WHERE k=:te AND knn=0 AND class=0");
        $tn->BindParam(":te",$te,PDO::PARAM_INT);
        $tn->execute();
        $tns=$tn->fetchALL(PDO::FETCH_ASSOC);
        foreach ($tns as $kye) {
            $a = $kye['jml'];
        }
        return $a;
    }
    //------------------------------------------//
    //Mencari nilai True Positif
    function caritpF($te){
        include('koneksi.php');
        $tp = $koneksi->prepare("SELECT COUNT(*) AS jml FROM prediksi WHERE k=:te AND fuzzy=1 AND class=1");
        $tp->BindParam(":te",$te,PDO::PARAM_INT);
        $tp->execute();
        $tps=$tp->fetchALL(PDO::FETCH_ASSOC);
        foreach ($tps as $kye) {
            $a = $kye['jml'];
        }
        return $a;
    }
    //Mencari nilai False Positif
    function carifpF($te){
        include('koneksi.php');
        $fp = $koneksi->prepare("SELECT COUNT(*) AS jml FROM prediksi WHERE k=:te AND fuzzy=0 AND class=1");
        $fp->BindParam(":te",$te,PDO::PARAM_INT);
        $fp->execute();
        $fps=$fp->fetchALL(PDO::FETCH_ASSOC);
        foreach ($fps as $kye) {
            $a = $kye['jml'];
        }
        return $a;
    }
    //Mencari nilai False Negatif
    function carifnF($te){
        include('koneksi.php');
        $fn = $koneksi->prepare("SELECT COUNT(*) AS jml FROM prediksi WHERE k=:te AND fuzzy=1 AND class=0");
        $fn->BindParam(":te",$te,PDO::PARAM_INT);
        $fn->execute();
        $fns=$fn->fetchALL(PDO::FETCH_ASSOC);
        foreach ($fns as $kye) {
            $a = $kye['jml'];
        }
        return $a;
    }
    //Mencari nilai True Negatif
    function caritnF($te){
        include('koneksi.php');
        $tn = $koneksi->prepare("SELECT COUNT(*) AS jml FROM prediksi WHERE k=:te AND fuzzy=0 AND class=0");
        $tn->BindParam(":te",$te,PDO::PARAM_INT);
        $tn->execute();
        $tns=$tn->fetchALL(PDO::FETCH_ASSOC);
        foreach ($tns as $kye) {
            $a = $kye['jml'];
        }
        return $a;
    }
    //-----------------------------//
//Mencari nilai True Positif
function caritpW($te){
    include('koneksi.php');
    $tp = $koneksi->prepare("SELECT COUNT(*) AS jml FROM prediksi WHERE k=:te AND weigted=1 AND class=1");
    $tp->BindParam(":te",$te,PDO::PARAM_INT);
    $tp->execute();
    $tps=$tp->fetchALL(PDO::FETCH_ASSOC);
    foreach ($tps as $kye) {
        $a = $kye['jml'];
    }
    return $a;
}
//Mencari nilai False Positif
function carifpW($te){
    include('koneksi.php');
    $fp = $koneksi->prepare("SELECT COUNT(*) AS jml FROM prediksi WHERE k=:te AND weigted=0 AND class=1");
    $fp->BindParam(":te",$te,PDO::PARAM_INT);
    $fp->execute();
    $fps=$fp->fetchALL(PDO::FETCH_ASSOC);
    foreach ($fps as $kye) {
        $a = $kye['jml'];
    }
    return $a;
}
//Mencari nilai False Negatif
function carifnW($te){
    include('koneksi.php');
    $fn = $koneksi->prepare("SELECT COUNT(*) AS jml FROM prediksi WHERE k=:te AND weigted=1 AND class=0");
    $fn->BindParam(":te",$te,PDO::PARAM_INT);
    $fn->execute();
    $fns=$fn->fetchALL(PDO::FETCH_ASSOC);
    foreach ($fns as $kye) {
        $a = $kye['jml'];
    }
    return $a;
}
//Mencari nilai True Negatif
function caritnW($te){
    include('koneksi.php');
    $tn = $koneksi->prepare("SELECT COUNT(*) AS jml FROM prediksi WHERE k=:te AND weigted=0 AND class=0");
    $tn->BindParam(":te",$te,PDO::PARAM_INT);
    $tn->execute();
    $tns=$tn->fetchALL(PDO::FETCH_ASSOC);
    foreach ($tns as $kye) {
        $a = $kye['jml'];
    }
    return $a;
}

}
?>